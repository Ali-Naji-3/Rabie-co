<?php

namespace App\Observers;

use App\Models\AuditLog;
use App\Models\Product;

class ProductObserver
{
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
    }
}
