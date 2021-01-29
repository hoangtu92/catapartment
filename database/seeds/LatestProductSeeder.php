<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LatestProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table("latest_products")->insert([
            'product_id' => 1,
            'display' => true,
            'lft' => 5
        ]);
        DB::table("latest_products")->insert([
            'product_id' => 2,
            'display' => true,
            'lft' => 4
        ]);
        DB::table("latest_products")->insert([
            'product_id' => 3,
            'display' => true,
            'lft' => 3
        ]);
        DB::table("latest_products")->insert([
            'product_id' => 5,
            'display' => true,
            'lft' => 2
        ]);
        DB::table("latest_products")->insert([
            'product_id' => 18,
            'display' => true,
            'lft' => 1
        ]);
    }
}
