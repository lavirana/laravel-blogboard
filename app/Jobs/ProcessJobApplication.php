<?php

namespace App\Jobs;

use App\Models\Application;
use App\Notifications\ApplicationReceived;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ProcessJobApplication implements ShouldQueue

{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    public int $tries = 3;
    public function __construct(
        public readonly Application $application
    ) {}

    public function handle(): void
    {
        // 1. Send confirmation to applicant

        $this->application->jobListing->employer->notify(
            new ApplicationReceived($this->application)
        );

        // 2. Update application status

        $this->application->update(['status' => 'reviewed']);
        // 3. Log it
        \Log::info("Application #{$this->application->id} processed.");

    }

}

