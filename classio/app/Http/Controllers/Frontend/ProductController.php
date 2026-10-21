<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function show($slug)
    {
        $product = Product::where('slug', $slug)
            ->where('status', 'active')
            ->with([
                'images' => function($q) {
                    $q->orderBy('sort_order', 'asc')->orderBy('id', 'asc');
                },
                'variants' => function($q) {
                    $q->orderBy('is_default', 'desc')->orderBy('id', 'asc');
                },
                'category',
                'subcategory'
            ])
            ->firstOrFail();

        $relatedProducts = collect();
        if ($product->category_id) {
            $relatedQuery = Product::where('status', 'active')
                ->where('id', '!=', $product->id)
                ->where('category_id', $product->category_id)
                ->with(['images', 'variants', 'category']);
            
            // Prioritize same subcategory if exists
            if ($product->subcategory_id) {
                $relatedQuery->orderByRaw('subcategory_id = ? DESC', [$product->subcategory_id]);
            }
            
            $relatedProducts = $relatedQuery->take(4)->get();
        }

        $categories = Category::where('is_active', true)->orderBy('sort_order')->get();

        return view('frontend.product', compact('product', 'relatedProducts', 'categories'));
    }
}