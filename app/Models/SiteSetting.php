<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

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
        'custom_css',
        'custom_js',
        'header_scripts',
        'footer_scripts',
    ];

    protected $casts = [
        'sticky_header' => 'boolean',
    ];

    /**
     * Get the site settings (singleton pattern)
     */
    public static function getSettings()
    {
        return static::first() ?? new static();
    }
}
