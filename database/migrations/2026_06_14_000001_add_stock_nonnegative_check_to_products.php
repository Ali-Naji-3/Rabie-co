<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        DB::statement('UPDATE products SET stock = 0 WHERE stock < 0');
        DB::statement('ALTER TABLE products ADD CONSTRAINT chk_stock_nonneg CHECK (stock >= 0)');
    }

    public function down(): void
    {
        DB::statement('ALTER TABLE products DROP CONSTRAINT chk_stock_nonneg');
    }
};
