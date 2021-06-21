<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta
        name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0"
    >
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Laravel Shop</title>
</head>
<body>
<nav>
    @foreach(\App\Models\Category::all() as $category)
        <a href="{{ route('products.show',$category) }}">{{ $category->name }}</a>
    @endforeach
</nav>
    <a href="{{ route('cart.show') }}">Shopping cart</a>

    @yield('content')
</body>
</html>
