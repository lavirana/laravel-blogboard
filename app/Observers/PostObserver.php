<?php

namespace App\Observers;

use App\Events\PostPublished;

use App\Models\Post;

use Illuminate\Support\Str;

class PostObserver

{

    // Runs before a post is saved (create or update)

    public function saving(Post $post): void

    {

        // Auto-generate slug from title if not set

        if (!$post->slug) {

            $post->slug = Str::slug($post->title) . '-' . Str::random(5);

        }

    }

    // Runs after a post is created

    public function created(Post $post): void

    {

        \Log::info("New post created: {$post->title} by User #{$post->user_id}");

    }

    // Runs after a post is updated

    public function updated(Post $post): void

    {

        // If post was just published, fire the event

        if ($post->wasChanged('status') && $post->status === 'published') {

            PostPublished::dispatch($post);

        }

    }

    // Runs after a post is soft-deleted

    public function deleted(Post $post): void

    {

        // Clean up related data

        $post->tags()->detach();

    }

}

