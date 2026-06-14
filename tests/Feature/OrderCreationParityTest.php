<?php

namespace Tests\Feature;

use App\Models\Cart;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class OrderCreationParityTest extends TestCase
{
    use RefreshDatabase;

    private function apiHeaders(User $user): array
    {
        return [
            'Authorization' => 'Bearer ' . $user->createToken('test')->plainTextToken,
            'Accept'        => 'application/json',
        ];
    }

    private function fixedPriceProduct(float $price): Product
    {
        return Product::factory()
            ->state(['price' => $price, 'sale_price' => null, 'discount_percentage' => 0])
            ->withStock(20)
            ->create();
    }

    private function legacyPayload(array $overrides = []): array
    {
        return array_merge([
            'shipping_address' => '123 Main Street',
            'payment_method'   => 'cod',
        ], $overrides);
    }

    private function structuredPayload(array $overrides = []): array
    {
        return array_merge([
            'name'           => 'Ali Alnaji',
            'address'        => '123 Main Street',
            'city'           => 'Riyadh',
            'country'        => 'Saudi Arabia',
            'phone'          => '0501234567',
            'payment_method' => 'cod',
        ], $overrides);
    }

    // ── Address format — legacy ───────────────────────────────────────────────

    public function test_legacy_payload_is_accepted(): void
    {
        $user    = User::factory()->create();
        $product = $this->fixedPriceProduct(30.00);
        Cart::factory()->for($user)->for($product)->create(['quantity' => 1]);

        $this->postJson('/api/orders', $this->legacyPayload(), $this->apiHeaders($user))
             ->assertStatus(201);
    }

    public function test_legacy_shipping_address_stored_as_partial_json(): void
    {
        $user    = User::factory()->create();
        $product = $this->fixedPriceProduct(30.00);
        Cart::factory()->for($user)->for($product)->create(['quantity' => 1]);

        $this->postJson('/api/orders', $this->legacyPayload(), $this->apiHeaders($user));

        $order   = Order::where('user_id', $user->id)->firstOrFail();
        $decoded = json_decode($order->shipping_address, true);
        $this->assertIsArray($decoded);
        $this->assertEquals('123 Main Street', $decoded['address']);
    }

    // ── Address format — structured ───────────────────────────────────────────

    public function test_structured_payload_is_accepted(): void
    {
        $user    = User::factory()->create();
        $product = $this->fixedPriceProduct(30.00);
        Cart::factory()->for($user)->for($product)->create(['quantity' => 1]);

        $this->postJson('/api/orders', $this->structuredPayload(), $this->apiHeaders($user))
             ->assertStatus(201);
    }

    public function test_structured_shipping_address_stored_as_full_json(): void
    {
        $user    = User::factory()->create();
        $product = $this->fixedPriceProduct(30.00);
        Cart::factory()->for($user)->for($product)->create(['quantity' => 1]);

        $this->postJson('/api/orders', $this->structuredPayload(), $this->apiHeaders($user));

        $order   = Order::where('user_id', $user->id)->firstOrFail();
        $decoded = json_decode($order->shipping_address, true);
        $this->assertIsArray($decoded);
        $this->assertEquals('Ali Alnaji',      $decoded['name']);
        $this->assertEquals('123 Main Street', $decoded['address']);
        $this->assertEquals('Riyadh',          $decoded['city']);
        $this->assertEquals('Saudi Arabia',    $decoded['country']);
        $this->assertEquals('0501234567',      $decoded['phone']);
    }

    public function test_structured_billing_address_mirrors_shipping(): void
    {
        $user    = User::factory()->create();
        $product = $this->fixedPriceProduct(30.00);
        Cart::factory()->for($user)->for($product)->create(['quantity' => 1]);

        $this->postJson('/api/orders', $this->structuredPayload(), $this->apiHeaders($user));

        $order = Order::where('user_id', $user->id)->firstOrFail();
        $this->assertEquals($order->shipping_address, $order->billing_address);
    }

    // ── payment_method ────────────────────────────────────────────────────────

    public function test_payment_method_is_stored(): void
    {
        $user    = User::factory()->create();
        $product = $this->fixedPriceProduct(30.00);
        Cart::factory()->for($user)->for($product)->create(['quantity' => 1]);

        $this->postJson('/api/orders', $this->structuredPayload(['payment_method' => 'bank_transfer']), $this->apiHeaders($user));

        $order = Order::where('user_id', $user->id)->firstOrFail();
        $this->assertEquals('bank_transfer', $order->payment_method);
    }

    public function test_invalid_payment_method_returns_422(): void
    {
        $user = User::factory()->create();

        $this->postJson('/api/orders', $this->structuredPayload(['payment_method' => 'crypto']), $this->apiHeaders($user))
             ->assertStatus(422);
    }

    public function test_missing_payment_method_returns_422(): void
    {
        $user    = User::factory()->create();
        $payload = $this->structuredPayload();
        unset($payload['payment_method']);

        $this->postJson('/api/orders', $payload, $this->apiHeaders($user))
             ->assertStatus(422);
    }

    // ── customer_email ────────────────────────────────────────────────────────

    public function test_customer_email_uses_provided_value(): void
    {
        $user    = User::factory()->create(['email' => 'user@example.com']);
        $product = $this->fixedPriceProduct(30.00);
        Cart::factory()->for($user)->for($product)->create(['quantity' => 1]);

        $this->postJson('/api/orders', $this->structuredPayload(['email' => 'contact@example.com']), $this->apiHeaders($user));

        $order = Order::where('user_id', $user->id)->firstOrFail();
        $this->assertEquals('contact@example.com', $order->customer_email);
    }

    public function test_customer_email_falls_back_to_auth_user_email(): void
    {
        $user    = User::factory()->create(['email' => 'user@example.com']);
        $product = $this->fixedPriceProduct(30.00);
        Cart::factory()->for($user)->for($product)->create(['quantity' => 1]);

        $this->postJson('/api/orders', $this->structuredPayload(), $this->apiHeaders($user));

        $order = Order::where('user_id', $user->id)->firstOrFail();
        $this->assertEquals('user@example.com', $order->customer_email);
    }

    // ── notes ─────────────────────────────────────────────────────────────────

    public function test_notes_over_500_chars_returns_422(): void
    {
        $user = User::factory()->create();

        $this->postJson('/api/orders', $this->structuredPayload(['notes' => str_repeat('x', 501)]), $this->apiHeaders($user))
             ->assertStatus(422);
    }
}
