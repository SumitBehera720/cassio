<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function show(Request $request, $slug)
    {
        // Handle virtual collection slugs gracefully
        if ($slug === 'offers') {
            $category = (object)[
                'name' => 'Offers & Deals',
                'slug' => 'offers',
                'image_path' => 'images/classio/banner_offers.jpg',
                'subcategories' => collect(),
            ];
            $query = Product::where('status', 'active')
                ->whereHas('variants', function ($q) {
                    $q->whereNotNull('compare_at_price')->whereColumn('compare_at_price', '>', 'price');
                })
                ->orWhere(function($q) {
                    $q->where('status', 'active')->where('is_trending', true);
                })
                ->with(['images', 'variants', 'category']);
        } elseif ($slug === 'trending') {
            $category = (object)[
                'name' => 'Trending Now',
                'slug' => 'trending',
                'image_path' => 'images/classio/hero_model.jpg',
                'subcategories' => collect(),
            ];
            $query = Product::where('status', 'active')
                ->where('is_trending', true)
                ->with(['images', 'variants', 'category']);
        } elseif ($slug === 'new-arrivals') {
            $category = (object)[
                'name' => 'New Arrivals',
                'slug' => 'new-arrivals',
                'image_path' => 'images/classio/banner_new_arrivals.jpg',
                'subcategories' => collect(),
            ];
            $query = Product::where('status', 'active')
                ->where(function($q) {
                    $q->where('is_new', true)->orWhere('is_featured', true);
                })
                ->with(['images', 'variants', 'category']);
        } elseif ($slug === 'featured') {
            $category = (object)[
                'name' => 'Featured Collections',
                'slug' => 'featured',
                'image_path' => 'images/classio/brand_boutique.jpg',
                'subcategories' => collect(),
            ];
            $query = Product::where('status', 'active')
                ->where('is_featured', true)
                ->with(['images', 'variants', 'category']);
        } else {
            // 1. Resolve active category by slug
            $category = Category::where('slug', $slug)
                ->where('is_active', true)
                ->with(['subcategories' => function($q) {
                    $q->where('is_active', true)->orderBy('sort_order', 'asc');
                }])
                ->firstOrFail();

            // 2. Base Query: Load active products belonging to category
            $query = Product::where('category_id', $category->id)
                ->where('status', 'active')
                ->with(['images', 'variants', 'category']);

            // Subcategory Filter
            if ($request->filled('subcategory')) {
                $query->whereHas('subcategory', function ($q) use ($request) {
                    $q->where('slug', $request->subcategory)->where('is_active', true);
                });
            }
        }

        // 3. Search Filter
        if ($request->filled('search')) {
            $query->where(function($q) use ($request) {
                $q->where('name', 'like', '%' . $request->search . '%')
                  ->orWhere('subtitle', 'like', '%' . $request->search . '%');
            });
        }

        // 4. Effective Price Subquery (for sorting by default variant price)
        $query->select('products.*')
              ->selectSub(function ($q) {
                  $q->select('price')
                    ->from('product_variants')
                    ->whereColumn('product_id', 'products.id')
                    ->orderBy('is_default', 'desc')
                    ->orderBy('id', 'asc')
                    ->limit(1);
              }, 'effective_price');

        // 5. Sorting logic
        $sort = $request->get('sort', 'featured');
        switch ($sort) {
            case 'price_asc':
                $query->orderBy('effective_price', 'asc');
                break;
            case 'price_desc':
                $query->orderBy('effective_price', 'desc');
                break;
            case 'newest':
                $query->orderBy('created_at', 'desc');
                break;
            case 'featured':
            default:
                $query->orderBy('is_featured', 'desc')->orderBy('created_at', 'desc');
                break;
        }

        // 6. Pagination (12 items per page)
        $products = $query->paginate(12)->withQueryString();

        // 7. Navigation Categories
        $categories = Category::where('is_active', true)->orderBy('sort_order')->get();

        return view('frontend.category', compact('category', 'products', 'categories'));
    }

    public function search(Request $request)
    {
        $q = trim($request->get('q', ''));
        $category = (object)[
            'name' => $q ? "Search: \"{$q}\"" : "All Products",
            'slug' => 'search',
            'image_path' => 'images/classio/hero_model.jpg',
            'subcategories' => collect(),
        ];

        $query = Product::where('status', 'active')->with(['images', 'variants', 'category']);

        if (!empty($q)) {
            $query->where(function($builder) use ($q) {
                $builder->where('name', 'like', "%{$q}%")
                        ->orWhere('subtitle', 'like', "%{$q}%")
                        ->orWhere('description', 'like', "%{$q}%");
            });
        }

        // Sort
        $sort = $request->get('sort', 'featured');
        if ($sort === 'price_asc') {
            $query->orderBy('id', 'asc');
        } elseif ($sort === 'price_desc') {
            $query->orderBy('id', 'desc');
        } else {
            $query->orderBy('is_featured', 'desc')->orderBy('id', 'asc');
        }

        $products = $query->paginate(16)->withQueryString();
        $categories = Category::where('is_active', true)->orderBy('sort_order')->get();

        return view('frontend.category', compact('category', 'products', 'categories'));
    }
}