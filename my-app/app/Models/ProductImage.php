<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductImage extends Model
{
    protected $fillable = ['product_id', 'image', 'sort_order'];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function toArray()
    {
        $array = parent::toArray();
        unset($array['image']);
        return $array;
    }

    public function getImageUrlAttribute(): string
    {
        return route('product.gallery.image', $this->id);
    }
}
