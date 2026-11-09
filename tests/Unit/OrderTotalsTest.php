<?php

namespace Tests\Unit;

use App\Models\Setting;
use App\Services\Commerce\OrderTotals;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class OrderTotalsTest extends TestCase
{
    use RefreshDatabase;

    public function test_default_tax_rate_is_five_percent(): void
    {
        $rate = OrderTotals::taxRate();
        $this->assertEquals(0.05, $rate);
    }

    public function test_setting_override_modifies_tax_rate(): void
    {
        Setting::set('vat_rate_percent', '10');
        $rate = OrderTotals::taxRate();
        $this->assertEquals(0.10, $rate);

        Setting::set('vat_rate_percent', '0');
        $this->assertEquals(0.0, OrderTotals::taxRate());
    }

    public function test_order_totals_calculation_with_vat_inclusive_pricing(): void
    {
        // 105 AED inclusive of 5% VAT:
        // taxableGross = 105.00
        // taxAmount = 105 * (0.05 / 1.05) = 5.00
        // subtotalExTax = 100.00
        $totals = OrderTotals::calculate(subtotal: 105.00, discount: 0.0, shipping: 0.0, taxRate: 0.05);

        $this->assertSame(105.0, $totals->subtotal);
        $this->assertSame(0.0, $totals->discount);
        $this->assertSame(0.0, $totals->shipping);
        $this->assertSame(0.05, $totals->taxRate);
        $this->assertSame(5.0, $totals->taxAmount);
        $this->assertSame(100.0, $totals->subtotalExTax);
        $this->assertSame(105.0, $totals->total);
    }

    public function test_order_totals_with_discount_and_shipping(): void
    {
        // Subtotal: 200, Discount: 50, Shipping: 25 -> Taxable Gross: 175
        // taxAmount = 175 * (0.05 / 1.05) = 8.33
        // subtotalExTax = 175 - 8.33 = 166.67
        $totals = OrderTotals::calculate(subtotal: 200.00, discount: 50.00, shipping: 25.00, taxRate: 0.05);

        $this->assertSame(200.0, $totals->subtotal);
        $this->assertSame(50.0, $totals->discount);
        $this->assertSame(25.0, $totals->shipping);
        $this->assertSame(8.33, $totals->taxAmount);
        $this->assertSame(166.67, $totals->subtotalExTax);
        $this->assertSame(175.0, $totals->total);
    }

    public function test_discount_cannot_exceed_subtotal(): void
    {
        $totals = OrderTotals::calculate(subtotal: 100.00, discount: 150.00, shipping: 10.00, taxRate: 0.05);

        $this->assertSame(100.0, $totals->discount);
        $this->assertSame(10.0, $totals->total);
    }

    public function test_negative_values_are_guarded_to_zero(): void
    {
        $totals = OrderTotals::calculate(subtotal: -50.00, discount: -10.00, shipping: -5.00, taxRate: 0.05);

        $this->assertSame(0.0, $totals->subtotal);
        $this->assertSame(0.0, $totals->discount);
        $this->assertSame(0.0, $totals->shipping);
        $this->assertSame(0.0, $totals->total);
        $this->assertSame(0.0, $totals->taxAmount);
        $this->assertSame(0.0, $totals->subtotalExTax);
    }

    public function test_to_array_returns_consistent_keys(): void
    {
        $totals = OrderTotals::calculate(subtotal: 100.00);
        $array = $totals->toArray();

        $this->assertArrayHasKey('subtotal', $array);
        $this->assertArrayHasKey('discount', $array);
        $this->assertArrayHasKey('shipping_fee', $array);
        $this->assertArrayHasKey('tax_rate', $array);
        $this->assertArrayHasKey('tax_amount', $array);
        $this->assertArrayHasKey('subtotal_ex_tax', $array);
        $this->assertArrayHasKey('total', $array);
    }
}

