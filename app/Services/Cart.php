<?php


namespace App\Services;


use App\Models\Product;

class Cart
{

    const SESSION_KEY = 'products';

    private $items;

    public function __construct()
    {
        $products = session()->get(self::SESSION_KEY) ?? collect();

        $this->items = $products->map(function ($quantity, $productId) {
            $product = Product::find($productId);

            return collect([
                'id'       => $product->id,
                'name'     => $product->name,
                'price'    => $product->price,
                'quantity' => $quantity,
                'total'    => $quantity * $product->price,
            ]);
        })->values();

    }

    public static function clear(){
        session()->forget(self::SESSION_KEY);
    }

    public static function load()
    {
        return new self();
    }

    public function getItems()
    {
        return $this->items;
    }

    public function getTotalQuantity()
    {
        return $this->items->sum('quantity');
    }

    public function getTotalPrice()
    {
        return $this->items->sum('total');
    }

    public function getProducts(){
        $productIds = $this->items->pluck('id');
        return Product::findMany($productIds);
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


    public static function remove(Product $product)
    {
        $products = session()->get(self::SESSION_KEY) ?? collect();
        $products->forget($product->id);


        session()->put(self::SESSION_KEY, $products);
    }

    protected function save()
    {
        request()->session()->put(self::SESSION_KEY, $this->products);
    }
}
