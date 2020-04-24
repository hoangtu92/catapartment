<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RecommendProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table("recommend_products")->insert([
            'product_id' => 1,
            'display' => true,
            'category' => "新品預購"
        ]);
        DB::table("recommend_products")->insert([
            'product_id' => 2,
            'display' => true,
            'category' => "換季促銷"
        ]);
        DB::table("recommend_products")->insert([
            'product_id' => 3,
            'display' => true,
            'category' => "換季促銷"
        ]);
        DB::table("recommend_products")->insert([
            'product_id' => 4,
            'display' => true,
            'category' => "熱賣拼圖"
        ]);
        DB::table("recommend_products")->insert([
            'product_id' => 5,
            'display' => true,
            'category' => "熱賣拼圖"
        ]);

    }
}
