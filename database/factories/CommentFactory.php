<?php

namespace Database\Factories;

use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class CommentFactory extends Factory
{
    protected $model = Comment::class;

    public function definition(): array
    {
        return [
            'post_id'      => Post::factory(),
            'user_id'      => User::factory(),
            'author_name'  => fake()->name(),
            'author_email' => fake()->unique()->safeEmail(),
            'body'         => fake()->paragraph(), // This fixes the "Not Null" error
            'approved'     => fake()->boolean(80), // 80% chance of being true
        ];
    }
}
