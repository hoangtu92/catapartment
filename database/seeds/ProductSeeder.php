<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table("products")->insert([
        'category_id' => 1,
        'name' => 'Smart watches wood edition',
        'slug' => "smart-watches-wood-edition",
        'price' => 500,
        'sale_price' => 400,
        'image' => '/images/product01.jpg'
    ]);

        DB::table("products")->insert([
            'category_id' => 1,
            'name' => 'Penatibus parturient',
            'slug' => "penatibus-parturient",
            'price' => 500,
            'sale_price' => 400,
            'image' => '/images/product02.jpg'
        ]);

        DB::table("products")->insert([
            'category_id' => 2,
            'name' => 'Wooden bow tie man',
            'slug' => "wooden-bow-tie-man",
            'price' => 500,
            'sale_price' => 400,
            'image' => '/images/product03.jpg'
        ]);

        DB::table("products")->insert([
            'category_id' => 1,
            'name' => 'Lorem ip sum',
            'slug' => "lorem-ip-sum",
            'price' => 500,
            'sale_price' => 400,
            'image' => '/images/product01.jpg'
        ]);

        DB::table("products")->insert([
            'category_id' => 1,
            'name' => 'Product 1',
            'slug' => "product-1",
            'price' => 500,
            'sale_price' => 400,
            'image' => '/images/product02.jpg'
        ]);

        DB::table("products")->insert([
            'category_id' => 2,
            'name' => 'Product 2',
            'slug' => "product-2",
            'price' => 500,
            'sale_price' => 400,
            'image' => '/images/product03.jpg'
        ]);
    }
}
