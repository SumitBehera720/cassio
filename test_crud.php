<?php
require __DIR__.'/classio/vendor/autoload.php';
$app = require_once __DIR__.'/classio/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\Category;
use App\Models\Subcategory;
use App\Models\Product;
use App\Models\ProductVariant;
use App\Models\Setting;
use Illuminate\Support\Str;

echo "1. Category CRUD\n";
$cat = Category::create(['name'=>'Test Cat', 'slug'=>'test-cat', 'is_active'=>1, 'sort_order'=>1]);
echo "Created Category: {$cat->id}\n";
$cat->update(['name'=>'Test Cat Edited']);
echo "Updated Category: {$cat->name}\n";

echo "2. Subcategory CRUD\n";
$sub = Subcategory::create(['name'=>'Test Sub', 'slug'=>'test-sub', 'category_id'=>$cat->id, 'is_active'=>1]);
echo "Created Subcategory: {$sub->id}\n";

echo "3. Product CRUD\n";
$prod = Product::create(['name'=>'Test Product', 'slug'=>'test-product', 'category_id'=>$cat->id, 'subcategory_id'=>$sub->id, 'description'=>'Desc', 'status'=>'active']);
echo "Created Product: {$prod->id}\n";

echo "4. Product Variants\n";
$var = ProductVariant::create(['product_id'=>$prod->id, 'sku'=>'TEST-SKU-1', 'size'=>'42', 'color'=>'Navy', 'price'=>4999, 'availability'=>'in_stock', 'is_default'=>1]);
echo "Created Variant: {$var->sku}\n";

echo "5. Settings\n";
Setting::updateOrCreate(['key_name'=>'whatsapp_number'], ['value'=>'+919876543210']);
echo "Setting updated: " . Setting::where('key_name','whatsapp_number')->first()->value . "\n";

echo "6. Cleanup\n";
$var->delete();
$prod->delete();
$sub->delete();
$cat->delete();
echo "Cleanup successful.\n";
