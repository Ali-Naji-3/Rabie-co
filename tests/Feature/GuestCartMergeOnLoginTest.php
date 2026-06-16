<?php

namespace Tests\Feature;

use App\Models\Cart;
use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class GuestCartMergeOnLoginTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Start a real session and return its ID, so it can be reused as the
     * guest session cookie on a follow-up request within the same test.
     */
    private function establishGuestSession(): string
    {
        $this->startSession();

        return session()->getId();
    }

    private function loginAs(User $user, string $sessionId)
    {
        return $this->withCookie(config('session.cookie'), $sessionId)
            ->post(route('login'), [
                'email' => $user->email,
                'password' => 'password',
            ]);
    }

    public function test_guest_cart_survives_login(): void
    {
        $user = User::factory()->create();
        $product = Product::factory()->withStock(10)->create();

        $sessionId = $this->establishGuestSession();
        Cart::factory()->forSession($sessionId)->for($product)->create(['quantity' => 2]);

        $response = $this->loginAs($user, $sessionId);

        $response->assertRedirect();
        $this->assertDatabaseCount('carts', 1);
        $this->assertDatabaseHas('carts', [
            'user_id' => $user->id,
            'product_id' => $product->id,
            'quantity' => 2,
            'session_id' => null,
        ]);
    }

    public function test_guest_cart_quantity_merges_with_existing_user_cart_item(): void
    {
        $user = User::factory()->create();
        $product = Product::factory()->withStock(20)->create();

        Cart::factory()->for($user)->for($product)->create(['quantity' => 3]);

        $sessionId = $this->establishGuestSession();
        Cart::factory()->forSession($sessionId)->for($product)->create(['quantity' => 2]);

        $response = $this->loginAs($user, $sessionId);

        $response->assertRedirect();
        $this->assertDatabaseCount('carts', 1);
        $this->assertDatabaseHas('carts', [
            'user_id' => $user->id,
            'product_id' => $product->id,
            'quantity' => 5,
        ]);
    }

    public function test_no_duplicate_cart_rows_remain_after_merge(): void
    {
        $user = User::factory()->create();
        $productA = Product::factory()->withStock(10)->create();
        $productB = Product::factory()->withStock(10)->create();

        Cart::factory()->for($user)->for($productA)->create(['quantity' => 1]);

        $sessionId = $this->establishGuestSession();
        Cart::factory()->forSession($sessionId)->for($productA)->create(['quantity' => 4]);
        Cart::factory()->forSession($sessionId)->for($productB)->create(['quantity' => 1]);

        $this->loginAs($user, $sessionId);

        $this->assertDatabaseCount('carts', 2);
        $this->assertDatabaseHas('carts', [
            'user_id' => $user->id,
            'product_id' => $productA->id,
            'quantity' => 5,
        ]);
        $this->assertDatabaseHas('carts', [
            'user_id' => $user->id,
            'product_id' => $productB->id,
            'quantity' => 1,
            'session_id' => null,
        ]);
    }
}
