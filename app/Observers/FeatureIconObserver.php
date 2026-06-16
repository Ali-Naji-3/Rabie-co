<?php

namespace App\Observers;

use App\Models\FeatureIcon;
use Illuminate\Support\Facades\Cache;

class FeatureIconObserver
{
    public function saved(FeatureIcon $featureIcon): void
    {
        Cache::forget('home:feature_icons');
    }

    public function deleted(FeatureIcon $featureIcon): void
    {
        Cache::forget('home:feature_icons');
    }
}
