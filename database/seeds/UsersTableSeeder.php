<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('users')->insert([
            'username' => 'user1',
            'role' => 'user',
            'phone' => '0947584711',
            'name' => Str::random(10),
            'email' => 'ml-codesign3@gmail.com',
            'password' => bcrypt('12121212'),
        ]);
        DB::table('users')->insert([
            'username' => 'administrator',
            'role' => 'admin',
            'phone' => '0947556511',
            'name' => Str::random(10),
            'email' => 'ml-codesign6@gmail.com',
            'password' => bcrypt('123456'),
        ]);


    }
}
