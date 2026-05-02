<?php

namespace App\Mail;

use App\Models\Post;

use Illuminate\Bus\Queueable;

use Illuminate\Contracts\Queue\ShouldQueue;

use Illuminate\Mail\Mailable;

use Illuminate\Mail\Mailables\Content;

use Illuminate\Mail\Mailables\Envelope;

use Illuminate\Queue\SerializesModels;

class PostApproved extends Mailable implements ShouldQueue

{

    use Queueable, SerializesModels;

    public function __construct(

        public readonly Post $post

    ) {}

    public function envelope(): Envelope

    {

        return new Envelope(

            subject: "Your post '{$this->post->title}' has been approved",

            replyTo: [config('mail.from.address')],

        );

    }

    public function content(): Content

    {

        return new Content(

            view: 'emails.post-approved',

            with: [

                'postUrl' => route('posts.show', $this->post),

                'author'  => $this->post->user->name,

            ]

        );

    }

}

