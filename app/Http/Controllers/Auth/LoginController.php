<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    /**
     * Attempts allowed before the named "login" limiter locks the pair out.
     */
    private const MAX_ATTEMPTS = 5;

    public function showLogin()
    {
        return view('auth.sign-in');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ], [
            'email.required' => __('runtime.enter_email'),
            'email.email' => __('runtime.valid_email'),
            'password.required' => __('runtime.enter_password'),
        ]);

        $throttleKey = $this->throttleKey($request);

        if (RateLimiter::tooManyAttempts($throttleKey, self::MAX_ATTEMPTS)) {
            $seconds = RateLimiter::availableIn($throttleKey);

            throw ValidationException::withMessages([
                'email' => __('runtime.too_many_attempts', ['seconds' => $seconds]),
            ]);
        }

        $remember = $request->boolean('remember');

        // The session id is regenerated on success — remember it so the
        // guest cart can be claimed for the user before the id changes.
        $oldSessionId = $request->session()->getId();

        if (Auth::attempt(['email' => $credentials['email'], 'password' => $credentials['password']], $remember)) {
            RateLimiter::clear($throttleKey);
            $user = Auth::user();

            if ($user->hasTwoFactorEnabled()) {
                // Do not keep the user signed in until the second factor is
                // proven; only the pending identity stays in the session.
                Auth::logout();
                $request->session()->put([
                    'login.id' => $user->id,
                    'login.remember' => $remember,
                    'login.cart_session_id' => $oldSessionId,
                ]);
                $request->session()->regenerate();

                return redirect()->route('two-factor.challenge');
            }

            Cart::claimGuestCart($oldSessionId, (int) $user->id);
            $request->session()->regenerate();

            return redirect()->intended(route('account.dashboard'));
        }

        RateLimiter::hit($throttleKey);

        throw ValidationException::withMessages([
            'email' => __('runtime.invalid_credentials'),
        ]);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('home');
    }

    private function throttleKey(Request $request): string
    {
        return strtolower($request->input('email')).'|'.$request->ip();
    }
}
