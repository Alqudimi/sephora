<?php

namespace Tests\Unit;

use App\Models\Setting;
use App\Support\CommerceSettings;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CommerceSettingsTest extends TestCase
{
    use RefreshDatabase;

    public function test_casting_helpers(): void
    {
        Setting::set('test_int', '42');
        Setting::set('test_float', '19.99');
        Setting::set('test_bool_true', 'true');
        Setting::set('test_bool_yes', 'yes');
        Setting::set('test_bool_false', '0');
        Setting::set('test_str', 'Sephora UAE');

        $this->assertSame(42, CommerceSettings::int('test_int', 0));
        $this->assertSame(19.99, CommerceSettings::float('test_float', 0.0));
        $this->assertTrue(CommerceSettings::bool('test_bool_true', false));
        $this->assertTrue(CommerceSettings::bool('test_bool_yes', false));
        $this->assertFalse(CommerceSettings::bool('test_bool_false', true));
        $this->assertSame('Sephora UAE', CommerceSettings::string('test_str', ''));

        // Defaults on missing key
        $this->assertSame(100, CommerceSettings::int('missing_int', 100));
        $this->assertSame(55.5, CommerceSettings::float('missing_float', 55.5));
        $this->assertFalse(CommerceSettings::bool('missing_bool', false));
        $this->assertSame('default', CommerceSettings::string('missing_str', 'default'));
    }

    public function test_commerce_delivery_settings_prefer_database_overrides(): void
    {
        Setting::set('free_shipping_threshold', '300');
        Setting::set('shipping_fee', '35');
        Setting::set('same_day_fee', '45');
        Setting::set('cod_fee', '20');

        $this->assertSame(300.0, CommerceSettings::freeShippingThreshold());
        $this->assertSame(35.0, CommerceSettings::standardShippingFee());
        $this->assertSame(45.0, CommerceSettings::sameDayFee());
        $this->assertSame(20.0, CommerceSettings::codFee());
    }
}

