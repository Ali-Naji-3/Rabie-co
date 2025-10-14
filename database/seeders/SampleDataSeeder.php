<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Seeder;

class SampleDataSeeder extends Seeder
{
    public function run(): void
    {
        // Create categories
        $electronics = Category::create([
            'name' => 'Electronics',
            'slug' => 'electronics',
            'description' => 'Electronic devices and gadgets',
            'is_active' => true,
        ]);

        $clothing = Category::create([
            'name' => 'Clothing',
            'slug' => 'clothing',
            'description' => 'Fashion and apparel',
            'is_active' => true,
        ]);

        $home = Category::create([
            'name' => 'Home & Garden',
            'slug' => 'home-garden',
            'description' => 'Home decor and garden supplies',
            'is_active' => true,
        ]);

        // Create sample products
        Product::create([
            'category_id' => $electronics->id,
            'name' => 'Wireless Headphones',
            'slug' => 'wireless-headphones',
            'description' => 'Premium noise-cancelling wireless headphones',
            'price' => 199.99,
            'sale_price' => 149.99,
            'stock' => 50,
            'sku' => 'WH-001',
            'is_featured' => true,
            'is_active' => true,
        ]);

        Product::create([
            'category_id' => $electronics->id,
            'name' => 'Smart Watch',
            'slug' => 'smart-watch',
            'description' => 'Fitness tracking smartwatch with heart rate monitor',
            'price' => 299.99,
            'stock' => 30,
            'sku' => 'SW-001',
            'is_featured' => true,
            'is_active' => true,
        ]);

        Product::create([
            'category_id' => $clothing->id,
            'name' => 'Classic T-Shirt',
            'slug' => 'classic-t-shirt',
            'description' => '100% cotton comfortable t-shirt',
            'price' => 29.99,
            'sale_price' => 19.99,
            'stock' => 100,
            'sku' => 'TS-001',
            'is_featured' => false,
            'is_active' => true,
        ]);

        Product::create([
            'category_id' => $clothing->id,
            'name' => 'Denim Jeans',
            'slug' => 'denim-jeans',
            'description' => 'Classic blue denim jeans',
            'price' => 79.99,
            'stock' => 75,
            'sku' => 'DJ-001',
            'is_featured' => false,
            'is_active' => true,
        ]);

        Product::create([
            'category_id' => $home->id,
            'name' => 'Table Lamp',
            'slug' => 'table-lamp',
            'description' => 'Modern LED table lamp',
            'price' => 49.99,
            'stock' => 40,
            'sku' => 'TL-001',
            'is_featured' => false,
            'is_active' => true,
        ]);
    }
}

