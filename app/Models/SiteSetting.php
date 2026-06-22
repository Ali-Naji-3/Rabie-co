<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class SiteSetting extends Model
{
    protected $fillable = [
        'site_name',
        'site_tagline',
        'site_description',
        'logo',
        'footer_logo',
        'favicon',
        'header_background_color',
        'header_text_color',
        'sticky_header',
        'phone',
        'email',
        'address',
        'whatsapp',
        'working_hours',
        'facebook_url',
        'instagram_url',
        'twitter_url',
        'linkedin_url',
        'youtube_url',
        'tiktok_url',
        'meta_title',
        'meta_description',
        'meta_keywords',
        'og_image',
        'google_analytics_id',
        'google_tag_manager_id',
        'footer_description',
        'copyright_text',
        'footer_background_color',
        'footer_text_color',
        'default_currency',
        'enable_product_card_ctas',
        'enable_buy_now_button',
    ];

    protected $casts = [
        'sticky_header' => 'boolean',
        'enable_product_card_ctas' => 'boolean',
        'enable_buy_now_button' => 'boolean',
    ];

    /**
     * Container key for the per-request resolved settings instance.
     * Registered as a `scoped` binding in AppServiceProvider so the cache
     * lookup happens at most once per request and is flushed at the request
     * boundary (no cross-request/test leakage).
     */
    public const REQUEST_CACHE_KEY = 'storefront.site_settings';

    /**
     * Get the site settings (singleton pattern).
     *
     * Resolves through a per-request `scoped` binding so repeated callers
     * (view composer, CurrencyService, controllers) share a single cache
     * lookup. Falls back to the direct cache read when the binding is not
     * registered (e.g. early boot, isolated unit tests).
     */
    public static function getSettings()
    {
        if (app()->bound(self::REQUEST_CACHE_KEY)) {
            return app(self::REQUEST_CACHE_KEY);
        }

        return Cache::remember('site_settings', 1800, fn () => static::first() ?? new static());
    }
}
