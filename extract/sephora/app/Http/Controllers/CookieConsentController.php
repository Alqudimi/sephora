<?php

namespace App\Http\Controllers;

use App\Models\Consent;
use Illuminate\Http\Request;

class CookieConsentController extends Controller
{
    /**
     * Record the visitor's cookie choice and remember it for a year.
     *
     * The consent row is the audit trail; the cookie only controls whether
     * the banner is shown again.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'choice' => 'required|in:accepted,declined',
        ]);

        $user = $request->user();

        Consent::create([
            'user_id' => $user?->id,
            'email' => $user?->email,
            'type' => 'cookies',
            'version' => '1.0',
            'accepted' => $validated['choice'] === 'accepted',
            'ip_address' => $request->ip(),
            'accepted_at' => now(),
        ]);

        $request->session()->put('cookie_consent', $validated['choice']);

        return back()->withCookie(cookie(
            name: 'cookie_consent',
            value: $validated['choice'],
            minutes: 60 * 24 * 365,
            path: '/',
            secure: $request->isSecure(),
            httpOnly: true,
            sameSite: 'lax',
        ));
    }
}
