<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        $now = now();

        // Seed "Real Results" — the after_products promotional section
        $realResultsId = DB::table('homepage_sections')->insertGetId([
            'section_key'  => 'real_results',
            'section_name' => 'Real Results',
            'title'        => 'Real Results',
            'subtitle'     => 'See what to expect at every stage of your treatment',
            'position'     => 'after_products',
            'card_layout'  => 'promotional',
            'order'        => 1,
            'is_active'    => 1,
            'created_at'   => $now,
            'updated_at'   => $now,
        ]);

        // Seed "Special Offers" — the after_reviews promotional section
        $specialOffersId = DB::table('homepage_sections')->insertGetId([
            'section_key'  => 'special_offers',
            'section_name' => 'Special Offers',
            'title'        => 'Special Offers',
            'subtitle'     => 'Exclusive deals selected for you',
            'position'     => 'after_reviews',
            'card_layout'  => 'promotional',
            'order'        => 2,
            'is_active'    => 1,
            'created_at'   => $now,
            'updated_at'   => $now,
        ]);

        // Backfill existing banners by their legacy position column
        DB::table('promotional_banners')
            ->where('position', 'after_products')
            ->update(['homepage_section_id' => $realResultsId]);

        DB::table('promotional_banners')
            ->where('position', 'after_reviews')
            ->update(['homepage_section_id' => $specialOffersId]);
    }

    public function down(): void
    {
        // Null out the FK backfill
        DB::table('promotional_banners')->update(['homepage_section_id' => null]);

        // Remove only the rows this migration created (by section_key)
        DB::table('homepage_sections')
            ->whereIn('section_key', ['real_results', 'special_offers'])
            ->delete();
    }
};
