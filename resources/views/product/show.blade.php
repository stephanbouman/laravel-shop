@extends('layouts.app')

@section('content')

    <div class="flex space-x-6 pt-4 justify-between">
        <div class="w-auto">

            <x-page-header>{{ $product->name }}</x-page-header>
            <dl>
                <dt>Prijs:</dt>
                <dd>&euro; {{ $product->price }}</dd>
            </dl>
            <ul>
                @foreach($product->advantages as $advantage)
                    <li class="flex space-x-2 mb-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-green-500"  viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-11a1 1 0 10-2 0v2H7a1 1 0 100 2h2v2a1 1 0 102 0v-2h2a1 1 0 100-2h-2V7z" clip-rule="evenodd" />
                        </svg>
                        <span>
                    {{ $advantage->content }}
                </span>
                    </li>
                @endforeach
                @foreach($product->disadvantages as $disadvantage)
                    <li class="flex space-x-2 mb-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-red-400" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM7 9a1 1 0 000 2h6a1 1 0 100-2H7z" clip-rule="evenodd" />
                        </svg>
                        <span>
                    {{ $disadvantage->content }}
                </span>
                    </li>
                @endforeach
            </ul>
        </div>
        <div class="w-1/3">
            <div class="shadow-2xl bg-white p-10 rounded-xl">
                <form method="post" action="{{ route('cart.add') }}" class="flex space-x-2 w-full">
                    {{ csrf_field() }}
                    <input type="hidden" name="product_id" value="{{ $product->id }}"/>
                    <input type="number" name="quantity" value="1" class="border border-gray-200 py-3 px-3"/>
                    <button class="bg-green-500 hover:bg-green-600 text-white px-6 py-3">toevoegen</button>
                </form>
            </div>
        </div>
    </div>

@endsection
