<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Update the subject column to have a default value
        DB::statement("ALTER TABLE contacts MODIFY COLUMN subject ENUM('order_inquiry', 'product_question', 'shipping_issue', 'return_refund', 'general_question', 'complaint', 'partnership_business') DEFAULT 'order_inquiry'");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Remove the default value
        DB::statement("ALTER TABLE contacts MODIFY COLUMN subject ENUM('order_inquiry', 'product_question', 'shipping_issue', 'return_refund', 'general_question', 'complaint', 'partnership_business')");
    }
};
