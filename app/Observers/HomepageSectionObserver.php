<?php

namespace App\Observers;

use App\Models\HomepageSection;
use Illuminate\Support\Facades\Cache;

class HomepageSectionObserver
{
    public function saved(HomepageSection $homepageSection): void
    {
        Cache::forget('home:sections');
    }

    public function deleted(HomepageSection $homepageSection): void
    {
        Cache::forget('home:sections');
    }
}
