<x-layout.app :categories="$categories">

    <!-- 1. Breadcrumb -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4">
        <nav class="flex text-xs font-sans text-gray-500 uppercase tracking-widest" aria-label="Breadcrumb">
            <ol class="inline-flex items-center space-x-1 md:space-x-3">
                <li class="inline-flex items-center">
                    <a href="{{ route('home') }}" class="hover:text-[#0F1A2C] transition-colors">Home</a>
                </li>
                <li>
                    <div class="flex items-center">
                        <span class="mx-2">/</span>
                        <span class="text-[#0F1A2C] font-semibold">{{ $category->name }}</span>
                    </div>
                </li>
            </ol>
        </nav>
    </div>

    @php
        $bannerImg = $category->image_url;
    @endphp

    <!-- 2. Category Hero -->
    <section class="bg-[#0B1A2C] text-white py-8 sm:py-12 lg:py-16 relative overflow-hidden">
        @if($bannerImg)
            <div class="absolute inset-0 opacity-25">
                <img src="{{ $bannerImg }}" alt="{{ $category->name }}" class="w-full h-full object-cover">
            </div>
            <div class="absolute inset-0 bg-gradient-to-r from-[#0B1A2C] via-[#0B1A2C]/80 to-transparent"></div>
        @endif
        <div class="relative max-w-[1440px] mx-auto px-4 sm:px-6 lg:px-8 text-center flex flex-col items-center z-10">
            <span class="font-sans text-[10px] sm:text-[11px] font-bold uppercase tracking-[0.25em] text-[#D8C3A5] mb-1.5 sm:mb-2">Classio Curations</span>
            <h1 class="font-serif text-2xl sm:text-4xl lg:text-5xl font-bold tracking-tight mb-2 sm:mb-3">{{ $category->name }}</h1>
            <p class="font-sans text-xs sm:text-sm text-gray-300 max-w-xl px-2">
                Discover exceptional styles, handpicked materials, and timeless pieces designed for you.
            </p>
        </div>
    </section>

    <!-- 3. Subcategory Navigation (Only if active subcategories exist) -->
    @if($category->subcategories->isNotEmpty())
        <div class="border-b border-gray-200 bg-white sticky top-0 z-30 shadow-sm">
            <div class="max-w-7xl mx-auto px-3 sm:px-6 lg:px-8">
                <div class="flex overflow-x-auto hide-scrollbar py-3 sm:py-4 gap-4 sm:gap-6 items-center" style="scrollbar-width: none;">
                    <a href="{{ route('category.show', $category->slug) }}" 
                       class="whitespace-nowrap font-sans text-xs sm:text-sm font-semibold uppercase tracking-widest transition-colors {{ !request('subcategory') ? 'text-[#0F1A2C] border-b-2 border-[#0F1A2C] pb-1' : 'text-gray-500 hover:text-[#0F1A2C]' }}">
                        All
                    </a>
                    @foreach($category->subcategories as $sub)
                        <a href="{{ route('category.show', ['slug' => $category->slug, 'subcategory' => $sub->slug]) }}" 
                           class="whitespace-nowrap font-sans text-xs sm:text-sm font-semibold uppercase tracking-widest transition-colors {{ request('subcategory') === $sub->slug ? 'text-[#0F1A2C] border-b-2 border-[#0F1A2C] pb-1' : 'text-gray-500 hover:text-[#0F1A2C]' }}">
                            {{ $sub->name }}
                        </a>
                    @endforeach
                </div>
            </div>
        </div>
    @endif

    <div class="max-w-[1440px] mx-auto px-3 sm:px-6 lg:px-8 py-5 sm:py-8 lg:py-12">
        
        <!-- 4. Product Discovery Toolbar -->
        <div class="flex flex-col sm:flex-row sm:items-center justify-between mb-6 sm:mb-8 gap-3 sm:gap-4 border-b border-gray-100 pb-4 sm:pb-6">
            
            <!-- Result Count -->
            <div class="font-sans text-xs sm:text-sm text-gray-500 order-2 sm:order-1">
                Showing {{ $products->firstItem() ?? 0 }}-{{ $products->lastItem() ?? 0 }} of {{ $products->total() }} results
            </div>

            <!-- Filters & Sort -->
            <form method="GET" action="{{ route('category.show', $category->slug) }}" class="flex flex-row gap-2 sm:gap-4 w-full sm:w-auto order-1 sm:order-2" id="discovery-toolbar">
                @if(request('subcategory'))
                    <input type="hidden" name="subcategory" value="{{ request('subcategory') }}">
                @endif
                
                <!-- Search -->
                <div class="relative flex-1 sm:w-64">
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Search {{ $category->name }}..." class="w-full bg-white border border-gray-300 px-3 py-1.5 sm:px-4 sm:py-2 text-xs sm:text-sm font-sans focus:outline-none focus:ring-1 focus:ring-[#0F1A2C] focus:border-[#0F1A2C] transition-colors rounded-sm">
                    <button type="submit" class="absolute right-0 top-0 bottom-0 px-2.5 sm:px-3 text-gray-400 hover:text-[#0F1A2C]">
                        <svg class="w-3.5 h-3.5 sm:w-4 sm:h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                    </button>
                </div>

                <!-- Sort -->
                <div class="relative w-36 sm:w-48 shrink-0">
                    <select name="sort" onchange="document.getElementById('discovery-toolbar').submit();" class="w-full bg-white border border-gray-300 px-2.5 py-1.5 sm:px-4 sm:py-2 text-xs sm:text-sm font-sans appearance-none focus:outline-none focus:ring-1 focus:ring-[#0F1A2C] focus:border-[#0F1A2C] cursor-pointer rounded-sm">
                        <option value="featured" {{ request('sort') === 'featured' ? 'selected' : '' }}>Featured</option>
                        <option value="newest" {{ request('sort') === 'newest' ? 'selected' : '' }}>New Arrivals</option>
                        <option value="price_asc" {{ request('sort') === 'price_asc' ? 'selected' : '' }}>Price: Low to High</option>
                        <option value="price_desc" {{ request('sort') === 'price_desc' ? 'selected' : '' }}>Price: High to Low</option>
                    </select>
                    <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-500">
                        <svg class="w-3.5 h-3.5 sm:w-4 sm:h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                    </div>
                </div>
            </form>
        </div>

        <!-- 5. Product Grid & Empty State -->
        @if($products->isEmpty())
            <div class="py-20 text-center flex flex-col items-center justify-center bg-gray-50 border border-gray-100">
                <svg class="w-12 h-12 text-gray-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M20 12H4M8 16l-4-4 4-4M16 8l4 4-4 4"></path></svg>
                <h3 class="font-serif text-2xl font-bold text-[#0F1A2C] mb-2">No products found</h3>
                <p class="font-sans text-sm text-gray-500 mb-6">We couldn't find any products matching your criteria.</p>
                <a href="{{ route('category.show', $category->slug) }}" class="bg-[#0F1A2C] text-white px-6 py-2.5 font-sans text-xs font-semibold uppercase tracking-widest hover:bg-[#D8C3A5] hover:text-[#0F1A2C] transition-colors focus:outline-none focus:ring-2 focus:ring-[#0F1A2C] focus:ring-offset-2">
                    Clear Filters
                </a>
            </div>
        @else
            <div class="grid grid-cols-2 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-2.5 sm:gap-4 md:gap-6">
                @foreach($products as $product)
                    <x-product-card :product="$product" />
                @endforeach
            </div>

            <!-- 6. Pagination -->
            <div class="mt-12">
                {{ $products->links() }}
            </div>
        @endif
    </div>

</x-layout.app>
