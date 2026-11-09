<?php

namespace Tests\Unit;

use App\Models\User;
use App\Services\Auth\TwoFactorAuthenticator;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TwoFactorAuthenticatorTest extends TestCase
{
    use RefreshDatabase;

    private TwoFactorAuthenticator $tfa;

    protected function setUp(): void
    {
        parent::setUp();
        $this->tfa = new TwoFactorAuthenticator();
    }

    public function test_generate_secret_returns_valid_base32_string(): void
    {
        $secret = $this->tfa->generateSecret(32);

        $this->assertSame(32, strlen($secret));
        $this->assertMatchesRegularExpression('/^[A-Z2-7]{32}$/', $secret);
    }

    public function test_compute_and_verify_totp_code(): void
    {
        $secret = $this->tfa->generateSecret(32);
        $now = time();

        $code = $this->tfa->code($secret, $now);

        $this->assertSame(6, strlen($code));
        $this->assertMatchesRegularExpression('/^\d{6}$/', $code);

        // Code should verify successfully at current timestamp
        $this->assertTrue($this->tfa->verify($secret, $code));

        // Code should verify within 1-step window (30 seconds in past or future)
        $pastCode = $this->tfa->code($secret, $now - 30);
        $this->assertTrue($this->tfa->verify($secret, $pastCode));

        $futureCode = $this->tfa->code($secret, $now + 30);
        $this->assertTrue($this->tfa->verify($secret, $futureCode));

        // Code outside window (> 60 seconds) should fail
        $distantCode = $this->tfa->code($secret, $now - 90);
        $this->assertFalse($this->tfa->verify($secret, $distantCode));

        // Malformed code should fail
        $this->assertFalse($this->tfa->verify($secret, 'invalid'));
        $this->assertFalse($this->tfa->verify($secret, '123'));
    }

    public function test_otpauth_uri_generation(): void
    {
        $user = User::factory()->create([
            'email' => 'tfa-user@sephora.ae',
        ]);

        $secret = 'JBSWY3DPEHPK3PXP';
        $uri = $this->tfa->otpauthUri($user, $secret);

        $this->assertStringStartsWith('otpauth://totp/', $uri);
        $this->assertStringContainsString('secret=JBSWY3DPEHPK3PXP', $uri);
        $this->assertStringContainsString('tfa-user%40sephora.ae', $uri);
    }

    public function test_recovery_codes_generation_and_consumption(): void
    {
        $codes = $this->tfa->generateRecoveryCodes(8);

        $this->assertCount(8, $codes);
        foreach ($codes as $code) {
            $this->assertMatchesRegularExpression('/^[A-Z0-9]{4}-[A-Z0-9]{4}$/', $code);
        }

        $user = User::factory()->create();
        $user->forceFill([
            'two_factor_recovery_codes' => $this->tfa->hashRecoveryCodes($codes),
        ])->save();

        // Valid consumption of code #0
        $consumed = $this->tfa->verifyRecoveryCode($user, $codes[0]);
        $this->assertTrue($consumed);

        // Code #0 cannot be used again
        $reused = $this->tfa->verifyRecoveryCode($user, $codes[0]);
        $this->assertFalse($reused);

        // Invalid code fails
        $invalid = $this->tfa->verifyRecoveryCode($user, 'ZZZZ-9999');
        $this->assertFalse($invalid);
    }
}

