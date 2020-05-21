<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FrameSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table("frames")->insert([
           'sku' => 1212,
           'name' => '白橡木',
            'image' => '/images/product01.jpg',
           'price' => 1200,
           'time' => 3,
           'sale_price' => 830
        ]);
        DB::table("frames")->insert([
            'sku' => 32121,
            'name' => '紅柚木',
            'image' => '/images/product02.jpg',
            'price' => 1100,
            'time' => 5,
            'sale_price' => 800,
            'created_at' => now()
        ]);

        DB::table("frames")->insert([
            'sku' => 42332,
            'name' => '古銅金',
            'image' => '/images/product03.jpg',
            'price' => 1400,
            'time' => 9,
            'sale_price' => 850
        ]);

    }
}
