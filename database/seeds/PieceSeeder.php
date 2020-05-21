<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PieceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table("pieces")->insert([
            "name" => "～100 片"
        ]);
        DB::table("pieces")->insert([
            "name" => "101～300 片"
        ]);
        DB::table("pieces")->insert([
            "name" => "301~500 片"
        ]);
        DB::table("pieces")->insert([
            "name" => "501片~800 片"
        ]);
        DB::table("pieces")->insert([
            "name" => "801~1,000 片"
        ]);
        DB::table("pieces")->insert([
            "name" => "1,001~1,200 片"
        ]);
        DB::table("pieces")->insert([
            "name" => "1,201~1,500 片"
        ]);
        DB::table("pieces")->insert([
            "name" => "1,501~2,000 片"
        ]);
        DB::table("pieces")->insert([
            "name" => "2,000片以上"
        ]);
    }
}
