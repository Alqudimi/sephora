<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'order_number', 'user_id', 'guest_email', 'status', 'payment_method',
        'payment_status', 'delivery_method', 'customer_name', 'customer_phone',
        'customer_email', 'emirate', 'area', 'shipping_address', 'delivery_instructions',
        'store_id', 'subtotal', 'discount', 'shipping_fee', 'coupon_code', 'total',
        'loyalty_points_earned', 'samples', 'gift_message', 'gift_box', 'placed_at',
    ];

    protected $casts = [
        'subtotal' => 'float',
        'discount' => 'float',
        'shipping_fee' => 'float',
        'total' => 'float',
        'samples' => 'array',
        'gift_box' => 'boolean',
        'placed_at' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function items()
    {
        return $this->hasMany(OrderItem::class);
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
            default => ucfirst($this->status),
        };
    }
}
