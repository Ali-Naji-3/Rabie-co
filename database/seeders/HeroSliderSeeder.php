<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\HeroSlider;

class HeroSliderSeeder extends Seeder
{
    public function run(): void
    {
        $sliders = [
            [
                'image' => 'hero-sliders/slider-1.jpg', // You'll need to upload actual images in admin
                'mobile_image' => null,
                'small_title' => 'BRAND NEW',
                'main_title' => 'SUMMER COLLECTION 2025',
                'description' => 'Discover the latest trends in fashion. Quality products at affordable prices with free shipping on orders over $50.',
                'button_text' => 'SHOP NOW',
                'button_link' => '/collection',
                'text_alignment' => 'left',
                'text_color' => '#000000',
                'background_overlay' => null,
                'overlay_opacity' => 0,
                'order' => 1,
                'is_active' => true,
                'animation' => 'fadeInUp', // Smooth fade in from bottom
            ],
            [
                'image' => 'hero-sliders/slider-2.jpg',
                'mobile_image' => null,
                'small_title' => 'NEW ARRIVALS',
                'main_title' => 'EXCLUSIVE DESIGNS',
                'description' => 'Step into style with our exclusive collection. Premium quality, modern designs, and unbeatable comfort.',
                'button_text' => 'DISCOVER MORE',
                'button_link' => '/collection',
                'text_alignment' => 'left',
                'text_color' => '#000000',
                'background_overlay' => null,
                'overlay_opacity' => 0,
                'order' => 2,
                'is_active' => true,
                'animation' => 'fadeIn', // Simple fade in
            ],
            [
                'image' => 'hero-sliders/slider-3.jpg',
                'mobile_image' => null,
                'small_title' => 'SPECIAL OFFER',
                'main_title' => 'UP TO 50% OFF',
                'description' => 'Limited time offer! Save big on our most popular items. Don\'t miss out on these amazing deals.',
                'button_text' => 'VIEW SALE',
                'button_link' => '/collection',
                'text_alignment' => 'left',
                'text_color' => '#000000',
                'background_overlay' => null,
                'overlay_opacity' => 0,
                'order' => 3,
                'is_active' => true,
                'animation' => 'slideInLeft', // Slide in from left
            ],
        ];

        foreach ($sliders as $slider) {
            HeroSlider::create($slider);
        }
    }
}
