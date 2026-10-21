<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use App\Models\Subcategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class AdminProductController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::with(['category', 'variants']);
        
        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        if ($request->filled('category_id')) {
            $query->where('category_id', $request->category_id);
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }
        
        $products = $query->orderBy('created_at', 'desc')->paginate(20)->withQueryString();
        $categories = Category::orderBy('name')->get();

        return view('admin.products.index', compact('products', 'categories'));
    }

    public function create()
    {
        $categories = Category::where('is_active', true)->orderBy('name')->get();
        $subcategories = Subcategory::where('is_active', true)->orderBy('name')->get();
        return view('admin.products.create', compact('categories', 'subcategories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'subcategory_id' => 'nullable|exists:subcategories,id',
            'name' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:products,slug',
            'status' => 'required|in:active,draft,archived',
            'description' => 'nullable|string'
        ]);

        $data = $request->except(['_token', 'is_featured', 'is_trending', 'is_new']);
        $data['slug'] = $request->slug ? Str::slug($request->slug) : Str::slug($request->name);
        $data['is_featured'] = $request->has('is_featured');
        $data['is_trending'] = $request->has('is_trending');
        $data['is_new'] = $request->has('is_new');

        $product = Product::create($data);

        return redirect()->route('admin.products.edit', $product)->with('success', 'Product created successfully. You can now add variants and images.');
    }
    
    public function edit(Product $product)
    {
        $categories = Category::where('is_active', true)->orderBy('name')->get();
        // Load subcategories for the selected category if needed, or just all active
        $subcategories = Subcategory::where('is_active', true)->orderBy('name')->get();
        
        $product->load(['variants' => function($q) {
            $q->orderBy('is_default', 'desc')->orderBy('id', 'asc');
        }, 'images' => function($q) {
            $q->orderBy('sort_order', 'asc')->orderBy('id', 'asc');
        }]);
        
        return view('admin.products.edit', compact('product', 'categories', 'subcategories'));
    }

    public function update(Request $request, Product $product)
    {
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'subcategory_id' => 'nullable|exists:subcategories,id',
            'name' => 'required|string|max:255',
            'slug' => ['required', 'string', 'max:255', Rule::unique('products')->ignore($product->id)],
            'status' => 'required|in:active,draft,archived',
            'description' => 'nullable|string'
        ]);

        $data = $request->except(['_token', '_method', 'is_featured', 'is_trending', 'is_new']);
        $data['slug'] = Str::slug($request->slug);
        $data['is_featured'] = $request->has('is_featured');
        $data['is_trending'] = $request->has('is_trending');
        $data['is_new'] = $request->has('is_new');

        $product->update($data);

        return back()->with('success', 'Product updated successfully.');
    }

    public function destroy(Product $product)
    {
        // Delete related images physically
        foreach ($product->images as $image) {
            if ($image->image_path && \Storage::disk('public')->exists($image->image_path)) {
                \Storage::disk('public')->delete($image->image_path);
            }
        }
        
        // Product deletion will cascade variants/images if DB is set up, otherwise we should delete them
        $product->variants()->delete();
        $product->images()->delete();
        $product->delete();
        
        return redirect()->route('admin.products.index')->with('success', 'Product deleted successfully.');
    }
}