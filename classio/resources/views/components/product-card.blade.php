@props(['product', 'variant' => null, 'showRating' => true, 'showSubtitle' => true])
@php
    $primaryImage = $product->images->where('is_primary', true)->first()->image_path ?? $product->images->first()->image_path ?? 'images/classio/product_coming_soon.jpg';
    $imgUrl = str_starts_with($primaryImage, 'http') ? $primaryImage : asset($primaryImage);

    $displayVariant = $variant ?? ($product->variants->where('is_default', true)->first() ?? $product->variants->first());
    $price = $displayVariant->price ?? 0;
    $compareAt = $displayVariant->compare_at_price ?? null;
    $discountPercent = ($compareAt && $compareAt > $price) ? round((($compareAt - $price) / $compareAt) * 100) : null;
    
    $rating = $product->rating;
    $reviewsCount = $product->reviews_count;
    $subtitle = $product->subtitle;

    $isWatch = ($product->category_id == 3) || 
               ($product->category && str_contains(strtolower($product->category->name), 'watch')) || 
               ($product->subcategory && str_contains(strtolower($product->subcategory->name), 'watch')) ||
               str_contains(strtolower($product->name), 'watch') ||
               str_contains(strtolower($product->name), 'chronograph') ||
               str_contains(strtolower($product->name), 'lorenzo') ||
               str_contains(strtolower($product->name), 'tissot') ||
               str_contains(strtolower($product->name), 'fossil') ||
               str_contains(strtolower($product->name), 'rado');
@endphp

