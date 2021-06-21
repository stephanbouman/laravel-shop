<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Laravel Shop</title>
</head>
<body>
<x-header></x-header>
<div class="container mx-auto">

    @yield('content')
</div>
</body>
</html>
