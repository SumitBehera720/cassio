<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductVariant;
use Illuminate\Http\Request;

class AdminProductVariantController extends Controller
{
    public function store(Request $request, Product $product)
    {
        $request->validate([
            'sku' => 'required|string|max:255|unique:product_variants',
            'price' => 'required|numeric|min:0',
            'compare_at_price' => 'nullable|numeric|min:0',
            'size' => 'nullable|string|max:255',
            'color' => 'nullable|string|max:255',
            'availability' => 'required|in:in_stock,out_of_stock',
            'is_default' => 'boolean'
        ]);

        $data = $request->all();
        $data['product_id'] = $product->id;
        $data['is_default'] = $request->has('is_default');

        if ($data['is_default']) {
            // Remove default from other variants
            $product->variants()->update(['is_default' => false]);
        } else {
            // If this is the first variant, make it default automatically
            if ($product->variants()->count() === 0) {
                $data['is_default'] = true;
            }
        }

        ProductVariant::create($data);

        return back()->with('success', 'Variant added successfully.');
    }

    public function destroy(ProductVariant $variant)
    {
        $product = $variant->product;
        $variant->delete();

        // If we deleted the default variant, try to set another one as default
        if ($variant->is_default && $product->variants()->count() > 0) {
            $product->variants()->first()->update(['is_default' => true]);
        }

        return back()->with('success', 'Variant deleted successfully.');
    }
}