<?php

namespace App\Observers;

use App\Models\HeroSlider;
use Illuminate\Support\Facades\Cache;

class HeroSliderObserver
{
    public function saved(HeroSlider $heroSlider): void
    {
        Cache::forget('home:hero_sliders');
    }

    public function deleted(HeroSlider $heroSlider): void
    {
        Cache::forget('home:hero_sliders');
    }
}
