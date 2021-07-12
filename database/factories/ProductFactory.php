<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Product::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $listCategory = Category::pluck('id');
        return [
            'name' => $this->faker->name(),
            'quantity' => rand(10, 100),
            'price' => rand(100, 10000),
            'category_id' => $this->faker->randomElement($listCategory),
            'image_path' => 'https://salt.tikicdn.com/cache/w444/ts/product/0f/4a/19/e2c1e692c76e5aeb99baa2dcef13cdcb.jpg'
        ];
    }
}
