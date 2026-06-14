<?php

namespace Tests\Feature;

use App\Models\Cart;
use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CheckoutStockTest extends TestCase
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

    // ── Sufficient stock ──────────────────────────────────────────────────────

    public function test_checkout_succeeds_and_decrements_stock(): void
    {
        $user = User::factory()->create();
        $product = Product::factory()->withStock(5)->create();
        Cart::factory()->for($user)->for($product)->create(['quantity' => 2]);

        $this->actingAs($user)->post(route('checkout.process'), $this->checkoutPayload());

        $this->assertDatabaseHas('products', ['id' => $product->id, 'stock' => 3]);
    }

    public function test_checkout_creates_order_item_with_correct_quantity(): void
    {
        $user = User::factory()->create();
        $product = Product::factory()->withStock(10)->create();
        Cart::factory()->for($user)->for($product)->create(['quantity' => 3]);

        $this->actingAs($user)->post(route('checkout.process'), $this->checkoutPayload());

        $this->assertDatabaseHas('order_items', [
            'product_id' => $product->id,
            'quantity' => 3,
        ]);
    }

    public function test_checkout_clears_cart_on_success(): void
    {
        $user = User::factory()->create();
        $product = Product::factory()->withStock(5)->create();
        Cart::factory()->for($user)->for($product)->create(['quantity' => 1]);

        $this->actingAs($user)->post(route('checkout.process'), $this->checkoutPayload());

        $this->assertDatabaseMissing('carts', ['user_id' => $user->id]);
    }

    // ── Insufficient stock ────────────────────────────────────────────────────

    public function test_checkout_fails_when_stock_is_insufficient(): void
    {
        $user = User::factory()->create();
        $product = Product::factory()->withStock(1)->create();
        Cart::factory()->for($user)->for($product)->create(['quantity' => 2]);

        $response = $this->actingAs($user)
            ->post(route('checkout.process'), $this->checkoutPayload());

        $response->assertRedirect();
        $response->assertSessionHas('error');
    }

    public function test_stock_is_not_decremented_when_checkout_fails(): void
    {
        $user = User::factory()->create();
        $product = Product::factory()->withStock(1)->create();
        Cart::factory()->for($user)->for($product)->create(['quantity' => 5]);

        $this->actingAs($user)->post(route('checkout.process'), $this->checkoutPayload());

        $this->assertDatabaseHas('products', ['id' => $product->id, 'stock' => 1]);
    }

    public function test_no_order_is_created_when_stock_check_fails(): void
    {
        $user = User::factory()->create();
        $product = Product::factory()->withStock(1)->create();
        Cart::factory()->for($user)->for($product)->create(['quantity' => 5]);

        $this->actingAs($user)->post(route('checkout.process'), $this->checkoutPayload());

        $this->assertDatabaseEmpty('orders');
        $this->assertDatabaseEmpty('order_items');
    }

    // ── Validate-all before mutate-all ────────────────────────────────────────
    // If item 2 fails stock, item 1 must NOT be decremented (no partial mutations).

    public function test_no_stock_is_decremented_if_any_item_fails(): void
    {
        $user = User::factory()->create();

        $productA = Product::factory()->withStock(10)->create();
        $productB = Product::factory()->withStock(1)->create();

        Cart::factory()->for($user)->for($productA)->create(['quantity' => 2]);
        Cart::factory()->for($user)->for($productB)->create(['quantity' => 5]);

        $this->actingAs($user)->post(route('checkout.process'), $this->checkoutPayload());

        // Product A must be untouched even though it had sufficient stock
        $this->assertDatabaseHas('products', ['id' => $productA->id, 'stock' => 10]);
        // Product B also untouched
        $this->assertDatabaseHas('products', ['id' => $productB->id, 'stock' => 1]);
    }

    public function test_cart_is_not_cleared_when_checkout_fails(): void
    {
        $user = User::factory()->create();
        $product = Product::factory()->withStock(1)->create();
        Cart::factory()->for($user)->for($product)->create(['quantity' => 5]);

        $this->actingAs($user)->post(route('checkout.process'), $this->checkoutPayload());

        $this->assertDatabaseHas('carts', ['user_id' => $user->id]);
    }

    // ── Stock boundary: reaches exactly zero ──────────────────────────────────

    public function test_checkout_with_exact_stock_succeeds_and_reaches_zero(): void
    {
        $user = User::factory()->create();
        $product = Product::factory()->withStock(2)->create();
        Cart::factory()->for($user)->for($product)->create(['quantity' => 2]);

        $this->actingAs($user)->post(route('checkout.process'), $this->checkoutPayload());

        $this->assertDatabaseHas('products', ['id' => $product->id, 'stock' => 0]);
    }

    public function test_checkout_with_zero_stock_fails(): void
    {
        $user = User::factory()->create();
        $product = Product::factory()->outOfStock()->create();
        Cart::factory()->for($user)->for($product)->create(['quantity' => 1]);

        $this->actingAs($user)->post(route('checkout.process'), $this->checkoutPayload());

        $this->assertDatabaseHas('products', ['id' => $product->id, 'stock' => 0]);
        $this->assertDatabaseEmpty('orders');
    }
}
