<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'order_number', 'user_id', 'guest_email', 'status', 'payment_method',
        'payment_status', 'delivery_method', 'customer_name', 'customer_phone',
        'customer_email', 'emirate', 'area', 'shipping_address', 'delivery_instructions',
        'store_id', 'tracking_number', 'courier', 'subtotal', 'subtotal_ex_tax', 'tax_rate',
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
        $key = 'shop.order_statuses.'.$this->status;
        $translated = __($key);

        return $translated !== $key ? $translated : ucfirst((string) $this->status);
    }

    public function getPaymentMethodLabelAttribute(): string
    {
        $key = 'shop.payment_methods.'.$this->payment_method;
        $translated = __($key);

        return $translated !== $key ? $translated : ucfirst(str_replace('_', ' ', (string) $this->payment_method));
    }

    public function getCourierLabelAttribute(): ?string
    {
        $courier = strtolower((string) $this->courier);
        if ($courier === '') {
            return null;
        }

        $key = 'shop.couriers.'.$courier;
        $translated = __($key);

        return $translated !== $key ? $translated : ucfirst((string) $this->courier);
    }

    public function getTrackingUrlAttribute(): ?string
    {
        $tracking = trim((string) $this->tracking_number);

        if ($tracking === '') {
            return null;
        }

        $courier = strtolower((string) $this->courier);

        return match ($courier) {
            'aramex' => "https://www.aramex.com/track/results?shipmentNumber={$tracking}",
            'dhl' => "https://www.dhl.com/ae-en/home/tracking/tracking-express.html?submit=1&tracking-id={$tracking}",
            'fedex' => "https://www.fedex.com/fedextrack/?trknbr={$tracking}",
            'smsa' => "https://www.smsaexpress.com/track?track={$tracking}",
            'emirates_post' => "https://emiratespost.ae/portal/track?tracknum={$tracking}",
            'fetchr' => "https://track.fetchr.us/?tracking_number={$tracking}",
            default => null,
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