<div x-data="{
    inWishlist: false,
    checkWishlist() {
        let list = JSON.parse(localStorage.getItem('wishlist') || '[]');
        this.inWishlist = list.some(item => item.product_id === {{ $product->id }});
    },
    toggleWishlist() {
        let list = JSON.parse(localStorage.getItem('wishlist') || '[]');
        let idx = list.findIndex(item => item.product_id === {{ $product->id }});
        if (idx > -1) {
            list.splice(idx, 1);
            this.inWishlist = false;
        } else {
            list.push({ product_id: {{ $product->id }}, name: '{{ addslashes($product->name) }}' });
            this.inWishlist = true;
        }
        localStorage.setItem('wishlist', JSON.stringify(list));
        window.dispatchEvent(new CustomEvent('wishlist-updated'));
    }
}" x-init="checkWishlist()" @wishlist-updated.window="checkWishlist()" class="group relative flex flex-col bg-transparent transition-all duration-300 min-w-0">
    <!-- Image Card Box with 1:1 (2:2) aspect ratio -->
    <div class="relative aspect-square bg-[#F8F7F5] rounded-lg overflow-hidden mb-2 sm:mb-2.5">
        <a href="{{ route('product.show', $product->slug) }}" class="block w-full h-full cursor-pointer" title="{{ $product->name }}">
            <img src="{{ $imgUrl }}" 
                 alt="{{ $product->name }}" 
                 width="300" 
                 height="300" 
                 loading="eager" 
                 decoding="async"
                 class="object-cover w-full h-full transition-transform duration-500 group-hover:scale-105">
        </a>
        
        <!-- Badges on top left -->
        <div class="absolute top-2 left-2 flex flex-col gap-1 z-10 pointer-events-none">
            @if($discountPercent)
                <span class="bg-[#B91C1C] text-white text-[8px] sm:text-[9px] font-bold px-1.5 py-0.5 rounded-[2px] tracking-wide uppercase shadow-sm">{{ $discountPercent }}% OFF</span>
            @elseif($product->is_new)
                <span class="bg-[#0B1E38] text-white text-[8px] sm:text-[9px] font-bold px-1.5 py-0.5 rounded-[2px] tracking-wide uppercase shadow-sm">NEW</span>
            @endif
        </div>

        <!-- Wishlist Heart on top right (FULLY FUNCTIONAL) -->
        <div class="absolute top-2 right-2 z-10">
            <button type="button"
                    @click.prevent.stop="toggleWishlist()" 
                    :class="inWishlist ? 'text-red-500 bg-white shadow-md' : 'text-gray-400 bg-white/90 hover:text-red-500 hover:bg-white'"
                    class="w-7 h-7 rounded-full flex items-center justify-center transition-all duration-200 shadow-sm focus:outline-none" 
                    aria-label="Add to wishlist">
                <svg class="w-3.5 h-3.5 transition-transform active:scale-125" :class="inWishlist ? 'fill-current text-red-500' : 'fill-none'" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path></svg>
            </button>
        </div>

        @if(!$isWatch)
        <!-- Coming Soon Badge Image (Clickable for quick email notify - Non-watches only) -->
        <button type="button" 
                @click.prevent.stop="$dispatch('open-notify-modal', { id: {{ $product->id }}, name: '{{ addslashes($product->name) }}', image: '{{ $imgUrl }}', price: '{{ number_format($price, 0) }}' })"
                class="absolute inset-x-2 bottom-2 z-20 group/cs flex items-center justify-center py-1 px-2 rounded-full bg-[#0B1A2C]/95 hover:bg-[#05121E] border border-[#D8C3A5]/80 hover:border-[#D8C3A5] shadow-lg transition-all duration-200 hover:scale-[1.03] backdrop-blur-xs cursor-pointer focus:outline-none"
                title="Coming Soon - Click to get notified">
            <img src="{{ asset('images/classio/coming_soon_badge.svg') }}" alt="Coming Soon - Click to get notified" class="h-4.5 sm:h-5.5 w-auto object-contain pointer-events-none">
        </button>
        @endif
    </div>

    <!-- Product Details (Tight, compact, no awkward spacing) -->
    <div class="flex flex-col text-left min-w-0">
        <a href="{{ route('product.show', $product->slug) }}" class="font-sans text-xs sm:text-[12.5px] font-semibold text-gray-900 leading-snug truncate group-hover:text-[#0B1A2C] transition-colors" title="{{ $product->name }}">
            {{ $product->name }}
        </a>

        @if($showSubtitle && $subtitle)
            <span class="font-sans text-[10px] sm:text-[10.5px] text-gray-400 font-normal leading-tight truncate mt-0.5 block">
                {{ $subtitle }}
            </span>
        @endif

        <div class="flex items-center text-xs sm:text-[13px] font-semibold text-gray-900 mt-1 sm:mt-1.5 flex-wrap gap-1 sm:gap-1.5 font-sans">
            <span>₹{{ number_format($price, 0) }}</span>
            @if($compareAt && $compareAt > $price)
                <span class="text-[11px] text-gray-400 font-normal line-through">₹{{ number_format($compareAt, 0) }}</span>
            @endif
        </div>

        @if($showRating && $rating)
            <div class="flex items-center gap-1 mt-1 text-[10.5px] sm:text-[11px] text-gray-500">
                <span class="text-amber-500 text-xs leading-none">★</span>
                <span class="font-bold text-gray-900 text-[11px] leading-none">{{ number_format($rating, 1) }}</span>
                <span class="text-gray-400 text-[10px] leading-none">({{ $reviewsCount ?? 50 }})</span>
            </div>
        @endif

        @if(!$isWatch)
        <!-- Quick Notify Action link (Coming soon products) -->
        <button type="button" 
                @click.prevent.stop="$dispatch('open-notify-modal', { id: {{ $product->id }}, name: '{{ addslashes($product->name) }}', image: '{{ $imgUrl }}', price: '{{ number_format($price, 0) }}' })"
                class="mt-1.5 text-[10px] sm:text-[10.5px] font-sans font-bold text-[#8E0F1E] hover:text-[#0B1A2C] transition-colors flex items-center gap-1 focus:outline-none">
            <span class="w-1.5 h-1.5 rounded-full bg-[#8E0F1E] animate-pulse"></span>
            <span>Coming Soon · Notify Me &rarr;</span>
        </button>
        @else
        <!-- Available Product / Watch in-stock indicator -->
        <div class="mt-1.5 text-[10px] sm:text-[10.5px] font-sans font-medium text-emerald-700 flex items-center gap-1">
            <span class="w-1.5 h-1.5 rounded-full bg-emerald-600"></span>
            <span>In Stock · Ready to Ship</span>
        </div>
        @endif
    </div>
</div>
