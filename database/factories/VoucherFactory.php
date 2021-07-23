<?php

namespace Database\Factories;

use App\Models\Voucher;
use Illuminate\Database\Eloquent\Factories\Factory;

class VoucherFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Voucher::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name(),
            'code' => $this->faker->unique->ean8,
            'from' => $this->faker->dateTime(),
            'to' => $this->faker->dateTime(),
            'status' => rand(1,2),
            'discount' => rand(10, 50),
            'min_price' => 20000000
        ];
    }
}
