<?php

namespace App\Traits;

use App\Models\Payment;
use Exception;
use Illuminate\Http\Request;

trait PaymentGateWays
{

    public function initializePaystack(array $request = ['email' => '', 'amount' => '' , 'product_name' => '' , 'product_id' => ''])
    {
        $realAmount = $request["amount"];
        $request["amount"] = $realAmount * 100;
        $request["metadata"] = json_encode($request);
        $pastackHandler = new PaystackHandler;
        $initializeProcess = $pastackHandler->initialize($request);

        $data = $initializeProcess["data"];

        return array_merge(
            [
                "public_key" => env("PAYSTACK_PUBLIC_KEY"),
                "amount" => doubleval($realAmount)
            ],
            $data
        );
    }

    public function verifyPaystackPayment(){
        $pastackHandler = new PaystackHandler;
        $initializeProcess = $pastackHandler->verify();
        return $initializeProcess;
    }
}
