<?php

namespace App\Http\Controllers\Account;

use App\Http\Controllers\Controller;
use App\Services\Auth\TwoFactorAuthenticator;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class SecurityController extends Controller
{
    public function edit(Request $request): View
    {
        return view('account.security', [
            'user' => $request->user(),
            'recoveryCodes' => $request->session()->get('recovery_codes', []),
        ]);
    }

    public function enable(Request $request, TwoFactorAuthenticator $authenticator): RedirectResponse
    {
        $user = $request->user();

        if ($user->hasTwoFactorEnabled()) {
            return redirect()->route('account.security');
        }

        if (! $user->two_factor_secret) {
            $user->forceFill(['two_factor_secret' => $authenticator->generateSecret()])->save();
        }

        return redirect()->route('account.security');
    }

    public function confirm(Request $request, TwoFactorAuthenticator $authenticator): RedirectResponse
    {
        $validated = $request->validate([
            'code' => 'required|digits:6',
        ]);

        $user = $request->user();

        if (! $user->two_factor_secret || ! $authenticator->verify($user->two_factor_secret, $validated['code'])) {
            throw ValidationException::withMessages([
                'code' => 'The authentication code is invalid. Check the time on your device and try again.',
            ]);
        }

        $recoveryCodes = $authenticator->generateRecoveryCodes();

        $user->forceFill([
            'two_factor_confirmed_at' => now(),
            'two_factor_recovery_codes' => $authenticator->hashRecoveryCodes($recoveryCodes),
        ])->save();

        return redirect()->route('account.security')->with('recovery_codes', $recoveryCodes);
    }

    public function disable(Request $request): RedirectResponse
    {
        $user = $request->user();

        if ($user->isStaff()) {
            throw ValidationException::withMessages([
                'password' => 'Two-factor authentication is mandatory for staff accounts.',
            ]);
        }

        $request->validate([
            'password' => 'required|current_password',
        ]);

        $user->forceFill([
            'two_factor_secret' => null,
            'two_factor_recovery_codes' => null,
            'two_factor_confirmed_at' => null,
        ])->save();

        return redirect()->route('account.security')->with('two_factor_disabled', true);
    }
}
