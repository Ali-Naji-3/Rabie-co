<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('customer_reviews', function (Blueprint $table) {
            $table->id();
            $table->string('customer_name');
            $table->string('title');
            $table->text('description');
            $table->unsignedTinyInteger('rating');
            $table->string('image')->nullable();
            $table->boolean('is_pinned')->default(false);
            $table->string('status', 20)->default('pending'); // pending | approved | rejected
            $table->unsignedInteger('sort_order')->default(0);
            $table->timestamps();

            // Serves the homepage feed ordering: approved → pinned first → sort_order → newest.
            $table->index(['status', 'is_pinned', 'sort_order']);
            // Serves the real-stats GROUP BY recompute and optional server-side filtering.
            $table->index(['status', 'rating']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('customer_reviews');
    }
};
