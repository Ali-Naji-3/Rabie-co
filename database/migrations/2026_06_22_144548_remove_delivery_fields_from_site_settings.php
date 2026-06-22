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
        Schema::table('site_settings', function (Blueprint $table) {
            $table->dropColumn([
                'show_delivery_info',
                'delivery_badge_text',
                'delivery_cta_text'
            ]);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('site_settings', function (Blueprint $table) {
            $table->boolean('show_delivery_info')->default(false);
            $table->string('delivery_badge_text')->nullable();
            $table->string('delivery_cta_text')->nullable();
        });
    }
};
