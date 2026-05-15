<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'seller_id',
        'title',
        'brand',
        'category',
        'subcategory',
        'sizes',
        'description',
        'price',
        'stock',
        'image',
        'rating',
    ];

    protected $casts = [
        'sizes' => 'array',
        'price' => 'decimal:2',
    ];

    public function seller()
    {
        return $this->belongsTo(User::class, 'seller_id');
    }

    public function images()
    {
        return $this->hasMany(ProductImage::class)->orderBy('sort_order');
    }

    public function reviews()
    {
        return $this->hasMany(ProductReview::class)->latest();
    }

    public function averageRating(): float
    {
        $avg = $this->reviews()->avg('rating');
        return $avg ? round((float) $avg, 1) : (float) ($this->rating ?? 0);
    }

    public function toArray()
    {
        $array = parent::toArray();
        unset($array['image']);
        return $array;
    }

    public function getImageUrlAttribute(): ?string
    {
        if (!$this->image) {
            return null;
        }
        return route('product.image', $this->id);
    }
}
