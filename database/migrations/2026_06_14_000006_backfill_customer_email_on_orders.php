<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // Populate customer_email from users.email for all orders that predate
        // migration 000002 (the column was added as nullable with no default).
        // Rows where user_id is already NULL (post-000005 deletions) are skipped
        // intentionally — no user record exists to copy from.
        DB::statement('
            UPDATE orders
            INNER JOIN users ON users.id = orders.user_id
            SET orders.customer_email = users.email
            WHERE orders.customer_email IS NULL
              AND orders.user_id IS NOT NULL
        ');
    }

    public function down(): void
    {
        // Data backfills cannot be reversed safely:
        // nulling customer_email would destroy snapshot data for rows that may
        // also have been updated by the application since this migration ran.
    }
};
