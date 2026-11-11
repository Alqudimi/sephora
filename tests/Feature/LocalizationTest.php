<?php

namespace Tests\Feature;

use App\Models\User;
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
        $response->assertSee('Cairo', false);
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

    public function test_one_click_locale_switch_route_for_guest(): void
    {
        $response = $this->from('/')->get(route('locale.switch', ['lang' => 'ar']));

        $response->assertRedirect('/');
        $response->assertSessionHas('locale', 'ar');
        $response->assertCookie('locale', 'ar');
    }

    public function test_one_click_locale_switch_updates_authenticated_user_profile(): void
    {
        $user = User::factory()->create([
            'preferred_language' => 'en',
        ]);

        $response = $this->actingAs($user)
            ->from('/my-account')
            ->get(route('locale.switch', ['lang' => 'ar']));

        $response->assertRedirect('/my-account');
        $response->assertSessionHas('locale', 'ar');
        $response->assertCookie('locale', 'ar');
        $this->assertSame('ar', $user->fresh()->preferred_language);
    }

    public function test_switching_back_to_english(): void
    {
        $user = User::factory()->create([
            'preferred_language' => 'ar',
        ]);

        $response = $this->actingAs($user)
            ->withSession(['locale' => 'ar'])
            ->from('/')
            ->get(route('locale.switch', ['lang' => 'en']));

        $response->assertRedirect('/');
        $response->assertSessionHas('locale', 'en');
        $response->assertCookie('locale', 'en');
        $this->assertSame('en', $user->fresh()->preferred_language);
    }

    public function test_account_country_language_form_persists_choice(): void
    {
        $user = User::factory()->create([
            'preferred_language' => 'en',
        ]);

        $response = $this->actingAs($user)
            ->post('/my-account/settings/country-and-language', [
                'preferred_language' => 'ar',
            ]);

        $response->assertRedirect();
        $response->assertSessionHas('locale', 'ar');
        $response->assertCookie('locale', 'ar');
        $this->assertSame('ar', $user->fresh()->preferred_language);
    }

    public function test_arabic_translations_are_complete_and_loadable(): void
    {
        app()->setLocale('ar');

        $this->assertSame('سيفورا الإمارات', __('messages.app_name'));
        $this->assertSame('حقيبة التسوق', __('messages.nav.bag'));
        $this->assertSame('الدفع | سيفورا الإمارات', __('messages.checkout.title'));
        $this->assertSame('تأكيد الطلب', __('messages.confirmation.heading'));
        $this->assertSame('الإمارات العربية المتحدة · العربية', __('messages.footer.country'));
    }

    public function test_static_page_uses_arabic_ui_translation_keys(): void
    {
        $response = $this->get('/faq?lang=ar');

        $response->assertOk();
        $response->assertSee('الأسئلة الشائعة', false);
        $response->assertDontSee('Frequently Asked Questions', false);
        $response->assertSee('dir="rtl"', false);
    }

    public function test_shared_ui_translation_keys_exist_in_both_locales(): void
    {
        $english = require resource_path('lang/en/ui.php');
        $arabic = require resource_path('lang/ar/ui.php');

        $this->assertSame(array_keys($english), array_keys($arabic));
    }

    public function test_full_content_translation_keys_exist_in_both_locales(): void
    {
        $english = require resource_path('lang/en/content.php');
        $arabic = require resource_path('lang/ar/content.php');

        $this->assertSame(array_keys($english), array_keys($arabic));
    }

    public function test_meta_translation_keys_exist_in_both_locales(): void
    {
        $english = require resource_path('lang/en/meta.php');
        $arabic = require resource_path('lang/ar/meta.php');

        $this->assertSame(array_keys($english), array_keys($arabic));
    }

    public function test_runtime_translation_keys_exist_in_both_locales(): void
    {
        $english = require resource_path('lang/en/runtime.php');
        $arabic = require resource_path('lang/ar/runtime.php');

        $this->assertSame(array_keys($english), array_keys($arabic));
    }

    public function test_shop_translation_keys_exist_in_both_locales(): void
    {
        $english = require resource_path('lang/en/shop.php');
        $arabic = require resource_path('lang/ar/shop.php');

        $this->assertSame(array_keys($english), array_keys($arabic));
        $this->assertSame(array_keys($english['order_statuses']), array_keys($arabic['order_statuses']));
        $this->assertSame(array_keys($english['payment_statuses']), array_keys($arabic['payment_statuses']));
    }

}
