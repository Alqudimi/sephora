<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'brand_id', 'name', 'slug', 'description', 'how_to_use', 'ingredients',
        'price', 'compare_at_price', 'size', 'sku', 'badge', 'type',
        'rating', 'reviews_count', 'stock',
        'is_bestseller', 'is_new', 'is_clean', 'is_exclusive', 'is_active',
        'sort_order',
    ];

    protected $casts = [
        'price' => 'float',
        'compare_at_price' => 'float',
        'rating' => 'float',
        'is_bestseller' => 'boolean',
        'is_new' => 'boolean',
        'is_clean' => 'boolean',
        'is_exclusive' => 'boolean',
        'is_active' => 'boolean',
    ];

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    public function images()
    {
        return $this->hasMany(ProductImage::class)->orderBy('sort_order');
    }

    public function shades()
    {
        return $this->hasMany(ProductShade::class)->orderBy('sort_order');
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class)->where('is_approved', true);
    }

    public function inWishlist(): bool
    {
        if (!auth()->check()) {
            return session()->get('wishlist', collect())->contains($this->id);
        }

        return WishlistItem::where('user_id', auth()->id())
            ->where('product_id', $this->id)
            ->exists();
    }

    public function getFirstImageAttribute(): string
    {
        return $this->images->first()?->path ?? 'images/placeholder.webp';
    }

    public function getStarsAttribute(): string
    {
        $full = (int) floor($this->rating);
        $half = ($this->rating - $full) >= 0.5;
        return str_repeat('★', $full) . ($half ? '☆' : '');
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeSorted($query, string $sort)
    {
        return match ($sort) {
            'price_asc' => $query->orderBy('price'),
            'price_desc' => $query->orderByDesc('price'),
            'rating' => $query->orderByDesc('rating'),
            'newest' => $query->orderByDesc('created_at'),
            default => $query->orderBy('sort_order'),
        };
    }
}
