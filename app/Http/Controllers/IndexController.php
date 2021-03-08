<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TransportMode;
use App\Item;
use App\Mail\AdminNotificationMail;
use App\Mail\ClientNotificationMail;
use App\Route;
use App\Country;
use App\Traits\PaymentGateWays;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class IndexController extends Controller
{
    use PaymentGateWays;
    public function index(Request $request)
    {
        $require = "nullable";
        $requestMethod = $request->method();
        if ($requestMethod == "POST") {
            $require = "required";
        }
        $data = $request->validate([
            "weight" => "$require|string",
            "transport_mode" => "$require|string",
            "route_id" => "$require|string",
        ]);

        $countries = Country::get();
        $locations = Route::get();
        $transportModes = TransportMode::get();

        $shippingCostData = null;
        if ($requestMethod == "POST") {
            $shippingCostData = $this->calcCosts(
                $data["transport_mode"],
                $data["route_id"],
                $data["weight"]
            );
        }


        return view("index", [
            "query" => $data,
            "locations" => $locations,
            "countries" => $countries,
            "transportModes" => $transportModes,
            "shippingCostData" => $shippingCostData
        ]);
    }

    private function calcCosts($transportModeID, $locationID, $weight)
    {
        $mode = TransportMode::findorfail($transportModeID);
        $location = Route::findorfail($locationID);
        $flatRate = $location->flat_rate;
        $basePrice = $mode->base_fare;
        $pricePerKg = $mode->price_per_kg;
        $priceByWeight = $pricePerKg * $weight;
        $total = $basePrice + $flatRate + $priceByWeight;
        $tax = $total * 0.1; // 10%
        $shippingCost = $total + $tax;

        return [
            "total_price" => $total,
            "custom_tax" => $tax,
            "shipping_cost" => $shippingCost
        ];
    }

    public function proceed(Request $request)
    {
        $data = $request->validate([
            "weight" => "required|string",
            "transport_mode" => "required|string",
            "route_id" => "required|string",
            "name" => "required|string",
            "email" => "required|string",
            "phone" => "required|string",
            "description" => "required|string",
            "package_name" => "required|string",
        ]);

        $shippingCostData = $this->calcCosts(
            $data["transport_mode"],
            $data["route_id"],
            $data["weight"]
        );

        $item = Item::create([
            "sender_name" => $data["name"],
            "sender_email" => $data["email"],
            "weight" => $data["weight"],
            "trans_mode_id" => $data["transport_mode"],
            "route_id" => $data["route_id"],
            "description" => $data["description"],
            "package_name" => $data["package_name"],
            "tax" => $shippingCostData["custom_tax"],
            "price" => $shippingCostData["shipping_cost"],
            "payment_stat" => 0
        ]);

        // dd($shippingCostData);
        // dd(env("PAYSTACK_SECRET_KEY"));

        $checkoutData = [
            "amount" => $shippingCostData["shipping_cost"],
            "email" => $item->sender_email,
            "package_name" => $item->package_name,
            "item_id" => $item->id,
            "callback_url" => route("payment.verify")
        ];


        $process = $this->initializePaystack($checkoutData);
        return redirect()->away($process["authorization_url"]);

        // Start paystack stuff here
    }

    public function paymentVerify(Request $request)
    {
        DB::beginTransaction();
        try {

            $validator = Validator::make($request->all(), [
                "trxref" => 'required|string|unique:items,payment_ref',
            ]);

            if ($validator->fails()) {
                throw new ValidationException($validator);
            }

            $process = $this->verifyPaystackPayment();

            $paymentData = $process["data"];
            if ($process["status"] && $paymentData["status"] == "success") {
                $item = Item::findorfail($paymentData["metadata"]["item_id"]);
                $item->update(
                        [
                            "payment_stat" => 1,
                            "payment_ref" => $paymentData["reference"]
                        ]
                    );
                DB::commit();

                $emailData = [
                    "client_name" => $item->sender_name,
                    "client_email" => $item->sender_email,
                    "package_name" => $item->package_name,
                    "package_description" => $item->description,
                    "shipping_cost" => "$".number_format($item->price)
                ];

                Mail::to("admin@mail.com")->send(new AdminNotificationMail($emailData));
                Mail::to($emailData["client_email"])->send(new ClientNotificationMail($emailData));

                return view("payment_status",
                    [
                        "status" => true,
                        "title" => "Payment Successful",
                        "message" => "We have successfully processed your payment!"
                    ]
                );
            } else {
                // payment failed: display message to customer
                return view("payment_status",
                    [
                        "status" => false,
                        "title" => "Payment Failed",
                        "message" => "We couldn`t verify your payment. Kindly contact support with payment reference #" . $request["trxref"]
                    ]
                );
            }
        } catch (ValidationException $e) {
            DB::rollback();
            dd($e);
            return view("payment_status",
                [
                    "status" => false,
                    "title" => "Payment Failed",
                    "message" => "Payment reference already used!"
                ]
            );
        } catch (\Exception $e) {
            DB::rollback();
            dd($e);
            return view("payment_status",
                [
                    "status" => false,
                    "title" => "Payment Failed",
                    "message" => "An error occured while processing your request!"
                ]
            );
        }
    }
}
