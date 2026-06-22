<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class HomepageSection extends Model
{
    protected $fillable = [
        'section_key',
        'section_name',
        'position',
        'card_layout',
        'title',
        'subtitle',
        'description',
        'background_color',
        'background_image',
        'text_color',
        'css_class',
        'items_to_show',
        'settings',
        'order',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'order' => 'integer',
        'items_to_show' => 'integer',
        'settings' => 'array',
    ];

    public function cards(): HasMany
    {
        return $this->hasMany(PromotionalBanner::class, 'homepage_section_id');
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('order', 'asc');
    }

    public function scopeByKey($query, $key)
    {
        return $query->where('section_key', $key);
    }

    public function scopeByPosition($query, string $position)
    {
        return $query->where('position', $position);
    }
}
