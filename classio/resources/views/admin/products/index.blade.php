@extends('admin.layout')

@section('title', 'Products Management')

@section('content')
<div class="space-y-6">
    <!-- Page Header -->
    <div class="sm:flex sm:items-center sm:justify-between pb-2 border-b border-gray-200">
        <div>
            <h1 class="text-2xl font-bold tracking-tight text-gray-900">Products Catalogue</h1>
            <p class="mt-1 text-sm text-gray-500">Manage your product listings, pricing, inventory stock, and storefront status.</p>
        </div>
        <div class="mt-4 sm:mt-0 flex items-center gap-3">
            <a href="{{ route('home') }}" target="_blank" class="inline-flex items-center gap-1.5 px-3.5 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 shadow-sm transition">
                <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                View Live Store
            </a>
            <a href="{{ route('admin.products.create') }}" class="inline-flex items-center gap-1.5 px-4 py-2 text-sm font-semibold text-white bg-classio-navy rounded-lg hover:bg-gray-800 shadow-sm transition">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                Add New Product
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

    <!-- Metric Counters -->
    <div class="grid grid-cols-2 sm:grid-cols-4 gap-4">
        <a href="{{ route('admin.products.index') }}" class="p-4 rounded-xl bg-white border border-gray-200 hover:border-classio-navy shadow-sm transition group">
            <div class="flex items-center justify-between">
                <span class="text-xs font-semibold uppercase tracking-wider text-gray-500">Total Products</span>
                <span class="w-2.5 h-2.5 rounded-full bg-blue-500"></span>
            </div>
            <div class="mt-2 flex items-baseline gap-2">
                <span class="text-2xl font-bold text-gray-900">{{ $totalCount ?? $products->total() }}</span>
                <span class="text-xs text-gray-500">in catalogue</span>
            </div>
        </a>

        <a href="{{ route('admin.products.index', ['status' => 'active']) }}" class="p-4 rounded-xl bg-white border border-gray-200 hover:border-emerald-600 shadow-sm transition group {{ request('status') === 'active' ? 'ring-2 ring-emerald-500 border-transparent' : '' }}">
            <div class="flex items-center justify-between">
                <span class="text-xs font-semibold uppercase tracking-wider text-emerald-700">Active Online</span>
                <span class="w-2.5 h-2.5 rounded-full bg-emerald-500"></span>
            </div>
            <div class="mt-2 flex items-baseline gap-2">
                <span class="text-2xl font-bold text-emerald-700">{{ $activeCount ?? 0 }}</span>
                <span class="text-xs text-emerald-600">published</span>
            </div>
        </a>

        <a href="{{ route('admin.products.index', ['status' => 'draft']) }}" class="p-4 rounded-xl bg-white border border-gray-200 hover:border-amber-500 shadow-sm transition group {{ request('status') === 'draft' ? 'ring-2 ring-amber-500 border-transparent' : '' }}">
            <div class="flex items-center justify-between">
                <span class="text-xs font-semibold uppercase tracking-wider text-amber-700">Drafts / Hidden</span>
                <span class="w-2.5 h-2.5 rounded-full bg-amber-400"></span>
            </div>
            <div class="mt-2 flex items-baseline gap-2">
                <span class="text-2xl font-bold text-amber-700">{{ $draftCount ?? 0 }}</span>
                <span class="text-xs text-amber-600">hidden</span>
            </div>
        </a>

        <div class="p-4 rounded-xl bg-white border border-gray-200 shadow-sm">
            <div class="flex items-center justify-between">
                <span class="text-xs font-semibold uppercase tracking-wider text-gray-500">Categories</span>
                <span class="w-2.5 h-2.5 rounded-full bg-purple-500"></span>
            </div>
            <div class="mt-2 flex items-baseline gap-2">
                <span class="text-2xl font-bold text-purple-700">{{ $categories->count() }}</span>
                <span class="text-xs text-gray-500">sections</span>
            </div>
        </div>
    </div>

    <!-- Filters & Search Toolbar -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-4">
        <form action="{{ route('admin.products.index') }}" method="GET" class="flex flex-col lg:flex-row gap-3">
            <!-- Search Input -->
            <div class="relative flex-1">
                <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
                    <svg class="h-4 w-4 text-gray-400" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M9 3.5a5.5 5.5 0 100 11 5.5 5.5 0 000-11zM2 9a7 7 0 1112.452 4.391l3.328 3.329a.75.75 0 11-1.06 1.06l-3.329-3.328A7 7 0 012 9z" clip-rule="evenodd"/></svg>
                </div>
                <input type="text" name="search" id="search" value="{{ request('search') }}" placeholder="Search by product name, slug, or description..." class="block w-full rounded-lg border-gray-300 pl-9 pr-8 py-2 text-sm placeholder-gray-400 focus:border-classio-navy focus:ring-classio-navy">
                @if(request('search'))
                    <a href="{{ route('admin.products.index', request()->except('search')) }}" class="absolute inset-y-0 right-0 flex items-center pr-2.5 text-gray-400 hover:text-gray-600">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                    </a>
                @endif
            </div>

            <!-- Category Filter -->
            <div class="w-full lg:w-56 shrink-0">
                <select name="category_id" id="category_id" onchange="this.form.submit()" class="block w-full rounded-lg border-gray-300 py-2 pl-3 pr-8 text-sm focus:border-classio-navy focus:ring-classio-navy">
                    <option value="">All Categories ({{ $totalCount ?? $products->total() }})</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ request('category_id') == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Status Filter -->
            <div class="w-full lg:w-44 shrink-0">
                <select name="status" id="status" onchange="this.form.submit()" class="block w-full rounded-lg border-gray-300 py-2 pl-3 pr-8 text-sm focus:border-classio-navy focus:ring-classio-navy">
                    <option value="">All Statuses</option>
                    <option value="active" {{ request('status') === 'active' ? 'selected' : '' }}>🟢 Active Only</option>
                    <option value="draft" {{ request('status') === 'draft' ? 'selected' : '' }}>🟡 Draft Only</option>
                    <option value="archived" {{ request('status') === 'archived' ? 'selected' : '' }}>⚪ Archived</option>
                </select>
            </div>

            <!-- Stock Filter -->
            <div class="w-full lg:w-44 shrink-0">
                <select name="stock" id="stock" onchange="this.form.submit()" class="block w-full rounded-lg border-gray-300 py-2 pl-3 pr-8 text-sm focus:border-classio-navy focus:ring-classio-navy">
                    <option value="">All Stock</option>
                    <option value="in_stock" {{ request('stock') === 'in_stock' ? 'selected' : '' }}>✓ In Stock Only</option>
                    <option value="out_of_stock" {{ request('stock') === 'out_of_stock' ? 'selected' : '' }}>✕ Out of Stock</option>
                </select>
            </div>

            <!-- Filter Buttons -->
            <div class="flex items-center gap-2">
                <button type="submit" class="px-4 py-2 text-sm font-medium text-white bg-classio-navy rounded-lg hover:bg-gray-800 transition">
                    Filter
                </button>
                @if(request()->hasAny(['search', 'category_id', 'status', 'stock']))
                    <a href="{{ route('admin.products.index') }}" class="px-3 py-2 text-sm font-medium text-gray-600 bg-gray-100 rounded-lg hover:bg-gray-200 transition" title="Clear all filters">
                        Reset
                    </a>
                @endif
            </div>
        </form>
    </div>

    <!-- Products Table -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200 text-left text-sm">
                <thead class="bg-gray-50/75">
                    <tr>
                        <th scope="col" class="py-3.5 pl-4 pr-3 font-semibold text-gray-900 sm:pl-6">Product</th>
                        <th scope="col" class="px-3 py-3.5 font-semibold text-gray-900">Category</th>
                        <th scope="col" class="px-3 py-3.5 font-semibold text-gray-900">Price & Offer</th>
                        <th scope="col" class="px-3 py-3.5 font-semibold text-gray-900">Stock & Variants</th>
                        <th scope="col" class="px-3 py-3.5 font-semibold text-gray-900">Status</th>
                        <th scope="col" class="relative py-3.5 pl-3 pr-4 sm:pr-6 text-right font-semibold text-gray-900">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 bg-white">
                    @forelse($products as $product)
                    <tr class="hover:bg-gray-50/60 transition">
                        <!-- Product thumbnail + name + live view link -->
                        <td class="py-3.5 pl-4 pr-3 sm:pl-6 max-w-xs">
                            <div class="flex items-center gap-3.5">
                                <div class="relative w-12 h-14 shrink-0 rounded-lg overflow-hidden border border-gray-200 bg-gray-50 shadow-2xs">
                                    <img src="{{ $product->primary_image_url }}" alt="{{ $product->name }}" class="w-full h-full object-cover object-center" onerror="this.onerror=null; this.src='{{ asset('images/classio/product_coming_soon.jpg') }}';">
                                </div>
                                <div class="min-w-0 flex-1">
                                    <div class="flex items-center gap-2">
                                        <a href="{{ route('admin.products.edit', $product) }}" class="font-semibold text-gray-900 hover:text-classio-navy truncate text-sm" title="{{ $product->name }}">
                                            {{ $product->name }}
                                        </a>
                                    </div>
                                    <div class="flex items-center gap-2 mt-0.5">
                                        <span class="text-xs text-gray-400 font-mono truncate max-w-[140px]">{{ $product->slug }}</span>
                                        <a href="{{ route('product.show', $product->slug) }}" target="_blank" class="inline-flex items-center gap-0.5 text-[11px] font-medium text-amber-700 hover:text-amber-800 hover:underline shrink-0" title="Preview live on storefront">
                                            <span>View Live</span>
                                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                                        </a>
                                    </div>
                                    <!-- Badges: Featured, Trending, New -->
                                    <div class="flex flex-wrap items-center gap-1 mt-1.5">
                                        @if($product->is_featured)
                                            <span class="inline-flex items-center px-1.5 py-0.5 rounded text-[10px] font-medium bg-blue-50 text-blue-700 border border-blue-200">Featured</span>
                                        @endif
                                        @if($product->is_trending)
                                            <span class="inline-flex items-center px-1.5 py-0.5 rounded text-[10px] font-medium bg-rose-50 text-rose-700 border border-rose-200">Trending</span>
                                        @endif
                                        @if($product->is_new)
                                            <span class="inline-flex items-center px-1.5 py-0.5 rounded text-[10px] font-medium bg-emerald-50 text-emerald-700 border border-emerald-200">New</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </td>

                        <!-- Category -->
                        <td class="whitespace-nowrap px-3 py-3.5 text-sm">
                            <span class="inline-flex items-center px-2 py-1 rounded-md text-xs font-medium bg-gray-100 text-gray-800">
                                {{ $product->category->name ?? 'Unassigned' }}
                            </span>
                            @if($product->subcategory)
                                <div class="text-[11px] text-gray-400 mt-1 pl-1">{{ $product->subcategory->name }}</div>
                            @endif
                        </td>

                        <!-- Price & Compare Price -->
                        <td class="whitespace-nowrap px-3 py-3.5 text-sm">
                            <div class="font-bold text-gray-900 text-sm">
                                ₹{{ number_format($product->price) }}
                            </div>
                            @if($product->compare_at_price && $product->compare_at_price > $product->price)
                                <div class="flex items-center gap-1.5 mt-0.5">
                                    <span class="text-xs text-gray-400 line-through">₹{{ number_format($product->compare_at_price) }}</span>
                                    <span class="text-[10px] font-semibold text-emerald-600 bg-emerald-50 px-1 rounded">
                                        -{{ round((($product->compare_at_price - $product->price) / $product->compare_at_price) * 100) }}%
                                    </span>
                                </div>
                            @endif
                        </td>

                        <!-- Stock & Variants -->
                        <td class="whitespace-nowrap px-3 py-3.5 text-sm">
                            @if($product->is_in_stock)
                                <span class="inline-flex items-center gap-1.5 px-2 py-0.5 rounded-full text-xs font-medium bg-emerald-50 text-emerald-700 border border-emerald-200/60">
                                    <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                                    In Stock
                                </span>
                            @else
                                <span class="inline-flex items-center gap-1.5 px-2 py-0.5 rounded-full text-xs font-medium bg-rose-50 text-rose-700 border border-rose-200/60">
                                    <span class="w-1.5 h-1.5 rounded-full bg-rose-500"></span>
                                    Out of Stock
                                </span>
                            @endif
                            <div class="text-[11px] text-gray-400 mt-1 pl-1">
                                {{ $product->variants->count() }} {{ \Illuminate\Support\Str::plural('variant', $product->variants->count()) }}
                            </div>
                        </td>

                        <!-- Status -->
                        <td class="whitespace-nowrap px-3 py-3.5 text-sm">
                            @if($product->status === 'active')
                                <span class="inline-flex items-center px-2 py-1 rounded-md text-xs font-semibold bg-emerald-100 text-emerald-800">
                                    Active
                                </span>
                            @elseif($product->status === 'draft')
                                <span class="inline-flex items-center px-2 py-1 rounded-md text-xs font-semibold bg-amber-100 text-amber-800">
                                    Draft
                                </span>
                            @else
                                <span class="inline-flex items-center px-2 py-1 rounded-md text-xs font-semibold bg-gray-100 text-gray-600">
                                    Archived
                                </span>
                            @endif
                        </td>

                        <!-- Actions -->
                        <td class="relative whitespace-nowrap py-3.5 pl-3 pr-4 text-right text-sm font-medium sm:pr-6">
                            <div class="flex items-center justify-end gap-2">
                                <a href="{{ route('admin.products.edit', $product) }}" class="inline-flex items-center gap-1 px-2.5 py-1.5 rounded-lg text-xs font-semibold text-gray-700 bg-gray-100 hover:bg-gray-200 transition">
                                    <svg class="w-3.5 h-3.5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                                    Edit
                                </a>
                                <form action="{{ route('admin.products.destroy', $product) }}" method="POST" class="inline-block" onsubmit="return confirm('Are you sure you want to delete \'{{ addslashes($product->name) }}\'? All variants and images will be permanently removed.');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="p-1.5 rounded-lg text-red-600 hover:bg-red-50 transition" title="Delete product">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="px-6 py-12 text-center">
                            <div class="mx-auto w-12 h-12 rounded-full bg-gray-100 flex items-center justify-center text-gray-400 mb-3">
                                <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/></svg>
                            </div>
                            <h3 class="text-sm font-semibold text-gray-900">No products found</h3>
                            <p class="mt-1 text-xs text-gray-500">Try adjusting your search or filters to find what you're looking for.</p>
                            <div class="mt-4 flex items-center justify-center gap-3">
                                @if(request()->hasAny(['search', 'category_id', 'status', 'stock']))
                                    <a href="{{ route('admin.products.index') }}" class="inline-flex items-center px-3 py-1.5 text-xs font-semibold text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 shadow-sm">
                                        Clear All Filters
                                    </a>
                                @endif
                                <a href="{{ route('admin.products.create') }}" class="inline-flex items-center px-3 py-1.5 text-xs font-semibold text-white bg-classio-navy rounded-lg hover:bg-gray-800 shadow-sm">
                                    + Add New Product
                                </a>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($products->hasPages())
            <div class="px-4 py-3.5 border-t border-gray-200 bg-gray-50/50 sm:px-6">
                {{ $products->links() }}
            </div>
        @endif
    </div>
</div>
@endsection