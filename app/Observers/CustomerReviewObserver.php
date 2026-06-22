<?php

namespace App\Observers;

use App\Models\CustomerReview;
use Illuminate\Support\Facades\Cache;

class CustomerReviewObserver
{
    public function saved(CustomerReview $review): void
    {
        $this->bust();
    }

    public function deleted(CustomerReview $review): void
    {
        $this->bust();
    }

    /**
     * Any status / pin / order / content change refreshes both the homepage
     * feed and the real-statistics aggregate.
     */
    private function bust(): void
    {
        Cache::forget('home:customer_reviews');
        Cache::forget('home:customer_reviews:stats');
    }
}
