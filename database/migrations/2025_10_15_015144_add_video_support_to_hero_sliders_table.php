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
        Schema::table('hero_sliders', function (Blueprint $table) {
            // Make image nullable for video sliders
            $table->string('image')->nullable()->change();
            
            // Video support
            $table->string('video')->nullable()->after('mobile_image');
            $table->string('video_thumbnail')->nullable()->after('video');
            $table->enum('media_type', ['image', 'video'])->default('image')->after('video_thumbnail');
            $table->string('video_url')->nullable()->after('media_type'); // For external videos (YouTube, Vimeo)
            $table->boolean('autoplay')->default(true)->after('video_url');
            $table->boolean('loop')->default(true)->after('autoplay');
            $table->boolean('muted')->default(true)->after('loop');
            $table->boolean('show_controls')->default(false)->after('muted');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('hero_sliders', function (Blueprint $table) {
            // Revert image field back to not nullable
            $table->string('image')->nullable(false)->change();
            
            $table->dropColumn([
                'video',
                'video_thumbnail',
                'media_type',
                'video_url',
                'autoplay',
                'loop',
                'muted',
                'show_controls',
            ]);
        });
    }
};
