<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('audit_logs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('actor_id')->nullable();
            $table->string('actor_type', 20)->nullable();    // 'user' | 'guest' | 'system'
            $table->string('event_source', 30)->nullable();  // 'web' | 'api' | 'admin_panel' | 'system'
            $table->string('event', 100);
            $table->string('subject_type', 100)->nullable();
            $table->unsignedBigInteger('subject_id')->nullable();
            $table->json('old_values')->nullable();
            $table->json('new_values')->nullable();
            $table->string('ip_address', 45)->nullable();
            $table->timestamp('created_at')->useCurrent();

            $table->index('actor_id', 'idx_audit_actor');
            $table->index('event', 'idx_audit_event');
            $table->index('created_at', 'idx_audit_created');
            $table->index(['subject_type', 'subject_id'], 'idx_audit_subject');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('audit_logs');
    }
};
