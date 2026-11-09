<?php

namespace Tests\Unit;

use App\Models\Setting;
use App\Services\Commerce\ShippingCalculator;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ShippingCalculatorTest extends TestCase
{
    use RefreshDatabase;

    private ShippingCalculator $calculator;

    protected function setUp(): void
    {
        parent::setUp();
        $this->calculator = new ShippingCalculator();
    }

    public function test_click_and_collect_is_always_free(): void
    {
        $fee = $this->calculator->fee('click_collect', 50.00);
        $this->assertSame(0.0, $fee);

        $feeWithCod = $this->calculator->fee('click_collect', 50.00, 'cod');
        $this->assertSame(0.0, $feeWithCod);
    }

    public function test_standard_delivery_applies_fee_below_threshold(): void
    {
        Setting::set('free_shipping_threshold', '250');
        Setting::set('shipping_fee', '25');

        $fee = $this->calculator->fee('standard', 200.00);
        $this->assertSame(25.0, $fee);
    }

    public function test_standard_delivery_is_free_at_or_above_threshold(): void
    {
        Setting::set('free_shipping_threshold', '250');
        Setting::set('shipping_fee', '25');

        $feeExact = $this->calculator->fee('standard', 250.00);
        $this->assertSame(0.0, $feeExact);

        $feeAbove = $this->calculator->fee('standard', 300.00);
        $this->assertSame(0.0, $feeAbove);
    }

    public function test_same_day_delivery_fee_is_charged_regardless_of_subtotal(): void
    {
        Setting::set('same_day_fee', '40');

        $feeLow = $this->calculator->fee('same_day', 100.00);
        $this->assertSame(40.0, $feeLow);

        $feeHigh = $this->calculator->fee('same_day', 1000.00);
        $this->assertSame(40.0, $feeHigh);
    }

    public function test_cod_payment_adds_cash_on_delivery_surcharge(): void
    {
        Setting::set('free_shipping_threshold', '250');
        Setting::set('shipping_fee', '25');
        Setting::set('cod_fee', '15');

        // Below threshold + COD: 25 + 15 = 40
        $feeBelow = $this->calculator->fee('standard', 100.00, 'cod');
        $this->assertSame(40.0, $feeBelow);

        // Above threshold + COD: 0 + 15 = 15
        $feeAbove = $this->calculator->fee('standard', 300.00, 'cod');
        $this->assertSame(15.0, $feeAbove);
    }

    public function test_label_and_threshold_accessors(): void
    {
        Setting::set('free_shipping_threshold', '275');

        $this->assertSame(275.0, $this->calculator->freeShippingThreshold());
        $this->assertNotEmpty($this->calculator->label('standard'));
        $this->assertNotEmpty($this->calculator->label('same_day'));
        $this->assertNotEmpty($this->calculator->label('click_collect'));
    }
}

