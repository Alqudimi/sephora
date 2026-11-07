<?php

namespace App\Support;

/**
 * Minimal, dependency-free .env rewriter used by app:go-production.
 *
 * Handles the three states a key can be in inside a shipped .env:
 * present (KEY=...), commented (# KEY=...), or missing entirely (append).
 */
class EnvFile
{
    public function __construct(private readonly string $path) {}

    public function exists(): bool
    {
        return is_file($this->path);
    }

    public function read(): string
    {
        $content = @file_get_contents($this->path);

        if ($content === false) {
            throw new \RuntimeException("Unable to read [{$this->path}].");
        }

        return $content;
    }

    public function get(string $key, ?string $default = null): ?string
    {
        if (! preg_match('/^'.preg_quote($key, '/').'=(.*)$/m', $this->read(), $m)) {
            return $default;
        }

        $value = trim($m[1]);

        if ($value !== '' && str_starts_with($value, '"') && str_ends_with($value, '"')) {
            $value = substr($value, 1, -1);
        }

        return $value;
    }

    /**
     * @param  array<string, string>  $values
     */
    public function setMany(array $values): void
    {
        foreach ($values as $key => $value) {
            $this->set($key, (string) $value);
        }
    }

    public function set(string $key, string $value): void
    {
        $content = $this->read();
        $line = static::render($key, $value);

        // Replace an existing (possibly commented) assignment with the live one.
        $pattern = '/^(?:#\s*)?'.preg_quote($key, '/').'=.*/m';

        if (preg_match($pattern, $content)) {
            $content = preg_replace($pattern, $line, $content, 1);
        } else {
            $content = rtrim($content).\PHP_EOL.$line.\PHP_EOL;
        }

        if (@file_put_contents($this->path, $content) === false) {
            throw new \RuntimeException("Unable to write [{$this->path}].");
        }
    }

    /** Render a KEY=value line, quoting values that contain shell-style metacharacters. */
    public static function render(string $key, string $value): string
    {
        if (preg_match('/^[\w.:@\/+=,\-]*$/', $value) && $value !== '') {
            return $key.'='.$value;
        }

        return $key.'="'.str_replace(['\\', '"'], ['\\\\', '\\"'], $value).'"';
    }
}
