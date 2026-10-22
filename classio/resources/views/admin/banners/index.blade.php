@extends('admin.layout')

@section('title', 'Banners Management')

@section('content')
<div class="space-y-6">
    <!-- Header -->
    <div class="sm:flex sm:items-center sm:justify-between pb-2 border-b border-gray-200">
        <div>
            <h1 class="text-2xl font-bold tracking-tight text-gray-900">Store Banners & Showcases</h1>
            <p class="mt-1 text-sm text-gray-500">Manage promotional hero sliders, collection showcases, and campaign graphics displayed across your storefront.</p>
        </div>
        <div class="mt-4 sm:mt-0 flex items-center gap-3">
            <a href="{{ route('home') }}" target="_blank" class="inline-flex items-center gap-1.5 px-3.5 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 shadow-sm transition">
                <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                View Live Store
            </a>
            <a href="{{ route('admin.banners.create') }}" class="inline-flex items-center gap-1.5 px-4 py-2 text-sm font-semibold text-white bg-classio-navy rounded-lg hover:bg-gray-800 shadow-sm transition">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                Add New Banner
            </a>
        </div>
    </div>

    @if(session('success'))
        <div class="p-4 rounded-xl bg-emerald-50 border border-emerald-200 text-emerald-800 flex items-center justify-between">
            <div class="flex items-center gap-3">
                <div class="w-8 h-8 rounded-full bg-emerald-100 flex items-center justify-center shrink-0 text-emerald-600">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                </div>
                <div>
                    <h3 class="font-semibold text-sm">Success</h3>
                    <p class="text-xs text-emerald-700">{{ session('success') }}</p>
                </div>
            </div>
            <button type="button" onclick="this.parentElement.remove()" class="text-emerald-500 hover:text-emerald-700 text-sm font-medium">Dismiss</button>
        </div>
    @endif

    <!-- Placement Section Filter & Helper Guide -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-4">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div class="flex flex-wrap items-center gap-2">
                <span class="text-xs font-semibold text-gray-500 uppercase tracking-wider mr-1">Section:</span>
                <a href="{{ route('admin.banners.index') }}" class="px-3 py-1.5 rounded-lg text-xs font-semibold transition {{ !request('placement') ? 'bg-classio-navy text-white' : 'bg-gray-100 text-gray-700 hover:bg-gray-200' }}">
                    All Banners ({{ $banners->total() }})
                </a>
                <a href="{{ route('admin.banners.index', ['placement' => 'hero_slider']) }}" class="px-3 py-1.5 rounded-lg text-xs font-semibold transition {{ request('placement') === 'hero_slider' ? 'bg-classio-navy text-white' : 'bg-gray-100 text-gray-700 hover:bg-gray-200' }}">
                    Hero Slider
                </a>
                <a href="{{ route('admin.banners.index', ['placement' => 'ladies_collection']) }}" class="px-3 py-1.5 rounded-lg text-xs font-semibold transition {{ request('placement') === 'ladies_collection' ? 'bg-classio-navy text-white' : 'bg-gray-100 text-gray-700 hover:bg-gray-200' }}">
                    Ladies Showcase
                </a>
                <a href="{{ route('admin.banners.index', ['placement' => 'gents_collection']) }}" class="px-3 py-1.5 rounded-lg text-xs font-semibold transition {{ request('placement') === 'gents_collection' ? 'bg-classio-navy text-white' : 'bg-gray-100 text-gray-700 hover:bg-gray-200' }}">
                    Gents Showcase
                </a>
                <a href="{{ route('admin.banners.index', ['placement' => 'watches_perfumes']) }}" class="px-3 py-1.5 rounded-lg text-xs font-semibold transition {{ request('placement') === 'watches_perfumes' ? 'bg-classio-navy text-white' : 'bg-gray-100 text-gray-700 hover:bg-gray-200' }}">
                    Watches & Perfumes
                </a>
            </div>

            <div class="text-xs text-gray-400">
                Sorted by Placement & Order
            </div>
        </div>
    </div>

    <!-- Visual Banner Cards Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        @forelse($banners as $banner)
        <div class="bg-white rounded-2xl shadow-sm border border-gray-200 overflow-hidden hover:shadow-md transition flex flex-col group">
            <!-- Banner Image Preview with Overlay Info -->
            <div class="relative aspect-16/9 bg-gray-100 overflow-hidden">
                <img src="{{ $banner->image_url }}" alt="{{ $banner->title ?? 'Banner' }}" class="w-full h-full object-cover group-hover:scale-105 transition duration-500" onerror="this.onerror=null; this.src='{{ asset('images/classio/hero_model.jpg') }}';">
                
                <!-- Top Floating Badges -->
                <div class="absolute top-3 left-3 right-3 flex items-center justify-between pointer-events-none">
                    <span class="inline-flex items-center px-2.5 py-1 rounded-md text-xs font-bold bg-[#0B1A2C]/90 text-amber-200 backdrop-blur-sm shadow-sm">
                        {{ $banner->placement_name }}
                    </span>
                    @if($banner->is_active)
                        <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-md text-xs font-semibold bg-emerald-600/90 text-white backdrop-blur-sm shadow-sm">
                            <span class="w-1.5 h-1.5 rounded-full bg-white animate-pulse"></span>
                            Live
                        </span>
                    @else
                        <span class="inline-flex items-center px-2.5 py-1 rounded-md text-xs font-semibold bg-gray-800/80 text-gray-300 backdrop-blur-sm shadow-sm">
                            Inactive
                        </span>
                    @endif
                </div>

                <!-- Bottom Floating Link -->
                @if($banner->link_url)
                    <div class="absolute bottom-3 left-3 right-3">
                        <a href="{{ $banner->link_url }}" target="_blank" class="inline-flex items-center gap-1 px-2.5 py-1 rounded-md text-xs font-medium bg-black/60 text-white hover:bg-black/80 backdrop-blur-sm transition">
                            <svg class="w-3.5 h-3.5 text-amber-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"/></svg>
                            <span class="truncate max-w-[260px]">{{ $banner->link_url }}</span>
                            <span class="text-amber-300">↗</span>
                        </a>
                    </div>
                @endif
            </div>

            <!-- Banner Details & Controls -->
            <div class="p-5 flex-1 flex flex-col justify-between">
                <div>
                    <div class="flex items-start justify-between gap-2 mb-1.5">
                        <h3 class="font-bold text-gray-900 text-base leading-snug line-clamp-2">
                            {{ $banner->title ?: 'Banner #' . $banner->id }}
                        </h3>
                        <span class="text-xs font-mono text-gray-400 shrink-0 bg-gray-50 px-2 py-0.5 rounded border border-gray-100">
                            Order: {{ $banner->sort_order }}
                        </span>
                    </div>
                    @if($banner->subtitle)
                        <p class="text-xs text-gray-500 line-clamp-2 leading-relaxed">
                            {{ $banner->subtitle }}
                        </p>
                    @endif
                    <div class="mt-3 text-[11px] text-gray-400 font-mono truncate">
                        File: {{ basename($banner->image_path) }}
                    </div>
                </div>

                <!-- Action Toolbar -->
                <div class="mt-5 pt-4 border-t border-gray-100 flex items-center justify-between">
                    <span class="text-xs text-gray-400">
                        Section: <strong class="text-gray-700 font-medium">{{ $banner->placement_section }}</strong>
                    </span>
                    <div class="flex items-center gap-2">
                        <a href="{{ route('admin.banners.edit', $banner) }}" class="inline-flex items-center gap-1 px-3 py-1.5 rounded-lg text-xs font-semibold text-gray-700 bg-gray-100 hover:bg-gray-200 transition">
                            <svg class="w-3.5 h-3.5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                            Edit Banner
                        </a>
                        <form action="{{ route('admin.banners.destroy', $banner) }}" method="POST" class="inline-block" onsubmit="return confirm('Delete this banner?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="p-1.5 rounded-lg text-red-600 hover:bg-red-50 transition" title="Delete banner">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        @empty
        <div class="col-span-full bg-white rounded-2xl shadow-sm border border-gray-200 p-12 text-center">
            <div class="mx-auto w-12 h-12 rounded-full bg-gray-100 flex items-center justify-center text-gray-400 mb-3">
                <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
            </div>
            <h3 class="text-sm font-semibold text-gray-900">No banners found</h3>
            <p class="mt-1 text-xs text-gray-500">There are no banners created for this placement section yet.</p>
            <div class="mt-4">
                <a href="{{ route('admin.banners.create') }}" class="inline-flex items-center px-4 py-2 text-xs font-semibold text-white bg-classio-navy rounded-lg hover:bg-gray-800 shadow-sm">
                    + Add New Banner
                </a>
            </div>
        </div>
        @endforelse
    </div>

    @if($banners->hasPages())
        <div class="mt-6">
            {{ $banners->links() }}
        </div>
    @endif
</div>
@endsection