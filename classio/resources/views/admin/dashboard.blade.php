@extends('admin.layout')

@section('title', 'Dashboard')

@section('content')
<div class="md:flex md:items-center md:justify-between mb-8">
    <div class="min-w-0 flex-1">
        <h2 class="text-2xl font-bold leading-7 text-gray-900 sm:truncate sm:text-3xl sm:tracking-tight">Dashboard Overview</h2>
    </div>
</div>

<dl class="mt-5 grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-3">
    
    <div class="relative overflow-hidden rounded-lg bg-white px-4 pb-12 pt-5 shadow sm:px-6 sm:pt-6">
        <dt>
            <div class="absolute rounded-md bg-classio-navy p-3">
                <svg class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6A2.25 2.25 0 016 3.75h2.25A2.25 2.25 0 0110.5 6v2.25a2.25 2.25 0 01-2.25 2.25H6a2.25 2.25 0 01-2.25-2.25V6zM3.75 15.75A2.25 2.25 0 016 13.5h2.25a2.25 2.25 0 012.25 2.25V18a2.25 2.25 0 01-2.25 2.25H6A2.25 2.25 0 013.75 18v-2.25zM13.5 6a2.25 2.25 0 012.25-2.25H18A2.25 2.25 0 0120.25 6v2.25A2.25 2.25 0 0118 10.5h-2.25a2.25 2.25 0 01-2.25-2.25V6zM13.5 15.75a2.25 2.25 0 012.25-2.25H18a2.25 2.25 0 012.25 2.25V18A2.25 2.25 0 0118 20.25h-2.25A2.25 2.25 0 0113.5 18v-2.25z" /></svg>
            </div>
            <p class="ml-16 truncate text-sm font-medium text-gray-500">Total Categories</p>
        </dt>
        <dd class="ml-16 flex items-baseline pb-6 sm:pb-7">
            <p class="text-2xl font-semibold text-gray-900">{{ $stats['categories'] }}</p>
            <div class="absolute inset-x-0 bottom-0 bg-gray-50 px-4 py-4 sm:px-6">
                <div class="text-sm"><a href="{{ route('admin.categories.index') }}" class="font-medium text-classio-champagne hover:text-classio-navy">View all</a></div>
            </div>
        </dd>
    </div>

    <div class="relative overflow-hidden rounded-lg bg-white px-4 pb-12 pt-5 shadow sm:px-6 sm:pt-6">
        <dt>
            <div class="absolute rounded-md bg-classio-navy p-3">
                <svg class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 10.5V6a3.75 3.75 0 10-7.5 0v4.5m11.356-1.993l1.263 12c.07.665-.45 1.243-1.119 1.243H4.25a1.125 1.125 0 01-1.12-1.243l1.264-12A1.125 1.125 0 015.513 7.5h12.974c.576 0 1.059.435 1.119 1.007zM8.625 10.5a.375.375 0 11-.75 0 .375.375 0 01.75 0zm7.5 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z" /></svg>
            </div>
            <p class="ml-16 truncate text-sm font-medium text-gray-500">Total Products</p>
        </dt>
        <dd class="ml-16 flex items-baseline pb-6 sm:pb-7">
            <p class="text-2xl font-semibold text-gray-900">{{ $stats['total_products'] }}</p>
            <p class="ml-2 flex items-baseline text-sm font-semibold text-green-600">{{ $stats['active_products'] }} active</p>
            <div class="absolute inset-x-0 bottom-0 bg-gray-50 px-4 py-4 sm:px-6">
                <div class="text-sm"><a href="{{ route('admin.products.index') }}" class="font-medium text-classio-champagne hover:text-classio-navy">View all</a></div>
            </div>
        </dd>
    </div>

    <div class="relative overflow-hidden rounded-lg bg-white px-4 pb-12 pt-5 shadow sm:px-6 sm:pt-6">
        <dt>
            <div class="absolute rounded-md bg-classio-navy p-3">
                <svg class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 15.75l5.159-5.159a2.25 2.25 0 013.182 0l5.159 5.159m-1.5-1.5l1.409-1.409a2.25 2.25 0 013.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 001.5-1.5V6a1.5 1.5 0 00-1.5-1.5H3.75A1.5 1.5 0 002.25 6v12a1.5 1.5 0 001.5 1.5zm10.5-11.25h.008v.008h-.008V8.25zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z" /></svg>
            </div>
            <p class="ml-16 truncate text-sm font-medium text-gray-500">Active Banners</p>
        </dt>
        <dd class="ml-16 flex items-baseline pb-6 sm:pb-7">
            <p class="text-2xl font-semibold text-gray-900">{{ $stats['active_banners'] }}</p>
            <div class="absolute inset-x-0 bottom-0 bg-gray-50 px-4 py-4 sm:px-6">
                <div class="text-sm"><a href="{{ route('admin.banners.index') }}" class="font-medium text-classio-champagne hover:text-classio-navy">View all</a></div>
            </div>
        </dd>
    </div>
</dl>

<div class="mt-8 grid grid-cols-1 gap-5 lg:grid-cols-2">
    <!-- Subcategories & Variants Snapshot -->
    <div class="overflow-hidden rounded-lg bg-white shadow">
        <div class="p-6">
            <h3 class="text-base font-semibold leading-6 text-gray-900 mb-4">Catalogue Details</h3>
            <ul role="list" class="divide-y divide-gray-200">
                <li class="flex justify-between py-3">
                    <span class="text-sm font-medium text-gray-500">Subcategories</span>
                    <span class="text-sm font-semibold text-gray-900">{{ $stats['subcategories'] }}</span>
                </li>
                <li class="flex justify-between py-3">
                    <span class="text-sm font-medium text-gray-500">Featured Products</span>
                    <span class="text-sm font-semibold text-gray-900">{{ $stats['featured'] }}</span>
                </li>
                <li class="flex justify-between py-3">
                    <span class="text-sm font-medium text-gray-500">Trending Products</span>
                    <span class="text-sm font-semibold text-gray-900">{{ $stats['trending'] }}</span>
                </li>
                <li class="flex justify-between py-3">
                    <span class="text-sm font-medium text-gray-500">New Arrivals</span>
                    <span class="text-sm font-semibold text-gray-900">{{ $stats['new_arrivals'] }}</span>
                </li>
            </ul>
        </div>
    </div>
    
    <!-- Stock Snapshot -->
    <div class="overflow-hidden rounded-lg bg-white shadow">
        <div class="p-6">
            <h3 class="text-base font-semibold leading-6 text-gray-900 mb-4">Variant Stock Availability</h3>
            <ul role="list" class="divide-y divide-gray-200">
                <li class="flex justify-between py-3">
                    <span class="text-sm font-medium text-gray-500">In Stock Variants</span>
                    <span class="text-sm font-semibold text-green-600">{{ $stats['in_stock'] }}</span>
                </li>
                <li class="flex justify-between py-3">
                    <span class="text-sm font-medium text-gray-500">Out of Stock Variants</span>
                    <span class="text-sm font-semibold text-red-600">{{ $stats['out_of_stock'] }}</span>
                </li>
            </ul>
        </div>
    </div>
</div>
@endsection