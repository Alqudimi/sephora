<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\Verified;
use Illuminate\Http\Request;

class EmailVerificationController extends Controller
{
    /**
     * Show the verification notice, or move on when the address is already
     * verified.
     */
    public function notice(Request $request)
    {
        if ($request->user()->hasVerifiedEmail()) {
            return redirect()->route('account.dashboard');
        }

        return view('auth.verify-email');
    }

    /**
     * Handle the signed link from the verification email.
     */
    public function verify(Request $request, string $id, string $hash)
    {
        $user = $request->user();

        abort_unless((string) $user->getKey() === (string) $id, 403);
        abort_unless(hash_equals(sha1($user->getEmailForVerification()), $hash), 403);

        if (! $user->hasVerifiedEmail()) {
            $user->markEmailAsVerified();
            event(new Verified($user));
        }

        return redirect()->route('account.dashboard')->with('verified', true);
    }

    /**
     * Resend the verification email on request.
     */
    public function send(Request $request)
    {
        if ($request->user()->hasVerifiedEmail()) {
            return redirect()->route('account.dashboard');
        }

        $request->user()->sendEmailVerificationNotification();

        return back()->with('verification_sent', true);
    }
}
