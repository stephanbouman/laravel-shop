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

        @foreach($cart['items'] as $cartItem)
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
            <td>{{ $cart['quantity'] }}</td>
            <td>{{ $cart['totalPrice'] }}</td>
            <td>&nbsp;</td>
        </tr>
        </tfoot>
    </table>


@endsection
