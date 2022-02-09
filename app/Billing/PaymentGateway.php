<?php

namespace App\Billing;

class PaymentGateway
{
    public function charge($amount)
    {
//        sleep(3);

        return [
            'amount' => $amount];
    }
}