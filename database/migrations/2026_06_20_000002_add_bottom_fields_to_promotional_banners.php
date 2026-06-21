<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('promotional_banners', function (Blueprint $table) {
            $table->string('bottom_title')->nullable()->after('main_title');
            $table->text('bottom_description')->nullable()->after('description');
        });
    }

    public function down(): void
    {
        Schema::table('promotional_banners', function (Blueprint $table) {
            $table->dropColumn(['bottom_title', 'bottom_description']);
        });
    }
};
