<?php

namespace App\Listeners;

use App\Events\PostPublished;

use App\Notifications\PostPublishedNotification;

use Illuminate\Contracts\Queue\ShouldQueue;

// ShouldQueue makes this listener run in the background queue

class SendPostPublishedNotification implements ShouldQueue

{

    public function handle(PostPublished $event): void

    {

        $post = $event->post;

        // Notify all subscribers who follow this category

        $post->category?->subscribers->each(function ($user) use ($post) {

            $user->notify(new PostPublishedNotification($post));

        });

        Mail::to($event->post->user->email)->queue(new PostPublished($event->post));

    }

}

