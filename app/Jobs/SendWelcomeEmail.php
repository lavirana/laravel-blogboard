<?php

namespace App\Jobs;

use App\Mail\WelcomeEmail;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendWelcomeEmail implements ShouldQueue

{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    // Number of times to retry if it fails
    public int $tries = 3;
    // Wait between retries (seconds)
    public int $backoff = 60;
    // Max execution time before marking as timed out
    public int $timeout = 30;

    public function __construct(
        public readonly User $user
    ) {}

    public function handle(): void
    {
        Mail::to($this->user->email)
            ->send(new WelcomeEmail($this->user));
    }

    // Called when all retries are exhausted
    public function failed(\Throwable $exception): void
    {
        \Log::error("Failed to send welcome email to {$this->user->email}: {$exception->getMessage()}");
    }
}