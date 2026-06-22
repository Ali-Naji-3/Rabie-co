<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Carbon\Carbon;

class PromotionalBanner extends Model
{
    protected $fillable = [
        'homepage_section_id',
        'image',
        'mobile_image',
        'focal_point',
        'video',
        'video_thumbnail',
        'media_type',
        'video_url',
        'autoplay',
        'loop',
        'muted',
        'show_controls',
        'title',
        'alt_text',
        'small_title',
        'main_title',
        'bottom_title',
        'description',
        'bottom_description',
        'button_text',
        'text_color',
        'text_alignment',
        'link_url',
        'open_new_tab',
        'position',
        'start_date',
        'end_date',
        'order',
        'is_active',
        'settings',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'open_new_tab' => 'boolean',
        'autoplay' => 'boolean',
        'loop' => 'boolean',
        'muted' => 'boolean',
        'show_controls' => 'boolean',
        'order' => 'integer',
        'start_date' => 'datetime',
        'end_date' => 'datetime',
        'settings' => 'array',
    ];

    public function section(): BelongsTo
    {
        return $this->belongsTo(HomepageSection::class, 'homepage_section_id');
    }

    /**
     * Scope to get only active banners
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Scope to get banners that are currently scheduled
     */
    public function scopeScheduled($query)
    {
        $now = Carbon::now();
        return $query->where(function ($q) use ($now) {
            $q->where('start_date', '<=', $now)
              ->orWhereNull('start_date');
        })->where(function ($q) use ($now) {
            $q->where('end_date', '>=', $now)
              ->orWhereNull('end_date');
        });
    }

    /**
     * Scope to get banners ordered
     */
    public function scopeOrdered($query)
    {
        return $query->orderBy('order', 'asc')->orderBy('id', 'asc');
    }

    /**
     * Scope to get banners by position
     */
    public function scopeByPosition($query, $position)
    {
        return $query->where('position', $position);
    }

    /**
     * Increment views count
     */
    public function incrementViews()
    {
        $this->increment('views_count');
    }

    /**
     * Increment clicks count
     */
    public function incrementClicks()
    {
        $this->increment('clicks_count');
    }

    /**
     * Get click-through rate
     */
    public function getClickThroughRateAttribute()
    {
        if ($this->views_count === 0) {
            return 0;
        }
        return round(($this->clicks_count / $this->views_count) * 100, 2);
    }
}
