<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('customer_review_settings', function (Blueprint $table) {
            $table->id();
            $table->boolean('is_active')->default(true);
            $table->string('section_title')->default('Customer Reviews');

            // Real (off) vs Marketing (on) statistics toggle.
            $table->boolean('use_marketing_stats')->default(false);

            // Marketing statistics — admin-controlled numbers used when the toggle is on.
            $table->decimal('marketing_average_rating', 3, 2)->nullable();
            $table->unsignedInteger('marketing_total_reviews')->nullable();
            $table->unsignedInteger('marketing_five_star')->default(0);
            $table->unsignedInteger('marketing_four_star')->default(0);
            $table->unsignedInteger('marketing_three_star')->default(0);
            $table->unsignedInteger('marketing_two_star')->default(0);
            $table->unsignedInteger('marketing_one_star')->default(0);

            $table->timestamps();
        });

        // Seed the single settings row so getSettings() always resolves a persisted record.
        DB::table('customer_review_settings')->insert([
            'is_active' => true,
            'section_title' => 'Customer Reviews',
            'use_marketing_stats' => false,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

    public function down(): void
    {
        Schema::dropIfExists('customer_review_settings');
    }
};
