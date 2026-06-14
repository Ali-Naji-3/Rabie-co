<?php

namespace Tests\Feature;

use App\Models\Cart;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class OrderSuccessAuthorizationTest extends TestCase
{
    use RefreshDatabase;

    // ── Owner access ──────────────────────────────────────────────────────────

    public function test_owner_can_view_own_order_success_page(): void
    {
        $owner = User::factory()->create();
        $order = Order::factory()->for($owner)->create();

        $response = $this->actingAs($owner)
            ->get(route('order.success', $order->id));

        $response->assertOk();
    }

    // ── Non-owner access ──────────────────────────────────────────────────────

    public function test_non_owner_is_forbidden(): void
    {
        $owner   = User::factory()->create();
        $other   = User::factory()->create();
        $order   = Order::factory()->for($owner)->create();

        $response = $this->actingAs($other)
            ->get(route('order.success', $order->id));

        $response->assertForbidden();
    }

    // ── Session-authorized access ─────────────────────────────────────────────

    public function test_session_authorized_non_owner_can_view_order(): void
    {
        $owner    = User::factory()->create();
        $nonOwner = User::factory()->create();
        $order    = Order::factory()->for($owner)->create();

        $response = $this->actingAs($nonOwner)
            ->withSession(['last_completed_order_id' => $order->id])
            ->get(route('order.success', $order->id));

        $response->assertOk();
    }

    // ── Session consumed after use ────────────────────────────────────────────

    public function test_session_key_is_consumed_after_successful_view(): void
    {
        $owner    = User::factory()->create();
        $nonOwner = User::factory()->create();
        $order    = Order::factory()->for($owner)->create();

        // First visit: session key present, access granted
        $response = $this->actingAs($nonOwner)
            ->withSession(['last_completed_order_id' => $order->id])
            ->get(route('order.success', $order->id));

        $response->assertOk();
        $response->assertSessionMissing('last_completed_order_id');

        // Second visit: key consumed, access denied
        $response2 = $this->actingAs($nonOwner)
            ->get(route('order.success', $order->id));

        $response2->assertForbidden();
    }

    // ── Missing session authorization ─────────────────────────────────────────

    public function test_missing_session_key_is_forbidden_for_non_owner(): void
    {
        $owner   = User::factory()->create();
        $other   = User::factory()->create();
        $order   = Order::factory()->for($owner)->create();

        $response = $this->actingAs($other)
            ->get(route('order.success', $order->id));

        $response->assertForbidden();
    }

    public function test_wrong_session_order_id_is_forbidden(): void
    {
        $owner   = User::factory()->create();
        $other   = User::factory()->create();
        $order   = Order::factory()->for($owner)->create();
        $decoy   = Order::factory()->for($owner)->create();

        // Session contains a different order's ID
        $response = $this->actingAs($other)
            ->withSession(['last_completed_order_id' => $decoy->id])
            ->get(route('order.success', $order->id));

        $response->assertForbidden();
    }

    // ── Orders with null user_id (post-deletion state) ────────────────────────

    public function test_null_user_id_order_is_forbidden_without_session(): void
    {
        $anyUser = User::factory()->create();
        $order   = Order::factory()->withNullUser()->create();

        $response = $this->actingAs($anyUser)
            ->get(route('order.success', $order->id));

        $response->assertForbidden();
    }

    public function test_null_user_id_order_is_accessible_with_valid_session(): void
    {
        $anyUser = User::factory()->create();
        $order   = Order::factory()->withNullUser()->create();

        $response = $this->actingAs($anyUser)
            ->withSession(['last_completed_order_id' => $order->id])
            ->get(route('order.success', $order->id));

        $response->assertOk();
    }

    // ── Unauthenticated user redirected (existing behavior preserved) ─────────

    public function test_unauthenticated_user_is_redirected_to_login(): void
    {
        $order = Order::factory()->create();

        $response = $this->get(route('order.success', $order->id));

        $response->assertRedirect(route('login'));
    }

    // ── Checkout process sets session order ID ────────────────────────────────

    public function test_checkout_process_stores_order_id_in_session(): void
    {
        $user    = User::factory()->create();
        $product = Product::factory()->withStock(5)->create();
        Cart::factory()->for($user)->for($product)->create(['quantity' => 1]);

        $response = $this->actingAs($user)->post(route('checkout.process'), [
            'name'           => 'Test User',
            'email'          => 'test@example.com',
            'phone'          => '0501234567',
            'address'        => '123 Main Street',
            'city'           => 'Riyadh',
            'country'        => 'Saudi Arabia',
            'payment_method' => 'cod',
        ]);

        $response->assertSessionHas('last_completed_order_id');
    }

    public function test_session_order_id_matches_created_order(): void
    {
        $user    = User::factory()->create();
        $product = Product::factory()->withStock(5)->create();
        Cart::factory()->for($user)->for($product)->create(['quantity' => 1]);

        $this->actingAs($user)->post(route('checkout.process'), [
            'name'           => 'Test User',
            'email'          => 'test@example.com',
            'phone'          => '0501234567',
            'address'        => '123 Main Street',
            'city'           => 'Riyadh',
            'country'        => 'Saudi Arabia',
            'payment_method' => 'cod',
        ]);

        $orderId = session('last_completed_order_id');
        $this->assertNotNull($orderId);
        $this->assertDatabaseHas('orders', ['id' => $orderId, 'user_id' => $user->id]);
    }
}
