<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class FaqSection extends Model
{
    protected $fillable = ['title', 'subtitle', 'is_active'];

    protected $casts = ['is_active' => 'boolean'];

    public function items(): HasMany
    {
        return $this->hasMany(FaqItem::class);
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }
}
