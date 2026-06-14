<?php

namespace App\Services;

use Illuminate\Support\Collection;

final class PricingService
{
    public const TAX_RATE = 0.0;
    public const SHIPPING_COST = 10.00;
    public const FREE_SHIPPING_THRESHOLD = 100.00;

    /**
     * @param  Collection  $cartItems  Must have 'product' eager-loaded.
     * @return array{subtotal: float, shipping: float, tax: float, total: float}
     */
    public function calculate(Collection $cartItems): array
    {
        $subtotal = (float) $cartItems->sum(
            fn ($item) => $item->product->final_price * $item->quantity
        );
        $shipping = $subtotal >= self::FREE_SHIPPING_THRESHOLD ? 0.0 : self::SHIPPING_COST;
        $tax      = round($subtotal * self::TAX_RATE, 2);
        $total    = round($subtotal + $shipping + $tax, 2);

        return compact('subtotal', 'shipping', 'tax', 'total');
    }
}
