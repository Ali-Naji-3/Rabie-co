<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // ── carts ─────────────────────────────────────────────────────────────
        Schema::table('carts', function (Blueprint $table) {
            // Guest cart lookup: WHERE session_id = ? AND product_id = ?
            // The leftmost-prefix rule means (session_id, product_id) also covers
            // WHERE session_id = ? alone — used by CartController and CheckoutController
            // to fetch and delete all rows for a guest session. session_id has zero
            // index coverage today; every guest request is a full table scan.
            $table->index(['session_id', 'product_id'], 'idx_carts_session_product');

            // Authenticated cart lookup: WHERE user_id = ? AND product_id = ?
            // The FK implicit index covers user_id alone. This composite eliminates
            // the secondary row scan for the duplicate-item check in CartController::add().
            // (user_id, product_id) also satisfies the FK constraint because user_id
            // is the leftmost column — the standalone FK index remains in place to
            // avoid altering FK constraint bookkeeping in MariaDB.
            $table->index(['user_id', 'product_id'], 'idx_carts_user_product');
        });

        // ── orders ────────────────────────────────────────────────────────────
        Schema::table('orders', function (Blueprint $table) {
            // User order history: WHERE user_id = ? ORDER BY created_at DESC LIMIT 10
            // The FK index on user_id finds the rows but still requires a filesort
            // for the ORDER BY. Placing created_at as the second column lets the
            // optimizer traverse the index in sort order, eliminating the filesort
            // and the temporary table it would otherwise allocate per request.
            $table->index(['user_id', 'created_at'], 'idx_orders_user_created');

            // Filament admin list filter: WHERE status = ?
            $table->index('status', 'idx_orders_status');

            // Filament admin list filter: WHERE payment_status = ?
            $table->index('payment_status', 'idx_orders_payment_status');
        });

        // ── products ──────────────────────────────────────────────────────────
        Schema::table('products', function (Blueprint $table) {
            // Homepage featured block:
            //   WHERE is_active = 1 AND is_featured = 1 ORDER BY created_at DESC LIMIT 8
            // All three columns applied left-to-right as the query predicates narrow the
            // result set: is_active eliminates inactive products, is_featured selects the
            // featured subset, created_at enables ordered traversal without filesort.
            $table->index(['is_active', 'is_featured', 'created_at'], 'idx_products_active_featured');

            // Storefront category filter and unfiltered active-product listing:
            //   WHERE is_active = 1 AND category_id = ?  (collection page with filter)
            //   WHERE is_active = 1                      (unfiltered listing, API endpoint)
            //
            // Column order rationale — is_active is leftmost, not category_id:
            //   Every storefront and API query filters on is_active = 1. Placing it first
            //   means the composite covers both the unfiltered active-product scan (prefix
            //   rule) and the compound category-filtered query. Placing category_id first
            //   would make the composite useless for the unfiltered case, which already has
            //   FK-index coverage for WHERE category_id = ? alone and does not need help.
            //   The FK-created index on category_id is retained for FK constraint enforcement.
            $table->index(['is_active', 'category_id'], 'idx_products_active_category');
        });

        // ── reviews ───────────────────────────────────────────────────────────
        Schema::table('reviews', function (Blueprint $table) {
            // Homepage review block:
            //   WHERE is_featured = 1 AND is_approved = 1 ORDER BY created_at DESC LIMIT 6
            // is_featured is leftmost because it is the most selective predicate for this
            // query — only a small subset of reviews are featured. is_approved further
            // narrows the set; created_at allows ordered traversal without filesort.
            $table->index(['is_featured', 'is_approved', 'created_at'], 'idx_reviews_featured_approved');

            // Duplicate review check: WHERE user_id = ? AND product_id = ?
            // FK indexes on each column exist separately; the composite eliminates the
            // secondary row scan when both predicates are applied together in
            // ReviewController::store().
            $table->index(['user_id', 'product_id'], 'idx_reviews_user_product');
        });
    }

    public function down(): void
    {
        Schema::table('carts', function (Blueprint $table) {
            $table->dropIndex('idx_carts_session_product');
            $table->dropIndex('idx_carts_user_product');
        });

        Schema::table('orders', function (Blueprint $table) {
            $table->dropIndex('idx_orders_user_created');
            $table->dropIndex('idx_orders_status');
            $table->dropIndex('idx_orders_payment_status');
        });

        Schema::table('products', function (Blueprint $table) {
            $table->dropIndex('idx_products_active_featured');
            $table->dropIndex('idx_products_active_category');
        });

        Schema::table('reviews', function (Blueprint $table) {
            $table->dropIndex('idx_reviews_featured_approved');
            $table->dropIndex('idx_reviews_user_product');
        });
    }
};
