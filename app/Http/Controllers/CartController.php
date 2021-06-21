<?php

namespace App\Http\Controllers;

use App\Service\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Requests\UpdateCartRequest;
use App\Http\Requests\DeleteProductFromCartRequest;

class CartController extends Controller
{

    public function show()
    {
        return view('carts.show')
            ->with('cart', Cart::get());
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function add(UpdateCartRequest $request)
    {
        $product = Product::find($request->product_id);
        Cart::add($product, $request->quantity);

        return redirect()->route('carts.show');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function remove($id)
    {
        //
    }

    public function delete(DeleteProductFromCartRequest $request){
        $product = Product::find($request->product_id);
        Cart::remove($product);

        return redirect()->route('carts.show');
    }
}
