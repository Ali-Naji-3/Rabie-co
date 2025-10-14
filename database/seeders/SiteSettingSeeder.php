<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\SiteSetting;

class SiteSettingSeeder extends Seeder
{
    public function run(): void
    {
        SiteSetting::create([
            'site_name' => 'Rabie-Co',
            'site_tagline' => 'Your Fashion Destination',
            'site_description' => 'Discover the latest trends in fashion at Rabie-Co. Quality products, affordable prices, and exceptional service.',
            'phone' => '+1 (555) 123-4567',
            'email' => 'info@rabie-co.com',
            'address' => '123 Fashion Street, New York, NY 10001',
            'working_hours' => 'Mon-Fri: 9:00 AM - 6:00 PM',
            'footer_description' => 'Rabie-Co is your premier destination for fashion and style. We offer high-quality products at affordable prices with exceptional customer service.',
            'copyright_text' => '© ' . date('Y') . ' Rabie-Co. All rights reserved.',
            'header_background_color' => '#ffffff',
            'header_text_color' => '#000000',
            'footer_background_color' => '#222222',
            'footer_text_color' => '#ffffff',
            'sticky_header' => true,
            'meta_title' => 'Rabie-Co - Fashion Shop',
            'meta_description' => 'Shop the latest fashion trends at Rabie-Co. Quality products, great prices, and fast shipping.',
            'meta_keywords' => 'fashion, clothing, apparel, online shop, rabie-co',
        ]);
    }
}
