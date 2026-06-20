<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Symfony\Component\HtmlSanitizer\HtmlSanitizer;
use Symfony\Component\HtmlSanitizer\HtmlSanitizerConfig;

class Product extends Model
{
    use HasFactory;
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
        'rating',
        'rating_count',
        'auto_review_count',
        'short_description',
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'sale_price' => 'decimal:2',
        'images' => 'array',
        'is_featured' => 'boolean',
        'is_active' => 'boolean',
        'rating' => 'decimal:1',
        'rating_count' => 'integer',
        'auto_review_count' => 'boolean',
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
    
    public function getDisplayRatingAttribute(): ?float
    {
        if ($this->rating !== null) {
            return (float) $this->rating;
        }
        $avg = $this->getAttribute('avg_rating');
        return $avg !== null ? round((float) $avg, 1) : null;
    }

    public function getDisplayReviewCountAttribute(): ?int
    {
        if ($this->auto_review_count) {
            $count = $this->getAttribute('approved_review_count');
            return $count !== null ? (int) $count : null;
        }
        return $this->rating_count;
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

    public function setDescriptionAttribute(?string $value): void
    {
        if ($value === null) {
            $this->attributes['description'] = null;
            return;
        }

        static $sanitizer;
        $sanitizer ??= new HtmlSanitizer(
            (new HtmlSanitizerConfig())
                ->allowElement('p')
                ->allowElement('br')
                ->allowElement('strong')
                ->allowElement('em')
                ->allowElement('u')
                ->allowElement('s')
                ->allowElement('ul')
                ->allowElement('ol')
                ->allowElement('li')
                ->allowElement('a', ['href'])
                ->allowLinkSchemes(['http', 'https'])
                ->dropElement('script')
                ->dropElement('iframe')
                ->dropElement('object')
                ->dropElement('embed')
                ->dropElement('svg')
                ->withMaxInputLength(500000)
        );

        // RFC 3986 §3.1: schemes are case-insensitive. Symfony's allowLinkSchemes
        // check is strict-case, so normalize href schemes to lowercase first.
        $value = (string) preg_replace_callback(
            '/href="([^"]*)"/i',
            static function (array $m): string {
                $url = preg_replace_callback(
                    '/^([a-zA-Z][a-zA-Z0-9+\-.]*):/u',
                    static fn (array $n): string => strtolower($n[0]),
                    $m[1],
                ) ?? $m[1];
                return 'href="' . $url . '"';
            },
            $value,
        ) ?? $value;

        $this->attributes['description'] = $sanitizer->sanitize($value);
    }
}
