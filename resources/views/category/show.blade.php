<h1>{{ $category->name }}</h1>
<h2>Onze producten</h2>
@foreach($category->products as $product)
    <div>
        <a href="{{ route('products.show', $product) }}">
            {{ $product->name }}
        </a>
        {{ $product->price }}

    </div>
@endforeach
