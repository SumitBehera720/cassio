<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $guarded = [];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function subcategory()
    {
        return $this->belongsTo(Subcategory::class);
    }

    public function variants()
    {
        return $this->hasMany(ProductVariant::class);
    }

    public function images()
    {
        return $this->hasMany(ProductImage::class);
    }

    /**
     * Get the default or first variant.
     */
    public function getDefaultVariantAttribute()
    {
        return $this->variants->where('is_default', true)->first() ?? $this->variants->first();
    }

    /**
     * Get primary image URL safely.
     */
    public function getPrimaryImageUrlAttribute(): string
    {
        $primary = $this->images->where('is_primary', true)->first() ?? $this->images->first();
        if ($primary) {
            return $primary->image_url;
        }
        return asset('images/classio/product_coming_soon.jpg');
    }

    /**
     * Get price from default variant.
     */
    public function getPriceAttribute()
    {
        return $this->default_variant ? $this->default_variant->price : 0;
    }

    /**
     * Get compare at price from default variant.
     */
    public function getCompareAtPriceAttribute()
    {
        return $this->default_variant ? $this->default_variant->compare_at_price : null;
    }

    /**
     * Check if product has any in-stock variant.
     */
    public function getIsInStockAttribute(): bool
    {
        if ($this->variants->isEmpty()) {
            return true;
        }
        return $this->variants->contains(function ($variant) {
            return $variant->availability === 'in_stock';
        });
    }

    public function getRatingAttribute($value)
    {
        if ($value !== null) {
            return (float) $value;
        }
        $ratings = [
            'embroidered-anarkali-dress' => 4.5,
            'classic-formal-blazer' => 4.7,
            'premium-chronograph-watch' => 4.6,
            'structured-handbag' => 4.4,
            'luxury-eau-de-parfum' => 4.6,
            'casual-sneakers' => 4.3,
        ];
        return $ratings[$this->slug] ?? null;
    }

    public function getReviewsCountAttribute($value)
    {
        if ($value !== null) {
            return (int) $value;
        }
        $counts = [
            'embroidered-anarkali-dress' => 128,
            'classic-formal-blazer' => 92,
            'premium-chronograph-watch' => 210,
            'structured-handbag' => 76,
            'luxury-eau-de-parfum' => 180,
            'casual-sneakers' => 95,
        ];
        return $counts[$this->slug] ?? null;
    }

    public function getSubtitleAttribute($value)
    {
        if (!empty($value)) {
            return $value;
        }
        if ($this->subcategory) {
            return $this->subcategory->name;
        }
        return $this->category ? $this->category->name : '';
    }
}