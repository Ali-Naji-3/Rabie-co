<?php

namespace App\Observers;

use App\Models\FaqItem;
use Illuminate\Support\Facades\Cache;

class FaqItemObserver
{
    public function saved(FaqItem $faqItem): void
    {
        Cache::forget('home:faq');
    }

    public function deleted(FaqItem $faqItem): void
    {
        Cache::forget('home:faq');
    }
}
