<?php

namespace App\Services;

use App\Models\EgpRateHistory;
use App\Models\SiteSetting;
use Illuminate\Support\Facades\Cache;

class CurrencyService
{
    public const CURRENCIES = ['USD', 'EGP'];

    /**
     * Per-request memo for the EGP rate. The service is bound `scoped`, so a
     * fresh instance (and fresh memo) is created for every request/job and
     * flushed at its boundary — no cross-request leakage. A separate "loaded"
     * flag is required because null is a valid, cacheable rate value.
     */
    private bool $egpRateLoaded = false;
    private ?float $egpRate = null;

    /** Per-request memo for the resolved default currency. */
    private ?string $defaultCurrency = null;

    /**
     * Format a USD amount in the customer's session-selected currency.
     * This is the only entry point for customer-facing price display.
     * Currency multiplication happens here and nowhere else in the codebase.
     */
    public function formatPrice(float $usdAmount, ?string $currency = null): string
    {
        $currency ??= session('currency') ?? $this->getDefaultCurrency();

        if ($currency === 'EGP') {
            $rate = $this->getEgpRate();
            if ($rate === null) {
                // No rate configured — fall back to USD silently
                return $this->formatUsd($usdAmount);
            }
            $egp = round($usdAmount * $rate, 2);
            return 'EGP ' . number_format($egp, 2);
        }

        return $this->formatUsd($usdAmount);
    }

    /**
     * Format a USD amount always as USD, regardless of session.
     * Use this for: emails, Filament admin displays, and any context without a session.
     */
    public function formatUsd(float $usdAmount): string
    {
        return '$' . number_format($usdAmount, 2);
    }

    /**
     * Returns the current EGP rate, or null if not configured.
     */
    public function getEgpRate(): ?float
    {
        if (! $this->egpRateLoaded) {
            $this->egpRate = Cache::rememberForever('egp_rate', function () {
                $row = EgpRateHistory::latest('created_at')->first();
                return $row ? (float) $row->rate : null;
            });
            $this->egpRateLoaded = true;
        }

        return $this->egpRate;
    }

    /**
     * True only when an EGP rate has been set by admin.
     * Use to conditionally show the EGP currency switcher option.
     */
    public function hasEgpRate(): bool
    {
        return $this->getEgpRate() !== null;
    }

    /**
     * Returns the store-level default currency set by admin.
     * Falls back to 'USD' if not configured or the stored value is invalid.
     */
    public function getDefaultCurrency(): string
    {
        if ($this->defaultCurrency === null) {
            $setting = SiteSetting::getSettings()->default_currency ?? 'USD';
            $this->defaultCurrency = in_array($setting, self::CURRENCIES, true) ? $setting : 'USD';
        }

        return $this->defaultCurrency;
    }
}
