@extends('layouts.app')

@section('content')

    <x-page-header>{{ $product->name }}</x-page-header>
    <dl>
        <dt>Prijs:</dt>
        <dd>&euro; {{ $product->price }}</dd>
    </dl>
    <form method="post" action="{{ route('cart.add') }}">
        {{ csrf_field() }}
        <input type="hidden" name="product_id" value="{{ $product->id }}"/>
        <input type="number" name="quantity" value="1"/>
        <button>add</button>
    </form>
@endsection
