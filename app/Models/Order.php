<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'order_number', 'user_id', 'guest_email', 'status', 'payment_method',
        'payment_status', 'delivery_method', 'customer_name', 'customer_phone',
        'customer_email', 'emirate', 'area', 'shipping_address', 'delivery_instructions',
        'store_id', 'tracking_number', 'subtotal', 'subtotal_ex_tax', 'tax_rate',
        'tax_amount', 'discount', 'shipping_fee', 'coupon_code', 'total',
        'loyalty_points_earned', 'samples', 'gift_message', 'gift_box',
        'payment_gateway', 'payment_reference', 'payment_payload', 'idempotency_key',
        'placed_at', 'shipped_at', 'delivered_at', 'cancelled_at', 'refunded_at',
        'stock_restored_at', 'refund_amount', 'refund_reference', 'cancel_reason',
    ];

    protected $casts = [
        'subtotal' => 'float',
        'subtotal_ex_tax' => 'float',
        'tax_rate' => 'float',
        'tax_amount' => 'float',
        'discount' => 'float',
        'shipping_fee' => 'float',
        'total' => 'float',
        'refund_amount' => 'float',
        'samples' => 'array',
        'payment_payload' => 'array',
        'gift_box' => 'boolean',
        'placed_at' => 'datetime',
        'shipped_at' => 'datetime',
        'delivered_at' => 'datetime',
        'cancelled_at' => 'datetime',
        'refunded_at' => 'datetime',
        'stock_restored_at' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function couponRedemptions()
    {
        return $this->hasMany(CouponRedemption::class);
    }

    public function store()
    {
        return $this->belongsTo(Store::class, 'store_id');
    }

    public function auditLogs()
    {
        return $this->morphMany(AuditLog::class, 'auditable');
    }

    public function scopeForUser($query, $userId)
    {
        return $query->where('user_id', $userId);
    }

    public function getStatusLabelAttribute(): string
    {
        return match ($this->status) {
            'pending' => 'Pending',
            'processing' => 'Processing',
            'shipped' => 'Shipped',
            'out_for_delivery' => 'Out for Delivery',
            'delivered' => 'Delivered',
            'cancelled' => 'Cancelled',
            'refunded' => 'Refunded',
            default => ucfirst($this->status),
        };
    }

    public function getPaymentMethodLabelAttribute(): string
    {
        return match ($this->payment_method) {
            'cod' => 'Cash on Delivery',
            'apple_pay' => 'Apple Pay',
            'card' => 'Credit or Debit Card',
            'tabby' => 'Tabby',
            'tamara' => 'Tamara',
            'zaincash' => 'ZainCash (محفظة زين كاش)',
            default => ucfirst(str_replace('_', ' ', $this->payment_method)),
        };
    }

    public function isPaid(): bool
    {
        return $this->payment_status === 'paid';
    }

    public function canBeCancelled(): bool
    {
        return in_array($this->status, ['pending', 'processing', 'shipped'], true)
            && $this->payment_status !== 'refunded';
    }
}
