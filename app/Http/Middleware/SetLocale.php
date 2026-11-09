<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\Response;

class SetLocale
{
    /** Supported locales. */
    public const SUPPORTED = ['en', 'ar'];

    /** Default locale. */
    public const DEFAULT = 'en';

    /**
     * Determine the locale from the request and store it in the session.
     *
     * Priority:
     *  1. ?lang= query parameter (explicit user choice, persisted in session)
     *  2. Session 'locale' value
     *  3. 'locale' cookie
     *  4. Default ('en')
     */
    public function handle(Request $request, Closure $next): Response
    {
        $locale = $this->resolveLocale($request);

        if (! in_array($locale, self::SUPPORTED, true)) {
            $locale = self::DEFAULT;
        }

        App::setLocale($locale);
        Session::put('locale', $locale);

        $response = $next($request);

        if ($request->has('lang')) {
            $response->headers->setCookie(cookie('locale', $locale, 60 * 24 * 365, '/', null, $request->isSecure(), false, false, 'lax'));

            if ($request->user() && $request->user()->preferred_language !== $locale) {
                $request->user()->update(['preferred_language' => $locale]);
            }
        }

        return $response;
    }

    /**
     * Resolve the locale to use for the current request.
     */
    protected function resolveLocale(Request $request): string
    {
        // 1. Explicit query parameter: ?lang=ar or ?lang=en
        if ($request->has('lang') && in_array($request->query('lang'), self::SUPPORTED, true)) {
            return $request->query('lang');
        }

        // 2. Session value
        $session = Session::get('locale');
        if ($session && in_array($session, self::SUPPORTED, true)) {
            return $session;
        }

        // 3. User saved preference
        $userLang = $request->user()?->preferred_language;
        if ($userLang && in_array($userLang, self::SUPPORTED, true)) {
            return $userLang;
        }

        // 4. Cookie value
        $cookie = $request->cookie('locale');
        if ($cookie && in_array($cookie, self::SUPPORTED, true)) {
            return $cookie;
        }

        // 5. Default
        return self::DEFAULT;
    }
}
