<?php

namespace Tests\Feature;

use App\Models\Setting;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class MiscFeaturesTest extends TestCase
{
    use CreatesCatalog, RefreshDatabase;

    public function test_wishlist_requires_authentication(): void
    {
        $product = $this->makeProduct();

        $this->postJson('/wishlist/toggle', ['product_id' => $product->id])
            ->assertOk()
            ->assertJsonPath('success', false);
    }

    public function test_user_can_toggle_wishlist(): void
    {
        $user = User::factory()->create();
        $product = $this->makeProduct();

        $this->actingAs($user)
            ->postJson('/wishlist/toggle', ['product_id' => $product->id])
            ->assertOk()
            ->assertJsonPath('success', true)
            ->assertJsonPath('added', true);

        $this->assertDatabaseHas('wishlist_items', [
            'user_id' => $user->id,
            'product_id' => $product->id,
        ]);

        // Toggle again → removed
        $this->actingAs($user)
            ->postJson('/wishlist/toggle', ['product_id' => $product->id])
            ->assertJsonPath('added', false);

        $this->assertDatabaseMissing('wishlist_items', [
            'user_id' => $user->id,
            'product_id' => $product->id,
        ]);
    }

    public function test_wishlist_page_shows_saved_products(): void
    {
        $user = User::factory()->create();
        $product = $this->makeProduct(['name' => 'Wishlisted Elixir']);
        $user->wishlistItems()->create(['product_id' => $product->id]);

        $this->actingAs($user)
            ->get('/my-account/wishlist')
            ->assertStatus(200)
            ->assertSee('Wishlisted Elixir');
    }

    public function test_newsletter_subscribe_stores_email(): void
    {
        $this->postJson('/newsletter/subscribe', ['email' => 'Fan@Example.com'])
            ->assertOk()
            ->assertJsonPath('success', true);

        $this->assertDatabaseHas('newsletter_subscribers', ['email' => 'fan@example.com']);
    }

    public function test_newsletter_rejects_bad_email(): void
    {
        $this->postJson('/newsletter/subscribe', ['email' => 'not-an-email'])
            ->assertStatus(422);
    }

    public function test_newsletter_is_idempotent(): void
    {
        $this->postJson('/newsletter/subscribe', ['email' => 'once@example.com']);
        $this->postJson('/newsletter/subscribe', ['email' => 'once@example.com']);

        $this->assertDatabaseCount('newsletter_subscribers', 1);
    }

    public function test_contact_form_stores_message(): void
    {
        $this->post('/contact-us', [
            'name' => 'Curious Client',
            'email' => 'client@example.com',
            'message' => 'When will the Kayali restock arrive?',
        ])->assertSessionHas('contact_success');

        $this->assertDatabaseHas('contact_messages', [
            'email' => 'client@example.com',
            'status' => 'new',
        ]);
    }

    public function test_contact_form_validates_required_fields(): void
    {
        $this->post('/contact-us', ['name' => '', 'email' => 'bad', 'message' => ''])
            ->assertSessionHasErrors(['name', 'email', 'message']);
    }

    public function test_gift_card_balance_endpoint_validates_input(): void
    {
        $this->postJson('/gift-card/balance', ['card_number' => ''])
            ->assertStatus(422);
    }

    public function test_gift_card_balance_returns_json(): void
    {
        $this->postJson('/gift-card/balance', ['card_number' => '6046 1234 5678 9012'])
            ->assertOk()
            ->assertJsonStructure(['success', 'valid', 'balance', 'message']);
    }

    public function test_user_can_store_address(): void
    {
        $user = User::factory()->create();

        $this->actingAs($user)->post('/my-account/addresses', [
            'full_name' => 'Fatima Al Mansoori',
            'phone' => '+971501234567',
            'emirate' => 'Dubai',
            'street_address' => 'Burj Crown Residences, Suite 1804',
            'is_default' => true,
        ])->assertSessionHas('address_saved');

        $this->assertDatabaseHas('addresses', [
            'user_id' => $user->id,
            'emirate' => 'Dubai',
            'is_default' => true,
        ]);
    }

    public function test_only_one_default_address_per_user(): void
    {
        $user = User::factory()->create();

        $this->actingAs($user)->post('/my-account/addresses', [
            'full_name' => 'First Address',
            'phone' => '+971501234567',
            'emirate' => 'Dubai',
            'street_address' => 'Tower One',
            'is_default' => true,
        ]);

        $this->actingAs($user)->post('/my-account/addresses', [
            'full_name' => 'Second Address',
            'phone' => '+971501234567',
            'emirate' => 'Abu Dhabi',
            'street_address' => 'Tower Two',
            'is_default' => true,
        ]);

        $this->assertEquals(1, $user->fresh()->addresses()->where('is_default', true)->count());
    }

    public function test_settings_can_be_set_and_cached(): void
    {
        Setting::set('shipping_fee', '30');

        $this->assertEquals('30', Setting::get('shipping_fee'));
        $this->assertEquals('fallback', Setting::get('missing_key', 'fallback'));

        Setting::set('shipping_fee', '35');
        $this->assertEquals('35', Setting::get('shipping_fee'), 'Setting::set must invalidate the cache');
    }

    public function test_checkout_rate_limited_after_threshold(): void
    {
        $product = $this->makeProduct();

        // 10 requests/hour allowed; blast past it.
        for ($i = 0; $i < 12; $i++) {
            $this->post('/checkout/place-order', array_merge([
                'customer_name' => 'Test',
                'customer_phone' => '+971500000000',
                'delivery_method' => 'standard',
                'emirate' => 'Dubai',
                'street_address' => 'X',
                'payment_method' => 'cod',
            ]));
        }

        $this->assertEquals(429, $this->post('/checkout/place-order', [
            'customer_name' => 'Test',
            'customer_phone' => '+971500000000',
            'delivery_method' => 'standard',
            'emirate' => 'Dubai',
            'street_address' => 'X',
            'payment_method' => 'cod',
        ])->status());
    }
}
