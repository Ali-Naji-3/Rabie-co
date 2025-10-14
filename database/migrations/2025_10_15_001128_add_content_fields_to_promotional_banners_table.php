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
            $table->string('small_title')->nullable()->after('thumbnail');
            $table->string('main_title')->nullable()->after('small_title');
            $table->text('description')->nullable()->after('main_title');
            $table->string('button_text')->nullable()->after('description');
            $table->string('text_color')->default('#000000')->after('button_text');
            $table->string('text_alignment')->default('left')->after('text_color');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('promotional_banners', function (Blueprint $table) {
            $table->dropColumn(['small_title', 'main_title', 'description', 'button_text', 'text_color', 'text_alignment']);
        });
    }
};
