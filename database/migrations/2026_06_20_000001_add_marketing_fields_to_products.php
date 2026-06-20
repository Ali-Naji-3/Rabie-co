<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->decimal('rating', 3, 1)->nullable()->after('is_active');
            $table->unsignedInteger('rating_count')->nullable()->after('rating');
            $table->boolean('auto_review_count')->default(false)->after('rating_count');
            $table->text('short_description')->nullable()->after('auto_review_count');
        });
    }

    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn(['rating', 'rating_count', 'auto_review_count', 'short_description']);
        });
    }
};
