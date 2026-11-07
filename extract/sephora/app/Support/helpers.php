<?php

use App\Support\Media;

if (! function_exists('media_url')) {
    /**
     * Resolve a stored media path (local or absolute CDN URL) to a URL.
     */
    function media_url(?string $path, string $fallback = 'images/placeholder.webp'): string
    {
        return Media::url($path, $fallback);
    }
}
