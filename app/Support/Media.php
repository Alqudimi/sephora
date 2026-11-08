<?php

namespace App\Support;

class Media
{
    /**
     * Cache of scanned local filenames in public/images/products to avoid redundant filesystem calls.
     *
     * @var array<string, bool>|null
     */
    protected static ?array $localProductFiles = null;

    /**
     * Resolve a stored media path into a browser-ready URL.
     *
     * 1. If empty, falls back to placeholder.
     * 2. If data: or blob:, passes through unchanged.
     * 3. If a matching file exists locally in public/images/products/, serves the fast local asset.
     * 4. If remote URL without local copy, returns the remote URL.
     * 5. If local relative path doesn't exist on disk, falls back to $fallback.
     */
    public static function url(?string $path, string $fallback = 'images/placeholder.webp'): string
    {
        $path = trim((string) $path);

        if ($path === '') {
            return asset(ltrim($fallback, '/'));
        }

        if (str_starts_with($path, 'data:') || str_starts_with($path, 'blob:')) {
            return $path;
        }

        $isRemote = preg_match('#^(https?:)?//#i', $path) === 1;

        // Check if the filename matches an existing file in public/images/products/
        $urlPath = $isRemote ? (parse_url($path, PHP_URL_PATH) ?? '') : $path;
        $filename = basename($urlPath);

        if ($filename !== '' && $filename !== '/' && $filename !== '.') {
            if (self::$localProductFiles === null) {
                self::$localProductFiles = [];
                $dir = function_exists('public_path') ? public_path('images/products') : (__DIR__ . '/../../public/images/products');
                if (is_dir($dir)) {
                    $scanned = scandir($dir);
                    if ($scanned !== false) {
                        foreach ($scanned as $f) {
                            if ($f !== '.' && $f !== '..') {
                                self::$localProductFiles[$f] = true;
                            }
                        }
                    }
                }
            }

            $lf = strtolower($filename);
            $isGenericBanner = str_contains($lf, '1744x992')
                || str_contains($lf, 'brand_highlight')
                || str_contains($lf, 'brandhighlight')
                || str_contains($lf, 'bn_box')
                || str_contains($lf, 'fragthematic');

            if (! $isGenericBanner && isset(self::$localProductFiles[$filename])) {
                return asset('images/products/' . $filename);
            }
        }

        if ($isRemote) {
            return $path;
        }

        $cleanPath = ltrim($path, '/');
        $publicFile = function_exists('public_path') ? public_path($cleanPath) : (__DIR__ . '/../../public/' . $cleanPath);
        if (file_exists($publicFile)) {
            return asset($cleanPath);
        }

        return asset(ltrim($fallback, '/'));
    }

    /**
     * Clear cached local file index (useful for tests).
     */
    public static function flushCache(): void
    {
        self::$localProductFiles = null;
    }
}
