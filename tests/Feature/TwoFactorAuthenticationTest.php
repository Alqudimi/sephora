<?php

namespace Tests\Feature;

use App\Models\User;
use App\Services\Auth\TwoFactorAuthenticator;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TwoFactorAuthenticationTest extends TestCase
{
    use RefreshDatabase;

    private function admin(array $attributes = []): User
    {
        return User::factory()->create(array_merge([
            'role' => 'admin',
            'is_admin' => true,
            'two_factor_confirmed_at' => now(),
        ], $attributes));
    }

    private function withPendingLogin(User $user): static
    {
        return $this->withSession([
            'login.id' => $user->id,
            'login.remember' => false,
        ]);
    }

    public function test_staff_without_two_factor_is_sent_to_security_setup(): void
    {
        $admin = User::factory()->create([
            'role' => 'admin',
            'is_admin' => true,
        ]);

        $this->actingAs($admin)
            ->get('/admin')
            ->assertRedirect(route('account.security'))
            ->assertSessionHas('two_factor_required', true);
    }

    public function test_staff_with_two_factor_can_reach_the_admin_panel(): void
    {
        $this->actingAs($this->admin())
            ->get('/admin')
            ->assertOk();
    }

    public function test_login_requires_the_second_factor_before_authenticating(): void
    {
        $user = $this->admin();
        $secret = app(TwoFactorAuthenticator::class)->generateSecret();
        $user->forceFill(['two_factor_secret' => $secret])->save();

        $this->post(route('login.attempt'), [
            'email' => $user->email,
            'password' => 'password',
        ])->assertRedirect(route('two-factor.challenge'));

        $this->assertGuest();
        $this->assertSame($user->id, session('login.id'));
    }

    public function test_valid_totp_completes_the_login(): void
    {
        $authenticator = app(TwoFactorAuthenticator::class);
        $user = $this->admin();
        $secret = $authenticator->generateSecret();
        $user->forceFill(['two_factor_secret' => $secret])->save();

        $this->post(route('login.attempt'), [
            'email' => $user->email,
            'password' => 'password',
        ])->assertRedirect(route('two-factor.challenge'));

        $this->post(route('two-factor.challenge.store'), [
            'code' => $authenticator->code($secret),
        ])->assertRedirect(route('admin.dashboard'));

        $this->assertAuthenticatedAs($user->fresh());
        $this->assertNotNull($user->fresh()->last_login_at);
    }

    public function test_invalid_totp_is_rejected(): void
    {
        $authenticator = app(TwoFactorAuthenticator::class);
        $user = $this->admin();
        $secret = $authenticator->generateSecret();
        $user->forceFill(['two_factor_secret' => $secret])->save();

        $valid = $authenticator->code($secret);
        $invalid = $valid === '000000' ? '000001' : '000000';

        $this->withPendingLogin($user)
            ->post(route('two-factor.challenge.store'), ['code' => $invalid])
            ->assertSessionHasErrors('code');

        $this->assertGuest();
    }

    public function test_recovery_code_completes_the_login_and_is_consumed(): void
    {
        $authenticator = app(TwoFactorAuthenticator::class);
        $user = $this->admin();
        $codes = $authenticator->generateRecoveryCodes();

        $user->forceFill([
            'two_factor_secret' => $authenticator->generateSecret(),
            'two_factor_recovery_codes' => $authenticator->hashRecoveryCodes($codes),
        ])->save();

        $this->withPendingLogin($user)
            ->post(route('two-factor.challenge.store'), ['recovery_code' => $codes[0]])
            ->assertRedirect(route('admin.dashboard'));

        $this->assertAuthenticatedAs($user->fresh());
        $this->assertCount(7, $user->fresh()->two_factor_recovery_codes);

        $this->post(route('logout'));

        $this->withPendingLogin($user)
            ->post(route('two-factor.challenge.store'), ['recovery_code' => $codes[0]])
            ->assertSessionHasErrors('code');

        $this->assertGuest();
    }

    public function test_setup_flow_generates_secret_and_recovery_codes(): void
    {
        $authenticator = app(TwoFactorAuthenticator::class);
        $user = User::factory()->create([
            'role' => 'admin',
            'is_admin' => true,
        ]);

        $this->actingAs($user)
            ->get(route('account.security'))
            ->assertOk()
            ->assertSee('Set up two-step verification');

        $this->actingAs($user)
            ->post(route('account.security.enable'))
            ->assertRedirect(route('account.security'));

        $user->refresh();
        $this->assertNotEmpty($user->two_factor_secret);
        $this->assertFalse($user->hasTwoFactorEnabled());

        $response = $this->actingAs($user)->post(route('account.security.confirm'), [
            'code' => $authenticator->code($user->two_factor_secret),
        ])->assertRedirect(route('account.security'));

        $recoveryCodes = session('recovery_codes');
        $this->assertCount(8, $recoveryCodes);
        $response->assertSessionHas('recovery_codes');

        $user->refresh();
        $this->assertTrue($user->hasTwoFactorEnabled());
        $this->assertCount(8, $user->two_factor_recovery_codes);

        $this->actingAs($user)
            ->get(route('account.security'))
            ->assertOk()
            ->assertSee($recoveryCodes[0]);

        $this->actingAs($user)->get('/admin')->assertOk();
    }

    public function test_staff_cannot_disable_two_factor(): void
    {
        $user = $this->admin();

        $this->actingAs($user)
            ->post(route('account.security.disable'), ['password' => 'password'])
            ->assertSessionHasErrors('password');

        $this->assertTrue($user->fresh()->hasTwoFactorEnabled());
    }

    public function test_customer_can_disable_two_factor_with_the_current_password(): void
    {
        $user = User::factory()->create([
            'two_factor_confirmed_at' => now(),
        ]);

        $this->actingAs($user)
            ->post(route('account.security.disable'), ['password' => 'wrong-password'])
            ->assertSessionHasErrors('password');

        $this->assertTrue($user->fresh()->hasTwoFactorEnabled());

        $this->actingAs($user)
            ->post(route('account.security.disable'), ['password' => 'password'])
            ->assertRedirect(route('account.security'));

        $user->refresh();
        $this->assertFalse($user->hasTwoFactorEnabled());
        $this->assertNull($user->two_factor_secret);
        $this->assertNull($user->two_factor_recovery_codes);
    }
}
