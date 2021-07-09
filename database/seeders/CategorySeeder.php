<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Category::insert(
            [
                ['name' => 'Iphone', 'created_at' => now(), 'updated_at' => now()],
                ['name' => 'Imac', 'created_at' => now(), 'updated_at' => now()],
                ['name' => 'Ipad', 'created_at' => now(), 'updated_at' => now()],
                ['name' => 'Macbook', 'created_at' => now(), 'updated_at' => now()],
                ['name' => 'AppleWatch', 'created_at' => now(), 'updated_at' => now()],
                ['name' => 'AirPod', 'created_at' => now(), 'updated_at' => now()]
            ]
        );
    }
}
