<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;

class Setting extends Model
{
    protected $fillable = ['key', 'value'];

    public const CACHE_KEY = 'settings.all';

    /**
     * Cached settings lookup (one query per cache lifetime, not per call).
     */
    public static function get(string $key, $default = null)
    {
        return static::cached()->get($key, $default);
    }

    public static function set(string $key, $value): void
    {
        static::updateOrCreate(['key' => $key], ['value' => $value]);
        Cache::forget(static::CACHE_KEY);
    }

    /**
     * @return Collection<string, string|null>
     */
    public static function cached(): Collection
    {
        // Cache a plain array: serializes safely on every cache driver.
        return collect(Cache::rememberForever(static::CACHE_KEY, function () {
            return static::query()->pluck('value', 'key')->all();
        }));
    }

    protected static function booted(): void
    {
        // Keep the cache coherent when settings change through Eloquent.
        static::saved(fn () => Cache::forget(static::CACHE_KEY));
        static::deleted(fn () => Cache::forget(static::CACHE_KEY));
    }
}
