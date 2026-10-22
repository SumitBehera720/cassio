<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\AuthController as AdminAuthController;
use App\Http\Controllers\Admin\AdminCategoryController;
use App\Http\Controllers\Admin\AdminProductController;
use App\Http\Controllers\Frontend\CategoryController;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\ProductController;
use App\Http\Controllers\Frontend\CartController;
use App\Http\Controllers\Frontend\WishlistController;
use App\Http\Controllers\Frontend\AuthController as FrontendAuthController;
use App\Http\Controllers\Frontend\AccountController;
use App\Http\Controllers\Frontend\PageController;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/search', [CategoryController::class, 'search'])->name('search');
Route::get('/search/suggest', [CategoryController::class, 'searchSuggest'])->name('search.suggest');
Route::get('/category/{slug}', [CategoryController::class, 'show'])->name('category.show');
Route::get('/product/{slug}', [ProductController::class, 'show'])->name('product.show');
Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::post('/cart/validate', [CartController::class, 'validateCart'])->name('cart.validate');
Route::get('/wishlist', [WishlistController::class, 'index'])->name('wishlist.index');
Route::get('/wishlist/products', [WishlistController::class, 'getProducts'])->name('wishlist.products');

// Customer / Unified Authentication
Route::get('/login', [FrontendAuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [FrontendAuthController::class, 'login'])->name('login.submit');
Route::post('/register', [FrontendAuthController::class, 'register'])->name('register.submit');
Route::post('/logout', [FrontendAuthController::class, 'logout'])->name('logout');
Route::get('/account', [AccountController::class, 'index'])->name('account.index');

// Dedicated Information & Customer Service Pages
Route::get('/about', [PageController::class, 'about'])->name('about');
Route::get('/contact', [PageController::class, 'contact'])->name('contact');
Route::post('/contact', [PageController::class, 'contactSubmit'])->name('contact.submit');
Route::get('/stores', [PageController::class, 'stores'])->name('stores');
Route::get('/customer-service', [PageController::class, 'customerService'])->name('customer-service');
Route::get('/faq', [PageController::class, 'faq'])->name('faq');
Route::get('/track-order', [PageController::class, 'trackOrder'])->name('track-order');
Route::get('/shipping-policy', [PageController::class, 'shippingPolicy'])->name('shipping-policy');
Route::get('/return-policy', [PageController::class, 'returnPolicy'])->name('return-policy');
Route::get('/privacy-policy', [PageController::class, 'privacyPolicy'])->name('privacy-policy');
Route::get('/terms', [PageController::class, 'terms'])->name('terms');
Route::get('/size-guide', [PageController::class, 'sizeGuide'])->name('size-guide');

// Admin Auth Routes
Route::get('/admin/login', [AdminAuthController::class, 'showLoginForm'])->name('admin.login');
Route::post('/admin/login', [AdminAuthController::class, 'login'])->name('admin.login.submit');
Route::post('/admin/logout', [AdminAuthController::class, 'logout'])->name('admin.logout');

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