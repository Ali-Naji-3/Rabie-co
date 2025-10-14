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
        Schema::create('homepage_sections', function (Blueprint $table) {
            $table->id();
            
            // Section Identification
            $table->string('section_key')->unique(); 
            // e.g., 'hero_slider', 'featured_products', 'promotional_banner', 'featured_reviews'
            
            $table->string('section_name'); // Display name for admin
            
            // Content
            $table->string('title')->nullable(); // Section title (e.g., "Welcome to product")
            $table->string('subtitle')->nullable(); // Section subtitle
            $table->text('description')->nullable();
            
            // Styling
            $table->string('background_color')->nullable();
            $table->string('background_image')->nullable();
            $table->string('text_color')->nullable();
            $table->string('css_class')->nullable(); // Additional CSS classes
            
            // Configuration
            $table->integer('items_to_show')->nullable(); // How many items to display (e.g., 8 products)
            $table->json('settings')->nullable(); // Additional settings as JSON
            
            // Settings
            $table->integer('order')->default(0); // For drag & drop section ordering
            $table->boolean('is_active')->default(true);
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('homepage_sections');
    }
};
