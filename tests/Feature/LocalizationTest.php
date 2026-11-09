<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class LocalizationTest extends TestCase
{
    use RefreshDatabase;

    public function test_default_locale_is_english(): void
    {
        $response = $this->get('/');

        $response->assertOk();
        $response->assertSee('dir="ltr"', false);
        $this->assertSame('en', app()->getLocale());
    }

    public function test_switching_locale_via_query_parameter(): void
    {
        $response = $this->get('/?lang=ar');

        $response->assertOk();
        $response->assertSessionHas('locale', 'ar');
        $this->assertSame('ar', app()->getLocale());
        $response->assertSee('dir="rtl"', false);
    }

    public function test_persisted_session_locale_is_respected(): void
    {
        $response = $this->withSession(['locale' => 'ar'])->get('/');

        $response->assertOk();
        $this->assertSame('ar', app()->getLocale());
        $response->assertSee('dir="rtl"', false);
    }

    public function test_unsupported_locale_falls_back_to_default(): void
    {
        $response = $this->get('/?lang=fr');

        $response->assertOk();
        $this->assertSame('en', app()->getLocale());
        $response->assertSee('dir="ltr"', false);
    }
}

