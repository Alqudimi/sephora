<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Faq extends Model
{
    protected $fillable = ['category', 'question', 'answer', 'sort_order'];

    public function scopeCategory($query, string $category)
    {
        return $query->where('category', $category)->orderBy('sort_order');
    }
}
