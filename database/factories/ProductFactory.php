<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Carbon\Carbon;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $now = Carbon::now();
        return [
            'company_id' => $this->faker->numberBetween(1, 5),
            'product_name' => '',
            'price' => $this->faker->numberBetween(10, 20) * 10,
            'stock' => $this->faker->numberBetween(100, 1000),
            'comment' => $this->faker->realText,
            'img_path' => '',
            'created_at' => $now,
            'updated_at' => $now,
        ];
    }
}
