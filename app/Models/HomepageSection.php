<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HomepageSection extends Model
{
    protected $fillable = [
        'section_key',
        'section_name',
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

    /**
     * Scope to get only active sections
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Scope to get sections ordered
     */
    public function scopeOrdered($query)
    {
        return $query->orderBy('order', 'asc');
    }

    /**
     * Scope to get section by key
     */
    public function scopeByKey($query, $key)
    {
        return $query->where('section_key', $key);
    }
}
