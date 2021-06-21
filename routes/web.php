<?php

use App\Service\Cart;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::resource('categories', CategoryController::class)
    ->only([
        'index',
        'show',
    ]);

Route::get('products/{product}', [ProductController::class, 'show'])
    ->name('products.show');

Route::get('cart',[CartController::class, 'show'])
    ->name('cart.show');

Route::post('cart',[CartController::class, 'add'])
    ->name('cart.add');

Route::delete('cart',[CartController::class, 'delete'])
    ->name('cart.delete');

Route::get('foo',function(){
    var_dump(session()->get('thinks'));
});

Route::get('bar',function(){
    dd(Cart::get());
});
