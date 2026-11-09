<?php

namespace Tests\Feature;

use App\Filament\Pages\ShopSettings;
use App\Filament\Resources\BannerResource\Pages\CreateBanner;
use App\Filament\Resources\BannerResource\Pages\EditBanner;
use App\Filament\Resources\GiftCardResource\Pages\CreateGiftCard;
use App\Models\Banner;
use App\Models\GiftCard;
use App\Models\Setting;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class AdminContentAndSettingsTest extends TestCase
{
    use CreatesCatalog, RefreshDatabase;

    private User $admin;

    protected function setUp(): void
    {
        parent::setUp();

        $this->admin = User::factory()->create([
            'role' => 'admin',
            'is_admin' => true,
            'two_factor_confirmed_at' => now(),
        ]);
    }

    public function test_admin_can_create_banner_via_filament_resource(): void
    {
        Livewire::actingAs($this->admin)
            ->test(CreateBanner::class)
            ->fillForm([
                'title' => 'Exclusive Summer Glow',
                'subtitle' => 'Shine bright with our limited-edition summer beauty essentials.',
                'badge' => 'HOT DEAL',
                'image_path' => 'https://example.com/banner-summer.webp',
                'link' => '/shop/makeup',
                'cta_label' => 'Explore Now',
                'position' => 'hero_carousel',
                'sort_order' => 5,
                'is_active' => true,
            ])
            ->call('create')
            ->assertHasNoFormErrors();

        $this->assertDatabaseHas('banners', [
            'title' => 'Exclusive Summer Glow',
            'badge' => 'HOT DEAL',
            'position' => 'hero_carousel',
            'sort_order' => 5,
            'is_active' => true,
        ]);
    }

    public function test_admin_can_update_banner_via_filament_resource(): void
    {
        $banner = Banner::create([
            'title' => 'Original Banner Title',
            'image_path' => 'https://example.com/original.webp',
            'position' => 'hero_carousel',
            'sort_order' => 1,
            'is_active' => true,
        ]);

        Livewire::actingAs($this->admin)
            ->test(EditBanner::class, ['record' => $banner->id])
            ->fillForm([
                'title' => 'Updated Banner Title',
                'badge' => 'LIMITED TIME',
                'is_active' => false,
            ])
            ->call('save')
            ->assertHasNoFormErrors();

        $banner->refresh();
        $this->assertEquals('Updated Banner Title', $banner->title);
        $this->assertEquals('LIMITED TIME', $banner->badge);
        $this->assertFalse($banner->is_active);
    }

    public function test_homepage_hero_carousel_renders_active_banners_from_database(): void
    {
        Banner::query()->delete();

        Banner::create([
            'title' => 'Dior Forever Skin Glow',
            'subtitle' => 'Radiant 24h wear foundation with clean floral skincare.',
            'badge' => 'SEPHORA EXCLUSIVE',
            'image_path' => 'https://example.com/dior-forever.webp',
            'link' => '/brands/dior',
            'cta_label' => 'Discover Dior',
            'position' => 'hero_carousel',
            'sort_order' => 1,
            'is_active' => true,
        ]);

        $response = $this->get('/');

        $response->assertOk();
        $response->assertSee('Dior Forever Skin Glow');
        $response->assertSee('SEPHORA EXCLUSIVE');
        $response->assertSee('Discover Dior');
        $response->assertSee('/brands/dior');
    }

    public function test_admin_can_save_and_apply_all_store_settings(): void
    {
        Livewire::actingAs($this->admin)
            ->test(ShopSettings::class)
            ->set('data.store_name', 'Sephora UAE Flagship')
            ->set('data.contact_email', 'help@sephora.ae')
            ->set('data.contact_phone', '+971 4 800 7374')
            ->set('data.support_hours', '9 AM – 11 PM Daily')
            ->set('data.announcement_enabled', true)
            ->set('data.announcement_bold', 'RAMADAN EXCLUSIVE')
            ->set('data.announcement_message', 'Complimentary luxury gift with every purchase above 350 AED.')
            ->set('data.announcement_action_text', 'CLAIM GIFT →')
            ->set('data.announcement_action_link', '/shop/fragrance')
            ->set('data.announcement_bg_color', '#004B23')
            ->set('data.announcement_text_color', '#FFD700')
            ->set('data.card_enabled', true)
            ->set('data.apple_pay_enabled', true)
            ->set('data.cod_enabled', true)
            ->set('data.cod_max_limit', '3000')
            ->set('data.social_instagram', 'https://instagram.com/mycustomstore')
            ->set('data.social_tiktok', 'https://tiktok.com/@mycustomstore')
            ->set('data.seo_meta_title', 'Sephora UAE — Official Luxury Beauty & Fragrances')
            ->call('save')
            ->assertHasNoErrors();

        $this->assertEquals('Sephora UAE Flagship', Setting::get('store_name'));
        $this->assertEquals('help@sephora.ae', Setting::get('contact_email'));
        $this->assertEquals('RAMADAN EXCLUSIVE', Setting::get('announcement_bold'));
        $this->assertEquals('#004B23', Setting::get('announcement_bg_color'));
        $this->assertEquals('#FFD700', Setting::get('announcement_text_color'));
        $this->assertEquals('3000', Setting::get('cod_max_limit'));
        $this->assertEquals('https://instagram.com/mycustomstore', Setting::get('social_instagram'));

        // Verify live storefront header reflects the new announcement settings
        $response = $this->get('/');
        $response->assertOk();
        $response->assertSee('RAMADAN EXCLUSIVE');
        $response->assertSee('Complimentary luxury gift with every purchase above 350 AED.');
        $response->assertSee('CLAIM GIFT →');
        $response->assertSee('/shop/fragrance');
        $response->assertSee('#004B23', false);
        $response->assertSee('#FFD700', false);

        // Verify live storefront footer reflects custom social links
        $response->assertSee('https://instagram.com/mycustomstore', false);
        $response->assertSee('https://tiktok.com/@mycustomstore', false);
    }

    public function test_admin_can_issue_gift_card_via_filament_resource(): void
    {
        Livewire::actingAs($this->admin)
            ->test(CreateGiftCard::class)
            ->fillForm([
                'code' => '6046111122223333',
                'pin' => '7890',
                'initial_balance' => 750.00,
                'balance' => 750.00,
                'currency' => 'AED',
                'is_active' => true,
                'recipient_name' => 'Layla Hassan',
                'recipient_email' => 'layla@example.com',
                'sender_name' => 'Store Concierge',
                'message' => 'Happy Anniversary!',
            ])
            ->call('create')
            ->assertHasNoFormErrors();

        $this->assertDatabaseHas('gift_cards', [
            'code' => '6046111122223333',
            'pin' => '7890',
            'initial_balance' => 750.00,
            'balance' => 750.00,
            'recipient_email' => 'layla@example.com',
            'is_active' => true,
        ]);
    }

    public function test_admin_can_configure_bnpl_gateways(): void
    {
        Livewire::actingAs($this->admin)
            ->test(ShopSettings::class)
            ->set('data.tabby_enabled', true)
            ->set('data.tabby_mode', 'production')
            ->set('data.tabby_merchant_code', 'sephora_uae_live')
            ->set('data.tabby_public_key', 'pk_live_tabby_123')
            ->set('data.tabby_secret_key', 'sk_live_tabby_456')
            ->set('data.tamara_enabled', true)
            ->set('data.tamara_mode', 'production')
            ->set('data.tamara_api_token', 'tamara_live_token_789')
            ->set('data.tamara_notification_token', 'tamara_wh_token_abc')
            ->call('save')
            ->assertHasNoErrors();

        $this->assertEquals('1', Setting::get('tabby_enabled'));
        $this->assertEquals('production', Setting::get('tabby_mode'));
        $this->assertEquals('sephora_uae_live', Setting::get('tabby_merchant_code'));
        $this->assertEquals('pk_live_tabby_123', Setting::get('tabby_public_key'));
        $this->assertEquals('1', Setting::get('tamara_enabled'));
        $this->assertEquals('production', Setting::get('tamara_mode'));
        $this->assertEquals('tamara_live_token_789', Setting::get('tamara_api_token'));
    }
}

