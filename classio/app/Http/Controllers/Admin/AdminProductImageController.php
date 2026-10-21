<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Http\Request;
use App\Services\CloudinaryService;
use Illuminate\Support\Facades\Storage;

class AdminProductImageController extends Controller
{
    public function store(Request $request, Product $product, CloudinaryService $cloudinary)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,webp|max:2048',
            'is_primary' => 'boolean'
        ]);

        $result = $cloudinary->upload($request->file('image'), 'products/' . $product->slug);
        $path = $result['secure_url'];
        
        $is_primary = $request->has('is_primary');

        if ($is_primary) {
            $product->images()->update(['is_primary' => false]);
        } else {
            if ($product->images()->count() === 0) {
                $is_primary = true;
            }
        }

        ProductImage::create([
            'product_id' => $product->id,
            'image_path' => $path,
            'is_primary' => $is_primary
        ]);

        return back()->with('success', 'Image added successfully.');
    }

    public function destroy(ProductImage $image, CloudinaryService $cloudinary)
    {
        $product = $image->product;
        
        if ($image->image_path) {
            if (strpos($image->image_path, 'res.cloudinary.com') !== false) {
                try {
                    $cloudinary->delete($image->image_path);
                } catch (\Exception $e) {
                    // Log or handle foreign asset error
                }
            } elseif (Storage::disk('public')->exists($image->image_path)) {
                Storage::disk('public')->delete($image->image_path);
            }
        }
        
        $image->delete();

        // If default image was deleted, try to set another one as primary
        if ($image->is_primary && $product->images()->count() > 0) {
            $product->images()->first()->update(['is_primary' => true]);
        }

        return back()->with('success', 'Image deleted successfully.');
    }
}