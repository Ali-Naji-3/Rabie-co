<?php

namespace Database\Factories;

use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class CartFactory extends Factory
{
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'session_id' => null,
            'product_id' => Product::factory(),
            'quantity' => 1,
        ];
    }

    public function forSession(string $sessionId): static
    {
        return $this->state([
            'user_id' => null,
            'session_id' => $sessionId,
        ]);
    }
}
