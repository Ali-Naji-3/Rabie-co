<?php

namespace App\Observers;

use App\Models\FaqSection;
use Illuminate\Support\Facades\Cache;

class FaqSectionObserver
{
    public function saved(FaqSection $faqSection): void
    {
        Cache::forget('home:faq');
    }

    public function deleted(FaqSection $faqSection): void
    {
        Cache::forget('home:faq');
    }
}
