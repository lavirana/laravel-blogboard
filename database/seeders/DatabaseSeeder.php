<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Category;
use App\Models\Comment;
use App\Models\JobListing; // Ensure the JobListing model exists in the specified namespace
use App\Models\Post;
use App\Models\Tag;
use App\Models\User;


class DatabaseSeeder extends Seeder
{

    public function run(): void
    {
        // 1. Create users
        User::factory(10)->create();
        // 2. Create a specific admin user you can log in with
        User::factory()->create([
            'name'  => 'Admin User',
            'email' => 'admin@blogboard.com',
        ]);

        // 3. Create categories
        $categories = Category::factory(8)->create();
        // 4. Create tags
        $tags = Tag::factory(15)->create();
        // 5. Create 50 published posts with tags attached
        Post::factory(50)
            ->published()
            ->create()
            ->each(function ($post) use ($tags) {
                // Attach 1-4 random tags to each post
                $post->tags()->attach(
                    $tags->random(rand(1, 4))->pluck('id')
                );
                // Add 0-5 comments per post
                // Inside DatabaseSeeder.php, where you create comments:
                Comment::factory(rand(0, 5))->create([
                    'post_id' => $post->id,
                    'user_id' => User::inRandomOrder()->first()->id, // Link to an existing user
                ]);
            });

        // 6. Create 10 draft posts
        Post::factory(10)->draft()->create();
        // 7. Create job listings

        JobListing::factory(25)->create();
        $this->command->info('Database seeded successfully!');
        $this->command->info('   Users: ' . User::count());
        $this->command->info('   Posts: ' . Post::count());
        $this->command->info('   Jobs: ' . JobListing::count());
    }
}
