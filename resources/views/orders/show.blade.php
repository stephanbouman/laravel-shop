@extends('layouts.app')

@section('content')
    <x-page-header>Bestelling #{{ $order->id }}</x-page-header>
    <dl>
        <dt>Email:</dt>
        <dd>{{ $order->email }}</dd>
        <dt>Besteldatum:</dt>
        <dd>{{ $order->created_at->format('d-m-Y H:i') }}</dd>
        <dt>Status:</dt>
        <dd>
            @if($order->is_open)
                open <a href="#">betaal</a>
            @endif
            @if($order->is_paid)
                betaald
            @endif
        </dd>
        <dt>Totaalprijs:</dt>
        <dd>@currency($order->totalPrice)</dd>
    </dl>
    @foreach($order->orderlines as $orderLine)
        <div class="mb-2 pb-2 border-b border-gray-200">
            <a href="{{ route('products.show',$orderLine->product) }}" class="text-blue-600">
                {{ $orderLine->name }}
            </a>
            {{ $orderLine->quantity }}
            @currency($orderLine->price)
            @currency($orderLine->price * $orderLine->quantity)
        </div>
    @endforeach

@endsection
