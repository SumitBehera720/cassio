@extends('admin.layout')

@section('title', 'Edit Product')

@section('content')
<div class="md:flex md:items-center md:justify-between mb-8">
    <div class="min-w-0 flex-1">
        <h2 class="text-2xl font-bold leading-7 text-gray-900 sm:truncate sm:text-3xl sm:tracking-tight">Edit Product: {{ $product->name }}</h2>
    </div>
    <div class="mt-4 flex md:ml-4 md:mt-0 gap-x-3">
        <a href="{{ route('product.show', $product->slug) }}" target="_blank" class="inline-flex items-center rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50">View Live</a>
        <a href="{{ route('admin.products.index') }}" class="inline-flex items-center rounded-md bg-classio-navy px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-gray-800 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-classio-navy">Back to list</a>
    </div>
</div>

<div class="space-y-10 divide-y divide-gray-900/10">

    <!-- Basic Info -->
    <div class="grid grid-cols-1 gap-x-8 gap-y-8 md:grid-cols-3">
        <div class="px-4 sm:px-0">
            <h2 class="text-base font-semibold leading-7 text-gray-900">Basic Information</h2>
            <p class="mt-1 text-sm leading-6 text-gray-600">Update product classification and status.</p>
        </div>

        <form action="{{ route('admin.products.update', $product) }}" method="POST" class="bg-white shadow-sm ring-1 ring-gray-900/5 sm:rounded-xl md:col-span-2">
            @csrf
            @method('PUT')
            <div class="px-4 py-6 sm:p-8">
                <div class="grid max-w-2xl grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                    
                    <div class="sm:col-span-4">
                        <label for="name" class="block text-sm font-medium leading-6 text-gray-900">Name</label>
                        <div class="mt-2">
                            <input type="text" name="name" id="name" value="{{ old('name', $product->name) }}" required class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-classio-navy sm:text-sm sm:leading-6">
                        </div>
                        @error('name')<p class="mt-2 text-sm text-red-600">{{ $message }}</p>@enderror
                    </div>

                    <div class="sm:col-span-4">
                        <label for="slug" class="block text-sm font-medium leading-6 text-gray-900">Slug</label>
                        <div class="mt-2">
                            <input type="text" name="slug" id="slug" value="{{ old('slug', $product->slug) }}" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-classio-navy sm:text-sm sm:leading-6">
                        </div>
                        @error('slug')<p class="mt-2 text-sm text-red-600">{{ $message }}</p>@enderror
                    </div>

                    <div class="col-span-full">
                        <label for="description" class="block text-sm font-medium leading-6 text-gray-900">Description</label>
                        <div class="mt-2">
                            <textarea id="description" name="description" rows="5" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-classio-navy sm:text-sm sm:leading-6">{{ old('description', $product->description) }}</textarea>
                        </div>
                    </div>

                    <div class="sm:col-span-3">
                        <label for="category_id" class="block text-sm font-medium leading-6 text-gray-900">Category</label>
                        <div class="mt-2">
                            <select id="category_id" name="category_id" required class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-classio-navy sm:text-sm sm:leading-6">
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="sm:col-span-3">
                        <label for="subcategory_id" class="block text-sm font-medium leading-6 text-gray-900">Subcategory</label>
                        <div class="mt-2">
                            <select id="subcategory_id" name="subcategory_id" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-classio-navy sm:text-sm sm:leading-6">
                                <option value="">None</option>
                                @foreach($subcategories as $sub)
                                    <option value="{{ $sub->id }}" {{ old('subcategory_id', $product->subcategory_id) == $sub->id ? 'selected' : '' }}>{{ $sub->name }} ({{ $sub->category->name ?? '' }})</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="sm:col-span-3">
                        <label for="status" class="block text-sm font-medium leading-6 text-gray-900">Status</label>
                        <div class="mt-2">
                            <select id="status" name="status" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-classio-navy sm:text-sm sm:leading-6">
                                <option value="active" {{ old('status', $product->status) === 'active' ? 'selected' : '' }}>Active</option>
                                <option value="draft" {{ old('status', $product->status) === 'draft' ? 'selected' : '' }}>Draft</option>
                                <option value="archived" {{ old('status', $product->status) === 'archived' ? 'selected' : '' }}>Archived</option>
                            </select>
                        </div>
                    </div>

                    <div class="sm:col-span-6">
                        <fieldset>
                            <legend class="sr-only">Flags</legend>
                            <div class="flex gap-4">
                                <div class="relative flex items-start">
                                    <div class="flex h-6 items-center">
                                        <input id="is_featured" name="is_featured" type="checkbox" value="1" {{ old('is_featured', $product->is_featured) ? 'checked' : '' }} class="h-4 w-4 rounded border-gray-300 text-classio-navy focus:ring-classio-navy">
                                    </div>
                                    <div class="ml-3 text-sm leading-6">
                                        <label for="is_featured" class="font-medium text-gray-900">Featured</label>
                                    </div>
                                </div>
                                <div class="relative flex items-start">
                                    <div class="flex h-6 items-center">
                                        <input id="is_trending" name="is_trending" type="checkbox" value="1" {{ old('is_trending', $product->is_trending) ? 'checked' : '' }} class="h-4 w-4 rounded border-gray-300 text-classio-navy focus:ring-classio-navy">
                                    </div>
                                    <div class="ml-3 text-sm leading-6">
                                        <label for="is_trending" class="font-medium text-gray-900">Trending</label>
                                    </div>
                                </div>
                                <div class="relative flex items-start">
                                    <div class="flex h-6 items-center">
                                        <input id="is_new" name="is_new" type="checkbox" value="1" {{ old('is_new', $product->is_new) ? 'checked' : '' }} class="h-4 w-4 rounded border-gray-300 text-classio-navy focus:ring-classio-navy">
                                    </div>
                                    <div class="ml-3 text-sm leading-6">
                                        <label for="is_new" class="font-medium text-gray-900">New</label>
                                    </div>
                                </div>
                            </div>
                        </fieldset>
                    </div>

                </div>
            </div>
            <div class="flex items-center justify-end gap-x-6 border-t border-gray-900/10 px-4 py-4 sm:px-8">
                <button type="submit" class="rounded-md bg-classio-navy px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-gray-800">Save Basic Info</button>
            </div>
        </form>
    </div>

    <!-- Images -->
    <div class="grid grid-cols-1 gap-x-8 gap-y-8 pt-10 md:grid-cols-3">
        <div class="px-4 sm:px-0">
            <h2 class="text-base font-semibold leading-7 text-gray-900">Product Images</h2>
            <p class="mt-1 text-sm leading-6 text-gray-600">Upload and manage product images. Make sure to select a primary image.</p>
        </div>

        <div class="bg-white shadow-sm ring-1 ring-gray-900/5 sm:rounded-xl md:col-span-2">
            <div class="px-4 py-6 sm:p-8">
                
                <!-- Existing Images -->
                @if($product->images->count() > 0)
                <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-8">
                    @foreach($product->images as $image)
                    <div class="relative group rounded-lg overflow-hidden border border-gray-200">
                        <img src="{{ Storage::url($image->image_path) }}" alt="" class="w-full h-32 object-cover {{ $image->is_primary ? 'ring-2 ring-classio-champagne' : '' }}">
                        @if($image->is_primary)
                            <div class="absolute top-2 left-2 bg-classio-champagne text-white text-[10px] font-bold px-2 py-1 rounded">PRIMARY</div>
                        @endif
                        <div class="absolute inset-0 bg-black bg-opacity-50 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity gap-2">
                            <form action="{{ route('admin.images.destroy', $image) }}" method="POST" onsubmit="return confirm('Delete image?');">
                                @csrf @method('DELETE')
                                <button type="submit" class="bg-red-600 text-white p-2 rounded-full hover:bg-red-700">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                </button>
                            </form>
                        </div>
                    </div>
                    @endforeach
                </div>
                @endif

                <!-- Upload Form -->
                <form action="{{ route('admin.products.images.store', $product) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="grid grid-cols-1 gap-x-6 gap-y-4 sm:grid-cols-6">
                        <div class="sm:col-span-4">
                            <label class="block text-sm font-medium leading-6 text-gray-900">Upload Image</label>
                            <input type="file" name="image" accept="image/*" required class="mt-2 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-gray-50 file:text-gray-700 hover:file:bg-gray-100 border border-gray-300 rounded-md">
                            @error('image')<p class="mt-2 text-sm text-red-600">{{ $message }}</p>@enderror
                        </div>
                        <div class="sm:col-span-2 flex flex-col justify-end">
                            <div class="flex items-center mb-2">
                                <input id="is_primary" name="is_primary" type="checkbox" value="1" class="h-4 w-4 rounded border-gray-300 text-classio-navy">
                                <label for="is_primary" class="ml-2 text-sm text-gray-900">Set as Primary</label>
                            </div>
                            <button type="submit" class="rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50">Upload</button>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>

    <!-- Variants -->
    <div class="grid grid-cols-1 gap-x-8 gap-y-8 pt-10 md:grid-cols-3">
        <div class="px-4 sm:px-0">
            <h2 class="text-base font-semibold leading-7 text-gray-900">Product Variants</h2>
            <p class="mt-1 text-sm leading-6 text-gray-600">Manage SKUs, sizing, pricing and availability.</p>
        </div>

        <div class="bg-white shadow-sm ring-1 ring-gray-900/5 sm:rounded-xl md:col-span-2 overflow-hidden">
            
            <!-- List Variants -->
            @if($product->variants->count() > 0)
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col" class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">SKU</th>
                            <th scope="col" class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Attributes</th>
                            <th scope="col" class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Price</th>
                            <th scope="col" class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Stock</th>
                            <th scope="col" class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Default</th>
                            <th scope="col" class="relative px-4 py-3"><span class="sr-only">Actions</span></th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($product->variants as $variant)
                        <tr>
                            <td class="px-4 py-3 whitespace-nowrap text-sm font-medium text-gray-900">{{ $variant->sku }}</td>
                            <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-500">
                                @if($variant->size) <span class="bg-gray-100 px-2 py-1 rounded text-xs mr-1">Size: {{ $variant->size }}</span> @endif
                                @if($variant->color) <span class="bg-gray-100 px-2 py-1 rounded text-xs">Color: {{ $variant->color }}</span> @endif
                            </td>
                            <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-900">
                                @if($variant->compare_at_price > $variant->price)
                                    <span class="line-through text-gray-400 mr-1">₹{{ $variant->compare_at_price }}</span>
                                @endif
                                ₹{{ $variant->price }}
                            </td>
                            <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-500">
                                @if($variant->availability === 'in_stock')
                                    <span class="text-green-600 font-medium">In Stock</span>
                                @else
                                    <span class="text-red-600 font-medium">Out of Stock</span>
                                @endif
                            </td>
                            <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-500">
                                @if($variant->is_default)
                                    <span class="text-classio-navy">★ Default</span>
                                @endif
                            </td>
                            <td class="px-4 py-3 whitespace-nowrap text-right text-sm font-medium">
                                <form action="{{ route('admin.variants.destroy', $variant) }}" method="POST" class="inline-block" onsubmit="return confirm('Delete variant?');">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-900">Delete</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            @else
            <div class="px-4 py-8 text-center text-sm text-gray-500 border-b border-gray-200">
                No variants added yet. Products require at least one default variant for pricing.
            </div>
            @endif

            <!-- Add Variant Form -->
            <div class="px-4 py-6 sm:p-8 bg-gray-50">
                <h3 class="text-sm font-semibold leading-6 text-gray-900 mb-4">Add New Variant</h3>
                <form action="{{ route('admin.products.variants.store', $product) }}" method="POST">
                    @csrf
                    <div class="grid grid-cols-1 gap-x-4 gap-y-4 sm:grid-cols-6">
                        
                        <div class="sm:col-span-2">
                            <label class="block text-xs font-medium text-gray-700">SKU</label>
                            <input type="text" name="sku" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-classio-navy focus:ring-classio-navy sm:text-sm">
                        </div>

                        <div class="sm:col-span-2">
                            <label class="block text-xs font-medium text-gray-700">Size (Optional)</label>
                            <input type="text" name="size" placeholder="e.g. M, L, 42" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-classio-navy focus:ring-classio-navy sm:text-sm">
                        </div>

                        <div class="sm:col-span-2">
                            <label class="block text-xs font-medium text-gray-700">Color (Optional)</label>
                            <input type="text" name="color" placeholder="e.g. Navy Blue" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-classio-navy focus:ring-classio-navy sm:text-sm">
                        </div>

                        <div class="sm:col-span-2">
                            <label class="block text-xs font-medium text-gray-700">Price (₹)</label>
                            <input type="number" step="0.01" name="price" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-classio-navy focus:ring-classio-navy sm:text-sm">
                        </div>

                        <div class="sm:col-span-2">
                            <label class="block text-xs font-medium text-gray-700">Compare-at Price (₹)</label>
                            <input type="number" step="0.01" name="compare_at_price" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-classio-navy focus:ring-classio-navy sm:text-sm">
                        </div>

                        <div class="sm:col-span-2">
                            <label class="block text-xs font-medium text-gray-700">Availability</label>
                            <select name="availability" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-classio-navy focus:ring-classio-navy sm:text-sm">
                                <option value="in_stock">In Stock</option>
                                <option value="out_of_stock">Out of Stock</option>
                            </select>
                        </div>
                        
                        <div class="sm:col-span-6 flex items-center justify-between mt-2">
                            <div class="flex items-center">
                                <input id="is_default" name="is_default" type="checkbox" value="1" class="h-4 w-4 rounded border-gray-300 text-classio-navy focus:ring-classio-navy">
                                <label for="is_default" class="ml-2 block text-sm text-gray-900">Set as Default Variant</label>
                            </div>
                            <button type="submit" class="rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-100">Add Variant</button>
                        </div>

                    </div>
                </form>
            </div>
        </div>
    </div>

</div>
@endsection