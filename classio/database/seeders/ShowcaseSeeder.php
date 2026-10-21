<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
use App\Models\Subcategory;
use App\Models\Product;
use App\Models\ProductVariant;
use App\Models\ProductImage;
use App\Models\Banner;
use Illuminate\Support\Str;

class ShowcaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Categories
        $categoriesData = [
            ['name' => 'Ladies Collection', 'slug' => 'ladies-collection', 'image_path' => 'images/classio/cat_ladies.jpg', 'sort_order' => 1],
            ['name' => 'Gents Collection', 'slug' => 'gents-collection', 'image_path' => 'images/classio/cat_gents.jpg', 'sort_order' => 2],
            ['name' => 'Watches & Perfumes', 'slug' => 'watches-perfumes', 'image_path' => 'images/classio/cat_watches.jpg', 'sort_order' => 3],
            ['name' => 'Fashion Accessories', 'slug' => 'fashion-accessories', 'image_path' => 'images/classio/cat_accessories.jpg', 'sort_order' => 4],
            ['name' => 'Bags Collection', 'slug' => 'bags-collection', 'image_path' => 'images/classio/cat_bags.jpg', 'sort_order' => 5],
            ['name' => 'Footwear', 'slug' => 'footwear', 'image_path' => 'images/classio/cat_footwear.jpg', 'sort_order' => 6],
            ['name' => 'Gifts & Accessories', 'slug' => 'gifts-accessories', 'image_path' => 'images/classio/cat_gifts.jpg', 'sort_order' => 7],
            ['name' => 'Electronics & Audio', 'slug' => 'electronics-audio', 'image_path' => 'images/classio/cat_electronics.jpg', 'sort_order' => 8],
            ['name' => 'New Arrivals', 'slug' => 'new-arrivals', 'image_path' => 'images/classio/cat_new_arrivals.jpg', 'sort_order' => 9],
            ['name' => 'Offers & Deals', 'slug' => 'offers', 'image_path' => null, 'sort_order' => 10],
        ];

        $categories = [];
        foreach ($categoriesData as $c) {
            $cat = Category::updateOrCreate(
                ['slug' => $c['slug']],
                ['name' => $c['name'], 'image_path' => $c['image_path'], 'is_active' => true, 'sort_order' => $c['sort_order']]
            );
            $categories[$c['slug']] = $cat;
        }

        // Subcategories
        $subcategoriesData = [
            ['cat' => 'ladies-collection', 'name' => 'Women Ethnic Wear', 'slug' => 'women-ethnic-wear'],
            ['cat' => 'ladies-collection', 'name' => 'Women Western Wear', 'slug' => 'women-western-wear'],
            ['cat' => 'gents-collection', 'name' => 'Men Formal Wear', 'slug' => 'men-formal-wear'],
            ['cat' => 'gents-collection', 'name' => 'Men Casual Wear', 'slug' => 'men-casual-wear'],
            ['cat' => 'watches-perfumes', 'name' => 'Men Watches', 'slug' => 'men-watches'],
            ['cat' => 'watches-perfumes', 'name' => 'Women Watches', 'slug' => 'women-watches'],
            ['cat' => 'watches-perfumes', 'name' => 'Perfumes', 'slug' => 'perfumes'],
            ['cat' => 'bags-collection', 'name' => 'Women Bags', 'slug' => 'women-bags'],
            ['cat' => 'footwear', 'name' => 'Men Footwear', 'slug' => 'men-footwear'],
            ['cat' => 'fashion-accessories', 'name' => 'Accessories', 'slug' => 'accessories'],
        ];

        $subcategories = [];
        foreach ($subcategoriesData as $s) {
            $sub = Subcategory::updateOrCreate(
                ['slug' => $s['slug']],
                ['category_id' => $categories[$s['cat']]->id, 'name' => $s['name'], 'is_active' => true, 'sort_order' => 1]
            );
            $subcategories[$s['slug']] = $sub;
        }

        // 2. Banners
        Banner::truncate();
        Banner::create([
            'title' => "MODERN GENTLEMAN STYLE\nSUITS · BLAZERS · PREMIUM SHOES",
            'subtitle' => 'Exclusive Menswear',
            'image_path' => 'images/classio/hero_model.jpg',
            'link_url' => '/category/gents-collection',
            'placement_section' => 'hero_slider',
            'is_active' => true,
            'sort_order' => 1,
        ]);

        Banner::create([
            'title' => 'Ladies Collection',
            'subtitle' => 'Elegant styles for every occasion. From everyday essentials to statement pieces.',
            'image_path' => 'images/classio/ladies_banner.jpg',
            'link_url' => '/category/ladies-collection',
            'placement_section' => 'ladies_collection',
            'is_active' => true,
            'sort_order' => 1,
        ]);

        Banner::create([
            'title' => 'Gents Collection',
            'subtitle' => 'Style that defines you. Premium clothing for the modern gentleman.',
            'image_path' => 'images/classio/gents_banner.jpg',
            'link_url' => '/category/gents-collection',
            'placement_section' => 'gents_collection',
            'is_active' => true,
            'sort_order' => 1,
        ]);

        Banner::create([
            'title' => 'Watches & Perfumes',
            'subtitle' => 'Timeless watches and signature scents for a lasting impression.',
            'image_path' => 'images/classio/watches_banner.jpg',
            'link_url' => '/category/watches-perfumes',
            'placement_section' => 'watches_perfumes',
            'is_active' => true,
            'sort_order' => 1,
        ]);

        // Helper to create product with variant & image (under 1500 randomly)
        $pricesPool = [499, 599, 649, 699, 749, 799, 849, 899, 949, 999, 1099, 1149, 1199, 1249, 1299, 1349, 1399, 1449, 1499];
        $createProd = function($name, $slug, $catSlug, $subSlug, $price, $compareAt, $image, $subtitle = null, $rating = null, $reviewsCount = null, $isTrending = false, $isNew = false, $isFeatured = false) use ($categories, $subcategories, $pricesPool) {
            $randomPrice = $pricesPool[array_rand($pricesPool)];
            $randomCompareAt = (rand(1, 10) <= 7) ? ($randomPrice + rand(2, 6) * 100) : null;
            
            $prod = Product::updateOrCreate(
                ['slug' => $slug],
                [
                    'name' => $name,
                    'subtitle' => $subtitle,
                    'rating' => $rating,
                    'reviews_count' => $reviewsCount,
                    'category_id' => $categories[$catSlug]->id,
                    'subcategory_id' => $subSlug && isset($subcategories[$subSlug]) ? $subcategories[$subSlug]->id : null,
                    'description' => $name,
                    'is_featured' => $isFeatured,
                    'is_trending' => $isTrending,
                    'is_new' => $isNew,
                    'status' => 'active',
                ]
            );

            ProductVariant::where('product_id', $prod->id)->delete();
            ProductVariant::create([
                'product_id' => $prod->id,
                'sku' => strtoupper(Str::slug($slug)) . '-01',
                'price' => $randomPrice,
                'compare_at_price' => $randomCompareAt,
                'availability' => 'in_stock',
                'is_default' => true,
            ]);

            ProductImage::where('product_id', $prod->id)->delete();
            ProductImage::create([
                'product_id' => $prod->id,
                'image_path' => 'images/classio/product_coming_soon.jpg',
                'is_primary' => true,
                'sort_order' => 0,
            ]);

            return $prod;
        };

        // 3. Trending Now (6 products from the image)
        $createProd('Embroidered Anarkali Dress', 'embroidered-anarkali-dress', 'ladies-collection', 'women-ethnic-wear', 2799, 3499, 'images/classio/trending_anarkali.jpg', 'Women Ethnic Wear', 4.5, 128, true, false, false);
        $createProd('Classic Formal Blazer', 'classic-formal-blazer', 'gents-collection', 'men-formal-wear', 4999, null, 'images/classio/trending_blazer.jpg', 'Men Formal Wear', 4.7, 92, true, true, false);
        $createProd('Premium Chronograph Watch', 'premium-chronograph-watch', 'watches-perfumes', 'men-watches', 6499, 7999, 'images/classio/trending_watch.jpg', 'Men Watches', 4.6, 210, true, false, false);
        $createProd('Structured Handbag', 'structured-handbag', 'bags-collection', 'women-bags', 3299, null, 'images/classio/trending_handbag.jpg', 'Women Bags', 4.4, 76, true, false, false);
        $createProd('Luxury Eau De Parfum', 'luxury-eau-de-parfum', 'watches-perfumes', 'perfumes', 4499, 5999, 'images/classio/trending_perfume.jpg', 'Perfumes', 4.6, 180, true, false, false);
        $createProd('Casual Sneakers', 'casual-sneakers', 'footwear', 'men-footwear', 2199, null, 'images/classio/trending_sneakers.jpg', 'Men Footwear', 4.3, 95, true, false, false);

        // 4. Ladies Collection Showcase (4 products)
        $createProd('Designer Kurti', 'designer-kurti', 'ladies-collection', 'women-ethnic-wear', 1999, null, 'images/classio/ladies_kurti.jpg', 'Women Ethnic Wear', 4.5, 54, false, false, false);
        $createProd('Saree Collection', 'saree-collection', 'ladies-collection', 'women-ethnic-wear', 2499, null, 'images/classio/ladies_saree.jpg', 'Women Ethnic Wear', 4.8, 88, false, false, false);
        $createProd('Kurtis Set', 'kurtis-set', 'ladies-collection', 'women-ethnic-wear', 2299, null, 'images/classio/ladies_kurti_set.jpg', 'Women Ethnic Wear', 4.6, 42, false, false, false);
        $createProd('Western Dress', 'western-dress', 'ladies-collection', 'women-western-wear', 1799, null, 'images/classio/ladies_western.jpg', 'Women Western Wear', 4.4, 65, false, false, false);

        // 5. Gents Collection Showcase (4 products)
        $createProd('Formal Shirt', 'formal-shirt', 'gents-collection', 'men-formal-wear', 1499, null, 'images/classio/gents_shirt.jpg', 'Men Formal Wear', 4.5, 76, false, false, false);
        $createProd('Blazer', 'blazer', 'gents-collection', 'men-formal-wear', 4999, null, 'images/classio/gents_blazer.jpg', 'Men Formal Wear', 4.9, 112, false, false, false);
        $createProd('Chinos', 'chinos', 'gents-collection', 'men-casual-wear', 1899, null, 'images/classio/gents_chinos.jpg', 'Men Casual Wear', 4.6, 90, false, false, false);
        $createProd('Casual T-Shirt', 'casual-t-shirt', 'gents-collection', 'men-casual-wear', 999, null, 'images/classio/gents_tshirt.jpg', 'Men Casual Wear', 4.3, 58, false, false, false);

        // 6. Watches & Perfumes Showcase (4 products)
        $createProd("Men's Watch", 'mens-watch', 'watches-perfumes', 'men-watches', 5999, null, 'images/classio/watch_mens.jpg', 'Men Watches', 4.7, 85, false, false, false);
        $createProd("Women's Watch", 'womens-watch', 'watches-perfumes', 'women-watches', 4499, null, 'images/classio/watch_womens.jpg', 'Women Watches', 4.8, 94, false, false, false);
        $createProd('Luxury Perfume', 'luxury-perfume', 'watches-perfumes', 'perfumes', 3999, null, 'images/classio/perfume_luxury.jpg', 'Perfumes', 4.6, 62, false, false, false);
        $createProd('Deodorant Set', 'deodorant-set', 'watches-perfumes', 'perfumes', 1299, null, 'images/classio/perfume_deo.jpg', 'Perfumes', 4.5, 41, false, false, false);

        // 7. Featured Collections (6 products from the image)
        $createProd('Leather Handbag', 'leather-handbag', 'bags-collection', 'women-bags', 5499, null, 'images/classio/feat_handbag.jpg', 'Women Bags', 4.7, 48, false, true, true);
        $createProd('Classic Sunglasses', 'classic-sunglasses', 'fashion-accessories', 'accessories', 1499, null, 'images/classio/feat_sunglasses.jpg', 'Accessories', 4.4, 32, false, false, true);
        $createProd('Running Shoes', 'running-shoes', 'footwear', 'men-footwear', 2299, 3199, 'images/classio/feat_shoes.jpg', 'Men Footwear', 4.6, 120, false, false, true);
        $createProd('Analog Watch', 'analog-watch', 'watches-perfumes', 'men-watches', 5499, null, 'images/classio/feat_watch.jpg', 'Men Watches', 4.8, 77, false, true, true);
        $createProd('Leather Wallet', 'leather-wallet', 'fashion-accessories', 'accessories', 1299, null, 'images/classio/feat_wallet.jpg', 'Accessories', 4.5, 59, false, false, true);
        $createProd('Hoodie Jacket', 'hoodie-jacket', 'gents-collection', 'men-casual-wear', 1999, null, 'images/classio/feat_jacket.jpg', 'Men Casual Wear', 4.7, 83, false, true, true);
    }
}
