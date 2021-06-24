<?php


namespace App\Services;


use App\Models\Order;

class PaymentRequest
{

    public function __construct()
    {
        //
    }

    public static function forOrder(Order $order)
    {
        return resolve('mollie')->payments->create([
            "amount"      => [
                "currency" => "EUR",
                "value"    => (string)$order->total_price,
            ],
            "description" => "Order #" . $order->id,
            "redirectUrl" => route('orders.show',$order),
            "webhookUrl"  => route('payment.update'),
        ]);

    }


}
