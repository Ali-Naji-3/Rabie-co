<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class CustomerReview extends Model
{
    public const STATUS_PENDING = 'pending';
    public const STATUS_APPROVED = 'approved';
    public const STATUS_REJECTED = 'rejected';

    /**
     * Admin-editable fields. status, is_pinned and sort_order ARE fillable so the
     * trusted Filament moderation form can set them. The public-submission trust
     * boundary lives in CustomerReviewController, which never reads these from the
     * request — it forces status=pending, is_pinned=false, sort_order=0.
     */
    protected $fillable = [
        'customer_name',
        'title',
        'description',
        'rating',
        'image',
        'status',
        'is_pinned',
        'sort_order',
    ];

    protected $casts = [
        'is_pinned' => 'boolean',
        'rating' => 'integer',
    ];

    /** Approved reviews only. */
    public function scopeApproved(Builder $query): Builder
    {
        return $query->where('status', self::STATUS_APPROVED);
    }

    /** Pending reviews awaiting moderation. */
    public function scopePending(Builder $query): Builder
    {
        return $query->where('status', self::STATUS_PENDING);
    }

    /** Homepage feed: approved, pinned first, then admin order, then newest. */
    public function scopeForHomepage(Builder $query): Builder
    {
        return $query->approved()
            ->orderByDesc('is_pinned')
            ->orderBy('sort_order')
            ->orderByDesc('created_at');
    }

    /**
     * Real statistics over approved reviews — cached and observer-busted so the
     * GROUP BY runs once per write, never on every homepage request. SSOT for
     * both the homepage controller and the admin "real stats" reference panel.
     *
     * @return array{average: float, total: int, star_counts: array<int,int>}
     */
    public static function cachedRealStats(): array
    {
        return Cache::remember('home:customer_reviews:stats', 1800, function () {
            return static::computeRealStats();
        });
    }

    /**
     * Single GROUP BY aggregate over approved reviews. Not called per request —
     * only from inside cachedRealStats()'s cache miss.
     *
     * @return array{average: float, total: int, star_counts: array<int,int>}
     */
    public static function computeRealStats(): array
    {
        $rows = static::approved()
            ->selectRaw('rating, COUNT(*) as count')
            ->groupBy('rating')
            ->pluck('count', 'rating');

        $starCounts = [];
        $total = 0;
        $weighted = 0;

        for ($star = 5; $star >= 1; $star--) {
            $count = (int) ($rows[$star] ?? 0);
            $starCounts[$star] = $count;
            $total += $count;
            $weighted += $star * $count;
        }

        return [
            'average' => $total > 0 ? round($weighted / $total, 2) : 0.0,
            'total' => $total,
            'star_counts' => $starCounts,
        ];
    }
}
