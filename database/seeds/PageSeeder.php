<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table("pages")->insert([
            "title" => "Privacy & policy",
            "slug" => "privacy-policy",
            "content" => "lorem ipsum"
        ]);
    }
}
