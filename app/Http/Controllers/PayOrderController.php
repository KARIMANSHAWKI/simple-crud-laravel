<?php

namespace App\Http\Controllers;

use App\Billing\PaymentGateway;
use App\Models\Order;
use Illuminate\Http\Request;
use App\Http\Resources\Order as OrderResource;
use App\Traits\SuccessResponse;
use Mockery;



class PayOrderController extends Controller
{
    use SuccessResponse;


    public function store(Request $request , PaymentGateway $paymentGateway)
    {
        $data = $request->all();
        $payload = $paymentGateway->charge($data['amount']);
//        dd($payload);
        $order = Order::create($payload);
        return $this->successResponse(new OrderResource($order));
    }
}
