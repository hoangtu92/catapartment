<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UsersTableSeeder::class);
        $this->call(SlidesTableSeeder::class);
        $this->call(ProductCategoriesSeeder::class);
        $this->call(ProductSeeder::class);
        $this->call(FaqSeeder::class);
        $this->call(SettingsTableSeeder::class);
        $this->call(LatestProductSeeder::class);
        $this->call(RecommendProductSeeder::class);
        $this->call(ColorSeeder::class);
        $this->call(BrandSeeder::class);
    }
}
