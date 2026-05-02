<?php

use Illuminate\Support\Facades\Broadcast;
use App\Broadcasting\PostChannel;
use App\Models\Post;

// Private channel — authenticated users only
Broadcast::channel('posts.{post}', PostChannel::class);


// Public channel
Broadcast::channel('public-feed', fn() => true);


Broadcast::channel('App.Models.User.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});
