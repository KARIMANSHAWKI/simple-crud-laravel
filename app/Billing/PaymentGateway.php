<?php

namespace App\Billing;

class PaymentGateway implements IPaymentGateway
{
/*    private $currency;

    public function __construct($currency)
    {
        $this->currency = $currency;
    }*/

    public function charge($amount)
    {
        return [
            'amount' => $amount,
            //'currency' => $this->currency
        ];
    }
}