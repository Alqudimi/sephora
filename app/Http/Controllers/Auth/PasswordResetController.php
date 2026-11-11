<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules\Password as PasswordRule;
use Illuminate\Validation\ValidationException;

class PasswordResetController extends Controller
{
    /**
     * GET /forgot-password — request a reset link.
     */
    public function requestForm()
    {
        return view('auth.passwords.email');
    }

    public function sendResetLink(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email'],
        ]);

        $status = Password::sendResetLink($request->only('email'));

        // Keep the response identical for unknown accounts (no enumeration),
        // but surface throttling so a real customer is not left waiting in
        // silence for a link that was never sent.
        if ($status === Password::RESET_THROTTLED) {
            throw ValidationException::withMessages([
                'email' => __('runtime.reset_throttled'),
            ]);
        }

        if (! in_array($status, [Password::RESET_LINK_SENT, Password::INVALID_USER], true)) {
            report(new \RuntimeException('Password reset link failed with status: '.$status));

            throw ValidationException::withMessages([
                'email' => __('runtime.reset_failed'),
            ]);
        }

        return back()->with('reset_link_sent', true);
    }

    /**
     * GET /reset-password/{token} — the link e-mailed to the customer.
     */
    public function resetForm(string $token)
    {
        return view('auth.passwords.reset', [
            'token' => $token,
            'email' => request()->query('email', ''),
        ]);
    }

    public function reset(Request $request)
    {
        $request->validate([
            'token' => ['required', 'string'],
            'email' => ['required', 'email'],
            'password' => ['required', 'string', 'confirmed', PasswordRule::min(8)],
        ], [
            'password.confirmed' => __('runtime.password_mismatch'),
            'password.min' => __('runtime.password_min'),
        ]);

        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) {
                $user->forceFill([
                    'password' => Hash::make($password),
                    'remember_token' => Str::random(60),
                ])->save();
            }
        );

        if ($status !== Password::PASSWORD_RESET) {
            throw ValidationException::withMessages([
                'email' => __($status),
            ]);
        }

        return redirect()->route('login')->with('password_reset', true);
    }
}
