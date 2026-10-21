<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\ProductVariant;

$prices = [499, 599, 649, 699, 749, 799, 849, 899, 949, 999, 1099, 1149, 1199, 1249, 1299, 1349, 1399, 1449, 1499];

$variants = ProductVariant::all();
echo "Total variants to update: " . $variants->count() . PHP_EOL;

foreach ($variants as $v) {
    $price = $prices[array_rand($prices)];
    $hasDiscount = (rand(1, 10) <= 7);
    $compareAt = $hasDiscount ? ($price + rand(2, 6) * 100) : null;
    $v->update([
        'price' => $price,
        'compare_at_price' => $compareAt,
    ]);
    echo "Product #{$v->product_id} [{$v->sku}] -> Price: Rs.{$price} (Compare: " . ($compareAt ?? 'none') . ")" . PHP_EOL;
}

echo "All product prices successfully randomized strictly under 1500!" . PHP_EOL;
