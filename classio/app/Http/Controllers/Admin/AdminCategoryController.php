<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Services\CloudinaryService;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class AdminCategoryController extends Controller
{
    public function index(Request $request)
    {
        $query = Category::query();
        
        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }
        
        $categories = $query->orderBy('sort_order')->paginate(20);
        return view('admin.categories.index', compact('categories'));
    }

    public function create()
    {
        return view('admin.categories.create');
    }

    public function store(Request $request, CloudinaryService $cloudinary)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:categories,slug',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'is_active' => 'boolean',
            'sort_order' => 'integer'
        ]);

        $data = $request->except('image');
        $data['slug'] = $request->slug ? Str::slug($request->slug) : Str::slug($request->name);
        $data['is_active'] = $request->has('is_active');
        $data['sort_order'] = $request->sort_order ?? 0;

        if ($request->hasFile('image')) {
            $result = $cloudinary->upload($request->file('image'), 'categories/' . $data['slug']);
            $data['image_path'] = $result['secure_url'];
        }

        Category::create($data);

        return redirect()->route('admin.categories.index')->with('success', 'Category created successfully.');
    }
    
    public function edit(Category $category)
    {
        return view('admin.categories.edit', compact('category'));
    }

    public function update(Request $request, Category $category, CloudinaryService $cloudinary)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'slug' => ['required', 'string', 'max:255', Rule::unique('categories')->ignore($category->id)],
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'is_active' => 'boolean',
            'sort_order' => 'integer'
        ]);

        $data = $request->except('image');
        $data['slug'] = Str::slug($request->slug);
        $data['is_active'] = $request->has('is_active');

        if ($request->hasFile('image')) {
            if ($category->image_path) {
                if (strpos($category->image_path, 'res.cloudinary.com') !== false) {
                    try {
                        $cloudinary->delete($category->image_path);
                    } catch (\Exception $e) {}
                } elseif (Storage::disk('public')->exists($category->image_path)) {
                    Storage::disk('public')->delete($category->image_path);
                }
            }
            $result = $cloudinary->upload($request->file('image'), 'categories/' . $data['slug']);
            $data['image_path'] = $result['secure_url'];
        }

        $category->update($data);

        return redirect()->route('admin.categories.index')->with('success', 'Category updated successfully.');
    }

    public function destroy(Category $category, CloudinaryService $cloudinary)
    {
        // Data Integrity Check: Don't delete if it has products or subcategories
        if ($category->products()->count() > 0) {
            return back()->with('error', 'Cannot delete category. It has associated products.');
        }
        
        if ($category->subcategories()->count() > 0) {
            return back()->with('error', 'Cannot delete category. It has associated subcategories.');
        }

        if ($category->image_path) {
            if (strpos($category->image_path, 'res.cloudinary.com') !== false) {
                try {
                    $cloudinary->delete($category->image_path);
                } catch (\Exception $e) {}
            } elseif (Storage::disk('public')->exists($category->image_path)) {
                Storage::disk('public')->delete($category->image_path);
            }
        }

        $category->delete();
        
        return redirect()->route('admin.categories.index')->with('success', 'Category deleted successfully.');
    }
}