<?php

namespace Tests\Unit;

use App\Services\PricingService;
use PHPUnit\Framework\TestCase;

class PricingServiceTest extends TestCase
{
    private PricingService $service;

    protected function setUp(): void
    {
        parent::setUp();
        $this->service = new PricingService();
    }

    private function makeItem(float $price, int $qty): object
    {
        return (object) [
            'product'  => (object) ['final_price' => $price],
            'quantity' => $qty,
        ];
    }

    private function calc(array $items): array
    {
        return $this->service->calculate(collect($items));
    }

    // ── Subtotal ──────────────────────────────────────────────────────────────

    public function test_subtotal_is_price_times_quantity(): void
    {
        $result = $this->calc([$this->makeItem(25.00, 3)]);
        $this->assertEquals(75.00, $result['subtotal']);
    }

    public function test_subtotal_sums_multiple_items(): void
    {
        $result = $this->calc([
            $this->makeItem(20.00, 2), // 40
            $this->makeItem(15.00, 4), // 60
        ]);
        $this->assertEquals(100.00, $result['subtotal']);
    }

    // ── Shipping ──────────────────────────────────────────────────────────────

    public function test_shipping_is_10_when_subtotal_below_threshold(): void
    {
        $result = $this->calc([$this->makeItem(9.99, 9)]); // 89.91
        $this->assertEquals(10.00, $result['shipping']);
    }

    public function test_shipping_is_free_at_exactly_the_threshold(): void
    {
        $result = $this->calc([
            $this->makeItem(20.00, 2), // 40
            $this->makeItem(15.00, 4), // 60  → 100.00 total
        ]);
        $this->assertEquals(0.0, $result['shipping']);
    }

    public function test_shipping_is_free_above_threshold(): void
    {
        $result = $this->calc([$this->makeItem(60.00, 3)]); // 180
        $this->assertEquals(0.0, $result['shipping']);
    }

    // ── Tax ───────────────────────────────────────────────────────────────────

    public function test_tax_is_always_zero(): void
    {
        $result = $this->calc([$this->makeItem(200.00, 1)]);
        $this->assertEquals(0.0, $result['tax']);
    }

    // ── Total ─────────────────────────────────────────────────────────────────

    public function test_total_below_threshold_is_subtotal_plus_shipping(): void
    {
        $result = $this->calc([$this->makeItem(30.00, 2)]); // subtotal 60

        $this->assertEquals(60.00, $result['subtotal']);
        $this->assertEquals(10.00, $result['shipping']);
        $this->assertEquals(0.00, $result['tax']);
        $this->assertEquals(70.00, $result['total']);
    }

    public function test_total_above_threshold_equals_subtotal(): void
    {
        $result = $this->calc([$this->makeItem(60.00, 2)]); // subtotal 120

        $this->assertEquals(120.00, $result['subtotal']);
        $this->assertEquals(0.00, $result['shipping']);
        $this->assertEquals(0.00, $result['tax']);
        $this->assertEquals(120.00, $result['total']);
    }

    // ── Constants ─────────────────────────────────────────────────────────────

    public function test_free_shipping_threshold_constant_is_100(): void
    {
        $this->assertEquals(100.0, PricingService::FREE_SHIPPING_THRESHOLD);
    }

    public function test_shipping_cost_constant_is_10(): void
    {
        $this->assertEquals(10.0, PricingService::SHIPPING_COST);
    }

    public function test_tax_rate_constant_is_zero(): void
    {
        $this->assertEquals(0.0, PricingService::TAX_RATE);
    }
}
