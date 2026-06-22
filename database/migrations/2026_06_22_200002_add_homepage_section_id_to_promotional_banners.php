<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('promotional_banners', function (Blueprint $table) {
            // Nullable so existing rows are valid pre-backfill.
            // nullOnDelete: deleting a section orphans cards rather than cascading data loss.
            $table->foreignId('homepage_section_id')
                ->nullable()
                ->after('id')
                ->constrained()
                ->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::table('promotional_banners', function (Blueprint $table) {
            $table->dropForeign(['homepage_section_id']);
            $table->dropColumn('homepage_section_id');
        });
    }
};
