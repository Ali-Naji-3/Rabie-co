<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class OrderFactory extends Factory
{
    public function definition(): array
    {
        return [
            'user_id'          => User::factory(),
            'customer_email'   => fake()->unique()->safeEmail(),
            'order_number'     => 'ORD-' . date('Ymd') . '-' . Str::upper(Str::random(10)),
            'subtotal'         => 100.00,
            'tax'              => 0.00,
            'shipping'         => 10.00,
            'total'            => 110.00,
            'status'           => 'pending',
            'payment_status'   => 'pending',
            'payment_method'   => 'cod',
            'shipping_address' => json_encode([
                'name'        => fake()->name(),
                'address'     => fake()->streetAddress(),
                'city'        => fake()->city(),
                'country'     => 'Saudi Arabia',
                'phone'       => '0501234567',
            ]),
            'billing_address'  => null,
            'notes'            => null,
        ];
    }

    public function withNullUser(): static
    {
        return $this->state(['user_id' => null]);
    }
}
