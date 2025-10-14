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
        Schema::table('contacts', function (Blueprint $table) {
            // Remove email and website columns
            $table->dropColumn(['email', 'website']);
            
            // Add phone and subject columns
            $table->string('phone')->after('last_name');
            $table->enum('subject', [
                'order_inquiry',
                'product_question',
                'shipping_issue',
                'return_refund',
                'general_question',
                'complaint',
                'partnership_business'
            ])->default('order_inquiry')->after('phone');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('contacts', function (Blueprint $table) {
            // Remove phone and subject columns
            $table->dropColumn(['phone', 'subject']);
            
            // Restore email and website columns
            $table->string('email')->after('last_name');
            $table->string('website')->nullable()->after('email');
        });
    }
};
