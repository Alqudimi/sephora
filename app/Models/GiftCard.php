<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GiftCard extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'pin',
        'initial_balance',
        'balance',
        'currency',
        'is_active',
        'recipient_name',
        'recipient_email',
        'sender_name',
        'message',
        'expires_at',
        'last_used_at',
    ];

    protected $casts = [
        'initial_balance' => 'float',
        'balance' => 'float',
        'is_active' => 'boolean',
        'expires_at' => 'datetime',
        'last_used_at' => 'datetime',
    ];

    public function scopeActive(Builder $query): Builder
    {
        return $query->where('is_active', true)
            ->where(function (Builder $q) {
                $q->whereNull('expires_at')
                  ->orWhere('expires_at', '>', now());
            });
    }

    public function isValid(?string $pin = null): bool
    {
        if (! $this->is_active) {
            return false;
        }

        if ($this->expires_at !== null && $this->expires_at->isPast()) {
            return false;
        }

        if ($pin !== null && $this->pin !== null && $this->pin !== '') {
            if ($this->pin !== $pin) {
                return false;
            }
        }

        return true;
    }

    public function formattedCode(): string
    {
        $clean = preg_replace('/\s+/', '', $this->code);

        return implode(' ', str_split($clean, 4));
    }

    public static function generateCode(): string
    {
        do {
            // Sephora standard gift cards start with 6046 followed by 12 random digits
            $code = '6046'.str_pad((string) random_int(0, 999999999999), 12, '0', STR_PAD_LEFT);
        } while (static::where('code', $code)->exists());

        return $code;
    }

    public static function generatePin(): string
    {
        return str_pad((string) random_int(1000, 9999), 4, '0', STR_PAD_LEFT);
    }

    public function deduct(float $amount): bool
    {
        if ($amount <= 0 || $this->balance < $amount) {
            return false;
        }

        $this->balance -= $amount;
        $this->last_used_at = now();
        $this->save();

        return true;
    }
}

