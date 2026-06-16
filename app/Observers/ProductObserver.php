<?php

namespace App\Observers;

use App\Models\AuditLog;
use App\Models\Product;
use Illuminate\Support\Facades\Cache;

class ProductObserver
{
    /**
     * Fields that affect the cached featured-products/category-count
     * results. Deliberately excludes 'stock', which changes on every order
     * checkout — busting the cache on every stock decrement would defeat
     * most of the caching benefit during normal order volume.
     */
    private const DISPLAY_FIELDS = ['is_active', 'is_featured', 'name', 'price', 'sale_price', 'discount_percentage', 'primary_image'];

    public function created(Product $product): void
    {
        Cache::forget('products:featured');
        Cache::forget('categories:active_with_counts');
    }

    public function updated(Product $product): void
    {
        if ($product->wasChanged('price')) {
            AuditLog::record('product_price_changed', $product,
                ['price' => $product->getOriginal('price')],
                ['price' => $product->getChanges()['price']]
            );
        }

        if ($product->wasChanged('stock') && auth()->user()?->role === 'admin') {
            AuditLog::record('product_stock_changed', $product,
                ['stock' => $product->getOriginal('stock')],
                ['stock' => $product->getChanges()['stock']]
            );
        }

        if ($product->wasChanged(self::DISPLAY_FIELDS)) {
            Cache::forget('products:featured');
        }

        if ($product->wasChanged('category_id')) {
            Cache::forget('categories:active_with_counts');
        }
    }

    public function deleted(Product $product): void
    {
        Cache::forget('products:featured');
        Cache::forget('categories:active_with_counts');
    }
}
