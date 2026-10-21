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