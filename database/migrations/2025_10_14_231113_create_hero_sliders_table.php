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
        Schema::create('hero_sliders', function (Blueprint $table) {
            $table->id();
            
            // Slider Image
            $table->string('image');
            $table->string('mobile_image')->nullable(); // Responsive image for mobile
            
            // Content
            $table->string('small_title')->nullable(); // e.g., "BRAND NEW"
            $table->string('main_title'); // e.g., "COMERCIO SHOP"
            $table->text('description')->nullable();
            
            // Button
            $table->string('button_text')->default('SHOP NOW');
            $table->string('button_link')->default('/collection');
            
            // Styling
            $table->string('text_alignment')->default('left'); // left, center, right
            $table->string('text_color')->default('#000000');
            $table->string('background_overlay')->nullable(); // rgba color for overlay
            $table->integer('overlay_opacity')->default(0); // 0-100
            
            // Settings
            $table->integer('order')->default(0); // For drag & drop ordering
            $table->boolean('is_active')->default(true);
            
            // Animation
            $table->string('animation')->default('fadeInUp'); // CSS animation class
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hero_sliders');
    }
};
