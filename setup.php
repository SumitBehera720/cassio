<?php
$baseDir = __DIR__ . '/classio';
// Ensure models and migrations exist

function replaceInFile($path, $content) {
    if(file_exists($path)) {
        file_put_contents($path, $content);
    }
}

// 1. Database .env
$envPath = $baseDir . '/.env';
if(file_exists($envPath)) {
    $env = file_get_contents($envPath);
    $env = preg_replace('/DB_CONNECTION=.*/', "DB_CONNECTION=mysql\nDB_HOST=127.0.0.1\nDB_PORT=3306\nDB_DATABASE=classio_db\nDB_USERNAME=root\nDB_PASSWORD=", $env);
    file_put_contents($envPath, $env);
}

// 2. Models
replaceInFile($baseDir . '/app/Models/Category.php', '<?php namespace App\Models; use Illuminate\Database\Eloquent\Model; class Category extends Model { protected $guarded = []; public function subcategories() { return $this->hasMany(Subcategory::class); } public function products() { return $this->hasMany(Product::class); } }');
replaceInFile($baseDir . '/app/Models/Subcategory.php', '<?php namespace App\Models; use Illuminate\Database\Eloquent\Model; class Subcategory extends Model { protected $guarded = []; public function category() { return $this->belongsTo(Category::class); } public function products() { return $this->hasMany(Product::class); } }');
replaceInFile($baseDir . '/app/Models/Product.php', '<?php namespace App\Models; use Illuminate\Database\Eloquent\Model; class Product extends Model { protected $guarded = []; public function category() { return $this->belongsTo(Category::class); } public function subcategory() { return $this->belongsTo(Subcategory::class); } public function variants() { return $this->hasMany(ProductVariant::class); } public function images() { return $this->hasMany(ProductImage::class); } }');
replaceInFile($baseDir . '/app/Models/ProductVariant.php', '<?php namespace App\Models; use Illuminate\Database\Eloquent\Model; class ProductVariant extends Model { protected $guarded = []; public function product() { return $this->belongsTo(Product::class); } }');
replaceInFile($baseDir . '/app/Models/ProductImage.php', '<?php namespace App\Models; use Illuminate\Database\Eloquent\Model; class ProductImage extends Model { protected $guarded = []; public function product() { return $this->belongsTo(Product::class); } }');
replaceInFile($baseDir . '/app/Models/Banner.php', '<?php namespace App\Models; use Illuminate\Database\Eloquent\Model; class Banner extends Model { protected $guarded = []; }');
replaceInFile($baseDir . '/app/Models/Setting.php', '<?php namespace App\Models; use Illuminate\Database\Eloquent\Model; class Setting extends Model { protected $guarded = []; }');

echo "Models scaffolded.\n";
