<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FeatureIcon extends Model
{
    protected $fillable = [
        'icon_type',
        'icon_class',
        'icon_image',
        'title',
        'description',
        'link_url',
        'open_new_tab',
        'icon_color',
        'background_color',
        'text_color',
        'icon_size',
        'order',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'open_new_tab' => 'boolean',
        'order' => 'integer',
        'icon_size' => 'integer',
    ];

    /**
     * Scope to get only active icons
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Scope to get icons ordered
     */
    public function scopeOrdered($query)
    {
        return $query->orderBy('order', 'asc');
    }
}
