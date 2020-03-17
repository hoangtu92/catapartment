<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FaqSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table("faqs")->insert([
            "question" => "Lorem Ipsum is dummy text?",
            "answer" => "Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum is simply dummy text of the printing and typesetting industry.Lorem Ipsum is simply dummy text of the printing and typesetting industry.",
            "type" => "SHOPPING"
        ]);
        DB::table("faqs")->insert([
            "question" => "Lorem Ipsum is dummy text?",
            "answer" => "Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum is simply dummy text of the printing and typesetting industry.Lorem Ipsum is simply dummy text of the printing and typesetting industry.",
            "type" => "SHOPPING"
        ]);
        DB::table("faqs")->insert([
            "question" => "Lorem Ipsum is dummy text?",
            "answer" => "Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum is simply dummy text of the printing and typesetting industry.Lorem Ipsum is simply dummy text of the printing and typesetting industry.",
            "type" => "PAYMENT"
        ]);
        DB::table("faqs")->insert([
            "question" => "Lorem Ipsum is dummy text?",
            "answer" => "Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum is simply dummy text of the printing and typesetting industry.Lorem Ipsum is simply dummy text of the printing and typesetting industry.",
            "type" => "PAYMENT"
        ]);
    }
}
