<?php

namespace App\Http\Controllers;

use App\Billing\IPaymentGateway;
use App\Billing\PaymentGateway;
use App\Models\Order;
use Illuminate\Http\Request;
use App\Http\Resources\Order as OrderResource;
use App\Traits\SuccessResponse;
use Illuminate\Support\Facades\Cache;


/**

 * @mixin Builder
 */


class PayOrderController extends Controller
{


    use SuccessResponse;


    public function index()
    {
         dd(Cache::get('key'));
    }

    public function store(Request $request)
    {
        $paymentGateway = new PaymentGateway();
        $data = $request->all();
//        dd($data);
        $payload = $paymentGateway->charge($data['amount']);

        $order = Order::create($payload);
        dd($order);
        return $this->successResponse(new OrderResource($order));
    }
}
