<?php

namespace Tests\Feature;

use App\Models\Cart;
use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

/**
 * F4.1 — an is_active=false product must never be purchasable through any path:
 * add-to-cart, cart update, web checkout, or API checkout.
 */
class InactiveProductPurchaseTest extends TestCase
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

    // ── Add to cart ───────────────────────────────────────────────────────────

    public function test_inactive_product_cannot_be_added_to_cart(): void
    {
        $user = User::factory()->create();
        $product = Product::factory()->withStock(10)->state(['is_active' => false])->create();

        $response = $this->actingAs($user)
            ->post(route('cart.add'), ['product_id' => $product->id, 'quantity' => 1]);

        $response->assertSessionHas('error');
        $this->assertDatabaseMissing('carts', ['product_id' => $product->id]);
    }

    public function test_active_product_can_still_be_added_to_cart(): void
    {
        $user = User::factory()->create();
        $product = Product::factory()->withStock(10)->create();

        $this->actingAs($user)
            ->post(route('cart.add'), ['product_id' => $product->id, 'quantity' => 1]);

        $this->assertDatabaseHas('carts', [
            'user_id' => $user->id,
            'product_id' => $product->id,
            'quantity' => 1,
        ]);
    }

    // ── Cart update ───────────────────────────────────────────────────────────

    public function test_inactive_product_cannot_be_updated_in_cart(): void
    {
        $user = User::factory()->create();
        $product = Product::factory()->withStock(10)->create();
        $cart = Cart::factory()->for($user)->for($product)->create(['quantity' => 1]);

        $product->update(['is_active' => false]);

        $response = $this->actingAs($user)
            ->patch(route('cart.update', $cart->id), ['quantity' => 3]);

        $response->assertSessionHas('error');
        $this->assertDatabaseHas('carts', ['id' => $cart->id, 'quantity' => 1]);
    }

    // ── Web checkout ──────────────────────────────────────────────────────────

    public function test_inactive_product_cannot_be_checked_out(): void
    {
        $user = User::factory()->create();
        $product = Product::factory()->withStock(10)->create();
        Cart::factory()->for($user)->for($product)->create(['quantity' => 1]);

        // Product deactivated after it was placed in the cart.
        $product->update(['is_active' => false]);

        $this->actingAs($user)->post(route('checkout.process'), $this->checkoutPayload());

        $this->assertDatabaseEmpty('orders');
        $this->assertDatabaseEmpty('order_items');
        // Stock untouched and cart preserved so the user can amend it.
        $this->assertDatabaseHas('products', ['id' => $product->id, 'stock' => 10]);
        $this->assertDatabaseHas('carts', ['user_id' => $user->id]);
    }

    // ── API checkout ──────────────────────────────────────────────────────────

    public function test_inactive_product_cannot_be_ordered_via_api(): void
    {
        $user = User::factory()->create();
        $product = Product::factory()->withStock(10)->state(['name' => 'Gone Product'])->create();
        Cart::factory()->for($user)->for($product)->create(['quantity' => 1]);

        $product->update(['is_active' => false]);

        $response = $this->postJson(
            '/api/orders',
            ['shipping_address' => '123 Test St', 'payment_method' => 'cod'],
            $this->apiHeaders($user),
        );

        $response->assertStatus(422);
        $this->assertStringContainsString('Gone Product', $response->json('error'));
        $this->assertDatabaseEmpty('orders');
        $this->assertDatabaseHas('products', ['id' => $product->id, 'stock' => 10]);
    }
}
