<?php

namespace App\Http\Controllers;

use App\Services\Cart;
use App\Models\Order;
use App\Models\Product;
use App\Services\PaymentRequest;
use App\Models\OrderLine;
use Illuminate\Database\Eloquent\Model;
use App\Http\Requests\StoreOrderRequest;
use Illuminate\Contracts\Foundation\Application as ApplicationAlias;

class OrderController extends Controller
{

    public function store(StoreOrderRequest $request)
    {
        $order = Order::create([
            'email' => $request->email,
        ]);

        $orderLines = Cart::load()->getItems();
        $orderLines = $orderLines->map(function ($cartItem) {
            $product = Product::find($cartItem['id']);

            $orderLine             = new OrderLine();
            $orderLine->name       = $product->name;
            $orderLine->price      = $product->price;
            $orderLine->quantity   = $cartItem['quantity'];
            $orderLine->product_id = $product->id;

            return $orderLine;
        });

        Cart::clear();

        $order->orderlines()->saveMany($orderLines);

        $paymentRequest = PaymentRequest::forOrder($order);

        $order->savePaymentId($paymentRequest->id);

        return redirect($paymentRequest->getCheckoutUrl());


    }

    public function show(Order $order)
    {
        return view('orders.show', compact('order'));
    }


    public function index()
    {
        $orders = Order::all();

        return view('orders.index', compact('orders'));
    }

}
