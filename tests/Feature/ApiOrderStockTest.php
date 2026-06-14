<?php

namespace Tests\Feature;

use App\Models\Cart;
use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ApiOrderStockTest extends TestCase
{
    use RefreshDatabase;

    private function apiHeaders(User $user): array
    {
        $token = $user->createToken('test')->plainTextToken;

        return [
            'Authorization' => 'Bearer ' . $token,
            'Accept' => 'application/json',
        ];
    }

    private function orderPayload(array $overrides = []): array
    {
        return array_merge([
            'shipping_address' => '123 Test Street, Riyadh',
            'payment_method'   => 'cod',
        ], $overrides);
    }

    // ── Sufficient stock ──────────────────────────────────────────────────────

    public function test_api_checkout_succeeds_and_returns_201(): void
    {
        $user = User::factory()->create();
        $product = Product::factory()->withStock(5)->create();
        Cart::factory()->for($user)->for($product)->create(['quantity' => 2]);

        $response = $this->postJson('/api/orders', $this->orderPayload(), $this->apiHeaders($user));

        $response->assertStatus(201)
            ->assertJsonPath('message', 'Order placed successfully');
    }

    public function test_api_checkout_decrements_stock_on_success(): void
    {
        $user = User::factory()->create();
        $product = Product::factory()->withStock(5)->create();
        Cart::factory()->for($user)->for($product)->create(['quantity' => 3]);

        $this->postJson('/api/orders', $this->orderPayload(), $this->apiHeaders($user));

        $this->assertDatabaseHas('products', ['id' => $product->id, 'stock' => 2]);
    }

    public function test_api_checkout_clears_cart_on_success(): void
    {
        $user = User::factory()->create();
        $product = Product::factory()->withStock(5)->create();
        Cart::factory()->for($user)->for($product)->create(['quantity' => 1]);

        $this->postJson('/api/orders', $this->orderPayload(), $this->apiHeaders($user));

        $this->assertDatabaseMissing('carts', ['user_id' => $user->id]);
    }

    // ── Insufficient stock ────────────────────────────────────────────────────

    public function test_api_checkout_returns_422_when_stock_insufficient(): void
    {
        $user = User::factory()->create();
        $product = Product::factory()->withStock(1)->create();
        Cart::factory()->for($user)->for($product)->create(['quantity' => 5]);

        $response = $this->postJson('/api/orders', $this->orderPayload(), $this->apiHeaders($user));

        $response->assertStatus(422)
            ->assertJsonStructure(['error']);
    }

    public function test_api_checkout_includes_product_name_in_error(): void
    {
        $user = User::factory()->create();
        $product = Product::factory()->withStock(1)->state(['name' => 'Widget Pro'])->create();
        Cart::factory()->for($user)->for($product)->create(['quantity' => 5]);

        $response = $this->postJson('/api/orders', $this->orderPayload(), $this->apiHeaders($user));

        $response->assertStatus(422);
        $this->assertStringContainsString('Widget Pro', $response->json('error'));
    }

    public function test_api_stock_not_decremented_on_failure(): void
    {
        $user = User::factory()->create();
        $product = Product::factory()->withStock(1)->create();
        Cart::factory()->for($user)->for($product)->create(['quantity' => 5]);

        $this->postJson('/api/orders', $this->orderPayload(), $this->apiHeaders($user));

        $this->assertDatabaseHas('products', ['id' => $product->id, 'stock' => 1]);
    }

    public function test_api_no_order_created_on_stock_failure(): void
    {
        $user = User::factory()->create();
        $product = Product::factory()->withStock(1)->create();
        Cart::factory()->for($user)->for($product)->create(['quantity' => 5]);

        $this->postJson('/api/orders', $this->orderPayload(), $this->apiHeaders($user));

        $this->assertDatabaseEmpty('orders');
        $this->assertDatabaseEmpty('order_items');
    }

    // ── Validate-all before mutate-all ────────────────────────────────────────

    public function test_api_no_stock_decremented_if_any_item_fails(): void
    {
        $user = User::factory()->create();

        $productA = Product::factory()->withStock(10)->create();
        $productB = Product::factory()->withStock(1)->create();

        Cart::factory()->for($user)->for($productA)->create(['quantity' => 2]);
        Cart::factory()->for($user)->for($productB)->create(['quantity' => 5]);

        $this->postJson('/api/orders', $this->orderPayload(), $this->apiHeaders($user));

        $this->assertDatabaseHas('products', ['id' => $productA->id, 'stock' => 10]);
        $this->assertDatabaseHas('products', ['id' => $productB->id, 'stock' => 1]);
    }

    // ── Stock boundary: reaches exactly zero ──────────────────────────────────

    public function test_api_checkout_with_exact_stock_reaches_zero(): void
    {
        $user = User::factory()->create();
        $product = Product::factory()->withStock(3)->create();
        Cart::factory()->for($user)->for($product)->create(['quantity' => 3]);

        $this->postJson('/api/orders', $this->orderPayload(), $this->apiHeaders($user));

        $this->assertDatabaseHas('products', ['id' => $product->id, 'stock' => 0]);
    }

    public function test_api_checkout_with_zero_stock_fails(): void
    {
        $user = User::factory()->create();
        $product = Product::factory()->outOfStock()->create();
        Cart::factory()->for($user)->for($product)->create(['quantity' => 1]);

        $response = $this->postJson('/api/orders', $this->orderPayload(), $this->apiHeaders($user));

        $response->assertStatus(422);
        $this->assertDatabaseHas('products', ['id' => $product->id, 'stock' => 0]);
    }

    // ── Auth guard ────────────────────────────────────────────────────────────

    public function test_api_order_requires_authentication(): void
    {
        $response = $this->postJson('/api/orders', $this->orderPayload(), [
            'Accept' => 'application/json',
        ]);

        $response->assertStatus(401);
    }

    public function test_api_returns_400_when_cart_is_empty(): void
    {
        $user = User::factory()->create();

        $response = $this->postJson('/api/orders', $this->orderPayload(), $this->apiHeaders($user));

        $response->assertStatus(400)
            ->assertJsonPath('error', 'Cart is empty');
    }
}
