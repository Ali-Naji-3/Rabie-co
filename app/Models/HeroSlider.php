<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HeroSlider extends Model
{
    protected $fillable = [
        'image',
        'mobile_image',
        'video',
        'video_thumbnail',
        'media_type',
        'video_url',
        'autoplay',
        'loop',
        'muted',
        'show_controls',
        'small_title',
        'main_title',
        'description',
        'button_text',
        'button_link',
        'text_alignment',
        'text_color',
        'background_overlay',
        'overlay_opacity',
        'order',
        'is_active',
        'animation',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'autoplay' => 'boolean',
        'loop' => 'boolean',
        'muted' => 'boolean',
        'show_controls' => 'boolean',
        'order' => 'integer',
        'overlay_opacity' => 'integer',
    ];

    /**
     * Scope to get only active sliders
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Scope to get sliders ordered
     */
    public function scopeOrdered($query)
    {
        return $query->orderBy('order', 'asc');
    }
}
