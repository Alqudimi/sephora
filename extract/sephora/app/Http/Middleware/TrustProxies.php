<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Trust the reverse proxy (nginx / load balancer) that terminates TLS.
 *
 * Without this, Laravel sees 127.0.0.1 as the client for every request,
 * X-Forwarded-Proto is ignored (so HTTPS is never detected), and rate
 * limiters bucket every visitor into a single bucket.
 *
 * Configured via TRUSTED_PROXIES (config/app.php):
 *   - "127.0.0.1,::1"  for a local nginx
 *   - "10.0.0.0/8"     for an internal load balancer
 *   - "*"              trust any hop (only when the proxy chain is trusted)
 *
 * Implementation is runtime-config-driven (not bootstrap-time env()) so it
 * keeps working under `php artisan config:cache`.
 */
class TrustProxies
{
    public function handle(Request $request, Closure $next): Response
    {
        $value = config('app.trusted_proxies');

        if (is_string($value) && $value !== '') {
            $proxies = $value === '*' ? '*' : array_map('trim', explode(',', $value));

            $request->setTrustedProxies(
                $proxies,
                Request::HEADER_X_FORWARDED_FOR
                    | Request::HEADER_X_FORWARDED_HOST
                    | Request::HEADER_X_FORWARDED_PORT
                    | Request::HEADER_X_FORWARDED_PROTO
                    | Request::HEADER_X_FORWARDED_AWS_ELB,
            );
        }

        return $next($request);
    }
}
