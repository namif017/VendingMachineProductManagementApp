<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Carbon\Carbon;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class CompanyFactory extends Factory
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
            'company_name' => $this->faker->company,
            'street_address' => $this->faker->address,
            'representative_name' => $this->faker->name,
            'created_at' => $now,
            'updated_at' => $now,
        ];
    }
}
