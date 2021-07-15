<?php

namespace Database\Seeders;

use App\Models\Order;
use App\Models\Procon;
use App\Models\Product;
use App\Models\Category;
use App\Models\OrderLine;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Category::factory(10)->create()->each(function (Category $category) {
            $products = Product::factory(30)->make();

            $category->products()->saveMany($products)->each(function (Product $product){
                $procons = Procon::factory(5)->make();
                $product->procons()->saveMany($procons);
            });

        });

        Order::factory(12)->create()->each(function (Order $order) {
            $orderLines = Product::all()->random(rand(1,5))->map(function (Product $product) {
                $orderLine             = new OrderLine();
                $orderLine->product_id = $product->id;
                $orderLine->price      = $product->price;
                $orderLine->name       = $product->name;
                $orderLine->quantity   = rand(1, 4);

                return $orderLine;
            });

            $order->orderlines()->saveMany($orderLines);

        });
    }
}
