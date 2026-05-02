<?php

namespace App\Broadcasting;

use App\Models\User;
use App\Models\Post;

class PostChannel
{
    /**
     * Create a new channel instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Authenticate the user's access to the channel.
     */
    public function join(User $user, Post $post): bool
    {
        // User can listen if they are the post author or admin

        return $user->id === $post->user_id || $user->isAdmin();

    }

}
