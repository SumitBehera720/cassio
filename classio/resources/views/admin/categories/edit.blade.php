@extends('admin.layout')

@section('title', 'Edit Category')

@section('content')
<div class="md:flex md:items-center md:justify-between mb-8">
    <div class="min-w-0 flex-1">
        <h2 class="text-2xl font-bold leading-7 text-gray-900 sm:truncate sm:text-3xl sm:tracking-tight">Edit Category: {{ $category->name }}</h2>
    </div>
    <div class="mt-4 flex md:ml-4 md:mt-0">
        <a href="{{ route('admin.categories.index') }}" class="inline-flex items-center rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50">Back to list</a>
    </div>
</div>

<form action="{{ route('admin.categories.update', $category) }}" method="POST" enctype="multipart/form-data" class="bg-white shadow-sm ring-1 ring-gray-900/5 sm:rounded-xl md:col-span-2">
    @csrf
    @method('PUT')
    <div class="px-4 py-6 sm:p-8">
        <div class="grid max-w-2xl grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
            
            <div class="sm:col-span-4">
                <label for="name" class="block text-sm font-medium leading-6 text-gray-900">Name</label>
                <div class="mt-2">
                    <input type="text" name="name" id="name" value="{{ old('name', $category->name) }}" required class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-classio-navy sm:text-sm sm:leading-6">
                </div>
                @error('name')<p class="mt-2 text-sm text-red-600">{{ $message }}</p>@enderror
            </div>

            <div class="sm:col-span-4">
                <label for="slug" class="block text-sm font-medium leading-6 text-gray-900">Slug</label>
                <div class="mt-2">
                    <input type="text" name="slug" id="slug" value="{{ old('slug', $category->slug) }}" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-classio-navy sm:text-sm sm:leading-6">
                </div>
                @error('slug')<p class="mt-2 text-sm text-red-600">{{ $message }}</p>@enderror
            </div>

            <div class="sm:col-span-3">
                <label for="sort_order" class="block text-sm font-medium leading-6 text-gray-900">Sort Order</label>
                <div class="mt-2">
                    <input type="number" name="sort_order" id="sort_order" value="{{ old('sort_order', $category->sort_order) }}" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-classio-navy sm:text-sm sm:leading-6">
                </div>
            </div>

            <div class="sm:col-span-6">
                <div class="relative flex gap-x-3">
                    <div class="flex h-6 items-center">
                        <input id="is_active" name="is_active" type="checkbox" value="1" {{ old('is_active', $category->is_active) ? 'checked' : '' }} class="h-4 w-4 rounded border-gray-300 text-classio-navy focus:ring-classio-navy">
                    </div>
                    <div class="text-sm leading-6">
                        <label for="is_active" class="font-medium text-gray-900">Active</label>
                        <p class="text-gray-500">Category will be visible on the public store.</p>
                    </div>
                </div>
            </div>

            <div class="col-span-full" x-data="{ imagePreview: '{{ $category->image_url ?? '' }}' }">
                <label for="image" class="block text-sm font-medium leading-6 text-gray-900">Category Image</label>
                <div class="mt-2 flex items-center gap-x-3">
                    <template x-if="imagePreview">
                        <img :src="imagePreview" class="h-20 w-20 object-cover rounded bg-gray-100">
                    </template>
                    <template x-if="!imagePreview">
                        <svg class="h-20 w-20 text-gray-300" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
                            <path fill-rule="evenodd" d="M18.685 19.097A9.723 9.723 0 0021.75 12c0-5.385-4.365-9.75-9.75-9.75S2.25 6.615 2.25 12a9.723 9.723 0 003.065 7.097A9.716 9.716 0 0012 21.75a9.716 9.716 0 006.685-2.653zm-12.54-1.285A7.486 7.486 0 0112 15a7.486 7.486 0 015.855 2.812A8.224 8.224 0 0112 20.25a8.224 8.224 0 01-5.855-2.438zM15.75 9a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0z" clip-rule="evenodd" />
                        </svg>
                    </template>
                    <div class="ml-4 flex flex-col gap-2">
                        <input type="file" id="image" name="image" accept="image/*" @change="
                            let file = $event.target.files[0];
                            if (file) {
                                let reader = new FileReader();
                                reader.onload = (e) => { imagePreview = e.target.result };
                                reader.readAsDataURL(file);
                            } else {
                                imagePreview = '{{ $category->image_url ?? '' }}';
                            }
                        ">
                        <p class="text-xs text-gray-500">Leave blank to keep existing image</p>
                    </div>
                </div>
                @error('image')<p class="mt-2 text-sm text-red-600">{{ $message }}</p>@enderror
            </div>

        </div>
    </div>
    <div class="flex items-center justify-end gap-x-6 border-t border-gray-900/10 px-4 py-4 sm:px-8">
        <a href="{{ route('admin.categories.index') }}" class="text-sm font-semibold leading-6 text-gray-900">Cancel</a>
        <button type="submit" class="rounded-md bg-classio-navy px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-gray-800 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-classio-navy">Save Changes</button>
    </div>
</form>
@endsection
