<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BrandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $brands = [
            "日本" => ["Apollo","Appleone","Beverly","Cuties","Epoch","Ensky","Tenyo","Yanoman"],

            "台灣" => ["台旺拼圖", "Puzzle Story","Art Puzzle"],


            "波蘭" => ["Castorland","Bluebird Puzzle"],

            "義大利"  => ["Clementoni"],

            "美國" => ["Cobble Hill","D-Toys","Dinotoys","Galison","NYPC","Perre","Sunsaut","Tower Puzzle","Trefl Puzzle"],

            "西班牙" => ["Educa"],

            "加拿大" => ["Eurographics"],

            "英國" => ["Gibsonc"],

            "法國" => ["Grafika", "Nathan"],

            "德國" => ["Heye","Ravensburger","Schmidt-speie"],

            "荷蘭" => ["Jumbo"],

            "大陸" => ["Limited", "若熊"]
        ];

        function formatNum($n){
            return $n < 10 ? "0".$n : $n;
        }

        foreach($brands as $country => $items){

            $idx = 0;


            foreach($items as $brand_name){
                if($idx < 10) $idx++;

                DB::table("brands")->insert([
                    "name" => $brand_name,
                    "logo" => "/images/brand-logo".formatNum($idx).".jpg",
                    "country"=> $country,
                    "description" => "Lorem Ipsum is simply dummy text of the printing and typesetting industry.
Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book."
                ]);
            }

        }


    }
}
