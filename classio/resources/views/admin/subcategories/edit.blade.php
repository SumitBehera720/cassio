@extends('admin.layout')

@section('title', 'Edit Subcategory')

@section('content')
<div class="md:flex md:items-center md:justify-between mb-8">
    <div class="min-w-0 flex-1">
        <h2 class="text-2xl font-bold leading-7 text-gray-900 sm:truncate sm:text-3xl sm:tracking-tight">Edit Subcategory: {{ $subcategory->name }}</h2>
    </div>
    <div class="mt-4 flex md:ml-4 md:mt-0">
        <a href="{{ route('admin.subcategories.index') }}" class="inline-flex items-center rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50">Back to list</a>
    </div>
</div>

<form action="{{ route('admin.subcategories.update', $subcategory) }}" method="POST" class="bg-white shadow-sm ring-1 ring-gray-900/5 sm:rounded-xl md:col-span-2">
    @csrf
    @method('PUT')
    <div class="px-4 py-6 sm:p-8">
        <div class="grid max-w-2xl grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
            
            <div class="sm:col-span-4">
                <label for="category_id" class="block text-sm font-medium leading-6 text-gray-900">Parent Category</label>
                <div class="mt-2">
                    <select id="category_id" name="category_id" required class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-classio-navy sm:text-sm sm:leading-6">
                        <option value="">Select a category</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ old('category_id', $subcategory->category_id) == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>
                @error('category_id')<p class="mt-2 text-sm text-red-600">{{ $message }}</p>@enderror
            </div>

            <div class="sm:col-span-4">
                <label for="name" class="block text-sm font-medium leading-6 text-gray-900">Name</label>
                <div class="mt-2">
                    <input type="text" name="name" id="name" value="{{ old('name', $subcategory->name) }}" required class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-classio-navy sm:text-sm sm:leading-6">
                </div>
                @error('name')<p class="mt-2 text-sm text-red-600">{{ $message }}</p>@enderror
            </div>

            <div class="sm:col-span-4">
                <label for="slug" class="block text-sm font-medium leading-6 text-gray-900">Slug</label>
                <div class="mt-2">
                    <input type="text" name="slug" id="slug" value="{{ old('slug', $subcategory->slug) }}" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-classio-navy sm:text-sm sm:leading-6">
                </div>
                @error('slug')<p class="mt-2 text-sm text-red-600">{{ $message }}</p>@enderror
            </div>

            <div class="sm:col-span-3">
                <label for="sort_order" class="block text-sm font-medium leading-6 text-gray-900">Sort Order</label>
                <div class="mt-2">
                    <input type="number" name="sort_order" id="sort_order" value="{{ old('sort_order', $subcategory->sort_order) }}" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-classio-navy sm:text-sm sm:leading-6">
                </div>
            </div>

            <div class="sm:col-span-6">
                <div class="relative flex gap-x-3">
                    <div class="flex h-6 items-center">
                        <input id="is_active" name="is_active" type="checkbox" value="1" {{ old('is_active', $subcategory->is_active) ? 'checked' : '' }} class="h-4 w-4 rounded border-gray-300 text-classio-navy focus:ring-classio-navy">
                    </div>
                    <div class="text-sm leading-6">
                        <label for="is_active" class="font-medium text-gray-900">Active</label>
                        <p class="text-gray-500">Subcategory will be visible on the public store.</p>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <div class="flex items-center justify-end gap-x-6 border-t border-gray-900/10 px-4 py-4 sm:px-8">
        <a href="{{ route('admin.subcategories.index') }}" class="text-sm font-semibold leading-6 text-gray-900">Cancel</a>
        <button type="submit" class="rounded-md bg-classio-navy px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-gray-800 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-classio-navy">Save Changes</button>
    </div>
</form>
@endsection
