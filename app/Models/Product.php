<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{
    protected $fillable = [
        'category_id',
        'name',
        'slug',
        'description',
        'price',
        'discount_percentage',
        'sale_price',
        'stock',
        'primary_image',
        'images',
        'sku',
        'is_featured',
        'is_active',
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'sale_price' => 'decimal:2',
        'images' => 'array',
        'is_featured' => 'boolean',
        'is_active' => 'boolean',
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function reviews(): HasMany
    {
        return $this->hasMany(Review::class);
    }

    public function orderItems(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }
    
    // Auto-calculate sale price from percentage
    public function getSalePriceAttribute($value)
    {
        // If discount percentage is set, calculate sale price
        if ($this->attributes['discount_percentage'] > 0) {
            $discount = $this->attributes['price'] * ($this->attributes['discount_percentage'] / 100);
            return round($this->attributes['price'] - $discount, 2);
        }
        
        // Otherwise return the stored sale_price
        return $value;
    }
    
    // Get final price (sale price if available, otherwise regular price)
    public function getFinalPriceAttribute()
    {
        return $this->sale_price ?? $this->price;
    }
}
