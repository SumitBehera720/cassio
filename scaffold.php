<?php
$base = __DIR__ . '/classio';

// 1. Create Migrations
$migrationsDir = $base . '/database/migrations';
// clear old migrations to avoid conflicts (if any)
foreach (glob($migrationsDir . '/*_create_*.php') as $file) {
    unlink($file);
}

$migrations = [
    '2026_10_08_100000_create_categories_table.php' => "<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
return new class extends Migration {
    public function up() {
        Schema::create('categories', function (Blueprint \$table) {
            \$table->id();
            \$table->string('name');
            \$table->string('slug')->unique();
            \$table->string('image_path')->nullable();
            \$table->boolean('is_active')->default(true);
            \$table->integer('sort_order')->default(0);
            \$table->timestamps();
        });
    }
    public function down() { Schema::dropIfExists('categories'); }
};",

    '2026_10_08_100001_create_subcategories_table.php' => "<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
return new class extends Migration {
    public function up() {
        Schema::create('subcategories', function (Blueprint \$table) {
            \$table->id();
            \$table->foreignId('category_id')->constrained('categories')->onDelete('cascade');
            \$table->string('name');
            \$table->string('slug')->unique();
            \$table->boolean('is_active')->default(true);
            \$table->integer('sort_order')->default(0);
            \$table->timestamps();
        });
    }
    public function down() { Schema::dropIfExists('subcategories'); }
};",

    '2026_10_08_100002_create_products_table.php' => "<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
return new class extends Migration {
    public function up() {
        Schema::create('products', function (Blueprint \$table) {
            \$table->id();
            \$table->foreignId('category_id')->constrained('categories')->onDelete('restrict');
            \$table->foreignId('subcategory_id')->nullable()->constrained('subcategories')->onDelete('set null');
            \$table->string('name');
            \$table->string('slug')->unique();
            \$table->text('description')->nullable();
            \$table->boolean('is_featured')->default(false);
            \$table->boolean('is_trending')->default(false);
            \$table->boolean('is_new')->default(false);
            \$table->enum('status', ['active', 'inactive'])->default('active');
            \$table->timestamps();
        });
    }
    public function down() { Schema::dropIfExists('products'); }
};",

    '2026_10_08_100003_create_product_variants_table.php' => "<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
return new class extends Migration {
    public function up() {
        Schema::create('product_variants', function (Blueprint \$table) {
            \$table->id();
            \$table->foreignId('product_id')->constrained('products')->onDelete('cascade');
            \$table->string('sku')->unique();
            \$table->string('size')->nullable();
            \$table->string('color')->nullable();
            \$table->decimal('price', 10, 2);
            \$table->decimal('compare_at_price', 10, 2)->nullable();
            \$table->enum('availability', ['in_stock', 'out_of_stock'])->default('in_stock');
            \$table->boolean('is_default')->default(false);
            \$table->timestamps();
        });
    }
    public function down() { Schema::dropIfExists('product_variants'); }
};",

    '2026_10_08_100004_create_product_images_table.php' => "<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
return new class extends Migration {
    public function up() {
        Schema::create('product_images', function (Blueprint \$table) {
            \$table->id();
            \$table->foreignId('product_id')->constrained('products')->onDelete('cascade');
            \$table->string('image_path');
            \$table->boolean('is_primary')->default(false);
            \$table->integer('sort_order')->default(0);
            \$table->timestamps();
        });
    }
    public function down() { Schema::dropIfExists('product_images'); }
};",

    '2026_10_08_100005_create_banners_table.php' => "<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
return new class extends Migration {
    public function up() {
        Schema::create('banners', function (Blueprint \$table) {
            \$table->id();
            \$table->string('title')->nullable();
            \$table->string('subtitle')->nullable();
            \$table->string('image_path');
            \$table->string('link_url')->nullable();
            \$table->string('placement_section');
            \$table->boolean('is_active')->default(true);
            \$table->integer('sort_order')->default(0);
            \$table->timestamps();
        });
    }
    public function down() { Schema::dropIfExists('banners'); }
};",

    '2026_10_08_100006_create_settings_table.php' => "<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
return new class extends Migration {
    public function up() {
        Schema::create('settings', function (Blueprint \$table) {
            \$table->id();
            \$table->string('key_name')->unique();
            \$table->text('value')->nullable();
            \$table->timestamps();
        });
    }
    public function down() { Schema::dropIfExists('settings'); }
};"
];

