<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SlidesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table("slides")->insert([
            'title' => 'Slide 1',
            'link' => null,
            'image' => '/images/home-slider-img01.jpg'
        ]);

        DB::table("slides")->insert([
            'title' => 'Slide 2',
            'link' => null,
            'image' => '/images/home-slider-img02.jpg'
        ]);

        DB::table("slides")->insert([
            'title' => 'Slide 3',
            'link' => '#',
            'image' => '/images/home-slider-img01.jpg'
        ]);

        DB::table("slides")->insert([
            'title' => 'Slide 4',
            'link' => null,
            'image' => '/images/home-slider-img02.jpg'
        ]);

        DB::table("slides")->insert([
            'title' => 'Slide 5',
            'link' => null,
            'image' => '/images/home-slider-img01.jpg'
        ]);
    }
}
