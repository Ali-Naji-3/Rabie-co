<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            // Display-only: rate at time of order for historical EGP display.
            // Never used in any calculation — all order totals remain USD canonical.
            $table->decimal('display_rate_snapshot', 10, 4)->nullable()->after('total');
        });
    }

    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn('display_rate_snapshot');
        });
    }
};
