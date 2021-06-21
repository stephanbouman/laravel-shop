<?php


namespace App\Service;


use App\Models\Product;

class Cart
{

    const SESSION_KEY = 'products';

    public static function get()
    {
        $products = session()->get(self::SESSION_KEY) ?? collect();

        $cartItems = $products->map(function ($quantity, $productId) {
            $product = Product::find($productId);

            return collect([
                'id'  => $product->id,
                'name'  => $product->name,
                'price' => $product->price,
                'quantity' => $quantity,
                'total'    => $quantity * $product->price,
            ]);
        })->values();

        return [
            'items' => $cartItems,
            'quantity' => $cartItems->sum('quantity'),
            'totalPrice' => $cartItems->sum('total')
        ];
    }

    public static function add(Product $product, int $quantity = 1)
    {
        $products = session()->get(self::SESSION_KEY) ?? collect();

        if ($products->get($product->id)) {
            $quantity = $products->get($product->id) + $quantity;
        }

        $products->put($product->id, $quantity);

        session()->put(self::SESSION_KEY, $products);
    }


    public static function remove(Product $product){
        $products = session()->get(self::SESSION_KEY) ?? collect();
        $products->forget($product->id);


        session()->put(self::SESSION_KEY, $products);
    }

    protected function save()
    {
        request()->session()->put(self::SESSION_KEY, $this->products);
    }
}
