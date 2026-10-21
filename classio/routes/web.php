<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\AdminCategoryController;
use App\Http\Controllers\Admin\AdminProductController;
use App\Http\Controllers\Frontend\CategoryController;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\ProductController;
use App\Http\Controllers\Frontend\CartController;
use App\Http\Controllers\Frontend\WishlistController;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/search', [CategoryController::class, 'search'])->name('search');
Route::get('/category/{slug}', [CategoryController::class, 'show'])->name('category.show');
Route::get('/product/{slug}', [ProductController::class, 'show'])->name('product.show');
Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::post('/cart/validate', [CartController::class, 'validateCart'])->name('cart.validate');
Route::get('/wishlist', [WishlistController::class, 'index'])->name('wishlist.index');
Route::get('/wishlist/products', [WishlistController::class, 'getProducts'])->name('wishlist.products');

Route::get('/admin/login', [AuthController::class, 'showLoginForm'])->name('admin.login');
Route::post('/admin/login', [AuthController::class, 'login'])->name('admin.login.submit');
Route::post('/admin/logout', [AuthController::class, 'logout'])->name('admin.logout');

Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('categories', AdminCategoryController::class);
    Route::resource('subcategories', \App\Http\Controllers\Admin\AdminSubcategoryController::class);
    Route::resource('banners', \App\Http\Controllers\Admin\AdminBannerController::class);
    Route::get('/settings', [\App\Http\Controllers\Admin\SettingsController::class, 'index'])->name('settings.index');
    Route::post('/settings', [\App\Http\Controllers\Admin\SettingsController::class, 'update'])->name('settings.update');
    Route::post('/products/{product}/variants', [\App\Http\Controllers\Admin\AdminProductVariantController::class, 'store'])->name('products.variants.store');
    Route::delete('/variants/{variant}', [\App\Http\Controllers\Admin\AdminProductVariantController::class, 'destroy'])->name('variants.destroy');
    Route::post('/products/{product}/images', [\App\Http\Controllers\Admin\AdminProductImageController::class, 'store'])->name('products.images.store');
    Route::delete('/images/{image}', [\App\Http\Controllers\Admin\AdminProductImageController::class, 'destroy'])->name('images.destroy');

    Route::resource('products', AdminProductController::class);
});