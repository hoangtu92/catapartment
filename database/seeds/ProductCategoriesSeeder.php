<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductCategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table("product_categories")->insert([
            "name" => "迪士尼系列",
            "icon" => "/images/cat-icon01.png"
        ]);
        DB::table("product_categories")->insert([
            "name" => "宮崎駿系列",
            "icon" => "/images/cat-icon02.png"
        ]);
        DB::table("product_categories")->insert([
            "name" => "史奴比系列",
            "icon" => "/images/cat-icon03.png"
        ]);
        DB::table("product_categories")->insert([
            "name" => "海賊王系列",
            "icon" => "/images/cat-icon04.png"
        ]);
        DB::table("product_categories")->insert([
            "name" => "可愛動物系列",
            "icon" => "/images/cat-icon06.png"
        ]);
        DB::table("product_categories")->insert([
            "name" => "交通工具系列",
            "icon" => "/images/cat-icon07.png"
        ]);
        DB::table("product_categories")->insert([
            "name" => "古典名畫系列",
            "icon" => "/images/cat-icon08.png"
        ]);
        DB::table("product_categories")->insert([
            "name" => "風景圖系列",
            "icon" => "/images/cat-icon09.png"
        ]);
        DB::table("product_categories")->insert([
            "name" => "歐美熱門系列",
            "icon" => "/images/cat-icon10.png"
        ]);
        DB::table("product_categories")->insert([
            "name" => "台灣獨家系列",
            "icon" => "/images/cat-icon11.png"
        ]);

    }
}
