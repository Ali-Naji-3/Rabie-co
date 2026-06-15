<?php

namespace Tests\Feature;

use App\Mail\NewOrderNotification;
use App\Models\Cart;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Mail;
use Tests\TestCase;

class AdminOrderNotificationTest extends TestCase
{
    use RefreshDatabase;

    private function checkoutPayload(array $overrides = []): array
    {
        return array_merge([
            'name'           => 'Jane Doe',
            'email'          => 'jane@example.com',
            'phone'          => '0501234567',
            'address'        => '12 Palm Street',
            'city'           => 'Riyadh',
            'state'          => 'Riyadh Region',
            'postal_code'    => '12345',
            'country'        => 'Saudi Arabia',
            'payment_method' => 'cod',
        ], $overrides);
    }

    // ── Notification is sent on successful checkout ───────────────────────────

    public function test_admin_notification_is_sent_on_successful_checkout(): void
    {
        Mail::fake();
        config(['mail.admin_order_notification_email' => 'admin@example.com']);

        $user    = User::factory()->create();
        $product = Product::factory()->withStock(5)->create();
        Cart::factory()->for($user)->for($product)->create(['quantity' => 2]);

        $this->actingAs($user)
            ->post(route('checkout.process'), $this->checkoutPayload());

        Mail::assertSent(NewOrderNotification::class, function (NewOrderNotification $mail) {
            return $mail->hasTo('admin@example.com');
        });
    }

    public function test_notification_contains_correct_order_number(): void
    {
        Mail::fake();
        config(['mail.admin_order_notification_email' => 'admin@example.com']);

        $user    = User::factory()->create();
        $product = Product::factory()->withStock(5)->create();
        Cart::factory()->for($user)->for($product)->create(['quantity' => 1]);

        $this->actingAs($user)
            ->post(route('checkout.process'), $this->checkoutPayload());

        Mail::assertSent(NewOrderNotification::class, function (NewOrderNotification $mail) {
            $order = Order::first();
            return $mail->order->id === $order->id
                && $mail->envelope()->subject === 'New Order: ' . $order->order_number;
        });
    }

    public function test_notification_shipping_fields_are_decoded(): void
    {
        Mail::fake();
        config(['mail.admin_order_notification_email' => 'admin@example.com']);

        $user    = User::factory()->create();
        $product = Product::factory()->withStock(5)->create();
        Cart::factory()->for($user)->for($product)->create(['quantity' => 1]);

        $this->actingAs($user)
            ->post(route('checkout.process'), $this->checkoutPayload());

        Mail::assertSent(NewOrderNotification::class, function (NewOrderNotification $mail) {
            return $mail->shipping['city']    === 'Riyadh'
                && $mail->shipping['country'] === 'Saudi Arabia'
                && $mail->shipping['name']    === 'Jane Doe'
                && $mail->shipping['phone']   === '0501234567';
        });
    }

    // ── No email sent when admin address is not configured ────────────────────

    public function test_no_notification_sent_when_admin_email_not_configured(): void
    {
        Mail::fake();
        config(['mail.admin_order_notification_email' => null]);

        $user    = User::factory()->create();
        $product = Product::factory()->withStock(5)->create();
        Cart::factory()->for($user)->for($product)->create(['quantity' => 1]);

        $this->actingAs($user)
            ->post(route('checkout.process'), $this->checkoutPayload());

        Mail::assertNothingSent();
        $this->assertDatabaseCount('orders', 1);
    }

    // ── Mail failure never breaks checkout ────────────────────────────────────

    public function test_checkout_succeeds_even_when_mail_sending_fails(): void
    {
        config(['mail.admin_order_notification_email' => 'admin@example.com']);

        // Replace the mail manager binding with one that throws on to()
        $this->app->bind('mail.manager', function () {
            $mock = \Mockery::mock();
            $mock->shouldReceive('to')
                ->andThrow(new \RuntimeException('SMTP connection refused'));
            return $mock;
        });

        $user    = User::factory()->create();
        $product = Product::factory()->withStock(5)->create();
        Cart::factory()->for($user)->for($product)->create(['quantity' => 1]);

        $response = $this->actingAs($user)
            ->post(route('checkout.process'), $this->checkoutPayload());

        // Order must be persisted
        $this->assertDatabaseCount('orders', 1);
        // Checkout must redirect away from checkout (to order success)
        $response->assertRedirect();
        $this->assertStringNotContainsString('/checkout', $response->headers->get('Location'));
    }
}
