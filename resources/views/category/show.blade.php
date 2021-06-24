@extends('layouts.app')

@section('content')
    <x-page-header>{{ $category->name }}</x-page-header>
    <div class="grid grid-cols-4 gap-3">
        @foreach($category->products as $product)
            <div class="shadow-2xl">
                <a href="{{ route('products.show', $product) }}">
                    {{ $product->name }}
                </a>
                @currency($product->price)
            </div>
        @endforeach

    </div>
@endsection
