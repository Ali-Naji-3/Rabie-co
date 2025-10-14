<?php

namespace App\View\Composers;

use App\Models\SiteSetting;
use Illuminate\View\View;
use Illuminate\Support\Facades\Cache;

class SiteSettingsComposer
{
    public function compose(View $view)
    {
        // Cache site settings for 1 hour to reduce database queries
        $siteSettings = Cache::remember('site_settings', 3600, function () {
            return SiteSetting::first() ?? new SiteSetting();
        });
        
        $view->with('siteSettings', $siteSettings);
    }
}
