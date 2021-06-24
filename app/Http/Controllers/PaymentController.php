<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Mollie\Api\MollieApiClient;
use App\Http\Requests\UpdatePaymentRequest;

class PaymentController extends Controller
{
    public function update(UpdatePaymentRequest $request)
    {
        $payment = resolve('mollie')->payments->get($request->id);

        if (! $payment->isPaid()) {
            response('accepted');
        }

        $order = Order::wherePaymentId($request->id)->firstOrFail();

        if ($payment->amount->value != $order->total_price) {
            // some hacking was done...
        }

        $order->update(['status' => 'paid']);


    }
}
