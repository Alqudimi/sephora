<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    protected $fillable = [
        'product_id', 'user_id', 'author_name', 'rating', 'title', 'body',
        'is_approved', 'is_verified_purchase',
    ];

    protected $casts = [
        'is_approved' => 'boolean',
        'is_verified_purchase' => 'boolean',
        'rating' => 'integer',
    ];

    protected static function booted(): void
    {
        static::saved(function (Review $review) {
            $review->product?->recalculateRating();
        });

        static::deleted(function (Review $review) {
            $review->product?->recalculateRating();
        });
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
