<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<Category>
 */
class CategoryFactory extends Factory
{
    public function definition(): array
    {
        // Remove ->unique() here
        $name = fake()->randomElement([
            'Technology',
            'Laravel',
            'JavaScript',
            'DevOps',
            'Design',
            'Career',
            'Open Source',
            'Tutorials',
            'News'
        ]);

        return [
            'name'        => $name,
            'slug'        => Str::slug($name) . '-' . fake()->unique()->numberBetween(1, 1000), // Add a random number to slug to keep it unique
            'description' => fake()->sentence(),
            'color'       => fake()->hexColor(),
        ];
    }
}
