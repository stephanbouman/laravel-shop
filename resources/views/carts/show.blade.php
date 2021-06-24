@extends('layouts.app')

@section('content')
    <x-page-header>Winkelwagen</x-page-header>

    <table border="1">
        <thead>
        <tr>
            <th>Product</th>
            <th>Qty</th>
            <th>Price</th>
            <th>Total</th>
            <th>&nbsp;</th>
        </tr>
        </thead>
        <tbody>

        @foreach($cart->getItems() as $cartItem)
            <tr>
                <td>
                    <a
                        href="{{ route('products.show', $cartItem['id']) }}"
                        title="{{ $cartItem['name'] }}"
                    >
                        {{ $cartItem['name'] }}
                    </a>
                </td>
                <td>{{ $cartItem['price'] }}</td>
                <td>{{ $cartItem['quantity'] }}</td>
                <td>{{ $cartItem['total'] }}</td>
                <td>
                    <form method="post" action="{{route('cart.delete')}}">
                        {{ csrf_field() }}
                        @method('delete')
                        <input type="hidden" name="product_id" value="{{ $cartItem['id'] }}"/>
                        <button>delete</button>
                    </form>

                </td>
            </tr>
        @endforeach
        </tbody>
        <tfoot>
        <tr>
            <td>Totals</td>
            <td>&nbsp;</td>
            <td>{{ $cart->getTotalQuantity() }}</td>
            <td>{{ $cart->getTotalPrice()}}</td>
            <td>&nbsp;</td>
        </tr>
        </tfoot>
    </table>
    <form class="bg-gray-100 p-4" method="post" action="{{ route('orders.store') }}">
        @csrf
        <label for="email">Email:</label>
        <input type="email" name="email" id="email"/>
        <button class="bg-green-500 px-3 py-2 rounded-lg text-white">Afrekenen</button>
    </form>

@endsection
