<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Models\Post;
use App\Events\PostPublished;
use App\Notifications\PostPublishedNotification;


class PostPublishedNotification extends Notification implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct(
        public readonly Post $post
    )
    {
        //
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail','database'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
        ->subject("New post: {$this->post->title}")
        ->greeting("Hello {$notifiable->name}!")
        ->line("A new post has been published in a category you follow.")
        ->line("**{$this->post->title}**")
        ->line($this->post->excerpt)
        ->action('Read Post', route('posts.show', $this->post))
        ->line('You received this because you subscribed to this category.');
    }


       // Database notification content

       public function toDatabase(object $notifiable): array
       {
           return [
               'post_id'   => $this->post->id,
               'post_title'=> $this->post->title,
               'post_url'  => route('posts.show', $this->post),
               'type'      => 'post_published',
           ];
       }
   
       public function handle(PostPublished $event): void
    {
        // Access the post from the event
        $post = $event->post;

        // 1. Send to the post author
        $post->user->notify(new PostPublishedNotification($post));

        // 2. Send to a specific email (like an editor)
        Notification::route('mail', 'editor@example.com')
            ->notify(new PostPublishedNotification($post));
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
