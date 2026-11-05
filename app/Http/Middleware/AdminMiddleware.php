<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        if (! $request->user() || ! $request->user()->isStaff()) {
            abort(403, 'Unauthorized. Staff access only.');
        }

        if (! $request->user()->hasTwoFactorEnabled()) {
            return redirect()->route('account.security')
                ->with('two_factor_required', true);
        }

        return $next($request);
    }
}
