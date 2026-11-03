<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    protected $fillable = [
        'code', 'type', 'value', 'min_order', 'starts_at', 'expires_at',
        'usage_limit', 'used_count', 'is_active',
    ];

    protected $casts = [
        'value' => 'float',
        'min_order' => 'float',
        'starts_at' => 'date',
        'expires_at' => 'date',
        'is_active' => 'boolean',
    ];

    public function isValid(float $orderValue): bool
    {
        if (!$this->is_active) return false;
        if ($this->starts_at && $this->starts_at->isFuture()) return false;
        if ($this->expires_at && $this->expires_at->isPast()) return false;
        if ($this->usage_limit && $this->used_count >= $this->usage_limit) return false;
        if ($orderValue < $this->min_order) return false;
        return true;
    }

    public function discountFor(float $value): float
    {
        return $this->type === 'percent'
            ? round($value * ($this->value / 100), 2)
            : min($this->value, $value);
    }
}
