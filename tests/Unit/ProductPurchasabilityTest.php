<?php

namespace Tests\Unit;

use App\Models\Product;
use PHPUnit\Framework\TestCase;

/**
 * F4.1 — SSOT predicates for purchasability. Pure in-memory, no DB.
 */
class ProductPurchasabilityTest extends TestCase
{
    public function test_active_product_is_purchasable(): void
    {
        $product = new Product(['is_active' => true]);

        $this->assertTrue($product->isPurchasable());
    }

    public function test_inactive_product_is_not_purchasable(): void
    {
        $product = new Product(['is_active' => false]);

        $this->assertFalse($product->isPurchasable());
    }

    public function test_purchasability_is_independent_of_stock(): void
    {
        // In stock but deactivated → still not purchasable.
        $product = new Product(['is_active' => false, 'stock' => 50]);

        $this->assertFalse($product->isPurchasable());
    }

    public function test_has_stock_for_respects_quantity_boundary(): void
    {
        $product = new Product(['stock' => 3]);

        $this->assertTrue($product->hasStockFor(3));   // exact
        $this->assertTrue($product->hasStockFor(1));   // under
        $this->assertFalse($product->hasStockFor(4));  // over
    }

    public function test_zero_stock_cannot_fulfil_any_positive_quantity(): void
    {
        $product = new Product(['stock' => 0]);

        $this->assertFalse($product->hasStockFor(1));
    }
}
