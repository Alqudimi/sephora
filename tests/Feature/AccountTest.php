<?php

namespace Tests\Feature;

use App\Models\ContactMessage;
use App\Models\Order;
use App\Models\User;
use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\URL;
use Tests\TestCase;

class AccountTest extends TestCase
{
    use RefreshDatabase;

    private function makeUser(array $attrs = []): User
    {
        // email_verified_at is not mass assignable, so it is written
        // explicitly after the user row exists.
        $verifiedAt = array_key_exists('email_verified_at', $attrs)
            ? $attrs['email_verified_at']
            : now();
        unset($attrs['email_verified_at']);

        $user = User::create(array_merge([
            'name' => 'Layla Hassan',
            'email' => 'layla@example.com',
            'password' => Hash::make('secret-password'),
        ], $attrs));

        if ($verifiedAt !== null) {
            $user->forceFill(['email_verified_at' => $verifiedAt])->save();
        }

        return $user;
    }

    private function makeOrder(User $user, array $attrs = []): Order
    {
        static $n = 0;
        $n++;

        return Order::create(array_merge([
            'order_number' => 'AE-ACC-'.str_pad((string) $n, 5, '0', STR_PAD_LEFT),
            'user_id' => $user->id,
            'status' => 'processing',
            'payment_method' => 'cod',
            'payment_status' => 'pending',
            'delivery_method' => 'standard',
            'customer_name' => $user->name,
            'customer_phone' => '+971500000000',
            'subtotal' => 100,
            'total' => 125,
        ], $attrs));
    }

    public function test_guest_is_redirected_from_account_pages(): void
    {
        $this->get(route('account.dashboard'))->assertRedirect(route('login'));
        $this->get(route('account.settings'))->assertRedirect(route('login'));
        $this->get(route('account.contact'))->assertRedirect(route('login'));
    }

    public function test_dashboard_renders_real_user_stats_and_recent_orders(): void
    {
        $user = $this->makeUser();
        $this->makeOrder($user, ['order_number' => 'AE-RECENT-1']);

        $this->actingAs($user)
            ->get(route('account.dashboard'))
            ->assertOk()
            ->assertSee('Layla Hassan')
            ->assertSee('layla@example.com')
            ->assertSee('AE-RECENT-1')
            ->assertSee('Recent orders')
            ->assertDontSee('CREATE ACCOUNT');
    }

    public function test_unverified_user_sees_verification_banner_on_dashboard(): void
    {
        $user = $this->makeUser(['email_verified_at' => null]);

        $this->actingAs($user)
            ->get(route('account.dashboard'))
            ->assertOk()
            ->assertSee('not verified yet')
            ->assertSee(route('verification.notice'));
    }

    public function test_settings_page_renders_profile_and_password_forms(): void
    {
        $user = $this->makeUser();

        $this->actingAs($user)
            ->get(route('account.settings'))
            ->assertOk()
            ->assertSee('Personal information')
            ->assertSee('Change password')
            ->assertSee('name="current_password"', false)
            ->assertSee('action="'.route('account.settings.update').'"', false);
    }

    public function test_user_can_update_profile_without_changing_email(): void
    {
        $user = $this->makeUser();

        $this->actingAs($user)
            ->post(route('account.settings.update'), [
                'name' => 'Layla H.',
                'email' => $user->email,
                'phone' => '+971 50 111 2222',
                'preferred_store' => 'Dubai Mall',
            ])
            ->assertRedirect()
            ->assertSessionHas('settings_saved');

        $user->refresh();
        $this->assertSame('Layla H.', $user->name);
        $this->assertSame('+971 50 111 2222', $user->phone);
        $this->assertNotNull($user->email_verified_at);
    }

    public function test_changing_email_resets_verification(): void
    {
        $user = $this->makeUser(['email_verified_at' => now()]);

        $this->actingAs($user)
            ->post(route('account.settings.update'), [
                'name' => $user->name,
                'email' => 'new-address@example.com',
            ])
            ->assertRedirect();

        $this->assertSame('new-address@example.com', $user->fresh()->email);
        $this->assertNull($user->fresh()->email_verified_at);
    }

    public function test_user_can_change_password_with_correct_current_password(): void
    {
        $user = $this->makeUser();

        $this->actingAs($user)
            ->post(route('account.settings.update'), [
                'name' => $user->name,
                'email' => $user->email,
                'current_password' => 'secret-password',
                'new_password' => 'brand-new-password',
                'new_password_confirmation' => 'brand-new-password',
            ])
            ->assertRedirect()
            ->assertSessionHasNoErrors();

        $this->assertTrue(Hash::check('brand-new-password', $user->fresh()->password));
    }

    public function test_password_change_rejected_when_current_password_is_wrong(): void
    {
        $user = $this->makeUser();

        $this->actingAs($user)
            ->post(route('account.settings.update'), [
                'name' => $user->name,
                'email' => $user->email,
                'current_password' => 'not-the-password',
                'new_password' => 'brand-new-password',
                'new_password_confirmation' => 'brand-new-password',
            ])
            ->assertSessionHasErrors('current_password');

        $this->assertTrue(Hash::check('secret-password', $user->fresh()->password));
    }

