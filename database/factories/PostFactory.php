<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class PostFactory extends Factory
{
    public function definition(): array
    {
        $title = fake()->sentence(6);
        return [
            'user_id'      => User::factory(),
            'category_id'  => Category::factory(),
            'title'        => $title,
            'slug'         => Str::slug($title) . '-' . fake()->randomNumber(4),
            'body'         => fake()->paragraphs(8, true),
            'excerpt'      => fake()->paragraph(2),
            'status'       => fake()->randomElement(['draft', 'published', 'archived']),
            'published_at' => fake()->optional(0.7)->dateTimeBetween('-1 year', 'now'),
            'views'        => fake()->numberBetween(0, 10000),
        ];
    }

    // Named states — call as Post::factory()->published()->create()

    public function published(): static
    {
        return $this->state(fn(array $attributes) => [
            'status'       => 'published',
            'published_at' => fake()->dateTimeBetween('-6 months', 'now'),
        ]);
    }

    public function draft(): static
    {
        return $this->state(fn(array $attributes) => [
            'status'       => 'draft',
            'published_at' => null,
        ]);
    }
}
