<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Subcategory;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class AdminSubcategoryController extends Controller
{
    public function index(Request $request)
    {
        $query = Subcategory::with('category');
        
        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }
        
        $subcategories = $query->orderBy('sort_order')->paginate(20);
        return view('admin.subcategories.index', compact('subcategories'));
    }

    public function create()
    {
        $categories = Category::where('is_active', true)->orderBy('name')->get();
        return view('admin.subcategories.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'name' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:subcategories,slug',
            'is_active' => 'boolean',
            'sort_order' => 'integer'
        ]);

        $data = $request->all();
        $data['slug'] = $request->slug ? Str::slug($request->slug) : Str::slug($request->name);
        $data['is_active'] = $request->has('is_active');
        $data['sort_order'] = $request->sort_order ?? 0;

        Subcategory::create($data);

        return redirect()->route('admin.subcategories.index')->with('success', 'Subcategory created successfully.');
    }
    
    public function edit(Subcategory $subcategory)
    {
        $categories = Category::where('is_active', true)->orderBy('name')->get();
        return view('admin.subcategories.edit', compact('subcategory', 'categories'));
    }

    public function update(Request $request, Subcategory $subcategory)
    {
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'name' => 'required|string|max:255',
            'slug' => ['required', 'string', 'max:255', Rule::unique('subcategories')->ignore($subcategory->id)],
            'is_active' => 'boolean',
            'sort_order' => 'integer'
        ]);

        $data = $request->all();
        $data['slug'] = Str::slug($request->slug);
        $data['is_active'] = $request->has('is_active');
        
        $subcategory->update($data);

        return redirect()->route('admin.subcategories.index')->with('success', 'Subcategory updated successfully.');
    }

    public function destroy(Subcategory $subcategory)
    {
        // Data Integrity Check
        if ($subcategory->products()->count() > 0) {
            return back()->with('error', 'Cannot delete subcategory. It has associated products.');
        }

        $subcategory->delete();
        
        return redirect()->route('admin.subcategories.index')->with('success', 'Subcategory deleted successfully.');
    }
}