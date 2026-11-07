<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Notification;
use Tests\TestCase;

class AuthenticationTest extends TestCase
{
    use RefreshDatabase;

    public function test_registration_form_loads(): void
    {
        $this->get('/register')->assertStatus(200)->assertSee('Create Your Account');
    }

    public function test_user_can_register(): void
    {
        $response = $this->post('/register', [
            'name' => 'Fatima Al Mansoori',
            'email' => 'fatima@example.com',
            'phone' => '501234567',
            'password' => 'SuperSecret123',
            'password_confirmation' => 'SuperSecret123',
        ]);

        $response->assertRedirect(route('account.dashboard'));
        $this->assertAuthenticated();
        $this->assertDatabaseHas('users', ['email' => 'fatima@example.com', 'loyalty_tier' => 'member']);
    }

    public function test_registration_validates_input(): void
    {
        $response = $this->post('/register', [
            'name' => 'F',
            'email' => 'not-an-email',
            'password' => 'short',
            'password_confirmation' => 'different',
        ]);

        $response->assertSessionHasErrors(['name', 'email', 'password']);
        $this->assertGuest();
    }

    public function test_duplicate_email_rejected(): void
    {
        User::factory()->create(['email' => 'taken@example.com']);

        $this->post('/register', [
            'name' => 'Someone Else',
            'email' => 'taken@example.com',
            'password' => 'SuperSecret123',
            'password_confirmation' => 'SuperSecret123',
        ])->assertSessionHasErrors('email');
    }

    public function test_user_can_login_with_correct_credentials(): void
    {
        $user = User::factory()->create(['password' => 'SuperSecret123']);

        $response = $this->post('/sign-in', [
            'email' => $user->email,
            'password' => 'SuperSecret123',
        ]);

        $response->assertRedirect(route('account.dashboard'));
        $this->assertAuthenticatedAs($user);
    }

    public function test_login_fails_with_wrong_password(): void
    {
        $user = User::factory()->create(['password' => 'SuperSecret123']);

        $this->post('/sign-in', [
            'email' => $user->email,
            'password' => 'WrongPassword',
        ])->assertSessionHasErrors('email');

        $this->assertGuest();
    }

    public function test_login_locks_after_five_failures(): void
    {
        $user = User::factory()->create(['password' => 'SuperSecret123']);

        foreach (range(1, 5) as $i) {
            $this->post('/sign-in', [
                'email' => $user->email,
                'password' => "WrongPassword{$i}",
            ]);
        }

        // 6th attempt with the CORRECT password must still be throttled (429).
        $this->post('/sign-in', [
            'email' => $user->email,
            'password' => 'SuperSecret123',
        ])->assertStatus(429);

        $this->assertGuest();
    }

    public function test_user_can_logout(): void
    {
        $user = User::factory()->create();

        $this->actingAs($user)
            ->post('/sign-out')
            ->assertRedirect(route('home'));

        $this->assertGuest();
    }

    public function test_forgot_password_page_loads(): void
    {
        $this->get('/forgot-password')->assertStatus(200);
    }

    public function test_password_reset_link_flow(): void
    {
        Notification::fake();
        $user = User::factory()->create();

        $response = $this->post('/forgot-password', ['email' => $user->email]);

        // Always the same neutral response (no account enumeration).
        $response->assertSessionHas('reset_link_sent');

        $this->assertDatabaseCount('password_reset_tokens', 1);
    }

    public function test_account_pages_require_authentication(): void
    {
        foreach (['/my-account', '/my-account/orders', '/my-account/settings', '/my-account/wishlist'] as $uri) {
            $this->get($uri)->assertRedirect('/sign-in');
        }
    }
}
