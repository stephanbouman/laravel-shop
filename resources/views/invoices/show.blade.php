<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta
        name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0"
    >
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <title>Bestelling #{{ $order->id }}</title>
</head>
<body>
<h1 class="text-3xl mb-10">Factuur</h1>
<div class="flex flex-wrap mb-10">
    <div class="w-1/3">
        <dl>
            <dt class="text-xs text-gray-600">Factuurnummer:</dt>
            <dd>{{ $order->id }}</dd>
            <dt class="text-xs text-gray-600">Besteldatum:</dt>
            <dd>{{ $order->created_at->format('d-m-Y H:i') }}</dd>
        </dl>
    </div>
    <div class="w-1/3">
        <dl>
            <dt class="text-xs text-gray-600">Email:</dt>
            <dd>{{ $order->email }}</dd>
        </dl>
    </div>

    <div class="w-1/3">
        <dl>
            <dt class="text-xs text-gray-600">Status:</dt>
            <dd>
                @if($order->is_open)
                    open <a href="#">betaal</a>
                @endif
                @if($order->is_paid)
                    betaald
                @endif
            </dd>
        </dl>
    </div>
</div>

<div class="flex flex-wrap mb-2 pb-2 border-b border-gray-300 text-gray-500">
    <div class="w-1/2">Product</div>
    <div class="w-1/6 text-right">Stuksprijs</div>
    <div class="w-1/6 text-right">Aantal</div>
    <div class="w-1/6 text-right">Subtotaal</div>
</div>
@foreach($order->orderlines as $orderLine)
    <div class="mb-2 pb-2 border-b border-gray-200 flex-wrap flex">
        <div class="w-1/2">
            {{ $orderLine->name }}
        </div>
        <div class="w-1/6 text-right">
            @currency($orderLine->price)
        </div>
        <div class="w-1/6 text-right">
            {{ $orderLine->quantity }}
        </div>
        <div class="w-1/6 text-right">
            @currency($orderLine->price * $orderLine->quantity)
        </div>

    </div>
@endforeach
    <div class="flex flex-wrap font-semibold">
        <div class="w-2/3">Totaal</div>
        <div class="w-1/6 text-right">{{ $order->total_items }}</div>
        <div class="w-1/6 text-right">@currency($order->total_price)</div>
    </div>


</body>
</html>
