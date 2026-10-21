<?php
namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use App\Models\Category;
use App\Models\Product;

class HomeController extends Controller
{
    public function index()
    {
        $heroBanners = Banner::where('placement_section', 'hero_slider')
                             ->where('is_active', 1)
                             ->orderBy('sort_order')
                             ->get();
                             
        $navCategories = Category::where('is_active', 1)
                                 ->orderBy('sort_order')
                                 ->get();

        $quickNavCategories = Category::where('is_active', 1)
                                      ->orderBy('sort_order')
                                      ->get();

        $trendingProducts = Product::where('is_trending', true)
                                   ->where('status', 'active')
                                   ->with(['images', 'variants', 'category', 'subcategory'])
                                   ->orderBy('id', 'asc')
                                   ->take(6)
                                   ->get();

        $ladiesCategory = Category::where('slug', 'ladies-collection')->first();
        $ladiesProducts = $ladiesCategory ? Product::where('category_id', $ladiesCategory->id)
                                                   ->where('is_trending', false)
                                                   ->where('is_featured', false)
                                                   ->where('status', 'active')
                                                   ->with(['images', 'variants', 'category', 'subcategory'])
                                                   ->orderBy('id', 'asc')
                                                   ->take(4)->get() : collect();
        $ladiesBanner = Banner::where('placement_section', 'ladies_collection')->where('is_active', 1)->first();

        $gentsCategory = Category::where('slug', 'gents-collection')->first();
        $gentsProducts = $gentsCategory ? Product::where('category_id', $gentsCategory->id)
                                                 ->where('is_trending', false)
                                                 ->where('is_featured', false)
                                                 ->where('status', 'active')
                                                 ->with(['images', 'variants', 'category', 'subcategory'])
                                                 ->orderBy('id', 'asc')
                                                 ->take(4)->get() : collect();
        $gentsBanner = Banner::where('placement_section', 'gents_collection')->where('is_active', 1)->first();

        $watchesCategory = Category::where('slug', 'watches-perfumes')->first();
        $watchesProducts = $watchesCategory ? Product::where('category_id', $watchesCategory->id)
                                                     ->where('status', 'active')
                                                     ->with(['images', 'variants', 'category', 'subcategory'])
                                                     ->orderBy('id', 'asc')
                                                     ->take(4)->get() : collect();
        $watchesBanner = Banner::where('placement_section', 'watches_perfumes')->where('is_active', 1)->first();

        $accessoriesCategory = Category::where('slug', 'fashion-accessories')->first();
        $bagsCategory = Category::where('slug', 'bags-collection')->first();
        $footwearCategory = Category::where('slug', 'footwear')->first();
        $giftsCategory = Category::where('slug', 'gifts-accessories')->first();
        $electronicsCategory = Category::where('slug', 'electronics-audio')->first();

        // Featured products (6 items from the image)
        $allFeaturedProducts = Product::where('is_featured', 1)
                                      ->where('status', 'active')
                                      ->with(['images', 'variants', 'category', 'subcategory'])
                                      ->orderBy('id', 'asc')
                                      ->take(6)
                                      ->get();

        return view('frontend.home', compact(
            'heroBanners', 
            'navCategories', 
            'quickNavCategories', 
            'trendingProducts',
            'ladiesCategory',
            'ladiesProducts',
            'ladiesBanner',
            'gentsCategory',
            'gentsProducts',
            'gentsBanner',
            'watchesCategory',
            'watchesProducts',
            'watchesBanner',
            'accessoriesCategory',
            'bagsCategory',
            'footwearCategory',
            'giftsCategory',
            'electronicsCategory',
            'allFeaturedProducts'
        ));
    }
}