foreach ($migrations as $file => $content) {
    file_put_contents($migrationsDir . '/' . $file, $content);
}

// 2. Controllers
$controllersDir = $base . '/app/Http/Controllers';
mkdir($controllersDir . '/Frontend', 0755, true);
mkdir($controllersDir . '/Admin', 0755, true);

$controllers = [
    'Frontend/HomeController.php' => "<?php namespace App\Http\Controllers\Frontend; use App\Http\Controllers\Controller; class HomeController extends Controller { public function index() { return 'home'; } }",
    'Frontend/CategoryController.php' => "<?php namespace App\Http\Controllers\Frontend; use App\Http\Controllers\Controller; class CategoryController extends Controller { public function show(\$slug) { return 'category ' . \$slug; } }",
    'Frontend/ProductController.php' => "<?php namespace App\Http\Controllers\Frontend; use App\Http\Controllers\Controller; class ProductController extends Controller { public function show(\$slug) { return 'product ' . \$slug; } }",
    'Frontend/CartController.php' => "<?php namespace App\Http\Controllers\Frontend; use App\Http\Controllers\Controller; class CartController extends Controller { public function index() { return 'cart'; } }",
    'Admin/DashboardController.php' => "<?php namespace App\Http\Controllers\Admin; use App\Http\Controllers\Controller; class DashboardController extends Controller { public function index() { return 'admin dashboard'; } }",
    'Admin/AuthController.php' => "<?php namespace App\Http\Controllers\Admin; use App\Http\Controllers\Controller; class AuthController extends Controller { public function showLoginForm() { return 'admin login'; } }",
];
foreach ($controllers as $file => $content) {
    file_put_contents($controllersDir . '/' . $file, $content);
}

// 3. Middleware
$middlewareDir = $base . '/app/Http/Middleware';
if (!is_dir($middlewareDir)) mkdir($middlewareDir, 0755, true);

file_put_contents($middlewareDir . '/AdminAuth.php', "<?php namespace App\Http\Middleware; use Closure; use Illuminate\Http\Request; use Illuminate\Support\Facades\Auth; class AdminAuth { public function handle(Request \$request, Closure \$next) { if (!Auth::check()) { return redirect('/admin/login'); } return \$next(\$request); } }");

// Add Middleware to bootstrap/app.php in Laravel 11/12
$appPhp = file_get_contents($base . '/bootstrap/app.php');
$appPhp = str_replace('->withMiddleware(function (Middleware $middleware) {', "->withMiddleware(function (Middleware \$middleware) {\n    \$middleware->alias(['admin' => \\App\\Http\\Middleware\\AdminAuth::class]);", $appPhp);
file_put_contents($base . '/bootstrap/app.php', $appPhp);

// 4. Routes
$routesPath = $base . '/routes/web.php';
file_put_contents($routesPath, "<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\CategoryController;
use App\Http\Controllers\Frontend\ProductController;
use App\Http\Controllers\Frontend\CartController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\AuthController;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/category/{slug}', [CategoryController::class, 'show'])->name('category.show');
Route::get('/product/{slug}', [ProductController::class, 'show'])->name('product.show');
Route::get('/cart', [CartController::class, 'index'])->name('cart');

Route::get('/admin/login', [AuthController::class, 'showLoginForm'])->name('admin.login');
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
});
");

// 5. DatabaseSeeder
$seederPath = $base . '/database/seeders/DatabaseSeeder.php';
file_put_contents($seederPath, "<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Category;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder {
    public function run(): void {
        User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@classio.com',
            'password' => bcrypt('password'),
        ]);

        \$categories = [
            'Ladies Collection', 'Gents Collection', 'Watches & Perfumes', 'Fashion Accessories',
            'Bags Collection', 'Footwear', 'Gifts & Accessories', 'Electronics & Audio',
            'New Arrivals', 'Offers & Deals'
        ];

        foreach (\$categories as \$cat) {
            Category::create([
                'name' => \$cat,
                'slug' => Str::slug(\$cat)
            ]);
        }
    }
}
");

echo "Scaffold complete.\n";
