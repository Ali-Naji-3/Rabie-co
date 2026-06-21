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

        // The homepage caches each product's approved-review aggregate under
        // `products:featured`. Any change to a review's approval state or rating
        // changes that aggregate, so the cache must be evicted.
        if ($review->wasRecentlyCreated || $review->wasChanged(['is_approved', 'rating'])) {
            Cache::forget('products:featured');
        }
    }

    public function deleted(Review $review): void
    {
        Cache::forget('reviews:featured');
        Cache::forget('products:featured');
    }
}
