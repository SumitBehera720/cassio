<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\ProductImage;
use App\Models\Product;

$count = ProductImage::count();
ProductImage::query()->update(['image_path' => 'images/classio/product_coming_soon.jpg']);
echo "Updated {$count} product images in ProductImage table to images/classio/product_coming_soon.jpg" . PHP_EOL;

// Verify every product has at least one image
foreach (Product::all() as $prod) {
    if ($prod->images()->count() === 0) {
        ProductImage::create([
            'product_id' => $prod->id,
            'image_path' => 'images/classio/product_coming_soon.jpg',
            'is_primary' => true,
            'sort_order' => 0
        ]);
    }
}
echo "All products now have the Coming Soon image as their product photo." . PHP_EOL;
