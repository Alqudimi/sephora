<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Application-level HTTPS enforcement (defence in depth).
 *
 * nginx already 301-redirects port 80 → 443; this middleware guarantees
 * no insecure request ever reaches the app even if the request arrives on
 * a non-standard path (misconfigured load balancer, direct PHP-FPM access,
 * staging bypass, ...). Enabled with APP_FORCE_HTTPS=true (production).
 *
 * Signed URLs, asset() and route() links are switched to https separately
 * via UrlGenerator::forceScheme in AppServiceProvider.
 */
class ForceHttps
{
    public function handle(Request $request, Closure $next): Response
    {
        if (! config('app.force_https') || $request->secure()) {
            return $next($request);
        }

        return redirect()->to(
            'https://'.$request->getHost().$request->getRequestUri(),
            301,
        );
    }
}
