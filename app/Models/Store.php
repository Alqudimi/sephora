<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Store extends Model
{
    protected $fillable = [
        'name', 'city', 'emirate', 'address', 'phone', 'opening_hours',
        'latitude', 'longitude', 'services', 'has_brow_bar', 'has_beauty_bar', 'sort_order',
    ];

    protected $casts = [
        'opening_hours' => 'array',
        'services' => 'array',
        'has_brow_bar' => 'boolean',
        'has_beauty_bar' => 'boolean',
    ];
}
