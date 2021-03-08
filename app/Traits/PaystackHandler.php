<?php

namespace App\Traits;

use Exception;
use Unicodeveloper\Paystack\Paystack;

class PaystackHandler
{
    private $paystack;
    public function __construct()
    {
        $this->paystack = new Paystack;
    }

    public function initialize(array $request)
    {
        $paymentDetails = $this->paystack->getAuthorizationResponse($request);
        return $paymentDetails;
    }

    public function verify()
    {
        try {
            $paymentDetails = $this->paystack->getPaymentData();
            return $paymentDetails;
        } catch (Exception $e) {
            return [
                "status" => false,
                "message" => "Invalid transaction reference",
            ];
        }
    }
}
