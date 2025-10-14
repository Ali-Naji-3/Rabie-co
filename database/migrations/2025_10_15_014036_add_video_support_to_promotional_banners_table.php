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
        Schema::table('promotional_banners', function (Blueprint $table) {
            // Video support
            $table->string('video')->nullable()->after('mobile_image');
            $table->string('video_thumbnail')->nullable()->after('video');
            $table->enum('media_type', ['image', 'video'])->default('image')->after('video_thumbnail');
            $table->string('video_url')->nullable()->after('media_type'); // For external videos (YouTube, Vimeo)
            $table->boolean('autoplay')->default(false)->after('video_url');
            $table->boolean('loop')->default(false)->after('autoplay');
            $table->boolean('muted')->default(true)->after('loop');
            $table->boolean('show_controls')->default(true)->after('muted');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('promotional_banners', function (Blueprint $table) {
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
