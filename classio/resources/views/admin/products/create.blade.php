@extends('admin.layout')

@section('title', 'Add Product')

@section('content')
<div class="md:flex md:items-center md:justify-between mb-8">
    <div class="min-w-0 flex-1">
        <h2 class="text-2xl font-bold leading-7 text-gray-900 sm:truncate sm:text-3xl sm:tracking-tight">Add Product</h2>
    </div>
    <div class="mt-4 flex md:ml-4 md:mt-0">
        <a href="{{ route('admin.products.index') }}" class="inline-flex items-center rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50">Back to list</a>
    </div>
</div>

<form action="{{ route('admin.products.store') }}" method="POST" class="bg-white shadow-sm ring-1 ring-gray-900/5 sm:rounded-xl md:col-span-2">
    @csrf
    <div class="px-4 py-6 sm:p-8">
        <div class="grid max-w-2xl grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
            
            <div class="sm:col-span-6 border-b border-gray-900/10 pb-4">
                <h2 class="text-base font-semibold leading-7 text-gray-900">Basic Information</h2>
            </div>

            <div class="sm:col-span-4">
                <label for="name" class="block text-sm font-medium leading-6 text-gray-900">Name</label>
                <div class="mt-2">
                    <input type="text" name="name" id="name" value="{{ old('name') }}" required class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-classio-navy sm:text-sm sm:leading-6">
                </div>
                @error('name')<p class="mt-2 text-sm text-red-600">{{ $message }}</p>@enderror
            </div>

            <div class="sm:col-span-4">
                <label for="slug" class="block text-sm font-medium leading-6 text-gray-900">Slug (Optional)</label>
                <div class="mt-2">
                    <input type="text" name="slug" id="slug" value="{{ old('slug') }}" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-classio-navy sm:text-sm sm:leading-6" placeholder="Auto-generated if empty">
                </div>
                @error('slug')<p class="mt-2 text-sm text-red-600">{{ $message }}</p>@enderror
            </div>

            <div class="col-span-full">
                <label for="description" class="block text-sm font-medium leading-6 text-gray-900">Description</label>
                <div class="mt-2">
                    <textarea id="description" name="description" rows="5" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-classio-navy sm:text-sm sm:leading-6">{{ old('description') }}</textarea>
                </div>
                @error('description')<p class="mt-2 text-sm text-red-600">{{ $message }}</p>@enderror
            </div>

            <div class="sm:col-span-6 border-b border-gray-900/10 pt-4 pb-4">
                <h2 class="text-base font-semibold leading-7 text-gray-900">Classification</h2>
            </div>

            <div class="sm:col-span-3">
                <label for="category_id" class="block text-sm font-medium leading-6 text-gray-900">Category</label>
                <div class="mt-2">
                    <select id="category_id" name="category_id" required class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-classio-navy sm:text-sm sm:leading-6">
                        <option value="">Select a category</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>
                @error('category_id')<p class="mt-2 text-sm text-red-600">{{ $message }}</p>@enderror
            </div>

            <div class="sm:col-span-3">
                <label for="subcategory_id" class="block text-sm font-medium leading-6 text-gray-900">Subcategory (Optional)</label>
                <div class="mt-2">
                    <select id="subcategory_id" name="subcategory_id" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-classio-navy sm:text-sm sm:leading-6">
                        <option value="">None</option>
                        @foreach($subcategories as $sub)
                            <option value="{{ $sub->id }}" {{ old('subcategory_id') == $sub->id ? 'selected' : '' }}>{{ $sub->name }} ({{ $sub->category->name ?? '' }})</option>
                        @endforeach
                    </select>
                </div>
                @error('subcategory_id')<p class="mt-2 text-sm text-red-600">{{ $message }}</p>@enderror
            </div>

            <div class="sm:col-span-6 border-b border-gray-900/10 pt-4 pb-4">
                <h2 class="text-base font-semibold leading-7 text-gray-900">Product Flags</h2>
            </div>

            <div class="sm:col-span-3">
                <label for="status" class="block text-sm font-medium leading-6 text-gray-900">Status</label>
                <div class="mt-2">
                    <select id="status" name="status" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-classio-navy sm:text-sm sm:leading-6">
                        <option value="active" {{ old('status', 'active') === 'active' ? 'selected' : '' }}>Active</option>
                        <option value="draft" {{ old('status') === 'draft' ? 'selected' : '' }}>Draft</option>
                        <option value="archived" {{ old('status') === 'archived' ? 'selected' : '' }}>Archived</option>
                    </select>
                </div>
            </div>

            <div class="sm:col-span-6">
                <fieldset>
                    <legend class="sr-only">Flags</legend>
                    <div class="space-y-4">
                        <div class="relative flex items-start">
                            <div class="flex h-6 items-center">
                                <input id="is_featured" name="is_featured" type="checkbox" value="1" {{ old('is_featured') ? 'checked' : '' }} class="h-4 w-4 rounded border-gray-300 text-classio-navy focus:ring-classio-navy">
                            </div>
                            <div class="ml-3 text-sm leading-6">
                                <label for="is_featured" class="font-medium text-gray-900">Featured</label>
                                <p class="text-gray-500">Show in featured sections.</p>
                            </div>
                        </div>
                        <div class="relative flex items-start">
                            <div class="flex h-6 items-center">
                                <input id="is_trending" name="is_trending" type="checkbox" value="1" {{ old('is_trending') ? 'checked' : '' }} class="h-4 w-4 rounded border-gray-300 text-classio-navy focus:ring-classio-navy">
                            </div>
                            <div class="ml-3 text-sm leading-6">
                                <label for="is_trending" class="font-medium text-gray-900">Trending</label>
                            </div>
                        </div>
                        <div class="relative flex items-start">
                            <div class="flex h-6 items-center">
                                <input id="is_new" name="is_new" type="checkbox" value="1" {{ old('is_new') ? 'checked' : '' }} class="h-4 w-4 rounded border-gray-300 text-classio-navy focus:ring-classio-navy">
                            </div>
                            <div class="ml-3 text-sm leading-6">
                                <label for="is_new" class="font-medium text-gray-900">New Arrival</label>
                            </div>
                        </div>
                    </div>
                </fieldset>
            </div>
            
            <div class="sm:col-span-6 bg-gray-50 p-4 rounded-md mt-4 border border-gray-200">
                <p class="text-sm text-gray-600"><strong>Note:</strong> Price and Stock are not set here. You will be able to add Product Variants and Images after saving the basic product information.</p>
            </div>

        </div>
    </div>
    <div class="flex items-center justify-end gap-x-6 border-t border-gray-900/10 px-4 py-4 sm:px-8">
        <a href="{{ route('admin.products.index') }}" class="text-sm font-semibold leading-6 text-gray-900">Cancel</a>
        <button type="submit" class="rounded-md bg-classio-navy px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-gray-800 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-classio-navy">Save & Continue</button>
    </div>
</form>
@endsection