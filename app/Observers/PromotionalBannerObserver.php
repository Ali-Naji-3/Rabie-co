<?php

namespace App\Observers;

use App\Models\PromotionalBanner;
use Illuminate\Support\Facades\Cache;

class PromotionalBannerObserver
{
    public function saved(PromotionalBanner $promotionalBanner): void
    {
        Cache::forget('home:promo_banners:after_products');
        Cache::forget('home:promo_banners:after_reviews');
    }

    public function deleted(PromotionalBanner $promotionalBanner): void
    {
        Cache::forget('home:promo_banners:after_products');
        Cache::forget('home:promo_banners:after_reviews');
    }
}
