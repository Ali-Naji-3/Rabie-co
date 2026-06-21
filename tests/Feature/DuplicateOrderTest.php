<?php

namespace Tests\Feature;

use App\Models\Cart;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

/**
 * F5.1 — one cart must produce at most one order.
 *
 * True wall-clock concurrency cannot be driven from a single-threaded test
 * runner, so the cart-consumption invariant is exercised deterministically:
 * once a cart has been converted (rows deleted under lock), any further
 * submission re-reads an empty cart and is rejected. The row lock added in
 * CheckoutController / Api\OrderController is what makes this hold under real
 * concurrency — see the inline comments there.
 */
class DuplicateOrderTest extends TestCase
{
    use RefreshDatabase;

    private function checkoutPayload(array $overrides = []): array
    {
        return array_merge([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'phone' => '0501234567',
            'address' => '123 Main Street',
            'city' => 'Riyadh',
            'country' => 'Saudi Arabia',
            'payment_method' => 'cod',
        ], $overrides);
    }

    private function apiHeaders(User $user): array
    {
        return [
            'Authorization' => 'Bearer ' . $user->createToken('test')->plainTextToken,
            'Accept' => 'application/json',
        ];
    }

    // ── Web checkout ──────────────────────────────────────────────────────────

    public function test_single_web_checkout_creates_exactly_one_order(): void
    {
        $user = User::factory()->create();
        $product = Product::factory()->withStock(10)->create();
        Cart::factory()->for($user)->for($product)->create(['quantity' => 2]);

        $this->actingAs($user)->post(route('checkout.process'), $this->checkoutPayload());

        $this->assertSame(1, Order::count());
        $this->assertDatabaseHas('products', ['id' => $product->id, 'stock' => 8]);
    }

    public function test_second_web_checkout_on_consumed_cart_creates_no_second_order(): void
    {
        $user = User::factory()->create();
        $product = Product::factory()->withStock(10)->create();
        Cart::factory()->for($user)->for($product)->create(['quantity' => 2]);

        // First submission consumes the cart.
        $this->actingAs($user)->post(route('checkout.process'), $this->checkoutPayload());
        // Replayed submission (e.g. back-button re-POST) — cart is now empty.
        $second = $this->actingAs($user)->post(route('checkout.process'), $this->checkoutPayload());

        $second->assertRedirect(route('cart'));
        $this->assertSame(1, Order::count());
        // Stock decremented once only.
        $this->assertDatabaseHas('products', ['id' => $product->id, 'stock' => 8]);
    }

    // ── API checkout ──────────────────────────────────────────────────────────

    public function test_single_api_checkout_creates_exactly_one_order(): void
    {
        $user = User::factory()->create();
        $product = Product::factory()->withStock(10)->create();
        Cart::factory()->for($user)->for($product)->create(['quantity' => 2]);

        $this->postJson('/api/orders', ['shipping_address' => '123 St', 'payment_method' => 'cod'], $this->apiHeaders($user))
            ->assertStatus(201);

        $this->assertSame(1, Order::count());
        $this->assertDatabaseHas('products', ['id' => $product->id, 'stock' => 8]);
    }

    public function test_second_api_checkout_on_consumed_cart_creates_no_second_order(): void
    {
        $user = User::factory()->create();
        $product = Product::factory()->withStock(10)->create();
        Cart::factory()->for($user)->for($product)->create(['quantity' => 2]);

        $headers = $this->apiHeaders($user);
        $this->postJson('/api/orders', ['shipping_address' => '123 St', 'payment_method' => 'cod'], $headers)
            ->assertStatus(201);
        $second = $this->postJson('/api/orders', ['shipping_address' => '123 St', 'payment_method' => 'cod'], $headers);

        $second->assertStatus(400)->assertJsonPath('error', 'Cart is empty');
        $this->assertSame(1, Order::count());
        $this->assertDatabaseHas('products', ['id' => $product->id, 'stock' => 8]);
    }
}
