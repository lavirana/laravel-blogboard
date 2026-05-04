<?php

namespace App\Listeners;

use App\Events\UserRegistered;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;


class SendWelcomeEmail
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(UserRegistered $event): void
    {
         // Dispatch on a specific queue called 'emails'
    //SendWelcomeEmailJob::dispatch($event->user)->onQueue('emails');




    // Dispatch immediately (goes to queue)
        SendWelcomeEmail::dispatch($user);

        // Dispatch after a delay
        SendWelcomeEmail::dispatch($user)->delay(now()->addMinutes(5));

        // Dispatch on a specific queue
        SendWelcomeEmail::dispatch($user)->onQueue('emails');

        // Dispatch and chain jobs (run in sequence)
        SendWelcomeEmail::withChain([
            new SendOnboardingChecklist($user),
            new SendFirstTipEmail($user),
        ])->dispatch($user);
            }

}
