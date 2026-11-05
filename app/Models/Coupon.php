<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    protected $fillable = [
        'code', 'description', 'type', 'value', 'min_order', 'starts_at', 'expires_at',
        'usage_limit', 'per_user_limit', 'used_count', 'is_active',
    ];

    protected $casts = [
        'value' => 'float',
        'min_order' => 'float',
        'starts_at' => 'date',
        'expires_at' => 'date',
        'is_active' => 'boolean',
        'usage_limit' => 'integer',
        'per_user_limit' => 'integer',
        'used_count' => 'integer',
    ];

    public function redemptions()
    {
        return $this->hasMany(CouponRedemption::class);
    }

    public function isValid(float $orderValue, ?User $user = null, ?string $email = null): bool
    {
        if (! $this->is_active) {
            return false;
        }

        if ($this->starts_at && $this->starts_at->copy()->startOfDay()->isFuture()) {
            return false;
        }

        if ($this->expires_at && $this->expires_at->copy()->endOfDay()->isPast()) {
            return false;
        }

        if ($this->usage_limit !== null && $this->used_count >= $this->usage_limit) {
            return false;
        }

        if ($orderValue < $this->min_order) {
            return false;
        }

        if ($this->per_user_limit !== null && ($user || $email)) {
            $used = $this->redemptions()
                ->when($user, fn ($q) => $q->where('user_id', $user->id))
                ->when(! $user && $email, fn ($q) => $q->where('email', $email))
                ->count();

            if ($used >= $this->per_user_limit) {
                return false;
            }
        }

        return true;
    }

    public function discountFor(float $value): float
    {
        if (! in_array($this->type, ['percent', 'fixed'], true)) {
            return 0.0;
        }

        if ($this->type === 'percent') {
            $percent = min(100, max(0, $this->value));

            return round($value * ($percent / 100), 2);
        }

        return round(min(max(0, $this->value), $value), 2);
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }
}
