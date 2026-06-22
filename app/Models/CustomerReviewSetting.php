<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class CustomerReviewSetting extends Model
{
    protected $fillable = [
        'is_active',
        'section_title',
        'use_marketing_stats',
        'marketing_average_rating',
        'marketing_total_reviews',
        'marketing_five_star',
        'marketing_four_star',
        'marketing_three_star',
        'marketing_two_star',
        'marketing_one_star',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'use_marketing_stats' => 'boolean',
        'marketing_average_rating' => 'decimal:2',
    ];

    /**
     * Singleton accessor — mirrors SiteSetting::getSettings(). Cached so the
     * homepage read costs at most one query per cache window; busted by
     * CustomerReviewSettingObserver on save/delete.
     */
    public static function getSettings(): self
    {
        return Cache::remember('customer_review_settings', 1800, function () {
            return static::first() ?? new static();
        });
    }

    /**
     * Resolve the statistics the view should render.
     *
     * Marketing mode → admin-controlled numbers from this row (zero queries).
     * Real mode → the cached real aggregate passed in by the controller.
     *
     * @param  array{average: float, total: int, star_counts: array<int,int>}  $realStats
     * @return array{average: float, total: int, star_counts: array<int,int>}
     */
    public function resolvedStats(array $realStats): array
    {
        if (! $this->use_marketing_stats) {
            return $realStats;
        }

        return [
            'average' => (float) ($this->marketing_average_rating ?? 0),
            'total' => (int) ($this->marketing_total_reviews ?? 0),
            'star_counts' => [
                5 => (int) $this->marketing_five_star,
                4 => (int) $this->marketing_four_star,
                3 => (int) $this->marketing_three_star,
                2 => (int) $this->marketing_two_star,
                1 => (int) $this->marketing_one_star,
            ],
        ];
    }
}
