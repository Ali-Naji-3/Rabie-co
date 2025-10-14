<?php

namespace App\Observers;

use App\Models\SiteSetting;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Artisan;

class SiteSettingObserver
{
    /**
     * Handle the SiteSetting "created" event.
     */
    public function created(SiteSetting $siteSetting): void
    {
        $this->clearSiteSettingsCache();
    }

    /**
     * Handle the SiteSetting "updated" event.
     */
    public function updated(SiteSetting $siteSetting): void
    {
        $this->clearSiteSettingsCache();
    }

    /**
     * Handle the SiteSetting "deleted" event.
     */
    public function deleted(SiteSetting $siteSetting): void
    {
        $this->clearSiteSettingsCache();
    }

    /**
     * Handle the SiteSetting "saved" event.
     */
    public function saved(SiteSetting $siteSetting): void
    {
        $this->clearSiteSettingsCache();
    }

    /**
     * Clear site settings cache
     */
    private function clearSiteSettingsCache(): void
    {
        // Clear the site_settings cache key
        Cache::forget('site_settings');
        
        // Optionally clear view cache as well
        try {
            Artisan::call('view:clear');
        } catch (\Exception $e) {
            // Fail silently if view:clear fails
        }
    }
}
