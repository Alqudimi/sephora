<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\User;
use App\Services\Auth\TwoFactorAuthenticator;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class TwoFactorChallengeController extends Controller
{
    public function show(Request $request): View|RedirectResponse
    {
        if (! $request->session()->has('login.id')) {
            return redirect()->route('login');
        }

        return view('auth.two-factor-challenge');
    }

    public function store(Request $request, TwoFactorAuthenticator $authenticator): RedirectResponse
    {
        $request->validate([
            'code' => 'nullable|required_without:recovery_code|string|max:20',
            'recovery_code' => 'nullable|required_without:code|string|max:20',
        ]);

        $userId = $request->session()->get('login.id');
        $user = $userId ? User::find($userId) : null;

        if (! $user) {
            $request->session()->forget(['login.id', 'login.remember', 'login.cart_session_id']);

            return redirect()->route('login');
        }

        $recoveryCode = trim((string) $request->input('recovery_code'));
        $code = trim((string) $request->input('code'));

        $valid = $recoveryCode !== ''
            ? $authenticator->verifyRecoveryCode($user, $recoveryCode)
            : ($user->two_factor_secret ? $authenticator->verify($user->two_factor_secret, $code) : false);

        if (! $valid) {
            throw ValidationException::withMessages([
                'code' => $recoveryCode !== ''
                    ? 'This recovery code is invalid or has already been used.'
                    : 'This authentication code is invalid. Check your authenticator app and try again.',
            ]);
        }

        $remember = (bool) $request->session()->pull('login.remember', false);
        $cartSessionId = (string) $request->session()->pull('login.cart_session_id', '');
        $request->session()->forget('login.id');

        if ($cartSessionId !== '') {
            Cart::claimGuestCart($cartSessionId, (int) $user->id);
        }

        Auth::login($user, $remember);
        $request->session()->regenerate();
        $user->forceFill(['last_login_at' => now()])->save();

        return redirect()->intended($user->isStaff() ? route('admin.dashboard') : route('account.dashboard'));
    }
}
