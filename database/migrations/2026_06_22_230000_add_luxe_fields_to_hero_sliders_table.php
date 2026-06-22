<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('hero_sliders', function (Blueprint $table) {
            // Gold italic highlight rendered after main_title in the luxe headline.
            $table->string('highlight_text')->nullable()->after('main_title');

            // Up to three optional trust badges (e.g. "Dermatologist Approved").
            $table->string('badge_1')->nullable()->after('description');
            $table->string('badge_2')->nullable()->after('badge_1');
            $table->string('badge_3')->nullable()->after('badge_2');

            // Presentation controls for the single-hero luxe layout.
            $table->string('image_alignment')->default('right')->after('text_alignment');
            $table->string('layout_type')->default('single')->after('image_alignment');
        });
    }

    public function down(): void
    {
        Schema::table('hero_sliders', function (Blueprint $table) {
            $table->dropColumn([
                'highlight_text',
                'badge_1',
                'badge_2',
                'badge_3',
                'image_alignment',
                'layout_type',
            ]);
        });
    }
};
