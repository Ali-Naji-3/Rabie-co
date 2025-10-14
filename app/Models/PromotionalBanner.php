<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class PromotionalBanner extends Model
{
    protected $fillable = [
        'image',
        'mobile_image',
        'thumbnail',
        'title',
        'alt_text',
        'small_title',
        'main_title',
        'description',
        'button_text',
        'text_color',
        'text_alignment',
        'link_url',
        'open_new_tab',
        'position',
        'start_date',
        'end_date',
        'views_count',
        'clicks_count',
        'image_width',
        'image_height',
        'file_size',
        'order',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'open_new_tab' => 'boolean',
        'order' => 'integer',
        'views_count' => 'integer',
        'clicks_count' => 'integer',
        'image_width' => 'integer',
        'image_height' => 'integer',
        'file_size' => 'integer',
        'start_date' => 'datetime',
        'end_date' => 'datetime',
    ];

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
        return $query->orderBy('order', 'asc');
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
