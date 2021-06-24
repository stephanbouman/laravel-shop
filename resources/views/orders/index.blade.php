@extends('layouts.app')

@section('content')
    <x-page-header>Bestellingen</x-page-header>

    @foreach($orders as $order)
        <div class="mb-2 pb-2 border-b border-gray-200">
            <a href="{{ route('orders.show',$order) }}" class="text-blue-600">
                {{ $order->id }}
            </a>
            {{ $order->total_price }}
            {{ $order->status }}
        </div>
    @endforeach

@endsection
