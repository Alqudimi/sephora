<?php

namespace Tests\Feature;

use App\Models\Consent;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ConsentTest extends TestCase
{
    use RefreshDatabase;

    private function customer(array $attributes = []): User
    {
        return User::factory()->create(array_merge([
            'name' => 'Consent Customer',
            'email' => 'consent@example.com',
            'phone' => '+971500000002',
        ], $attributes));
    }

    private function settingsPayload(User $user, array $overrides = []): array
    {
        return array_merge([
            'name' => $user->name,
            'email' => $user->email,
            'phone' => $user->phone,
            'date_of_birth' => null,
            'gender' => null,
            'preferred_store' => null,
        ], $overrides);
    }

    public function test_cookie_banner_is_shown_until_a_choice_is_recorded(): void
    {
        $this->get('/')->assertSee('id="cookie-banner"', false);

        $this->withSession(['cookie_consent' => 'accepted'])->get('/')
            ->assertDontSee('id="cookie-banner"', false);

        $this->withSession(['cookie_consent' => 'declined'])->get('/')
            ->assertDontSee('id="cookie-banner"', false);
    }

    public function test_guests_can_accept_cookies_and_the_choice_is_logged(): void
    {
        $response = $this->post(route('consent.cookies'), ['choice' => 'accepted']);

        $response->assertRedirect();
        $response->assertCookie('cookie_consent', 'accepted');
        $this->assertSame('accepted', session('cookie_consent'));

        $consent = Consent::sole();
        $this->assertSame('cookies', $consent->type);
        $this->assertSame('1.0', $consent->version);
        $this->assertTrue($consent->accepted);
        $this->assertNull($consent->user_id);
        $this->assertNull($consent->email);
        $this->assertNotNull($consent->accepted_at);
        $this->assertNotNull($consent->ip_address);
    }

    public function test_guests_can_decline_optional_cookies(): void
    {
        $response = $this->post(route('consent.cookies'), ['choice' => 'declined']);

        $response->assertRedirect();
        $response->assertCookie('cookie_consent', 'declined');

        $consent = Consent::sole();
        $this->assertSame('cookies', $consent->type);
        $this->assertFalse($consent->accepted);
    }

    public function test_cookie_choice_is_validated(): void
    {
        $this->post(route('consent.cookies'), ['choice' => 'maybe'])
            ->assertSessionHasErrors('choice');

        $this->assertSame(0, Consent::count());
    }

    public function test_authenticated_cookie_consent_is_linked_to_the_account(): void
    {
        $user = $this->customer();

        $this->actingAs($user)
            ->post(route('consent.cookies'), ['choice' => 'accepted'])
            ->assertRedirect();

        $consent = Consent::sole();
        $this->assertSame($user->id, $consent->user_id);
        $this->assertSame($user->email, $consent->email);
    }

    public function test_marketing_opt_in_is_saved_and_logged_once_per_change(): void
    {
        $user = $this->customer();

        $this->actingAs($user)
            ->post(route('account.settings.update'), $this->settingsPayload($user, ['marketing_email' => '1']))
            ->assertRedirect()
            ->assertSessionHas('settings_saved', true);

        $user->refresh();
        $this->assertTrue($user->marketing_preferences['email']);

        $consent = $user->consents()->where('type', 'marketing')->sole();
        $this->assertTrue($consent->accepted);
        $this->assertSame($user->email, $consent->email);

        // Saving the form again without changing the choice must not append
        // a duplicate audit row.
        $this->actingAs($user)
            ->post(route('account.settings.update'), $this->settingsPayload($user, ['marketing_email' => '1']))
            ->assertRedirect();

        $this->assertSame(1, $user->consents()->where('type', 'marketing')->count());

        // Unchecking the box withdraws consent and is logged.
        $this->actingAs($user)
            ->post(route('account.settings.update'), $this->settingsPayload($user))
            ->assertRedirect();

        $user->refresh();
        $this->assertFalse($user->marketing_preferences['email']);
        $this->assertSame(1, $user->consents()->where('type', 'marketing')->where('accepted', false)->count());
    }

    public function test_registration_records_marketing_consent_when_opted_in(): void
    {
        $response = $this->post(route('register'), [
            'name' => 'New Member',
            'email' => 'new-member@example.com',
            'password' => 'password123',
            'password_confirmation' => 'password123',
            'marketing_email' => '1',
        ]);

        $response->assertRedirect(route('account.dashboard'));

        $user = User::where('email', 'new-member@example.com')->sole();
        $this->assertTrue($user->marketing_preferences['email']);

        $consent = Consent::sole();
        $this->assertSame('marketing', $consent->type);
        $this->assertSame($user->id, $consent->user_id);
        $this->assertTrue($consent->accepted);
    }

    public function test_registration_without_marketing_opt_in_creates_no_consent_row(): void
    {
        $response = $this->post(route('register'), [
            'name' => 'Quiet Member',
            'email' => 'quiet-member@example.com',
            'password' => 'password123',
            'password_confirmation' => 'password123',
        ]);

        $response->assertRedirect(route('account.dashboard'));

        $user = User::where('email', 'quiet-member@example.com')->sole();
        $this->assertFalse($user->marketing_preferences['email']);
        $this->assertSame(0, Consent::count());
    }
}
