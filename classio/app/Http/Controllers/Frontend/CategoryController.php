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
                'id' => null,
                'name' => 'Offers & Deals',
                'slug' => 'offers',
                'image_path' => 'images/classio/cat_accessories.jpg',
                'image_url' => asset('images/classio/cat_accessories.jpg'),
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
                'id' => null,
                'name' => 'Trending Now',
                'slug' => 'trending',
                'image_path' => 'images/classio/hero_model.jpg',
                'image_url' => asset('images/classio/hero_model.jpg'),
                'subcategories' => collect(),
            ];
            $query = Product::where('status', 'active')
                ->where('is_trending', true)
                ->with(['images', 'variants', 'category']);
        } elseif ($slug === 'new-arrivals') {
            $category = (object)[
                'id' => null,
                'name' => 'New Arrivals',
                'slug' => 'new-arrivals',
                'image_path' => 'images/classio/cat_new_arrivals.jpg',
                'image_url' => asset('images/classio/cat_new_arrivals.jpg'),
                'subcategories' => collect(),
            ];
            $query = Product::where('status', 'active')
                ->where(function($q) {
                    $q->where('is_new', true)->orWhere('is_featured', true);
                })
                ->with(['images', 'variants', 'category']);
        } elseif ($slug === 'featured') {
            $category = (object)[
                'id' => null,
                'name' => 'Featured Collections',
                'slug' => 'featured',
                'image_path' => 'images/classio/brand_boutique.jpg',
                'image_url' => asset('images/classio/brand_boutique.jpg'),
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
            'id' => null,
            'name' => $q ? "Search: \"{$q}\"" : "All Products",
            'slug' => 'search',
            'image_path' => 'images/classio/hero_model.jpg',
            'image_url' => asset('images/classio/hero_model.jpg'),
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

    public function searchSuggest(Request $request)
    {
        $q = trim($request->get('q', ''));
        if (strlen($q) < 2) {
            return response()->json(['categories' => [], 'products' => [], 'total' => 0]);
        }

        // Matching categories
        $categories = Category::where('is_active', true)
            ->where('name', 'like', "%{$q}%")
            ->orderBy('sort_order')
            ->take(4)
            ->get(['id', 'name', 'slug', 'image_path'])
            ->map(function ($cat) {
                $imgPath = $cat->image_path ? (str_starts_with($cat->image_path, 'http') ? $cat->image_path : asset($cat->image_path)) : null;
                $productCount = Product::where('category_id', $cat->id)->where('status', 'active')->count();
                return [
                    'id' => $cat->id,
                    'name' => $cat->name,
                    'slug' => $cat->slug,
                    'url' => route('category.show', $cat->slug),
                    'image' => $imgPath,
                    'count' => $productCount,
                ];
            });

        // Matching products
        $products = Product::where('status', 'active')
            ->where(function ($builder) use ($q) {
                $builder->where('name', 'like', "%{$q}%")
                        ->orWhere('subtitle', 'like', "%{$q}%")
                        ->orWhere('description', 'like', "%{$q}%");
            })
            ->with(['images', 'variants', 'category'])
            ->take(6)
            ->get()
            ->map(function ($prod) {
                $image = $prod->images->where('is_primary', true)->first()->image_path 
                    ?? $prod->images->first()->image_path 
                    ?? 'images/classio/product_coming_soon.jpg';
                $imageUrl = str_starts_with($image, 'http') ? $image : asset($image);
                $variant = $prod->variants->where('is_default', true)->first() ?? $prod->variants->first();
                $price = $variant->price ?? 0;
                $compareAt = $variant->compare_at_price ?? null;
                $discount = ($compareAt && $compareAt > $price) ? round((($compareAt - $price) / $compareAt) * 100) : null;

                return [
                    'id' => $prod->id,
                    'name' => $prod->name,
                    'subtitle' => $prod->subtitle,
                    'category_name' => $prod->category->name ?? 'Classio',
                    'price' => number_format($price, 0),
                    'compare_at' => $compareAt ? number_format($compareAt, 0) : null,
                    'discount' => $discount,
                    'image' => $imageUrl,
                    'url' => route('product.show', $prod->slug),
                ];
            });

        return response()->json([
            'categories' => $categories,
            'products' => $products,
            'total' => $categories->count() + $products->count(),
        ]);
    }
}