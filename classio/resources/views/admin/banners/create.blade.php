@extends('admin.layout')

@section('title', 'Add Banner')

@section('content')
<div class="max-w-4xl mx-auto space-y-6">
    <div class="sm:flex sm:items-center sm:justify-between pb-4 border-b border-gray-200">
        <div>
            <h1 class="text-2xl font-bold tracking-tight text-gray-900">Add New Banner</h1>
            <p class="mt-1 text-sm text-gray-500">Upload a promotional or showcase banner for your storefront.</p>
        </div>
        <div class="mt-4 sm:mt-0">
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

    <form action="{{ route('admin.banners.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf

        <div class="bg-white rounded-2xl shadow-sm ring-1 ring-gray-900/5 p-6 sm:p-8 space-y-6">
            <!-- Placement Section -->
            <div>
                <label for="placement_section" class="block text-xs font-semibold uppercase tracking-wider text-gray-700 mb-1.5">
                    Storefront Section Placement <span class="text-red-500">*</span>
                </label>
                <select id="placement_section" name="placement_section" required class="w-full rounded-lg border-gray-300 py-2.5 px-3.5 text-sm shadow-sm focus:border-classio-navy focus:ring-classio-navy">
                    <option value="hero_slider" {{ old('placement_section') == 'hero_slider' ? 'selected' : '' }}>
                        🌟 Homepage Hero Slider (Main top full-width banner)
                    </option>
                    <option value="ladies_collection" {{ old('placement_section') == 'ladies_collection' ? 'selected' : '' }}>
                        👗 Ladies Collection Showcase (Beside ladies products on homepage)
                    </option>
                    <option value="gents_collection" {{ old('placement_section') == 'gents_collection' ? 'selected' : '' }}>
                        👔 Gents Collection Showcase (Beside gents products on homepage)
                    </option>
                    <option value="watches_perfumes" {{ old('placement_section') == 'watches_perfumes' ? 'selected' : '' }}>
                        ⌚ Watches & Perfumes Showcase (Beside watches on homepage)
                    </option>
                    <option value="category_banner" {{ old('placement_section') == 'category_banner' ? 'selected' : '' }}>
                        📂 Category Header Banner (Top banner on category pages)
                    </option>
                    <option value="offers" {{ old('placement_section') == 'offers' ? 'selected' : '' }}>
                        🏷️ Special Offers & Flash Deals Banner
                    </option>
                    <option value="editorial" {{ old('placement_section') == 'editorial' ? 'selected' : '' }}>
                        ✨ Editorial & Brand Story Banner
                    </option>
                </select>
                <p class="mt-1.5 text-xs text-gray-400">Determines where this banner will be rendered on the website.</p>
            </div>

            <!-- Image Upload & Preview -->
            <div x-data="{ previewUrl: null }">
                <label class="block text-xs font-semibold uppercase tracking-wider text-gray-700 mb-1.5">
                    Banner Graphic Image <span class="text-red-500">*</span>
                </label>

                <!-- Live Preview Frame -->
                <div class="mb-3 rounded-xl overflow-hidden border border-gray-200 bg-gray-50 aspect-21/9 flex items-center justify-center relative">
                    <template x-if="previewUrl">
                        <img :src="previewUrl" class="w-full h-full object-cover">
                    </template>
                    <template x-if="!previewUrl">
                        <div class="text-center p-6 text-gray-400">
                            <svg class="mx-auto h-12 w-12 text-gray-300 mb-2" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                            <span class="text-xs">Image preview will appear here</span>
                        </div>
                    </template>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <span class="block text-xs font-medium text-gray-600 mb-1">Option A: Upload File</span>
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
                        <span class="block text-xs font-medium text-gray-600 mb-1">Option B: Or Enter Image URL / Path</span>
                        <input type="text" name="image_url" id="image_url" value="{{ old('image_url') }}" placeholder="https://... or images/classio/..." class="w-full rounded-lg border-gray-300 py-2 px-3 text-sm shadow-sm focus:border-classio-navy focus:ring-classio-navy" @input="previewUrl = $event.target.value">
                    </div>
                </div>
                <p class="mt-2 text-xs text-gray-400">Recommended: 1920x800px (Hero), 1200x800px (Showcase). Formats: JPG, PNG, WEBP.</p>
            </div>

            <!-- Title & Subtitle -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                <div>
                    <label for="title" class="block text-xs font-semibold uppercase tracking-wider text-gray-700 mb-1.5">Banner Heading Title (Optional)</label>
                    <input type="text" name="title" id="title" value="{{ old('title') }}" placeholder="e.g. Modern Gentleman Style" class="w-full rounded-lg border-gray-300 py-2.5 px-3.5 text-sm shadow-sm focus:border-classio-navy focus:ring-classio-navy">
                </div>

                <div>
                    <label for="subtitle" class="block text-xs font-semibold uppercase tracking-wider text-gray-700 mb-1.5">Banner Subtitle / Description (Optional)</label>
                    <input type="text" name="subtitle" id="subtitle" value="{{ old('subtitle') }}" placeholder="e.g. Handcrafted suits, blazers, and shoes" class="w-full rounded-lg border-gray-300 py-2.5 px-3.5 text-sm shadow-sm focus:border-classio-navy focus:ring-classio-navy">
                </div>
            </div>

            <!-- Link URL & Sort Order -->
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-6">
                <div class="sm:col-span-2">
                    <label for="link_url" class="block text-xs font-semibold uppercase tracking-wider text-gray-700 mb-1.5">Destination Link URL (Optional)</label>
                    <input type="text" name="link_url" id="link_url" value="{{ old('link_url') }}" placeholder="/category/gents-collection or https://..." class="w-full rounded-lg border-gray-300 py-2.5 px-3.5 text-sm shadow-sm focus:border-classio-navy focus:ring-classio-navy">
                    <p class="mt-1 text-xs text-gray-400">Clicking the banner will navigate the customer to this page.</p>
                </div>

                <div>
                    <label for="sort_order" class="block text-xs font-semibold uppercase tracking-wider text-gray-700 mb-1.5">Display Sort Order</label>
                    <input type="number" name="sort_order" id="sort_order" value="{{ old('sort_order', 1) }}" min="0" class="w-full rounded-lg border-gray-300 py-2.5 px-3.5 text-sm shadow-sm focus:border-classio-navy focus:ring-classio-navy">
                    <p class="mt-1 text-xs text-gray-400">Lower numbers appear first.</p>
                </div>
            </div>

            <!-- Active Status Toggle -->
            <div class="pt-4 border-t border-gray-100 flex items-center justify-between">
                <div>
                    <span class="text-sm font-semibold text-gray-900">Publish Immediately</span>
                    <p class="text-xs text-gray-500">Make this banner active on the storefront right away.</p>
                </div>
                <label class="relative inline-flex items-center cursor-pointer">
                    <input type="checkbox" name="is_active" value="1" class="sr-only peer" {{ old('is_active', true) ? 'checked' : '' }}>
                    <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-emerald-600"></div>
                </label>
            </div>
        </div>

        <div class="flex items-center justify-end gap-3">
            <a href="{{ route('admin.banners.index') }}" class="px-4 py-2.5 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-xl hover:bg-gray-50 shadow-sm transition">Cancel</a>
            <button type="submit" class="px-6 py-2.5 text-sm font-semibold text-white bg-classio-navy rounded-xl hover:bg-gray-800 shadow-md transition">
                Save & Publish Banner
            </button>
        </div>
    </form>
</div>
@endsection
