<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AdvertisementSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table("advertisements")->insert([
            "type" => "圖檔",
            "image" => "/images/home-slider-img01.jpg",
            "url" => "#",
            "display" => true
        ]);

        DB::table("advertisements")->insert([
            "type" => "圖檔",
            "image" => "/images/home-slider-img02.jpg",
            "url" => "#",
            "display" => true
        ]);
    }
}
