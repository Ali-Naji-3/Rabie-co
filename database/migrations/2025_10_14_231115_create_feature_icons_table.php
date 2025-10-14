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
        Schema::create('feature_icons', function (Blueprint $table) {
            $table->id();
            
            // Icon
            $table->string('icon_type')->default('class'); // 'class' or 'image'
            $table->string('icon_class')->nullable(); // e.g., 'flaticon-shipping'
            $table->string('icon_image')->nullable(); // uploaded icon image
            
            // Content
            $table->string('title');
            $table->text('description')->nullable();
            
            // Link
            $table->string('link_url')->nullable();
            $table->boolean('open_new_tab')->default(false);
            
            // Styling
            $table->string('icon_color')->default('#000000');
            $table->string('background_color')->nullable();
            $table->string('text_color')->default('#000000');
            $table->integer('icon_size')->default(48); // px
            
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
        Schema::dropIfExists('feature_icons');
    }
};
