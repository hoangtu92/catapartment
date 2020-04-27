<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ColorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table("colors")->insert([
            "name" => "Black",
            "value" => "black"
        ]);

        DB::table("colors")->insert([
            "name" => "Red",
            "value" => "red"
        ]);

        DB::table("colors")->insert([
            "name" => "Yellow",
            "value" => "yellow"
        ]);
    }
}
