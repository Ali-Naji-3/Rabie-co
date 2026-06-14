<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ProductFactory extends Factory
{
    public function definition(): array
    {
        $name = fake()->unique()->words(3, true);

        return [
            'category_id' => Category::factory(),
            'name' => $name,
            'slug' => Str::slug($name) . '-' . fake()->unique()->numberBetween(1, 99999),
            'description' => fake()->sentence(),
            'price' => fake()->randomFloat(2, 10, 500),
            'sale_price' => null,
            'discount_percentage' => 0,
            'stock' => 10,
            'primary_image' => null,
            'images' => null,
            'sku' => fake()->unique()->bothify('SKU-####??'),
            'is_featured' => false,
            'is_active' => true,
        ];
    }

    public function withStock(int $stock): static
    {
        return $this->state(['stock' => $stock]);
    }

    public function outOfStock(): static
    {
        return $this->state(['stock' => 0]);
    }
}
