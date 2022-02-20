<?php

namespace App\Billing;

interface IPaymentGateway
{
    public function charge($amount);
}