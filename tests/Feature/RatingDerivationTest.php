<?php

namespace Tests\Feature;

use App\Models\Product;
use App\Models\Review;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

/**
 * Locks the rating display logic:
 * - display_rating: manual `rating` column takes priority; falls back to approved-review avg.
 * - display_review_count: if `auto_review_count` is ON, uses real approved count;
 *   otherwise uses manual `rating_count`.
 */
class RatingDerivationTest extends TestCase
{
    use RefreshDatabase;

    /** Reload a product with the same aggregates the controllers eager-load. */
    private function withAggregates(int $productId): Product
    {
        return Product::query()
            ->withAvg(['reviews as avg_rating' => fn ($q) => $q->where('is_approved', true)], 'rating')
            ->withCount(['reviews as approved_review_count' => fn ($q) => $q->where('is_approved', true)])
            ->findOrFail($productId);
    }

    private function review(Product $product, int $rating, bool $approved): void
    {
        Review::create([
            'user_id' => User::factory()->create()->id,
            'product_id' => $product->id,
            'rating' => $rating,
            'title' => 'T',
            'comment' => 'C',
            'is_approved' => $approved,
        ]);
    }

    public function test_display_rating_is_average_of_approved_reviews(): void
    {
        // auto_review_count ON: count comes from real approved aggregate.
        $product = Product::factory()->create(['auto_review_count' => true]);
        $this->review($product, 5, true);
        $this->review($product, 4, true);
        $this->review($product, 3, true);

        $loaded = $this->withAggregates($product->id);

        $this->assertSame(4.0, $loaded->display_rating);
        $this->assertSame(3, $loaded->display_review_count);
    }

    public function test_unapproved_reviews_are_excluded(): void
    {
        // auto_review_count ON: unapproved must not inflate the aggregate count.
        $product = Product::factory()->create(['auto_review_count' => true]);
        $this->review($product, 5, true);
        $this->review($product, 1, false); // pending — must not count

        $loaded = $this->withAggregates($product->id);

        $this->assertSame(5.0, $loaded->display_rating);
        $this->assertSame(1, $loaded->display_review_count);
    }

    public function test_product_with_no_approved_reviews_displays_null(): void
    {
        // auto_review_count ON: with zero approved reviews, rating is null, count is 0.
        $product = Product::factory()->create(['auto_review_count' => true]);
        $this->review($product, 4, false); // only a pending review

        $loaded = $this->withAggregates($product->id);

        $this->assertNull($loaded->display_rating);
        $this->assertSame(0, $loaded->display_review_count);
    }

    public function test_manual_rating_overrides_review_average(): void
    {
        $product = Product::factory()->create();
        $this->review($product, 2, true); // real approved review: avg = 2.0

        // Admin sets a manual display rating of 4.5.
        DB::table('products')->where('id', $product->id)->update(['rating' => 4.5]);

        $loaded = $this->withAggregates($product->id);

        // Manual rating wins over review aggregate.
        $this->assertSame(4.5, $loaded->display_rating);
    }

    public function test_manual_rating_count_used_when_auto_is_off(): void
    {
        $product = Product::factory()->create();
        $this->review($product, 5, true); // 1 real approved review

        // Admin sets manual count and leaves auto_review_count OFF (false).
        DB::table('products')->where('id', $product->id)->update([
            'rating_count' => 332,
            'auto_review_count' => false,
        ]);

        $loaded = $this->withAggregates($product->id);

        // Must show the manual count, not the real 1.
        $this->assertSame(332, $loaded->display_review_count);
    }

    public function test_auto_review_count_uses_real_approved_count(): void
    {
        $product = Product::factory()->create();
        $this->review($product, 5, true);
        $this->review($product, 4, true);

        // Admin sets a stale manual count but turns auto ON.
        DB::table('products')->where('id', $product->id)->update([
            'rating_count' => 999,
            'auto_review_count' => true,
        ]);

        $loaded = $this->withAggregates($product->id);

        // auto ON → real count (2), manual 999 ignored.
        $this->assertSame(2, $loaded->display_review_count);
    }

    public function test_rating_falls_back_to_aggregate_when_not_set(): void
    {
        $product = Product::factory()->create(); // rating column is null by default

        $this->review($product, 5, true);
        $this->review($product, 3, true);

        $loaded = $this->withAggregates($product->id);

        // No manual override → uses review aggregate (avg 4.0).
        $this->assertSame(4.0, $loaded->display_rating);
    }
}
