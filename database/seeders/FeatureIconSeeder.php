<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\FeatureIcon;

class FeatureIconSeeder extends Seeder
{
    public function run(): void
    {
        $features = [
            [
                'icon_type' => 'class',
                'icon_class' => 'fas fa-shipping-fast',
                'title' => 'Free Shipping',
                'description' => 'Free delivery on orders over $50',
                'icon_color' => '#27ae60',
                'text_color' => '#333333',
                'icon_size' => 48,
                'order' => 1,
                'is_active' => true,
            ],
            [
                'icon_type' => 'class',
                'icon_class' => 'fas fa-headset',
                'title' => '24/7 Support',
                'description' => 'Dedicated customer support team',
                'icon_color' => '#3498db',
                'text_color' => '#333333',
                'icon_size' => 48,
                'order' => 2,
                'is_active' => true,
            ],
            [
                'icon_type' => 'class',
                'icon_class' => 'fas fa-shield-alt',
                'title' => 'Secure Payment',
                'description' => '100% secure payment gateway',
                'icon_color' => '#e74c3c',
                'text_color' => '#333333',
                'icon_size' => 48,
                'order' => 3,
                'is_active' => true,
            ],
            [
                'icon_type' => 'class',
                'icon_class' => 'fas fa-undo-alt',
                'title' => 'Easy Returns',
                'description' => '30-day return policy',
                'icon_color' => '#f39c12',
                'text_color' => '#333333',
                'icon_size' => 48,
                'order' => 4,
                'is_active' => true,
            ],
        ];

        foreach ($features as $feature) {
            FeatureIcon::create($feature);
        }
    }
}
