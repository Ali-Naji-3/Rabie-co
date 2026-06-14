<?php

namespace Tests\Feature;

use App\Models\Cart;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

/**
 * Pricing parity: web and API checkouts are asserted against the same expected
 * values rather than compared to each other in one request, which avoids
 * actingAs() guard state leaking across calls in the same test method.
 */
class PricingParityTest extends TestCase
{
    use RefreshDatabase;

    private function checkoutPayload(): array
    {
        return [
            'name'           => 'Test User',
            'email'          => 'test@example.com',
            'phone'          => '0501234567',
            'address'        => '123 Main Street',
            'city'           => 'Riyadh',
            'country'        => 'Saudi Arabia',
            'payment_method' => 'cod',
        ];
    }

    private function apiHeaders(User $user): array
    {
        return [
            'Authorization' => 'Bearer ' . $user->createToken('test')->plainTextToken,
            'Accept'        => 'application/json',
        ];
    }

    private function apiLegacyPayload(): array
    {
        return [
            'shipping_address' => '123 Test St',
            'payment_method'   => 'cod',
        ];
    }

    private function fixedPriceProduct(float $price): Product
    {
        return Product::factory()
            ->state(['price' => $price, 'sale_price' => null, 'discount_percentage' => 0])
            ->withStock(20)
            ->create();
    }

    // ── Web checkout — below free-shipping threshold ($30 × 2 = $60) ─────────

    public function test_web_checkout_totals_below_threshold(): void
    {
        $user    = User::factory()->create();
        $product = $this->fixedPriceProduct(30.00);
        Cart::factory()->for($user)->for($product)->create(['quantity' => 2]);

        $this->actingAs($user)->post(route('checkout.process'), $this->checkoutPayload());

        $order = Order::where('user_id', $user->id)->firstOrFail();
        $this->assertEquals(60.00, (float) $order->subtotal);
        $this->assertEquals(10.00, (float) $order->shipping);
        $this->assertEquals(0.00,  (float) $order->tax);
        $this->assertEquals(70.00, (float) $order->total);
    }

    // ── API checkout — below free-shipping threshold ($30 × 2 = $60) ─────────

    public function test_api_checkout_totals_below_threshold(): void
    {
        $user    = User::factory()->create();
        $product = $this->fixedPriceProduct(30.00);
        Cart::factory()->for($user)->for($product)->create(['quantity' => 2]);

        $this->postJson('/api/orders', $this->apiLegacyPayload(), $this->apiHeaders($user));

        $order = Order::where('user_id', $user->id)->firstOrFail();
        $this->assertEquals(60.00, (float) $order->subtotal);
        $this->assertEquals(10.00, (float) $order->shipping);
        $this->assertEquals(0.00,  (float) $order->tax);
        $this->assertEquals(70.00, (float) $order->total);
    }

    // ── Web checkout — at free-shipping threshold ($50 × 2 = $100) ───────────

    public function test_web_checkout_totals_at_threshold(): void
    {
        $user    = User::factory()->create();
        $product = $this->fixedPriceProduct(50.00);
        Cart::factory()->for($user)->for($product)->create(['quantity' => 2]);

        $this->actingAs($user)->post(route('checkout.process'), $this->checkoutPayload());

        $order = Order::where('user_id', $user->id)->firstOrFail();
        $this->assertEquals(100.00, (float) $order->subtotal);
        $this->assertEquals(0.00,   (float) $order->shipping);
        $this->assertEquals(0.00,   (float) $order->tax);
        $this->assertEquals(100.00, (float) $order->total);
    }

    // ── API checkout — at free-shipping threshold ($50 × 2 = $100) ───────────

    public function test_api_checkout_totals_at_threshold(): void
    {
        $user    = User::factory()->create();
        $product = $this->fixedPriceProduct(50.00);
        Cart::factory()->for($user)->for($product)->create(['quantity' => 2]);

        $this->postJson('/api/orders', $this->apiLegacyPayload(), $this->apiHeaders($user));

        $order = Order::where('user_id', $user->id)->firstOrFail();
        $this->assertEquals(100.00, (float) $order->subtotal);
        $this->assertEquals(0.00,   (float) $order->shipping);
        $this->assertEquals(0.00,   (float) $order->tax);
        $this->assertEquals(100.00, (float) $order->total);
    }

    // ── Web checkout — above free-shipping threshold ($60 × 2 = $120) ────────

    public function test_web_checkout_totals_above_threshold(): void
    {
        $user    = User::factory()->create();
        $product = $this->fixedPriceProduct(60.00);
        Cart::factory()->for($user)->for($product)->create(['quantity' => 2]);

        $this->actingAs($user)->post(route('checkout.process'), $this->checkoutPayload());

        $order = Order::where('user_id', $user->id)->firstOrFail();
        $this->assertEquals(120.00, (float) $order->subtotal);
        $this->assertEquals(0.00,   (float) $order->shipping);
        $this->assertEquals(0.00,   (float) $order->tax);
        $this->assertEquals(120.00, (float) $order->total);
    }

    // ── API checkout — above free-shipping threshold ($60 × 2 = $120) ────────

    public function test_api_checkout_totals_above_threshold(): void
    {
        $user    = User::factory()->create();
        $product = $this->fixedPriceProduct(60.00);
        Cart::factory()->for($user)->for($product)->create(['quantity' => 2]);

        $this->postJson('/api/orders', $this->apiLegacyPayload(), $this->apiHeaders($user));

        $order = Order::where('user_id', $user->id)->firstOrFail();
        $this->assertEquals(120.00, (float) $order->subtotal);
        $this->assertEquals(0.00,   (float) $order->shipping);
        $this->assertEquals(0.00,   (float) $order->tax);
        $this->assertEquals(120.00, (float) $order->total);
    }
}
