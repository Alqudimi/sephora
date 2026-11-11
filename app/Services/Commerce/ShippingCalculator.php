<?php

namespace App\Services\Commerce;

use App\Support\CommerceSettings;

class ShippingCalculator
{
    public function fee(string $deliveryMethod, float $merchandiseSubtotal, ?string $paymentMethod = null): float
    {
        $fee = match ($deliveryMethod) {
            'click_collect' => 0.0,
            'same_day' => CommerceSettings::sameDayFee(),
            default => $merchandiseSubtotal >= CommerceSettings::freeShippingThreshold()
                ? 0.0
                : CommerceSettings::standardShippingFee(),
        };

        if ($paymentMethod === 'cod' && $deliveryMethod !== 'click_collect') {
            $fee += CommerceSettings::codFee();
        }

        return round($fee, 2);
    }

    public function label(string $deliveryMethod): string
    {
        $key = "shop.delivery_methods.{$deliveryMethod}";
        $translated = __($key);

        if ($translated !== $key) {
            return $translated;
        }

        return (string) config("commerce.delivery_methods.{$deliveryMethod}", ucfirst(str_replace('_', ' ', $deliveryMethod)));
    }

    public function freeShippingThreshold(): float
    {
        return CommerceSettings::freeShippingThreshold();
    }
}
