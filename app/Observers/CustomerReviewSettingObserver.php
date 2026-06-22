<?php

namespace App\Observers;

use App\Models\CustomerReviewSetting;
use Illuminate\Support\Facades\Cache;

class CustomerReviewSettingObserver
{
    public function saved(CustomerReviewSetting $setting): void
    {
        $this->bust();
    }

    public function deleted(CustomerReviewSetting $setting): void
    {
        $this->bust();
    }

    /**
     * Section config changes bust the singleton cache; a mode toggle also
     * affects which statistics the homepage serves, so refresh the stats key too.
     */
    private function bust(): void
    {
        Cache::forget('customer_review_settings');
        Cache::forget('home:customer_reviews:stats');
    }
}
