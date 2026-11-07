<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    protected $fillable = [
        'name', 'slug', 'logo_path', 'description', 'is_featured',
        'is_sephora_collection', 'products_count', 'sort_order',
    ];

    protected $casts = [
        'is_featured' => 'boolean',
        'is_sephora_collection' => 'boolean',
    ];

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function offers()
    {
        return $this->hasMany(Offer::class);
    }

    public function getInitialAttribute(): string
    {
        return mb_substr($this->name, 0, 1);
    }
}
