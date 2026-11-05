<?php

namespace App\Services\Commerce;

/**
 * Immutable order money breakdown.
 *
 * Storefront prices are VAT inclusive. The tax amount is extracted from the
 * taxable gross, so subtotal + shipping always equals total.
 */
final class OrderTotals
{
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
        $taxRate = $taxRate ?? (float) config('commerce.tax_rate', 5.00);

        $taxableGross = round(max(0, $subtotal - $discount + $shipping), 2);
        $taxAmount = $taxRate > 0
            ? round($taxableGross * ($taxRate / (100 + $taxRate)), 2)
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
