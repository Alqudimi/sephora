<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Filament panel guard: every staff member must have confirmed two-factor
 * authentication before they can use the admin panel.
 *
 * Runs inside the panel's authMiddleware stack, so unauthenticated guests
 * have already been redirected to the panel login by Filament's
 * Authenticate middleware, and non-staff users have already been rejected
 * with 403 by User::canAccessPanel().
 */
class EnsureStaffTwoFactorConfirmed
{
    public function handle(Request $request, Closure $next): Response
    {
        $user = $request->user();

        if ($user !== null && $user->isStaff() && ! $user->hasTwoFactorEnabled()) {
            return redirect()
                ->route('account.security')
                ->with('two_factor_required', true);
        }

        return $next($request);
    }
}
