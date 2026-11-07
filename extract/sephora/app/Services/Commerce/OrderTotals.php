<?php

namespace App\Services\Commerce;

use App\Models\Setting;

/**
 * Immutable order money breakdown.
 *
 * Storefront prices are VAT inclusive. The tax amount is extracted from the
 * taxable gross, so subtotal + shipping always equals total.
 *
 * The tax rate is a FRACTION (0.05 = 5%), matching config/commerce.php and
 * the `orders.tax_rate` column. An admin override can be persisted in the
 * settings table as `vat_rate_percent` (e.g. "5" = 5%).
 */
final class OrderTotals
{
    public const DEFAULT_TAX_RATE = 0.05;

    public static function taxRate(): float
    {
        $percent = Setting::get('vat_rate_percent');

        if ($percent !== null && $percent !== '') {
            return round(((float) $percent) / 100, 6);
        }

        return (float) config('commerce.tax_rate', self::DEFAULT_TAX_RATE);
    }

    public function __construct(
        public readonly float $subtotal,
        public readonly float $discount,
        public readonly float $shipping,
        public readonly float $taxRate,
        public readonly float $taxAmount,
        public readonly float $subtotalExTax,
        public readonly float $total,
    ) {}

    public static function calculate(
        float $subtotal,
        float $discount = 0.0,
        float $shipping = 0.0,
        ?float $taxRate = null,
    ): self {
        $subtotal = round(max(0, $subtotal), 2);
        $discount = round(min(max(0, $discount), $subtotal), 2);
        $shipping = round(max(0, $shipping), 2);
        $taxRate = $taxRate ?? self::taxRate();

        $taxableGross = round(max(0, $subtotal - $discount + $shipping), 2);
        $taxAmount = $taxRate > 0
            ? round($taxableGross * ($taxRate / (1 + $taxRate)), 2)
            : 0.0;
        $subtotalExTax = round($taxableGross - $taxAmount, 2);

        return new self(
            subtotal: $subtotal,
            discount: $discount,
            shipping: $shipping,
            taxRate: $taxRate,
            taxAmount: $taxAmount,
            subtotalExTax: $subtotalExTax,
            total: $taxableGross,
        );
    }

    public function toArray(): array
    {
        return [
            'subtotal' => $this->subtotal,
            'discount' => $this->discount,
            'shipping_fee' => $this->shipping,
            'tax_rate' => $this->taxRate,
            'tax_amount' => $this->taxAmount,
            'subtotal_ex_tax' => $this->subtotalExTax,
            'total' => $this->total,
        ];
    }
}
