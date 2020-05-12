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
            'email_verified_at' => now()
        ]);

        DB::table('users')->insert([
            'username' => 'newskyson',
            'role' => 'user',
            'phone' => '0947584711',
            'name' => "張忠傑",
            'email' => 'newskyson@gmail.com',
            'password' => '$2y$10$DySv1k4pH3wVjWN91Tnn4.O8OIscV8P/dB1/KPE7s0Ho1gMDFDMBS',
            'email_verified_at' => now()
        ]);

        DB::table('users')->insert([
            'username' => 'yoyowang325',
            'role' => 'user',
            'phone' => '0978098601',
            'name' => "王友詳",
            'email' => 'abc0978098601@gmail.com',
            'password' => '$2y$10$wtK20EQCTe9bLjGCCXDozeCMTBsjxc1Ok0F1UUDNOIWUcXKBKsCXm',
            'email_verified_at' => now()
        ]);

        DB::table('users')->insert([
            'username' => 'administrator',
            'role' => 'admin',
            'phone' => '0947556511',
            'name' => Str::random(10),
            'email' => 'ml-codesign6@gmail.com',
            'password' => bcrypt('123456'),
            'email_verified_at' => now()
        ]);


    }
}
