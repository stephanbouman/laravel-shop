<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\Category;
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
         Category::factory(10)->create()->each(function(Category $category){
             $products = Product::factory(30)->make();

             $category->products()->saveMany($products);
         });
    }
}