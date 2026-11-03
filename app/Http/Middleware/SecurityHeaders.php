<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Baseline security headers for every response.
 *
 * CSP allows: self + Google Fonts (the design's typefaces) + inline styles
 * (Tailwind utility classes render background-image styles inline) + inline
 * scripts (small page-level JS blocks from the design markup).
 */
class SecurityHeaders
{
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);

        $response->headers->set('X-Content-Type-Options', 'nosniff');
        $response->headers->set('X-Frame-Options', 'SAMEORIGIN');
        $response->headers->set('Referrer-Policy', 'strict-origin-when-cross-origin');
        $response->headers->set('Permissions-Policy', 'camera=(), microphone=(), geolocation=(self)');
        $response->headers->set('Content-Security-Policy',
            "default-src 'self'; ".
            "script-src 'self' 'unsafe-inline'; ".
            "style-src 'self' 'unsafe-inline' https://fonts.googleapis.com; ".
            "font-src 'self' https://fonts.gstatic.com data:; ".
            "img-src 'self' data:; ".
            "connect-src 'self'; ".
            "frame-ancestors 'self'; ".
            "base-uri 'self'; ".
            "form-action 'self'"
        );

        return $response;
    }
}
