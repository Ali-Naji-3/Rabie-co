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
        Schema::create('site_settings', function (Blueprint $table) {
            $table->id();
            
            // Site Information
            $table->string('site_name')->default('Rabie-Co');
            $table->string('site_tagline')->nullable();
            $table->text('site_description')->nullable();
            
            // Logos and Images
            $table->string('logo')->nullable();
            $table->string('footer_logo')->nullable();
            $table->string('favicon')->nullable();
            
            // Header Settings
            $table->string('header_background_color')->default('#ffffff');
            $table->string('header_text_color')->default('#000000');
            $table->boolean('sticky_header')->default(true);
            
            // Contact Information
            $table->string('phone')->nullable();
            $table->string('email')->nullable();
            $table->text('address')->nullable();
            $table->string('whatsapp')->nullable();
            $table->string('working_hours')->nullable();
            
            // Social Media Links
            $table->string('facebook_url')->nullable();
            $table->string('instagram_url')->nullable();
            $table->string('twitter_url')->nullable();
            $table->string('linkedin_url')->nullable();
            $table->string('youtube_url')->nullable();
            $table->string('tiktok_url')->nullable();
            
            // SEO Settings
            $table->string('meta_title')->nullable();
            $table->text('meta_description')->nullable();
            $table->text('meta_keywords')->nullable();
            $table->string('og_image')->nullable();
            
            // Analytics
            $table->string('google_analytics_id')->nullable();
            $table->string('google_tag_manager_id')->nullable();
            
            // Footer Settings
            $table->text('footer_description')->nullable();
            $table->string('copyright_text')->default('© 2025 Rabie-Co. All rights reserved.');
            $table->string('footer_background_color')->default('#222222');
            $table->string('footer_text_color')->default('#ffffff');
            
            // Custom Scripts
            $table->text('custom_css')->nullable();
            $table->text('custom_js')->nullable();
            $table->text('header_scripts')->nullable();
            $table->text('footer_scripts')->nullable();
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('site_settings');
    }
};
