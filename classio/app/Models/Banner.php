<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Banner extends Model
{
    protected $guarded = [];

    /**
     * Get the resolved, accessible URL for the banner image.
     */
    public function getImageUrlAttribute(): string
    {
        if (!$this->image_path) {
            return asset('images/classio/hero_model.jpg');
        }

        if (str_starts_with($this->image_path, 'http://') || str_starts_with($this->image_path, 'https://')) {
            return $this->image_path;
        }

        if (file_exists(public_path($this->image_path))) {
            return asset($this->image_path);
        }

        if (file_exists(public_path('storage/' . $this->image_path))) {
            return asset('storage/' . $this->image_path);
        }

        return asset($this->image_path);
    }

    /**
     * Human-friendly label for the banner placement section.
     */
    public function getPlacementNameAttribute(): string
    {
        $map = [
            'hero_slider' => 'Homepage Hero Slider',
            'ladies_collection' => 'Ladies Collection Showcase',
            'gents_collection' => 'Gents Collection Showcase',
            'watches_perfumes' => 'Watches & Perfumes Showcase',
            'category_banner' => 'Category Header Banner',
            'editorial' => 'Editorial / Value Prop',
            'offers' => 'Special Offers & Deals',
        ];

        return $map[$this->placement_section] ?? ucwords(str_replace('_', ' ', (string) $this->placement_section));
    }
}