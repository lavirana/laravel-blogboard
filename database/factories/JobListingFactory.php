<?php

namespace Database\Factories;

use App\Models\Model;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Model>
 */
class JobListingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        return [
            'title'       => fake()->jobTitle(),
            'company'     => fake()->company(),
            'location'    => fake()->city() . ', ' . fake()->country(),
            'type'        => fake()->randomElement(['full-time', 'part-time', 'remote', 'contract']),
            'salary_range' => '$' . fake()->numberBetween(40, 80) . 'k - $' . fake()->numberBetween(80, 150) . 'k',
            'description' => fake()->paragraphs(4, true),
            'is_active'   => true,
            'expires_at'  => fake()->dateTimeBetween('+1 month', '+6 months'),
        ];
    }
}
