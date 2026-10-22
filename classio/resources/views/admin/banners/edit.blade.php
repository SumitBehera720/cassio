@extends('admin.layout')

@section('title', 'Edit Banner')

@section('content')
<div class="max-w-4xl mx-auto space-y-6">
    <div class="sm:flex sm:items-center sm:justify-between pb-4 border-b border-gray-200">
        <div>
            <h1 class="text-2xl font-bold tracking-tight text-gray-900">Edit Banner #{{ $banner->id }}</h1>
            <p class="mt-1 text-sm text-gray-500">Update banner graphic, target links, and storefront placement.</p>
        </div>
        <div class="mt-4 sm:mt-0 flex items-center gap-3">
            <a href="{{ route('admin.banners.index') }}" class="inline-flex items-center gap-1.5 px-3 py-2 text-sm font-semibold text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 shadow-sm transition">
                ← Back to Banners
            </a>
        </div>
    </div>

    @if($errors->any())
        <div class="p-4 rounded-xl bg-red-50 border border-red-200 text-red-800">
            <h3 class="text-sm font-semibold mb-1">Please correct the errors below:</h3>
            <ul class="list-disc list-inside text-xs space-y-1">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.banners.update', $banner) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf
        @method('PUT')

        <div class="bg-white rounded-2xl shadow-sm ring-1 ring-gray-900/5 p-6 sm:p-8 space-y-6">
            <!-- Placement Section -->
            <div>
                <label for="placement_section" class="block text-xs font-semibold uppercase tracking-wider text-gray-700 mb-1.5">
                    Storefront Section Placement <span class="text-red-500">*</span>
                </label>
                <select id="placement_section" name="placement_section" required class="w-full rounded-lg border-gray-300 py-2.5 px-3.5 text-sm shadow-sm focus:border-classio-navy focus:ring-classio-navy">
                    <option value="hero_slider" {{ old('placement_section', $banner->placement_section) == 'hero_slider' ? 'selected' : '' }}>
                        🌟 Homepage Hero Slider (Main top full-width banner)
                    </option>
                    <option value="ladies_collection" {{ old('placement_section', $banner->placement_section) == 'ladies_collection' ? 'selected' : '' }}>
                        👗 Ladies Collection Showcase (Beside ladies products on homepage)
                    </option>
                    <option value="gents_collection" {{ old('placement_section', $banner->placement_section) == 'gents_collection' ? 'selected' : '' }}>
                        👔 Gents Collection Showcase (Beside gents products on homepage)
                    </option>
                    <option value="watches_perfumes" {{ old('placement_section', $banner->placement_section) == 'watches_perfumes' ? 'selected' : '' }}>
                        ⌚ Watches & Perfumes Showcase (Beside watches on homepage)
                    </option>
                    <option value="category_banner" {{ old('placement_section', $banner->placement_section) == 'category_banner' ? 'selected' : '' }}>
                        📂 Category Header Banner (Top banner on category pages)
                    </option>
                    <option value="offers" {{ old('placement_section', $banner->placement_section) == 'offers' ? 'selected' : '' }}>
                        🏷️ Special Offers & Flash Deals Banner
                    </option>
                    <option value="editorial" {{ old('placement_section', $banner->placement_section) == 'editorial' ? 'selected' : '' }}>
                        ✨ Editorial & Brand Story Banner
                    </option>
                </select>
                <p class="mt-1.5 text-xs text-gray-400">Determines where this banner will be rendered on the website.</p>
            </div>

            <!-- Image Upload & Preview -->
            <div x-data="{ previewUrl: '{{ $banner->image_url }}' }">
                <label class="block text-xs font-semibold uppercase tracking-wider text-gray-700 mb-1.5">
                    Banner Graphic Image
                </label>

                <!-- Current / New Preview Frame -->
                <div class="mb-3 rounded-xl overflow-hidden border border-gray-200 bg-gray-50 aspect-21/9 flex items-center justify-center relative">
                    <template x-if="previewUrl">
                        <img :src="previewUrl" class="w-full h-full object-cover">
                    </template>
                    <template x-if="!previewUrl">
                        <div class="text-center p-6 text-gray-400">
                            <span class="text-xs">No image selected</span>
                        </div>
                    </template>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <span class="block text-xs font-medium text-gray-600 mb-1">Replace Image File:</span>
                        <input type="file" id="image" name="image" accept="image/*" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-xs file:font-semibold file:bg-classio-navy file:text-white hover:file:bg-gray-800" @change="
                            let file = $event.target.files[0];
                            if (file) {
                                let reader = new FileReader();
                                reader.onload = (e) => { previewUrl = e.target.result };
                                reader.readAsDataURL(file);
                            }
                        ">
                    </div>
                    <div>
                        <span class="block text-xs font-medium text-gray-600 mb-1">Or Update Image Path / URL:</span>
                        <input type="text" name="image_url" id="image_url" value="{{ old('image_url', $banner->image_path) }}" placeholder="https://... or images/classio/..." class="w-full rounded-lg border-gray-300 py-2 px-3 text-sm shadow-sm focus:border-classio-navy focus:ring-classio-navy" @input="previewUrl = $event.target.value">
                    </div>
                </div>
                <p class="mt-2 text-xs text-gray-400">Leave file empty to keep current image. Current path: <code class="font-mono text-gray-600">{{ $banner->image_path }}</code></p>
            </div>

            <!-- Title & Subtitle -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                <div>
                    <label for="title" class="block text-xs font-semibold uppercase tracking-wider text-gray-700 mb-1.5">Banner Heading Title (Optional)</label>
                    <input type="text" name="title" id="title" value="{{ old('title', $banner->title) }}" placeholder="e.g. Modern Gentleman Style" class="w-full rounded-lg border-gray-300 py-2.5 px-3.5 text-sm shadow-sm focus:border-classio-navy focus:ring-classio-navy">
                </div>

                <div>
                    <label for="subtitle" class="block text-xs font-semibold uppercase tracking-wider text-gray-700 mb-1.5">Banner Subtitle / Description (Optional)</label>
                    <input type="text" name="subtitle" id="subtitle" value="{{ old('subtitle', $banner->subtitle) }}" placeholder="e.g. Handcrafted suits, blazers, and shoes" class="w-full rounded-lg border-gray-300 py-2.5 px-3.5 text-sm shadow-sm focus:border-classio-navy focus:ring-classio-navy">
                </div>
            </div>

            <!-- Link URL & Sort Order -->
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-6">
                <div class="sm:col-span-2">
                    <label for="link_url" class="block text-xs font-semibold uppercase tracking-wider text-gray-700 mb-1.5">Destination Link URL (Optional)</label>
                    <input type="text" name="link_url" id="link_url" value="{{ old('link_url', $banner->link_url) }}" placeholder="/category/gents-collection or https://..." class="w-full rounded-lg border-gray-300 py-2.5 px-3.5 text-sm shadow-sm focus:border-classio-navy focus:ring-classio-navy">
                    <p class="mt-1 text-xs text-gray-400">Clicking the banner will navigate the customer to this page.</p>
                </div>

                <div>
                    <label for="sort_order" class="block text-xs font-semibold uppercase tracking-wider text-gray-700 mb-1.5">Display Sort Order</label>
                    <input type="number" name="sort_order" id="sort_order" value="{{ old('sort_order', $banner->sort_order) }}" min="0" class="w-full rounded-lg border-gray-300 py-2.5 px-3.5 text-sm shadow-sm focus:border-classio-navy focus:ring-classio-navy">
                    <p class="mt-1 text-xs text-gray-400">Lower numbers appear first.</p>
                </div>
            </div>

            <!-- Active Status Toggle -->
            <div class="pt-4 border-t border-gray-100 flex items-center justify-between">
                <div>
                    <span class="text-sm font-semibold text-gray-900">Banner Live Status</span>
                    <p class="text-xs text-gray-500">Toggle whether this banner is currently visible on the live storefront.</p>
                </div>
                <label class="relative inline-flex items-center cursor-pointer">
                    <input type="checkbox" name="is_active" value="1" class="sr-only peer" {{ old('is_active', $banner->is_active) ? 'checked' : '' }}>
                    <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-emerald-600"></div>
                </label>
            </div>
        </div>

        <div class="flex items-center justify-end gap-3">
            <a href="{{ route('admin.banners.index') }}" class="px-4 py-2.5 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-xl hover:bg-gray-50 shadow-sm transition">Cancel</a>
            <button type="submit" class="px-6 py-2.5 text-sm font-semibold text-white bg-classio-navy rounded-xl hover:bg-gray-800 shadow-md transition">
                Save Changes
            </button>
        </div>
    </form>
</div>
@endsection
