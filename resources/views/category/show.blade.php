@extends('layouts.app')

@section('content')
    <x-page-header>{{ $category->name }}</x-page-header>
    <h2>Onze producten</h2>
    @foreach($category->products as $product)
        <div>
            <a href="{{ route('products.show', $product) }}">
                {{ $product->name }}
            </a>
            {{ $product->price }}

        </div>
    @endforeach
@endsection
