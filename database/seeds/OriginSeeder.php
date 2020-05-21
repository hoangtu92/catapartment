<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OriginSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table("origins")->insert([
            "name" => "日本",
            "icon" => "/images/country-icon01.png"
        ]);
        DB::table("origins")->insert([
            "name" => "美國",
            "icon" => "/images/country-icon02.png"
        ]);
        DB::table("origins")->insert([
            "name" => "英國",
            "icon" => "/images/country-icon03.png"
        ]);
        DB::table("origins")->insert([
            "name" => "德國",
            "icon" => "/images/country-icon04.png"
        ]);
        DB::table("origins")->insert([
            "name" => "法國",
            "icon" => "/images/country-icon05.png"
        ]);
        DB::table("origins")->insert([
            "name" => "義大利",
            "icon" => "/images/country-icon06.png"
        ]);
        DB::table("origins")->insert([
            "name" => "韓國",
            "icon" => "/images/country-icon07.png"
        ]);
        DB::table("origins")->insert([
            "name" => "台灣",
            "icon" => "/images/country-icon08.png"
        ]);
    }
}
