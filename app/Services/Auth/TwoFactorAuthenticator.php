<?php

namespace App\Services\Auth;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

class TwoFactorAuthenticator
{
    private const BASE32_ALPHABET = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ234567';

    private const RECOVERY_ALPHABET = 'ABCDEFGHJKLMNPQRSTUVWXYZ23456789';

    /**
     * Generate a 160-bit base32 secret suitable for TOTP.
     */
    public function generateSecret(int $length = 32): string
    {
        $secret = '';

        for ($i = 0; $i < $length; $i++) {
            $secret .= self::BASE32_ALPHABET[random_int(0, strlen(self::BASE32_ALPHABET) - 1)];
        }

        return $secret;
    }

    /**
     * Compute the six digit code for a given secret and time step.
     */
    public function code(string $secret, ?int $timestamp = null): string
    {
        $counter = intdiv($timestamp ?? time(), 30);
        $hash = hash_hmac('sha1', pack('N2', 0, $counter), $this->base32Decode($secret), true);
        $offset = ord($hash[19]) & 0x0F;

        $value = ((ord($hash[$offset]) & 0x7F) << 24)
            | ((ord($hash[$offset + 1]) & 0xFF) << 16)
            | ((ord($hash[$offset + 2]) & 0xFF) << 8)
            | (ord($hash[$offset + 3]) & 0xFF);

        return str_pad((string) ($value % 1_000_000), 6, '0', STR_PAD_LEFT);
    }

    /**
     * Verify a code, tolerating one step of clock drift in either direction.
     */
    public function verify(string $secret, string $code, int $window = 1): bool
    {
        $code = preg_replace('/\s+/', '', $code) ?? '';

        if (! preg_match('/^\d{6}$/', $code)) {
            return false;
        }

        $now = time();

        for ($step = -$window; $step <= $window; $step++) {
            if (hash_equals($this->code($secret, $now + ($step * 30)), $code)) {
                return true;
            }
        }

        return false;
    }

    /**
     * Build the otpauth URI used by authenticator apps.
     */
    public function otpauthUri(User $user, string $secret): string
    {
        $issuer = rawurlencode((string) config('app.name', 'Sephora UAE'));
        $label = rawurlencode($issuer.':'.$user->email);

        return "otpauth://totp/{$label}?secret={$secret}&issuer={$issuer}&algorithm=SHA1&digits=6&period=30";
    }

    /**
     * @return array<int, string>
     */
    public function generateRecoveryCodes(int $count = 8): array
    {
        $codes = [];

        for ($i = 0; $i < $count; $i++) {
            $raw = '';

            for ($j = 0; $j < 8; $j++) {
                $raw .= self::RECOVERY_ALPHABET[random_int(0, strlen(self::RECOVERY_ALPHABET) - 1)];
            }

            $codes[] = substr($raw, 0, 4).'-'.substr($raw, 4, 4);
        }

        return $codes;
    }

    /**
     * @param  array<int, string>  $codes
     * @return array<int, string>
     */
    public function hashRecoveryCodes(array $codes): array
    {
        return array_map(fn (string $code) => Hash::make($code), $codes);
    }

    /**
     * Verify and consume a recovery code. Each code works exactly once.
     */
    public function verifyRecoveryCode(User $user, string $code): bool
    {
        $normalized = strtoupper((string) preg_replace('/[^A-Za-z0-9]/', '', $code));

        if (strlen($normalized) !== 8) {
            return false;
        }

        $formatted = substr($normalized, 0, 4).'-'.substr($normalized, 4, 4);
        $hashes = $user->two_factor_recovery_codes ?? [];

        foreach ($hashes as $index => $hash) {
            if (Hash::check($formatted, $hash)) {
                unset($hashes[$index]);
                $user->forceFill(['two_factor_recovery_codes' => array_values($hashes)])->save();

                return true;
            }
        }

        return false;
    }

    private function base32Decode(string $secret): string
    {
        $secret = strtoupper((string) preg_replace('/[^A-Za-z2-7]/', '', $secret));
        $bits = '';

        foreach (str_split($secret) as $character) {
            $position = strpos(self::BASE32_ALPHABET, $character);

            if ($position === false) {
                continue;
            }

            $bits .= str_pad(decbin($position), 5, '0', STR_PAD_LEFT);
        }

        $binary = '';

        foreach (str_split($bits, 8) as $byte) {
            if (strlen($byte) === 8) {
                $binary .= chr((int) bindec($byte));
            }
        }

        return $binary;
    }
}
