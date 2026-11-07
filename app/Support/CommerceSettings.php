<?php

namespace App\Support;

use App\Models\Setting;

/**
 * Settings-aware reads for every commerce rule. Each method prefers the
 * admin-managed override from the `settings` table and falls back to the
 * value in config/commerce.php, so behaviour never changes until an
 * override is explicitly saved in the panel.
 */
class CommerceSettings
{
    public static function get(string $key, mixed $default = null): mixed
    {
        $value = Setting::get($key);

        return ($value !== null && $value !== '') ? $value : $default;
    }

    public static function int(string $key, int $default): int
    {
        return (int) static::get($key, $default);
    }

    public static function float(string $key, float $default): float
    {
        return (float) static::get($key, $default);
    }

    public static function bool(string $key, bool $default): bool
    {
        $value = static::get($key, $default);

        if (is_bool($value)) {
            return $value;
        }

        return in_array($value, ['1', 1, 'true', 'on', 'yes'], true);
    }

    public static function string(string $key, string $default): string
    {
        return (string) static::get($key, $default);
    }

    // ── Delivery ────────────────────────────────────────────────

    public static function freeShippingThreshold(): float
    {
        return static::float('free_shipping_threshold', (float) config('commerce.free_shipping_threshold', 250));
    }

    public static function standardShippingFee(): float
    {
        return static::float('shipping_fee', (float) config('commerce.shipping.standard', 25));
    }

    public static function sameDayFee(): float
    {
        return static::float('same_day_fee', (float) config('commerce.shipping.same_day', 40));
    }

    public static function codFee(): float
    {
        return static::float('cod_fee', (float) config('commerce.shipping.cod_fee', 20));
    }

    // ── Tax ─────────────────────────────────────────────────────

    /**
     * VAT as a percentage (5 = 5%). Stored in settings as a plain number
     * for admin-friendliness; order rows keep the fractional rate (0.05).
     */
    public static function vatRatePercent(): float
    {
        $default = (float) config('commerce.tax_rate', 0.05) * 100;

        return static::float('vat_rate_percent', $default);
    }

    public static function companyTrn(): string
    {
        return static::string('company_trn', '');
    }

    // ── Cart & inventory ────────────────────────────────────────

    public static function maxQuantityPerItem(): int
    {
        return static::int('max_quantity_per_item', (int) config('commerce.max_quantity_per_item', 20));
    }

    public static function maxSamples(): int
    {
        return max(0, static::int('max_samples', (int) config('commerce.max_samples', 3)));
    }

    public static function lowStockThreshold(): int
    {
        return max(0, static::int('low_stock_threshold', 10));
    }

    // ── Loyalty ─────────────────────────────────────────────────

    public static function loyaltyEnabled(): bool
    {
        return static::bool('loyalty_enabled', (bool) config('commerce.loyalty_enabled', true));
    }
}
