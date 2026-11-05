<?php

namespace App\Support;

class Media
{
    /**
     * Resolve a stored media path into a browser-ready URL.
     *
     * The production catalogue stores absolute CDN URLs while the bundled
     * demo assets use paths relative to public/. Absolute URLs must pass
     * through unchanged, because asset() would prepend APP_URL to them.
     */
    public static function url(?string $path, string $fallback = 'images/placeholder.webp'): string
    {
        $path = trim((string) $path);

        if ($path === '') {
            $path = $fallback;
        }

        if (preg_match('#^(https?:)?//#i', $path) === 1 || str_starts_with($path, 'data:')) {
            return $path;
        }

        return asset(ltrim($path, '/'));
    }
}
