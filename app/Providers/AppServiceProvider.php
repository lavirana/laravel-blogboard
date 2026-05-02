<?php

namespace App\Providers;

use App\Events\PostPublished;
use App\Events\UserRegistered;
use App\Events\JobApplicationReceived;
use App\Listeners\SendPostPublishedNotification;
use App\Listeners\NotifyAdminOfNewPost;
use App\Listeners\SendWelcomeEmail;
use App\Listeners\NotifyJobOwnerOfApplication;
use Illuminate\Support\Facades\Event;
use App\Models\Post;
use App\Observers\PostObserver;

use Illuminate\Support\ServiceProvider;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // 1. Post Published Event (Multiple Listeners)
        Event::listen(
            PostPublished::class,
            [SendPostPublishedNotification::class, NotifyAdminOfNewPost::class]
        );

        // 2. User Registered Event
        Event::listen(
            UserRegistered::class,
            SendWelcomeEmail::class
        );

        // 3. Job Application Received
        Event::listen(
            JobApplicationReceived::class,
            NotifyJobOwnerOfApplication::class
        );
        
        Post::observe(PostObserver::class);
/*
          4. Comment Posted Event
         Event::listen(
            CommentPosted::class,
            [NotifyPostAuthorOfNewComment::class, ModerateComment::class]
        );

          5. Post Updated Event
         Event::listen(
            PostUpdated::class,
            NotifyFollowersOfPostUpdate::class
        );
*/

    }
}
