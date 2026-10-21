<?php
$base = __DIR__ . '/classio';
$controllersDir = $base . '/app/Http/Controllers/Admin';
$viewsDir = $base . '/resources/views/admin';

if (!is_dir($controllersDir)) mkdir($controllersDir, 0755, true);
if (!is_dir($viewsDir)) mkdir($viewsDir, 0755, true);
if (!is_dir($viewsDir . '/categories')) mkdir($viewsDir . '/categories', 0755, true);
if (!is_dir($viewsDir . '/products')) mkdir($viewsDir . '/products', 0755, true);

// 1. DashboardController
file_put_contents($controllersDir . '/DashboardController.php', "<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\{Product, Category, Subcategory, ProductVariant, Banner};
class DashboardController extends Controller {
    public function index() {
        \$stats = [
            'total_products' => Product::count(),
            'active_products' => Product::where('status', 'active')->count(),
            'categories' => Category::count(),
            'in_stock' => ProductVariant::where('availability', 'in_stock')->count(),
            'out_of_stock' => ProductVariant::where('availability', 'out_of_stock')->count(),
        ];
        return view('admin.dashboard', compact('stats'));
    }
}");

// 2. AdminCategoryController (Skeleton)
file_put_contents($controllersDir . '/AdminCategoryController.php', "<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
class AdminCategoryController extends Controller {
    public function index() { \$categories = Category::all(); return view('admin.categories.index', compact('categories')); }
    public function create() { return view('admin.categories.create'); }
    public function store(Request \$request) { /* Validation and Store */ return redirect()->route('admin.categories.index'); }
    public function edit(Category \$category) { return view('admin.categories.edit', compact('category')); }
    public function update(Request \$request, Category \$category) { /* Update */ return redirect()->route('admin.categories.index'); }
    public function destroy(Category \$category) { \$category->delete(); return redirect()->route('admin.categories.index'); }
}");

// 3. AdminProductController (Skeleton)
file_put_contents($controllersDir . '/AdminProductController.php', "<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
class AdminProductController extends Controller {
    public function index() { \$products = Product::all(); return view('admin.products.index', compact('products')); }
    public function create() { return view('admin.products.create'); }
    public function store(Request \$request) { return redirect()->route('admin.products.index'); }
    public function edit(Product \$product) { return view('admin.products.edit', compact('product')); }
    public function update(Request \$request, Product \$product) { return redirect()->route('admin.products.index'); }
    public function destroy(Product \$product) { \$product->delete(); return redirect()->route('admin.products.index'); }
}");

// 4. Admin Layout View
file_put_contents($viewsDir . '/layout.blade.php', "<!DOCTYPE html>
<html lang='en'>
<head><title>Admin Panel - Classio</title><script src='https://cdn.tailwindcss.com'></script></head>
<body class='bg-gray-100 flex'>
    <aside class='w-64 bg-gray-900 text-white min-h-screen p-4'>
        <h1 class='text-2xl font-bold mb-6'>Classio Admin</h1>
        <nav class='space-y-2'>
            <a href='{{ route('admin.dashboard') }}' class='block p-2 hover:bg-gray-700 rounded'>Dashboard</a>
            <a href='{{ route('admin.categories.index') }}' class='block p-2 hover:bg-gray-700 rounded'>Categories</a>
            <a href='{{ route('admin.products.index') }}' class='block p-2 hover:bg-gray-700 rounded'>Products</a>
            <form action='{{ route('admin.logout') }}' method='POST' class='mt-6'>
                @csrf <button class='w-full text-left p-2 bg-red-600 hover:bg-red-700 rounded'>Logout</button>
            </form>
        </nav>
    </aside>
    <main class='flex-1 p-8'>
        @yield('content')
    </main>
</body>
</html>");

// 5. Dashboard View
file_put_contents($viewsDir . '/dashboard.blade.php', "@extends('admin.layout')
@section('content')
<h2 class='text-3xl font-bold mb-6'>Dashboard</h2>
<div class='grid grid-cols-3 gap-6'>
    <div class='bg-white p-6 rounded shadow'>
        <h3 class='text-gray-500'>Total Products</h3>
        <p class='text-4xl font-bold'>{{ \$stats['total_products'] }}</p>
    </div>
    <div class='bg-white p-6 rounded shadow'>
        <h3 class='text-gray-500'>Active Categories</h3>
        <p class='text-4xl font-bold'>{{ \$stats['categories'] }}</p>
    </div>
    <div class='bg-white p-6 rounded shadow'>
        <h3 class='text-gray-500'>Out of Stock Variants</h3>
        <p class='text-4xl font-bold text-red-600'>{{ \$stats['out_of_stock'] }}</p>
    </div>
</div>
@endsection");

// 6. AuthController & Login View
file_put_contents($controllersDir . '/AuthController.php', "<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class AuthController extends Controller {
    public function showLoginForm() { return view('admin.login'); }
    public function login(Request \$request) {
        if (Auth::attempt(\$request->only('email', 'password'))) {
            return redirect()->route('admin.dashboard');
        }
        return back()->withErrors(['email' => 'Invalid credentials']);
    }
    public function logout() { Auth::logout(); return redirect()->route('admin.login'); }
}");

file_put_contents($viewsDir . '/login.blade.php', "<!DOCTYPE html>
<html><head><script src='https://cdn.tailwindcss.com'></script></head>
<body class='bg-gray-200 flex items-center justify-center h-screen'>
    <form action='{{ route('admin.login.submit') }}' method='POST' class='bg-white p-8 rounded shadow-md w-96'>
        @csrf
        <h2 class='text-2xl mb-4 font-bold'>Admin Login</h2>
        <input type='email' name='email' placeholder='Email' class='w-full border p-2 mb-4 rounded' required>
        <input type='password' name='password' placeholder='Password' class='w-full border p-2 mb-4 rounded' required>
        <button class='w-full bg-blue-600 text-white p-2 rounded'>Login</button>
    </form>
</body></html>");

// Update routes/web.php
$routes = "<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\AdminCategoryController;
use App\Http\Controllers\Admin\AdminProductController;

Route::get('/admin/login', [AuthController::class, 'showLoginForm'])->name('admin.login');
Route::post('/admin/login', [AuthController::class, 'login'])->name('admin.login.submit');
Route::post('/admin/logout', [AuthController::class, 'logout'])->name('admin.logout');

Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('categories', AdminCategoryController::class);
    Route::resource('products', AdminProductController::class);
});";
file_put_contents($base . '/routes/web.php', $routes);

echo "Admin Panel Scaffolded.\n";
