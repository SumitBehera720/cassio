@extends('admin.layout')

@section('title', 'Add Banner')

@section('content')
<div class="md:flex md:items-center md:justify-between mb-8">
    <div class="min-w-0 flex-1">
        <h2 class="text-2xl font-bold leading-7 text-gray-900 sm:truncate sm:text-3xl sm:tracking-tight">Add Banner</h2>
    </div>
    <div class="mt-4 flex md:ml-4 md:mt-0">
        <a href="{{ route('admin.banners.index') }}" class="inline-flex items-center rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50">Back to list</a>
    </div>
</div>

<form action="{{ route('admin.banners.store') }}" method="POST" enctype="multipart/form-data" class="bg-white shadow-sm ring-1 ring-gray-900/5 sm:rounded-xl md:col-span-2">
    @csrf
    <div class="px-4 py-6 sm:p-8">
        <div class="grid max-w-2xl grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
            
            <div class="sm:col-span-4">
                <label for="placement_section" class="block text-sm font-medium leading-6 text-gray-900">Placement Section</label>
                <div class="mt-2">
                    <select id="placement_section" name="placement_section" required class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-classio-navy sm:text-sm sm:leading-6">
                        <option value="hero_slider" {{ old('placement_section') == 'hero_slider' ? 'selected' : '' }}>Hero Slider</option>
                        <option value="category_banner" {{ old('placement_section') == 'category_banner' ? 'selected' : '' }}>Category Banner</option>
                        <option value="editorial" {{ old('placement_section') == 'editorial' ? 'selected' : '' }}>Editorial / Value Prop</option>
                        <option value="offers" {{ old('placement_section') == 'offers' ? 'selected' : '' }}>Offers</option>
                    </select>
                </div>
                @error('placement_section')<p class="mt-2 text-sm text-red-600">{{ $message }}</p>@enderror
            </div>

            <div class="col-span-full" x-data="{ imagePreview: null }">
                <label for="image" class="block text-sm font-medium leading-6 text-gray-900">Banner Image</label>
                <div class="mt-2 flex items-center gap-x-3">
                    <template x-if="imagePreview">
                        <img :src="imagePreview" class="h-32 w-auto object-cover rounded border border-gray-200">
                    </template>
                    <input type="file" id="image" name="image" accept="image/*" required class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-gray-50 file:text-gray-700 hover:file:bg-gray-100" @change="
                        let file = $event.target.files[0];
                        if (file) {
                            let reader = new FileReader();
                            reader.onload = (e) => { imagePreview = e.target.result };
                            reader.readAsDataURL(file);
                        } else {
                            imagePreview = null;
                        }
                    ">
                </div>
                @error('image')<p class="mt-2 text-sm text-red-600">{{ $message }}</p>@enderror
            </div>

            <div class="sm:col-span-3">
                <label for="title" class="block text-sm font-medium leading-6 text-gray-900">Title (Optional)</label>
                <div class="mt-2">
                    <input type="text" name="title" id="title" value="{{ old('title') }}" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-classio-navy sm:text-sm sm:leading-6">
                </div>
            </div>

            <div class="sm:col-span-3">
                <label for="subtitle" class="block text-sm font-medium leading-6 text-gray-900">Subtitle (Optional)</label>
                <div class="mt-2">
                    <input type="text" name="subtitle" id="subtitle" value="{{ old('subtitle') }}" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-classio-navy sm:text-sm sm:leading-6">
                </div>
            </div>

            <div class="sm:col-span-4">
                <label for="link_url" class="block text-sm font-medium leading-6 text-gray-900">Link URL (Optional)</label>
                <div class="mt-2">
                    <input type="url" name="link_url" id="link_url" value="{{ old('link_url') }}" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-classio-navy sm:text-sm sm:leading-6" placeholder="https://...">
                </div>
            </div>

            <div class="sm:col-span-3">
                <label for="sort_order" class="block text-sm font-medium leading-6 text-gray-900">Sort Order</label>
                <div class="mt-2">
                    <input type="number" name="sort_order" id="sort_order" value="{{ old('sort_order', 0) }}" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-classio-navy sm:text-sm sm:leading-6">
                </div>
            </div>

            <div class="sm:col-span-6">
                <div class="relative flex gap-x-3">
                    <div class="flex h-6 items-center">
                        <input id="is_active" name="is_active" type="checkbox" value="1" {{ old('is_active', true) ? 'checked' : '' }} class="h-4 w-4 rounded border-gray-300 text-classio-navy focus:ring-classio-navy">
                    </div>
                    <div class="text-sm leading-6">
                        <label for="is_active" class="font-medium text-gray-900">Active</label>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <div class="flex items-center justify-end gap-x-6 border-t border-gray-900/10 px-4 py-4 sm:px-8">
        <button type="submit" class="rounded-md bg-classio-navy px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-gray-800">Save Banner</button>
    </div>
</form>
@endsection