    public function test_account_contact_form_stores_a_message(): void
    {
        $user = $this->makeUser();

        $this->actingAs($user)
            ->post(route('account.contact.store'), [
                'name' => $user->name,
                'email' => $user->email,
                'phone' => '+971500000000',
                'subject' => 'Order enquiry',
                'message' => 'My order has not arrived yet, can you check it please?',
            ])
            ->assertRedirect()
            ->assertSessionHas('contact_success');

        $this->assertDatabaseHas('contact_messages', [
            'email' => $user->email,
            'subject' => 'Order enquiry',
            'status' => 'new',
        ]);
    }

    public function test_account_contact_form_validates_input(): void
    {
        $user = $this->makeUser();

        $this->actingAs($user)
            ->post(route('account.contact.store'), [
                'name' => '',
                'email' => 'not-an-email',
                'message' => 'short',
            ])
            ->assertSessionHasErrors(['name', 'email', 'message']);

        $this->assertSame(0, ContactMessage::count());
    }

    public function test_user_can_change_preferred_language(): void
    {
        $user = $this->makeUser(['preferred_language' => 'en']);

        $this->actingAs($user)
            ->post(route('account.country-language.update'), ['preferred_language' => 'ar'])
            ->assertRedirect()
            ->assertSessionHas('language_saved');

        $this->assertSame('ar', $user->fresh()->preferred_language);
    }

    public function test_preferred_language_is_validated(): void
    {
        $user = $this->makeUser();

        $this->actingAs($user)
            ->post(route('account.country-language.update'), ['preferred_language' => 'de'])
            ->assertSessionHasErrors('preferred_language');
    }

    public function test_unverified_user_sees_verification_notice(): void
    {
        $user = $this->makeUser(['email_verified_at' => null]);

        $this->actingAs($user)
            ->get(route('verification.notice'))
            ->assertOk()
            ->assertSee('Verify your email')
            ->assertSee('Resend verification email');
    }

    public function test_verified_user_is_sent_away_from_verification_notice(): void
    {
        $user = $this->makeUser();

        $this->actingAs($user)
            ->get(route('verification.notice'))
            ->assertRedirect(route('account.dashboard'));
    }

    public function test_signed_verification_link_marks_email_verified(): void
    {
        $user = $this->makeUser(['email_verified_at' => null]);

        $url = URL::temporarySignedRoute('verification.verify', now()->addMinutes(60), [
            'id' => $user->id,
            'hash' => sha1($user->email),
        ]);

        $this->actingAs($user)
            ->get($url)
            ->assertRedirect(route('account.dashboard'))
            ->assertSessionHas('verified');

        $this->assertNotNull($user->fresh()->email_verified_at);
    }

    public function test_verification_link_with_wrong_hash_is_rejected(): void
    {
        $user = $this->makeUser(['email_verified_at' => null]);

        $url = URL::temporarySignedRoute('verification.verify', now()->addMinutes(60), [
            'id' => $user->id,
            'hash' => sha1('someone-else@example.com'),
        ]);

        $this->actingAs($user)->get($url)->assertForbidden();
        $this->assertNull($user->fresh()->email_verified_at);
    }

    public function test_resend_verification_notification_is_sent(): void
    {
        Notification::fake();
        $user = $this->makeUser(['email_verified_at' => null]);

        $this->actingAs($user)
            ->post(route('verification.send'))
            ->assertSessionHas('verification_sent');

        Notification::assertSentTo($user, VerifyEmail::class);
    }

    public function test_registration_creates_unverified_user_and_sends_verification(): void
    {
        Notification::fake();

        $this->post(route('register'), [
            'name' => 'New Shopper',
            'email' => 'new-shopper@example.com',
            'password' => 'a-strong-password',
            'password_confirmation' => 'a-strong-password',
        ])->assertRedirect(route('account.dashboard'));

        $user = User::where('email', 'new-shopper@example.com')->firstOrFail();

        $this->assertNull($user->email_verified_at);
        $this->assertAuthenticatedAs($user);
        Notification::assertSentTo($user, VerifyEmail::class);
    }

    public function test_user_can_view_own_tax_invoice(): void
    {
        $user = $this->makeUser();
        $order = $this->makeOrder($user, ['order_number' => 'AE-INV-12345']);

        $this->actingAs($user)
            ->get(route('account.orders.invoice', $order->order_number))
            ->assertOk()
            ->assertSee('Tax Invoice')
            ->assertSee('AE-INV-12345')
            ->assertSee('Billed to');
    }

    public function test_user_cannot_view_another_users_tax_invoice(): void
    {
        $user1 = $this->makeUser(['email' => 'user1@example.com']);
        $user2 = $this->makeUser(['email' => 'user2@example.com']);
        $order = $this->makeOrder($user2, ['order_number' => 'AE-INV-99999']);

        $this->actingAs($user1)
            ->get(route('account.orders.invoice', $order->order_number))
            ->assertNotFound();
    }

    public function test_loyalty_tier_automatically_upgrades_with_points(): void
    {
        $user = $this->makeUser(['loyalty_points' => 0, 'loyalty_tier' => 'member']);

        $user->awardLoyaltyPoints(250);
        $this->assertSame('silver', $user->fresh()->loyalty_tier);
        $this->assertSame(250, $user->fresh()->loyalty_points);

        $user->awardLoyaltyPoints(800); // total 1050
        $this->assertSame('gold', $user->fresh()->loyalty_tier);

        $user->awardLoyaltyPoints(1500); // total 2550
        $this->assertSame('platinum', $user->fresh()->loyalty_tier);
    }
}
