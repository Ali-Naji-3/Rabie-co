<?php

namespace App\Observers;

use App\Models\Review;
use Illuminate\Support\Facades\Cache;

class ReviewObserver
{
    public function saved(Review $review): void
    {
        if ($review->wasRecentlyCreated || $review->wasChanged(['is_featured', 'is_approved'])) {
            Cache::forget('reviews:featured');
        }
    }

    public function deleted(Review $review): void
    {
        Cache::forget('reviews:featured');
    }
}
