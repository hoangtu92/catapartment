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
            'display' => true
        ]);
        DB::table("latest_products")->insert([
            'product_id' => 2,
            'display' => true
        ]);
        DB::table("latest_products")->insert([
            'product_id' => 3,
            'display' => true
        ]);
        DB::table("latest_products")->insert([
            'product_id' => 4,
            'display' => true
        ]);
        DB::table("latest_products")->insert([
            'product_id' => 5,
            'display' => true
        ]);
    }
}
