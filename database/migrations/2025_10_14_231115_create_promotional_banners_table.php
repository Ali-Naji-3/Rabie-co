<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('promotional_banners', function (Blueprint $table) {
            $table->id();
            
            // Banner Image
            $table->string('image');
            $table->string('mobile_image')->nullable(); // Responsive image for mobile
            $table->string('thumbnail')->nullable(); // Admin preview thumbnail
            
            // Content
            $table->string('title')->nullable(); // For admin reference
            $table->string('alt_text'); // SEO alt text
            
            // Link
            $table->string('link_url')->nullable();
            $table->boolean('open_new_tab')->default(false);
            
            // Position (where to show on homepage)
            $table->string('position')->default('after_products'); 
            // Options: after_products, after_reviews, before_footer, custom
            
            // Scheduling
            $table->dateTime('start_date')->nullable();
            $table->dateTime('end_date')->nullable();
            
            // Analytics
            $table->integer('views_count')->default(0);
            $table->integer('clicks_count')->default(0);
            
            // Image Processing Settings
            $table->integer('image_width')->nullable(); // Original width
            $table->integer('image_height')->nullable(); // Original height
            $table->integer('file_size')->nullable(); // In KB
            
            // Settings
            $table->integer('order')->default(0); // For drag & drop ordering
            $table->boolean('is_active')->default(true);
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('promotional_banners');
    }
};
