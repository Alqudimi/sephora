<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [
        'name', 'slug', 'parent_id', 'hero_title', 'hero_subtitle', 'hero_image',
        'description', 'is_active', 'show_in_nav', 'sort_order',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'show_in_nav' => 'boolean',
    ];

    public function parent()
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }

    public function children()
    {
        return $this->hasMany(Category::class, 'parent_id')->orderBy('sort_order');
    }

    public function products()
    {
        return $this->belongsToMany(Product::class)->withPivot('sort_order')->orderBy('category_product.sort_order');
    }

    public function scopeNav($query)
    {
        return $query->where('show_in_nav', true)->orderBy('sort_order');
    }
}
