<?php

namespace App\Observers;

use App\Models\JobListing;

class JobListingObserver
{
    /**
     * Handle the JobListing "created" event.
     */
    public function created(JobListing $jobListing): void
    {
        //
    }

    /**
     * Handle the JobListing "updated" event.
     */
    public function updated(JobListing $jobListing): void
    {
        //
    }

    /**
     * Handle the JobListing "deleted" event.
     */
    public function deleted(JobListing $jobListing): void
    {
        //
    }

    /**
     * Handle the JobListing "restored" event.
     */
    public function restored(JobListing $jobListing): void
    {
        //
    }

    /**
     * Handle the JobListing "force deleted" event.
     */
    public function forceDeleted(JobListing $jobListing): void
    {
        //
    }
}
