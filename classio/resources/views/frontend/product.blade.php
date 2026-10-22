<x-layout.app :categories="$categories">
    @php
        $whatsappNumber = \App\Models\Setting::where('key_name', 'whatsapp_number')->value('value') ?? '+91 95765 17660';
        $cleanNumber = preg_replace('/[^0-9]/', '', $whatsappNumber);
        if (empty($cleanNumber)) {
            $cleanNumber = '919576517660';
        }

        $galleryImages = $product->images->map(fn($img) => $img->image_url)->values();
        if ($galleryImages->isEmpty()) {
            $galleryImages = collect([asset('images/classio/product_coming_soon.jpg')]);
        }
        $primaryImageUrl = $galleryImages->first();

        $defaultVariant = $product->variants->where('is_default', true)->first() ?? $product->variants->first();
        $initialPrice = $defaultVariant->price ?? 0;
        $initialCompareAt = $defaultVariant->compare_at_price ?? null;
        $rating = $product->rating ?? 4.6;
        $reviewsCount = $product->reviews_count ?? 68;

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

    <div x-data="productPage()" class="bg-[#FAF9F6] min-h-screen pb-20 select-none">
        
        <!-- 1. Breadcrumb -->
        <div class="border-b border-gray-200/60 bg-white">
            <div class="max-w-[1440px] mx-auto px-4 sm:px-6 lg:px-8 py-3.5">
                <nav class="flex text-[11px] font-sans text-gray-500 uppercase tracking-widest overflow-x-auto no-scrollbar whitespace-nowrap" aria-label="Breadcrumb">
                    <ol class="inline-flex items-center space-x-1 md:space-x-2">
                        <li class="inline-flex items-center">
                            <a href="{{ route('home') }}" class="hover:text-[#0B1A2C] transition-colors font-medium">Home</a>
                        </li>
                        @if($product->category)
                        <li>
                            <div class="flex items-center">
                                <span class="mx-1.5 text-gray-300">/</span>
                                <a href="{{ route('category.show', $product->category->slug) }}" class="hover:text-[#0B1A2C] transition-colors font-medium">{{ $product->category->name }}</a>
                            </div>
                        </li>
                        @endif
                        @if($product->subcategory)
                        <li>
                            <div class="flex items-center">
                                <span class="mx-1.5 text-gray-300">/</span>
                                <a href="{{ route('category.show', ['slug' => $product->category->slug, 'subcategory' => $product->subcategory->slug]) }}" class="hover:text-[#0B1A2C] transition-colors font-medium">{{ $product->subcategory->name }}</a>
                            </div>
                        </li>
                        @endif
                        <li>
                            <div class="flex items-center">
                                <span class="mx-1.5 text-gray-300">/</span>
                                <span class="text-[#0B1A2C] font-semibold truncate max-w-[200px] sm:max-w-xs">{{ $product->name }}</span>
                            </div>
                        </li>
                    </ol>
                </nav>
            </div>
        </div>

        <div class="max-w-[1440px] mx-auto px-4 sm:px-6 lg:px-8 py-8 lg:py-12">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-14 items-start">
                
                <!-- 2. Product Media Gallery (Sticky on desktop) -->
                <div class="lg:col-span-6 lg:sticky lg:top-28">
                    <div class="flex flex-col-reverse sm:flex-row gap-3 sm:gap-4">
                        
                        <!-- Thumbnails Column -->
                        @if($galleryImages->count() > 1)
                        <div class="flex sm:flex-col gap-2.5 overflow-x-auto sm:overflow-y-auto max-h-[500px] no-scrollbar shrink-0 w-full sm:w-20">
                            @foreach($galleryImages as $index => $imgUrl)
                                <button type="button"
                                        @click="activeImage = '{{ $imgUrl }}'" 
                                        :class="activeImage === '{{ $imgUrl }}' ? 'border-[#0B1A2C] ring-2 ring-[#0B1A2C]/20' : 'border-gray-200 hover:border-gray-400 opacity-80 hover:opacity-100'"
                                        class="w-16 h-20 sm:w-20 sm:h-24 rounded-lg overflow-hidden border-2 transition-all duration-200 flex-shrink-0 bg-white">
                                    <img src="{{ $imgUrl }}" alt="{{ $product->name }} thumb {{ $index + 1 }}" class="w-full h-full object-cover">
                                </button>
                            @endforeach
                        </div>
                        @endif

                        <!-- Main Big Image Display -->
                        <div class="flex-1 bg-white rounded-2xl overflow-hidden border border-gray-200/80 shadow-sm relative group aspect-[3/4] max-h-[640px]">
                            <img :src="activeImage" 
                                 alt="{{ $product->name }}" 
                                 class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105">

                            <!-- Top Badges -->
                            <div class="absolute top-4 left-4 flex flex-col gap-1.5 z-10 pointer-events-none">
                                @if(!$isWatch)
                                    <span class="bg-[#8E0F1E] text-white text-[10px] font-bold uppercase tracking-widest px-3 py-1 rounded shadow-md">COMING SOON</span>
                                @endif
                                @if($product->is_new)
                                    <span class="bg-[#0B1A2C] text-white text-[10px] font-bold uppercase tracking-widest px-3 py-1 rounded shadow-md">NEW ARRIVAL</span>
                                @endif
                                <template x-if="discountPercent > 0">
                                    <span class="bg-[#B91C1C] text-white text-[10px] font-bold uppercase tracking-widest px-3 py-1 rounded shadow-md" x-text="discountPercent + '% OFF'"></span>
                                </template>
                            </div>

                            <!-- Floating Wishlist Button on Image -->
                            <div class="absolute top-4 right-4 z-10">
                                <x-wishlist-button :product="$product" />
                            </div>

                            @if(!$isWatch)
                            <!-- Bottom Floating Coming Soon Badge Image (Clickable for Email Notify - Non-watches only) -->
                            <button type="button" 
                                    @click="$dispatch('open-notify-modal', { id: {{ $product->id }}, name: '{{ addslashes($product->name) }}', image: activeImage, price: currentPrice })"
                                    class="absolute bottom-4 inset-x-4 z-20 flex items-center justify-center py-2 px-4 rounded-full bg-[#0B1A2C]/95 hover:bg-[#05121E] border border-[#D8C3A5] shadow-2xl hover:scale-[1.02] transition-all cursor-pointer focus:outline-none backdrop-blur-xs group/cs"
                                    title="Coming Soon - Click to get notified">
                                <img src="{{ asset('images/classio/coming_soon_badge.svg') }}" alt="Coming Soon - Click for Email Alert" class="h-6 sm:h-7 w-auto object-contain pointer-events-none">
                            </button>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- 3. Product Information Details (Right Column) -->
                <div class="lg:col-span-6 flex flex-col text-left">
                    
                    <!-- Category / Brand Tag -->
                    <div class="flex items-center justify-between mb-2">
                        <span class="font-sans text-xs font-bold uppercase tracking-widest text-[#D8C3A5] bg-[#0B1A2C] px-3 py-0.5 rounded-full">
                            {{ $product->category->name ?? 'Classio Luxury' }}
                        </span>
                        <span class="text-xs text-gray-500 font-sans tracking-wide">
                            SKU: <span class="font-mono text-gray-700" x-text="selectedVariant ? selectedVariant.sku : 'CLO-{{ $product->id }}'"></span>
                        </span>
                    </div>

                    <!-- Title -->
                    <h1 class="font-serif text-2xl sm:text-3xl lg:text-4xl font-bold text-[#0B1A2C] leading-tight mb-2">
                        {{ $product->name }}
                    </h1>

                    @if($product->subtitle)
                        <p class="font-sans text-sm text-gray-500 font-normal mb-3">
                            {{ $product->subtitle }}
                        </p>
                    @endif

                    <!-- Star Rating & Reviews -->
                    <div class="flex items-center gap-2 mb-5 pb-4 border-b border-gray-200/80">
                        <div class="flex items-center text-amber-500 text-sm">
                            <span>★</span><span>★</span><span>★</span><span>★</span><span class="text-amber-300">★</span>
                        </div>
                        <span class="font-sans text-xs font-bold text-gray-900">{{ number_format($rating, 1) }}</span>
                        <span class="text-gray-400 text-xs">·</span>
                        <a href="#reviews" class="font-sans text-xs text-gray-500 hover:text-[#0B1A2C] underline decoration-gray-300">
                            {{ $reviewsCount }} Verified Reviews
                        </a>
                        <span class="ml-auto text-[11px] font-sans font-semibold text-emerald-700 bg-emerald-50 px-2.5 py-0.5 rounded-full flex items-center gap-1">
                            <span class="w-1.5 h-1.5 rounded-full bg-emerald-600 animate-pulse"></span>
                            In Stock
                        </span>
                    </div>

                    <!-- Simple Default Price -->
                    <div class="flex items-center gap-3 my-4 flex-wrap">
                        <span class="font-sans text-2xl sm:text-3xl font-bold text-gray-900" x-text="'₹' + Number(currentPrice).toLocaleString('en-IN')"></span>
                        
                        <template x-if="currentCompareAt && currentCompareAt > currentPrice">
                            <span class="font-sans text-base text-gray-400 line-through" x-text="'₹' + Number(currentCompareAt).toLocaleString('en-IN')"></span>
                        </template>
                        
                        <template x-if="discountPercent > 0">
                            <span class="font-sans text-xs font-semibold text-red-600" x-text="'(' + discountPercent + '% off)'"></span>
                        </template>

                        <template x-if="currentCompareAt && currentCompareAt > currentPrice">
                            <span class="text-[11px] font-sans font-semibold text-emerald-700 bg-emerald-50 px-2 py-0.5 rounded border border-emerald-200/60" x-text="'Save ₹' + Number(currentCompareAt - currentPrice).toLocaleString('en-IN')"></span>
                        </template>
                    </div>

                    <!-- Size Selection -->
                    <template x-if="sizes.length > 0">
                        <div class="mb-5">
                            <div class="flex items-center justify-between mb-2.5">
                                <span class="font-sans text-xs font-bold uppercase tracking-wider text-gray-900">
                                    Select Size: <span class="text-[#0B1A2C] font-extrabold" x-text="selectedSize"></span>
                                </span>
                                <button type="button" @click="showSizeGuide = true" class="text-[11px] font-sans text-gray-500 hover:text-[#0B1A2C] underline">
                                    Size Guide
                                </button>
                            </div>
                            <div class="flex flex-wrap gap-2.5">
                                <template x-for="size in sizes" :key="size">
                                    <button type="button" 
                                            @click="selectSize(size)"
                                            :class="selectedSize === size ? 'border-[#0B1A2C] bg-[#0B1A2C] text-white shadow-md' : 'border-gray-300 bg-white text-gray-800 hover:border-gray-400'"
                                            class="min-w-[44px] h-11 px-3.5 rounded-lg border font-sans text-xs font-bold uppercase transition-all duration-200 flex items-center justify-center focus:outline-none">
                                        <span x-text="size"></span>
                                    </button>
                                </template>
                            </div>
                        </div>
                    </template>

                    <!-- Color Selection -->
                    <template x-if="colors.length > 0">
                        <div class="mb-6">
                            <div class="flex items-center justify-between mb-2.5">
                                <span class="font-sans text-xs font-bold uppercase tracking-wider text-gray-900">
                                    Color: <span class="text-[#0B1A2C] font-extrabold" x-text="selectedColor"></span>
                                </span>
                            </div>
                            <div class="flex flex-wrap gap-2.5">
                                <template x-for="color in colors" :key="color">
                                    <button type="button" 
                                            @click="selectColor(color)"
                                            :class="selectedColor === color ? 'border-[#0B1A2C] bg-white ring-2 ring-[#0B1A2C]' : 'border-gray-300 bg-white hover:border-gray-400'"
                                            class="px-4 py-2 rounded-lg border font-sans text-xs font-medium uppercase transition-all duration-200 focus:outline-none flex items-center gap-1.5">
                                        <span class="w-2.5 h-2.5 rounded-full bg-gray-700"></span>
                                        <span x-text="color"></span>
                                    </button>
                                </template>
                            </div>
                        </div>
                    </template>

                    @if(!$isWatch)
                    <!-- Coming Soon Early Access Notify Bar -->
                    <div class="mb-5 bg-[#0B1A2C] border border-[#D8C3A5]/60 rounded-xl p-4 flex flex-col sm:flex-row items-center justify-between gap-3 text-white shadow-sm">
                        <div class="flex items-center gap-3">
                            <span class="w-3 h-3 rounded-full bg-[#8E0F1E] animate-ping shrink-0"></span>
                            <div>
                                <h4 class="font-sans text-xs font-bold uppercase tracking-wider text-white flex items-center gap-2">
                                    <span>Coming Soon Drop</span>
                                    <span class="text-[9px] bg-[#8E0F1E] text-white px-1.5 py-0.2 rounded font-bold">LIMITED RELEASE</span>
                                </h4>
                                <p class="font-sans text-[11px] text-gray-300">Click below to get notified via email the moment stock drops.</p>
                            </div>
                        </div>
                        <button type="button" 
                                @click="$dispatch('open-notify-modal', { id: {{ $product->id }}, name: '{{ addslashes($product->name) }}', image: activeImage, price: currentPrice })"
                                class="w-full sm:w-auto px-5 py-2.5 rounded-lg bg-[#D8C3A5] hover:bg-[#c9b291] text-[#0B1A2C] font-sans font-bold text-xs uppercase tracking-wider transition-colors shadow-sm shrink-0 flex items-center justify-center gap-1.5 focus:outline-none">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path></svg>
                            <span>Notify Me</span>
                        </button>
                    </div>
                    @endif

                    <!-- Quantity & Action CTAs -->
                    <div class="flex flex-col sm:flex-row gap-3.5 mb-5">
                        <!-- Quantity Controller -->
                        <div class="flex items-center border border-gray-300 rounded-lg bg-white h-12 w-full sm:w-36 shrink-0 justify-between px-2">
                            <button type="button" @click="decrementQty()" class="w-8 h-8 rounded hover:bg-gray-100 flex items-center justify-center text-gray-600 focus:outline-none" aria-label="Decrease quantity">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4"></path></svg>
                            </button>
                            <span class="font-sans text-sm font-bold text-gray-900" x-text="quantity"></span>
                            <button type="button" @click="incrementQty()" class="w-8 h-8 rounded hover:bg-gray-100 flex items-center justify-center text-gray-600 focus:outline-none" aria-label="Increase quantity">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                            </button>
                        </div>

                        <!-- Primary Add to Cart Button -->
                        <button type="button" 
                                @click="addToCart()" 
                                class="flex-1 h-12 rounded-lg bg-[#0B1A2C] hover:bg-black text-white font-sans text-xs font-bold uppercase tracking-widest transition-all duration-200 flex items-center justify-center gap-2 shadow-lg focus:outline-none focus:ring-2 focus:ring-[#0B1A2C] focus:ring-offset-2">
                            <svg x-show="!addedSuccess" class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
                            <span x-show="!addedSuccess">Add to Cart</span>
                            <span x-show="addedSuccess" class="flex items-center gap-1.5 text-emerald-400" x-cloak>
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                Added to Cart!
                            </span>
                        </button>
                    </div>

                    <!-- Direct WhatsApp Buy/Enquiry CTA -->
                    @if($cleanNumber)
                    <a :href="whatsappUrl" 
                       target="_blank" 
                       rel="noopener noreferrer"
                       class="w-full h-12 rounded-lg bg-[#25D366] hover:bg-[#20ba59] text-white font-sans text-xs font-bold uppercase tracking-wider transition-all duration-200 flex items-center justify-center gap-2 shadow-sm focus:outline-none mb-6">
                        <svg class="w-5 h-5 fill-white" viewBox="0 0 32 32">
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M16 2C8.268 2 2 8.268 2 16C2 18.67 2.75 21.17 4.05 23.31L2.24 29.84L8.98 28.09C11.05 29.32 13.44 30 16 30C23.732 30 30 23.732 30 16C30 8.268 23.732 2 16 2ZM16 27.65C13.75 27.65 11.66 27.02 9.87 25.92L9.45 25.66L5.34 26.73L6.44 22.72L6.16 22.28C4.98 20.4 4.35 18.25 4.35 16C4.35 9.57 9.57 4.35 16 4.35C22.43 4.35 27.65 9.57 27.65 16C27.65 22.43 22.43 27.65 16 27.65ZM22.42 19.34C22.07 19.16 20.35 18.32 20.03 18.2C19.71 18.08 19.48 18.02 19.25 18.38C19.01 18.73 18.33 19.54 18.12 19.78C17.92 20.01 17.71 20.04 17.36 19.86C17.01 19.68 15.88 19.31 14.54 18.11C13.5 17.18 12.8 16.03 12.59 15.68C12.38 15.33 12.57 15.14 12.74 14.96C12.9 14.8 13.1 14.54 13.27 14.34C13.45 14.14 13.51 13.99 13.63 13.76C13.75 13.53 13.69 13.32 13.6 13.15C13.51 12.97 12.8 11.23 12.51 10.53C12.23 9.85 11.93 9.94 11.73 9.93C11.53 9.92 11.3 9.92 11.06 9.92C10.83 9.92 10.45 10.01 10.13 10.36C9.81 10.71 8.9 11.56 8.9 13.29C8.9 15.02 10.16 16.69 10.34 16.92C10.51 17.15 12.81 20.68 16.32 22.2C17.15 22.56 17.8 22.78 18.31 22.94C19.15 23.21 19.91 23.17 20.52 23.08C21.2 22.98 22.61 22.22 22.9 21.4C23.2 20.57 23.2 19.87 23.11 19.72C23.02 19.58 22.77 19.52 22.42 19.34Z"/>
                        </svg>
                        <span>Buy or Enquire on WhatsApp</span>
                    </a>
                    @endif

                    <!-- Value Propositions Strip -->
                    <div class="grid grid-cols-2 sm:grid-cols-4 gap-3 py-4 border-y border-gray-200/80 mb-6 bg-white rounded-xl px-4">
                        <div class="flex flex-col items-center text-center p-1">
                            <svg class="w-5 h-5 text-[#D8C3A5] mb-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.6" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4"></path></svg>
                            <span class="text-[10px] font-bold text-gray-900 font-sans uppercase">Free Delivery</span>
                            <span class="text-[9px] text-gray-500 font-sans">On orders ₹999+</span>
                        </div>
                        <div class="flex flex-col items-center text-center p-1">
                            <svg class="w-5 h-5 text-[#D8C3A5] mb-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.6" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path></svg>
                            <span class="text-[10px] font-bold text-gray-900 font-sans uppercase">Easy Returns</span>
                            <span class="text-[9px] text-gray-500 font-sans">7-Day policy</span>
                        </div>
                        <div class="flex flex-col items-center text-center p-1">
                            <svg class="w-5 h-5 text-[#D8C3A5] mb-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.6" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path></svg>
                            <span class="text-[10px] font-bold text-gray-900 font-sans uppercase">100% Genuine</span>
                            <span class="text-[9px] text-gray-500 font-sans">Certified Luxury</span>
                        </div>
                        <div class="flex flex-col items-center text-center p-1">
                            <svg class="w-5 h-5 text-[#D8C3A5] mb-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.6" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                            <span class="text-[10px] font-bold text-gray-900 font-sans uppercase">COD Available</span>
                            <span class="text-[9px] text-gray-500 font-sans">Pay at doorstep</span>
                        </div>
                    </div>

                    <!-- Accordion Details (Description, Material, Shipping) -->
                    <div class="space-y-2">
                        <!-- Description -->
                        <div class="border border-gray-200/80 rounded-xl bg-white overflow-hidden" x-data="{ open: true }">
                            <button type="button" @click="open = !open" class="w-full px-5 py-3.5 flex items-center justify-between text-left focus:outline-none">
                                <span class="font-sans text-xs font-bold uppercase tracking-wider text-gray-900">Product Details & Description</span>
                                <svg class="w-4 h-4 text-gray-400 transform transition-transform duration-200" :class="open ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                            </button>
                            <div x-show="open" class="px-5 pb-4 text-xs font-sans text-gray-600 leading-relaxed border-t border-gray-100 pt-3">
                                @if(str_contains($product->description ?? '', '<div') || str_contains($product->description ?? '', '<table') || str_contains($product->description ?? '', '<p'))
                                    {!! $product->description !!}
                                @else
                                    <p class="mb-2">{{ $product->description ?? 'Crafted from the finest materials with exquisite craftsmanship. Designed to elevate your personal style with sophisticated flair and comfort.' }}</p>
                                    <ul class="list-disc pl-4 space-y-1 text-gray-500 mt-2">
                                        <li>Fit: Premium Regular Tailored Fit</li>
                                        <li>Material: 100% High-Grade Fabric / Construction</li>
                                        <li>Origin: Handcrafted with care by Classio artisans</li>
                                    </ul>
                                @endif
                            </div>
                        </div>

                        <!-- Care Instructions -->
                        <div class="border border-gray-200/80 rounded-xl bg-white overflow-hidden" x-data="{ open: false }">
                            <button type="button" @click="open = !open" class="w-full px-5 py-3.5 flex items-center justify-between text-left focus:outline-none">
                                <span class="font-sans text-xs font-bold uppercase tracking-wider text-gray-900">
                                    {{ ($product->category && str_contains(strtolower($product->category->name), 'watch')) ? 'Watch Care & Maintenance' : 'Fabric & Care Instructions' }}
                                </span>
                                <svg class="w-4 h-4 text-gray-400 transform transition-transform duration-200" :class="open ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                            </button>
                            <div x-show="open" class="px-5 pb-4 text-xs font-sans text-gray-600 leading-relaxed border-t border-gray-100 pt-3" style="display: none;">
                                @if($product->category && str_contains(strtolower($product->category->name), 'watch'))
                                    <ul class="list-disc pl-4 space-y-1 text-gray-500">
                                        <li>Wipe case, crystal, and bracelet/strap regularly with a soft microfiber cloth.</li>
                                        <li>Keep away from intense magnetic fields (speakers, induction cooktops, magnetic fasteners).</li>
                                        <li>Avoid hot showers, steam, and saunas to protect water resistance gaskets.</li>
                                        <li>For automatic watches, wear daily or manually wind via crown when power reserve runs low.</li>
                                    </ul>
                                @else
                                    <ul class="list-disc pl-4 space-y-1 text-gray-500">
                                        <li>Machine wash cold with like colors or dry clean recommended.</li>
                                        <li>Do not bleach or tumble dry.</li>
                                        <li>Iron on low heat if needed.</li>
                                    </ul>
                                @endif
                            </div>
                        </div>

                        <!-- Shipping & Returns -->
                        <div class="border border-gray-200/80 rounded-xl bg-white overflow-hidden" x-data="{ open: false }">
                            <button type="button" @click="open = !open" class="w-full px-5 py-3.5 flex items-center justify-between text-left focus:outline-none">
                                <span class="font-sans text-xs font-bold uppercase tracking-wider text-gray-900">Shipping & Easy Returns</span>
                                <svg class="w-4 h-4 text-gray-400 transform transition-transform duration-200" :class="open ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                            </button>
                            <div x-show="open" class="px-5 pb-4 text-xs font-sans text-gray-600 leading-relaxed border-t border-gray-100 pt-3" style="display: none;">
                                <p class="text-gray-500">
                                    Orders are dispatched within 24 hours. Delivery takes 3–5 business days across India. We offer a hassle-free 7-day return and exchange window from the date of delivery.
                                </p>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <!-- 4. Related Products Showcase ("You May Also Like") -->
        @if($relatedProducts->isNotEmpty())
        <div class="max-w-[1440px] mx-auto px-4 sm:px-6 lg:px-8 py-12 sm:py-16 border-t border-gray-200/80 mt-10">
            <div class="flex items-end justify-between mb-6">
                <div>
                    <h2 class="font-serif text-2xl sm:text-3xl font-bold text-[#0B1A2C]">You May Also Like</h2>
                    <p class="font-sans text-xs text-gray-500 mt-1">Curated selections that match this piece</p>
                </div>
                <a href="{{ route('category.show', $product->category->slug ?? 'all') }}" class="font-sans text-xs font-semibold text-gray-800 hover:text-[#0B1A2C] transition-colors flex items-center gap-1">
                    Explore Category <svg class="w-3.5 h-3.5 ml-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                </a>
            </div>
            <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-3 sm:gap-4 lg:gap-5">
                @foreach($relatedProducts as $related)
                    <x-product-card :product="$related" :showRating="true" :showSubtitle="true" />
                @endforeach
            </div>
        </div>
        @endif

    </div>

    @push('scripts')
    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('productPage', () => ({
                variants: @json($product->variants),
                selectedVariant: null,
                quantity: 1,
                activeImage: '{{ $primaryImageUrl }}',
                addedSuccess: false,
                showSizeGuide: false,
                
                sizes: [],
                colors: [],
                selectedSize: '',
                selectedColor: '',

                init() {
                    this.sizes = [...new Set(this.variants.map(v => v.size).filter(Boolean))];
                    this.colors = [...new Set(this.variants.map(v => v.color).filter(Boolean))];

                    if (this.variants.length > 0) {
                        let def = this.variants.find(v => v.is_default) || this.variants[0];
                        this.selectedSize = def.size || (this.sizes[0] || '');
                        this.selectedColor = def.color || (this.colors[0] || '');
                        this.updateVariant();
                    }
                },

                selectSize(size) {
                    this.selectedSize = size;
                    this.updateVariant();
                },

                selectColor(color) {
                    this.selectedColor = color;
                    this.updateVariant();
                },

                updateVariant() {
                    let match = this.variants.find(v => 
                        (v.size || '') === this.selectedSize && 
                        (v.color || '') === this.selectedColor
                    );
                    this.selectedVariant = match || this.variants[0] || null;
                },

                get currentPrice() {
                    return this.selectedVariant ? this.selectedVariant.price : {{ $initialPrice }};
                },

                get currentCompareAt() {
                    return this.selectedVariant ? this.selectedVariant.compare_at_price : {{ $initialCompareAt ?? 'null' }};
                },

                get discountPercent() {
                    if (!this.currentCompareAt || this.currentCompareAt <= this.currentPrice) return 0;
                    return Math.round(((this.currentCompareAt - this.currentPrice) / this.currentCompareAt) * 100);
                },

                incrementQty() {
                    this.quantity++;
                },

                decrementQty() {
                    if (this.quantity > 1) this.quantity--;
                },

                get whatsappUrl() {
                    let name = encodeURIComponent("{{ $product->name }}");
                    let price = this.currentPrice;
                    let size = this.selectedSize ? `%0ASize: ${encodeURIComponent(this.selectedSize)}` : '';
                    let color = this.selectedColor ? `%0AColor: ${encodeURIComponent(this.selectedColor)}` : '';
                    let message = `Hi Classio, I want to order / enquire about:%0A*${name}*${size}${color}%0APrice: ₹${price}%0APlease confirm availability!`;
                    return `https://wa.me/{{ $cleanNumber }}?text=${message}`;
                },

                addToCart() {
                    try {
                        let cart = JSON.parse(localStorage.getItem('cart') || '[]');
                        let variantId = this.selectedVariant ? this.selectedVariant.id : {{ $defaultVariant->id ?? 1 }};
                        let itemIndex = cart.findIndex(item => item.product_id === {{ $product->id }} && item.variant_id === variantId);

                        if (itemIndex > -1) {
                            cart[itemIndex].quantity += this.quantity;
                        } else {
                            cart.push({
                                product_id: {{ $product->id }},
                                product_name: "{{ addslashes($product->name) }}",
                                product_slug: "{{ $product->slug }}",
                                variant_id: variantId,
                                size: this.selectedSize,
                                color: this.selectedColor,
                                quantity: this.quantity,
                                unit_price: this.currentPrice,
                                image: this.activeImage
                            });
                        }

                        localStorage.setItem('cart', JSON.stringify(cart));
                        window.dispatchEvent(new CustomEvent('cart-updated'));

                        this.addedSuccess = true;
                        setTimeout(() => {
                            this.addedSuccess = false;
                        }, 2500);
                    } catch (e) {
                        console.error('Error adding to cart:', e);
                    }
                }
            }));
        });
    </script>
    @endpush
</x-layout.app>
