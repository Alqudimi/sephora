<?php

namespace App\Services\Commerce;

class ShippingCalculator
{
    public function fee(string $deliveryMethod, float $merchandiseSubtotal, ?string $paymentMethod = null): float
    {
        $shipping = config('commerce.shipping', []);
        $threshold = (float) config('commerce.free_shipping_threshold', 250);

        $fee = match ($deliveryMethod) {
            'click_collect' => (float) ($shipping['click_collect'] ?? 0),
            'same_day' => (float) ($shipping['same_day'] ?? 40),
            default => $merchandiseSubtotal >= $threshold
                ? 0.0
                : (float) ($shipping['standard'] ?? 25),
        };

        if ($paymentMethod === 'cod' && $deliveryMethod !== 'click_collect') {
            $fee += (float) ($shipping['cod_fee'] ?? 20);
        }

        return round($fee, 2);
    }

    public function label(string $deliveryMethod): string
    {
        return (string) config("commerce.delivery_methods.{$deliveryMethod}", ucfirst(str_replace('_', ' ', $deliveryMethod)));
    }

    public function freeShippingThreshold(): float
    {
        return (float) config('commerce.free_shipping_threshold', 250);
    }
}
