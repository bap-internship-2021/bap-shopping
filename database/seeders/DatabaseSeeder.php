<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use App\Models\Statistical;
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
        $this->call([
            UserSeeder::class,
            CategorySeeder::class,
            VoucherSeeder::class,
            StatisticalSeeder::class
        ]);
    }
}
