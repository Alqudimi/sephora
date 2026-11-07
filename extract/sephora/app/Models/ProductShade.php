<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductShade extends Model
{
    protected $fillable = ['product_id', 'name', 'hex_color', 'price', 'stock', 'sort_order'];

    protected $casts = ['price' => 'float'];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
