<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'brand_id', 'name', 'slug', 'description', 'meta_title', 'meta_description',
        'how_to_use', 'ingredients', 'price', 'compare_at_price', 'size', 'sku',
        'badge', 'type', 'rating', 'reviews_count', 'stock',
        'is_bestseller', 'is_new', 'is_clean', 'is_exclusive', 'is_active',
        'sort_order',
    ];

    protected $casts = [
        'price' => 'float',
        'compare_at_price' => 'float',
        'rating' => 'float',
        'reviews_count' => 'integer',
        'stock' => 'integer',
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

    public function allReviews()
    {
        return $this->hasMany(Review::class);
    }

    public function inWishlist(): bool
    {
        if (! auth()->check()) {
            return session()->get('wishlist', collect())->contains($this->id);
        }

        return WishlistItem::where('user_id', auth()->id())
            ->where('product_id', $this->id)
            ->exists();
    }

    public function getFirstImageAttribute(): string
    {
        $packshot = $this->images->first(function ($img) {
            $p = strtolower($img->path);
            return !str_contains($p, '1744x992')
                && !str_contains($p, 'brand_highlight')
                && !str_contains($p, 'brandhighlight')
                && !str_contains($p, 'bn_box')
                && !str_contains($p, 'fragthematic')
                && !str_contains($p, 'gift')
                && !str_contains($p, 'gwp')
                && !str_contains($p, 'reassurance')
                && !str_contains($p, 'authorized-retailer')
                && !str_contains($p, 'image.png')
                && !str_contains($p, '765003dandgbodycream296')
                && !str_contains($p, '733904lancomeset296')
                && !str_contains($p, 'noimagemedium');
        });

        return ($packshot ?? $this->images->first())?->path ?? 'images/placeholder.webp';
    }

    public function getStarsAttribute(): string
    {
        $full = (int) floor($this->rating);
        $half = ($this->rating - $full) >= 0.5;

        return str_repeat('★', $full).($half ? '☆' : '');
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
            default => $query->orderBy('sort_order')->orderBy('name'),
        };
    }

    public function scopeInStock(Builder $query): Builder
    {
        return $query->where('stock', '>', 0);
    }

    /**
     * Recalculate the denormalized `rating` and `reviews_count` columns
     * from approved reviews. Called after review moderation changes.
     */
    public function recalculateRating(): void
    {
        $aggregate = $this->allReviews()
            ->where('is_approved', true)
            ->selectRaw('COUNT(*) AS count, COALESCE(AVG(rating), 0) AS average')
            ->first();

        $this->forceFill([
            'reviews_count' => (int) ($aggregate->count ?? 0),
            'rating' => round((float) ($aggregate->average ?? 0), 2),
        ])->save();
    }
}
