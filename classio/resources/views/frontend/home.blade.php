<x-layout.app :categories="$navCategories">
    <!-- 1. HERO CAMPAIGN -->
    <x-banner-block :banners="$heroBanners" />

    <!-- 2. CIRCULAR CATEGORY STORY NAVIGATION -->
    <section class="max-w-[1440px] mx-auto px-3 sm:px-6 lg:px-8 py-5 sm:py-8 lg:py-9 border-b border-gray-100">
        <div class="flex items-start justify-between gap-4 sm:gap-6 lg:gap-8 overflow-x-auto no-scrollbar scroll-smooth snap-x pb-2 pt-1">
            @foreach($quickNavCategories as $cat)
                @php
                    $catImage = $cat->image_path ? asset($cat->image_path) : null;
                @endphp
                <a href="{{ route('category.show', $cat->slug) }}" class="flex flex-col items-center group w-20 sm:w-24 lg:w-28 flex-shrink-0 snap-start text-center focus:outline-none">
                    <div class="w-18 h-18 sm:w-22 sm:h-22 lg:w-24 lg:h-24 rounded-full mb-2 overflow-hidden flex items-center justify-center p-1 border-2 border-gray-200 group-hover:border-[#0B1A2C] transition-all duration-300 relative shadow-sm group-hover:shadow-md bg-white">
                        @if($cat->slug === 'offers' || !$catImage)
                            <div class="w-full h-full rounded-full bg-[#8E0F1E] group-hover:bg-[#a31223] transition-colors flex flex-col items-center justify-center text-white">
                                <span class="font-serif font-black text-2xl sm:text-3xl leading-none">%</span>
                                <span class="text-[8px] sm:text-[9px] font-sans font-bold uppercase tracking-wider mt-0.5">OFFERS</span>
                            </div>
                        @else
                            <img src="{{ $catImage }}" 
                                 alt="{{ $cat->name }}" 
                                 width="100" 
                                 height="100" 
                                 loading="lazy" 
                                 decoding="async" 
                                 class="w-full h-full object-cover rounded-full group-hover:scale-110 transition-transform duration-500">
                        @endif
                    </div>
                    <span class="font-sans text-xs sm:text-[12.5px] font-medium text-center leading-snug text-gray-800 group-hover:text-[#0B1A2C] transition-colors line-clamp-2">
                        {!! str_replace(' & ', '<br>& ', $cat->name) !!}
                    </span>
                </a>
            @endforeach
        </div>
    </section>

    <!-- 3. TRENDING NOW SECTION (Responsive 2 to 6 Column Grid) -->
    @if($trendingProducts->isNotEmpty())
        <section class="max-w-[1440px] mx-auto px-3 sm:px-6 lg:px-8 py-6 sm:py-10 lg:py-14">
            <div class="flex items-end justify-between mb-4 sm:mb-6">
                <div>
                    <h2 class="font-serif text-xl sm:text-2xl lg:text-3xl font-bold text-[#0B1A2C]">Trending Now</h2>
                    <p class="font-sans text-[11px] sm:text-xs text-gray-500 mt-0.5">Our most loved picks this season</p>
                </div>
                <a href="/category/trending" class="font-sans text-xs font-semibold text-gray-800 hover:text-[#0B1A2C] transition-colors flex items-center gap-1">
                    View All <svg class="w-3.5 h-3.5 ml-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                </a>
            </div>
            
            <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-6 gap-2.5 sm:gap-4 lg:gap-5">
                @foreach($trendingProducts as $product)
                    <x-product-card :product="$product" />
                @endforeach
            </div>
        </section>
    @endif

    <!-- 4. LADIES COLLECTION SHOWCASE -->
    @if($ladiesCategory)
        <section class="max-w-[1440px] mx-auto px-3 sm:px-6 lg:px-8 pb-8 sm:pb-12 lg:pb-14">
            <div class="flex items-center justify-end mb-2 sm:mb-3">
                <a href="{{ route('category.show', $ladiesCategory->slug) }}" class="font-sans text-xs font-semibold text-gray-800 hover:text-[#0B1A2C] transition-colors flex items-center gap-1">
                    View All <svg class="w-3.5 h-3.5 ml-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                </a>
            </div>
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-3.5 sm:gap-4 lg:gap-5 items-start">
                <!-- Left Banner Card -->
                <div class="lg:col-span-5 bg-[#EFE9E0] border border-gray-200/60 rounded-xl overflow-hidden relative group flex flex-col justify-center p-5 sm:p-8 lg:p-10 min-h-[200px] sm:min-h-[260px] lg:h-[310px]">
                    <img src="{{ asset('images/classio/ladies_banner.jpg') }}" alt="Ladies Collection" width="500" height="400" loading="lazy" decoding="async" class="absolute inset-0 w-full h-full object-cover object-right group-hover:scale-105 transition-transform duration-700">
                    <div class="absolute inset-0 bg-gradient-to-r from-[#EFE9E0] via-[#EFE9E0]/90 to-transparent w-3/4 sm:w-2/3 lg:w-3/4 z-[1]"></div>
                    <div class="relative z-10 max-w-[240px] sm:max-w-[270px]">
                        <h3 class="font-serif text-2xl sm:text-3xl lg:text-4xl font-bold text-[#0B1A2C] leading-[1.1] mb-2 sm:mb-3">
                            Ladies<br>Collection
                        </h3>
                        <p class="font-sans text-[11px] sm:text-xs text-gray-600 mb-3.5 sm:mb-6 leading-relaxed line-clamp-2 sm:line-clamp-none">
                            Elegant styles for every occasion. From everyday essentials to statement pieces.
                        </p>
                        <a href="{{ route('category.show', $ladiesCategory->slug) }}" class="inline-flex items-center gap-1.5 bg-[#0B1A2C] text-white px-4 sm:px-6 py-2 sm:py-2.5 rounded-full font-sans text-[11px] sm:text-xs font-semibold tracking-wider uppercase hover:bg-black transition-colors">
                            SHOP WOMEN &rarr;
                        </a>
                    </div>
                </div>

                <!-- Right 4 Product Cards (2x2 on mobile) -->
                <div class="lg:col-span-7">
                    <div class="grid grid-cols-2 sm:grid-cols-4 gap-2.5 sm:gap-4">
                        @foreach($ladiesProducts as $product)
                            <x-product-card :product="$product" :showRating="false" :showSubtitle="false" />
                        @endforeach
                    </div>
                </div>
            </div>
        </section>
    @endif

    <!-- 5. GENTS COLLECTION SHOWCASE -->
    @if($gentsCategory)
        <section class="max-w-[1440px] mx-auto px-3 sm:px-6 lg:px-8 pb-8 sm:pb-12 lg:pb-14">
            <div class="flex items-center justify-end mb-2 sm:mb-3">
                <a href="{{ route('category.show', $gentsCategory->slug) }}" class="font-sans text-xs font-semibold text-gray-800 hover:text-[#0B1A2C] transition-colors flex items-center gap-1">
                    View All <svg class="w-3.5 h-3.5 ml-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                </a>
            </div>
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-3.5 sm:gap-4 lg:gap-5 items-start">
                <!-- Left Banner Card (Dark Navy) -->
                <div class="lg:col-span-5 bg-[#0A1C2E] rounded-xl overflow-hidden relative group flex flex-col justify-center p-5 sm:p-8 lg:p-10 min-h-[200px] sm:min-h-[260px] lg:h-[310px] text-white">
                    <img src="{{ asset('images/classio/gents_banner.jpg') }}" alt="Gents Collection" width="500" height="400" loading="lazy" decoding="async" class="absolute inset-0 w-full h-full object-cover object-right opacity-90 group-hover:scale-105 transition-transform duration-700">
                    <div class="absolute inset-0 bg-gradient-to-r from-[#0A1C2E] via-[#0A1C2E]/90 to-transparent w-3/4 sm:w-2/3 lg:w-3/4 z-[1]"></div>
                    <div class="relative z-10 max-w-[240px] sm:max-w-[270px]">
                        <h3 class="font-serif text-2xl sm:text-3xl lg:text-4xl font-bold text-white leading-[1.1] mb-2 sm:mb-3">
                            Gents<br>Collection
                        </h3>
                        <p class="font-sans text-[11px] sm:text-xs text-gray-300 mb-3.5 sm:mb-6 leading-relaxed line-clamp-2 sm:line-clamp-none">
                            Style that defines you. Premium clothing for the modern gentleman.
                        </p>
                        <a href="{{ route('category.show', $gentsCategory->slug) }}" class="inline-flex items-center gap-1.5 border border-white/60 bg-white/10 hover:bg-white hover:text-[#0B1A2C] text-white px-4 sm:px-6 py-2 sm:py-2.5 rounded-full font-sans text-[11px] sm:text-xs font-semibold tracking-wider uppercase transition-colors">
                            SHOP MEN &rarr;
                        </a>
                    </div>
                </div>

                <!-- Right 4 Product Cards (2x2 on mobile) -->
                <div class="lg:col-span-7">
                    <div class="grid grid-cols-2 sm:grid-cols-4 gap-2.5 sm:gap-4">
                        @foreach($gentsProducts as $product)
                            <x-product-card :product="$product" :showRating="false" :showSubtitle="false" />
                        @endforeach
                    </div>
                </div>
            </div>
        </section>
    @endif

    <!-- 6. WATCHES & PERFUMES SHOWCASE -->
    @if($watchesCategory)
        <section class="max-w-[1440px] mx-auto px-3 sm:px-6 lg:px-8 pb-8 sm:pb-12 lg:pb-14">
            <div class="flex items-center justify-end mb-2 sm:mb-3">
                <a href="{{ route('category.show', $watchesCategory->slug) }}" class="font-sans text-xs font-semibold text-gray-800 hover:text-[#0B1A2C] transition-colors flex items-center gap-1">
                    View All <svg class="w-3.5 h-3.5 ml-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                </a>
            </div>
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-3.5 sm:gap-4 lg:gap-5 items-start">
                <!-- Left Banner Card (Warm Sand) -->
                <div class="lg:col-span-5 bg-[#EAE4DC] border border-gray-200/60 rounded-xl overflow-hidden relative group flex flex-col justify-center p-5 sm:p-8 lg:p-10 min-h-[200px] sm:min-h-[260px] lg:h-[310px]">
                    <img src="{{ asset('images/classio/watches_banner.jpg') }}" alt="Watches & Perfumes" width="500" height="400" loading="lazy" decoding="async" class="absolute inset-0 w-full h-full object-cover object-right group-hover:scale-105 transition-transform duration-700">
                    <div class="absolute inset-0 bg-gradient-to-r from-[#EAE4DC] via-[#EAE4DC]/90 to-transparent w-3/4 sm:w-2/3 lg:w-3/4 z-[1]"></div>
                    <div class="relative z-10 max-w-[240px] sm:max-w-[270px]">
                        <h3 class="font-serif text-2xl sm:text-3xl lg:text-4xl font-bold text-[#0B1A2C] leading-[1.1] mb-2 sm:mb-3">
                            Watches &<br>Perfumes
                        </h3>
                        <p class="font-sans text-[11px] sm:text-xs text-gray-700 mb-3.5 sm:mb-6 leading-relaxed line-clamp-2 sm:line-clamp-none">
                            Timeless watches and signature scents for a lasting impression.
                        </p>
                        <a href="{{ route('category.show', $watchesCategory->slug) }}" class="inline-flex items-center gap-1.5 bg-[#0B1A2C] text-white px-4 sm:px-6 py-2 sm:py-2.5 rounded-full font-sans text-[11px] sm:text-xs font-semibold tracking-wider uppercase hover:bg-black transition-colors">
                            EXPLORE &rarr;
                        </a>
                    </div>
                </div>

                <!-- Right 4 Product Cards (2x2 on mobile) -->
                <div class="lg:col-span-7">
                    <div class="grid grid-cols-2 sm:grid-cols-4 gap-2.5 sm:gap-4">
                        @foreach($watchesProducts as $product)
                            <x-product-card :product="$product" :showRating="false" :showSubtitle="false" />
                        @endforeach
                    </div>
                </div>
            </div>
        </section>
    @endif

    <!-- 7. CATEGORY GRID BANNERS (Row 1: 3 cards, Row 2: 2 cards, Row 3: 2 cards) -->
    <section class="max-w-[1440px] mx-auto px-4 sm:px-6 lg:px-8 pb-10 sm:pb-12 lg:pb-14">
        <!-- Row 1: 3 Columns -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 lg:gap-5 mb-4 lg:mb-5">
            <!-- Fashion Accessories -->
            <div class="bg-[#EFE9E0] border border-gray-200/60 rounded-xl overflow-hidden flex items-center justify-between p-5 sm:p-7 relative group min-h-[175px] sm:min-h-[190px]">
                <div class="w-[48%] h-full absolute right-0 top-0 overflow-hidden">
                    <img src="{{ asset('images/classio/banner_accessories.jpg') }}" alt="Fashion Accessories" width="300" height="200" loading="lazy" decoding="async" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                </div>
                <div class="absolute inset-0 bg-gradient-to-r from-[#EFE9E0] via-[#EFE9E0]/95 to-transparent w-2/3 z-[1]"></div>
                <div class="relative z-10 max-w-[62%] sm:max-w-[60%]">
                    <h4 class="font-serif text-lg sm:text-xl lg:text-2xl font-bold text-[#0B1A2C] mb-1 leading-snug">Fashion<br>Accessories</h4>
                    <p class="font-sans text-[10.5px] sm:text-[11px] text-gray-600 mb-3 sm:mb-4 leading-normal line-clamp-2">Complete your look with premium accessories.</p>
                    <a href="/category/fashion-accessories" class="inline-flex items-center bg-[#0B1A2C] text-white px-3.5 sm:px-4 py-1.5 sm:py-2 rounded-full font-sans text-[10px] sm:text-[10.5px] font-bold tracking-wider uppercase hover:bg-black transition-colors">
                        SHOP NOW &rarr;
                    </a>
                </div>
            </div>

            <!-- Bags Collection -->
            <div class="bg-[#EFE9E0] border border-gray-200/60 rounded-xl overflow-hidden flex items-center justify-between p-5 sm:p-7 relative group min-h-[175px] sm:min-h-[190px]">
                <div class="w-[48%] h-full absolute right-0 top-0 overflow-hidden">
                    <img src="{{ asset('images/classio/banner_bags.jpg') }}" alt="Bags Collection" width="300" height="200" loading="lazy" decoding="async" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                </div>
                <div class="absolute inset-0 bg-gradient-to-r from-[#EFE9E0] via-[#EFE9E0]/95 to-transparent w-2/3 z-[1]"></div>
                <div class="relative z-10 max-w-[62%] sm:max-w-[60%]">
                    <h4 class="font-serif text-lg sm:text-xl lg:text-2xl font-bold text-[#0B1A2C] mb-1 leading-snug">Bags<br>Collection</h4>
                    <p class="font-sans text-[10.5px] sm:text-[11px] text-gray-600 mb-3 sm:mb-4 leading-normal line-clamp-2">Stylish bags for work, travel and everyday use.</p>
                    <a href="/category/bags-collection" class="inline-flex items-center bg-[#0B1A2C] text-white px-3.5 sm:px-4 py-1.5 sm:py-2 rounded-full font-sans text-[10px] sm:text-[10.5px] font-bold tracking-wider uppercase hover:bg-black transition-colors">
                        EXPLORE &rarr;
                    </a>
                </div>
            </div>

            <!-- Footwear -->
            <div class="bg-[#EFE9E0] border border-gray-200/60 rounded-xl overflow-hidden flex items-center justify-between p-5 sm:p-7 relative group min-h-[175px] sm:min-h-[190px] sm:col-span-2 lg:col-span-1">
                <div class="w-[48%] h-full absolute right-0 top-0 overflow-hidden">
                    <img src="{{ asset('images/classio/banner_footwear.jpg') }}" alt="Footwear" width="300" height="200" loading="lazy" decoding="async" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                </div>
                <div class="absolute inset-0 bg-gradient-to-r from-[#EFE9E0] via-[#EFE9E0]/95 to-transparent w-2/3 z-[1]"></div>
                <div class="relative z-10 max-w-[62%] sm:max-w-[60%]">
                    <h4 class="font-serif text-lg sm:text-xl lg:text-2xl font-bold text-[#0B1A2C] mb-1 leading-snug">Footwear</h4>
                    <p class="font-sans text-[10.5px] sm:text-[11px] text-gray-600 mb-3 sm:mb-4 leading-normal line-clamp-2">Comfort meets style for every step.</p>
                    <a href="/category/footwear" class="inline-flex items-center bg-[#0B1A2C] text-white px-3.5 sm:px-4 py-1.5 sm:py-2 rounded-full font-sans text-[10px] sm:text-[10.5px] font-bold tracking-wider uppercase hover:bg-black transition-colors">
                        SHOP FOOTWEAR &rarr;
                    </a>
                </div>
            </div>
        </div>

        <!-- Row 2: 2 Columns -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 lg:gap-5 mb-4 lg:mb-5">
            <!-- Gifts & Accessories -->
            <div class="bg-[#F6ECE6] border border-gray-200/60 rounded-xl overflow-hidden flex items-center justify-between p-6 sm:p-8 lg:p-9 relative group min-h-[190px] sm:min-h-[210px]">
                <div class="w-[48%] h-full absolute right-0 top-0 overflow-hidden">
                    <img src="{{ asset('images/classio/banner_gifts.jpg') }}" alt="Gifts & Accessories" width="400" height="250" loading="lazy" decoding="async" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                </div>
                <div class="absolute inset-0 bg-gradient-to-r from-[#F6ECE6] via-[#F6ECE6]/95 to-transparent w-2/3 z-[1]"></div>
                <div class="relative z-10 max-w-[60%] sm:max-w-[55%]">
                    <h4 class="font-serif text-xl sm:text-2xl lg:text-3xl font-bold text-[#0B1A2C] mb-1.5 leading-snug">Gifts & Accessories</h4>
                    <p class="font-sans text-[11px] sm:text-xs text-gray-600 mb-4 sm:mb-5">Perfect gifts for your<br>loved ones.</p>
                    <a href="/category/gifts-accessories" class="inline-flex items-center bg-[#0B1A2C] text-white px-4 sm:px-5 py-2 sm:py-2.5 rounded-full font-sans text-[11px] sm:text-xs font-bold tracking-wider uppercase hover:bg-black transition-colors">
                        VIEW GIFTS &rarr;
                    </a>
                </div>
            </div>

            <!-- Electronics & Audio -->
            <div class="bg-[#EEEBE4] border border-gray-200/60 rounded-xl overflow-hidden flex items-center justify-between p-6 sm:p-8 lg:p-9 relative group min-h-[190px] sm:min-h-[210px]">
                <div class="w-[48%] h-full absolute right-0 top-0 overflow-hidden">
                    <img src="{{ asset('images/classio/banner_electronics.jpg') }}" alt="Electronics & Audio" width="400" height="250" loading="lazy" decoding="async" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                </div>
                <div class="absolute inset-0 bg-gradient-to-r from-[#EEEBE4] via-[#EEEBE4]/95 to-transparent w-2/3 z-[1]"></div>
                <div class="relative z-10 max-w-[60%] sm:max-w-[55%]">
                    <h4 class="font-serif text-xl sm:text-2xl lg:text-3xl font-bold text-[#0B1A2C] mb-1.5 leading-snug">Electronics & Audio</h4>
                    <p class="font-sans text-[11px] sm:text-xs text-gray-600 mb-4 sm:mb-5">Premium audio and gadgets<br>for a better everyday life.</p>
                    <a href="/category/electronics-audio" class="inline-flex items-center bg-[#0B1A2C] text-white px-4 sm:px-5 py-2 sm:py-2.5 rounded-full font-sans text-[11px] sm:text-xs font-bold tracking-wider uppercase hover:bg-black transition-colors">
                        EXPLORE &rarr;
                    </a>
                </div>
            </div>
        </div>

        <!-- Row 3: 2 Columns (New Arrivals & Offers Deals) -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 lg:gap-5">
            <!-- New Arrivals -->
            <div class="bg-[#ECE8E1] border border-gray-200/60 rounded-xl overflow-hidden flex items-center justify-between p-6 sm:p-8 lg:p-9 relative group min-h-[190px] sm:min-h-[210px]">
                <div class="w-[48%] h-full absolute right-0 top-0 overflow-hidden">
                    <img src="{{ asset('images/classio/banner_new_arrivals.jpg') }}" alt="New Arrivals" width="400" height="250" loading="lazy" decoding="async" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                </div>
                <div class="absolute inset-0 bg-gradient-to-r from-[#ECE8E1] via-[#ECE8E1]/95 to-transparent w-2/3 z-[1]"></div>
                <div class="relative z-10 max-w-[60%] sm:max-w-[55%]">
                    <h4 class="font-serif text-xl sm:text-2xl lg:text-3xl font-bold text-[#0B1A2C] mb-1.5 leading-snug">New Arrivals</h4>
                    <p class="font-sans text-[11px] sm:text-xs text-gray-600 mb-4 sm:mb-5">Fresh styles, just for you.</p>
                    <a href="/category/new-arrivals" class="inline-flex items-center bg-[#0B1A2C] text-white px-4 sm:px-5 py-2 sm:py-2.5 rounded-full font-sans text-[11px] sm:text-xs font-bold tracking-wider uppercase hover:bg-black transition-colors">
                        SHOP NEW &rarr;
                    </a>
                </div>
            </div>

            <!-- Offers & Deals (Crimson Red Banner) -->
            <div class="bg-[#80091B] text-white rounded-xl overflow-hidden flex items-center justify-between p-6 sm:p-8 lg:p-9 relative group min-h-[190px] sm:min-h-[210px]">
                <div class="w-full h-full absolute inset-0 overflow-hidden opacity-30 mix-blend-overlay">
                    <img src="{{ asset('images/classio/banner_offers.jpg') }}" alt="Festive Deals" width="500" height="300" loading="lazy" decoding="async" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                </div>
                <div class="relative z-10 max-w-[58%] sm:max-w-[55%]">
                    <h4 class="font-serif text-xl sm:text-2xl lg:text-3xl font-bold text-white mb-1 leading-snug">Offers & Deals</h4>
                    <p class="font-sans text-[11px] sm:text-xs text-red-100 mb-4 sm:mb-5">Best deals on your favourite brands.</p>
                    <a href="/category/offers" class="inline-flex items-center border border-white/70 bg-white/10 hover:bg-white hover:text-[#80091B] text-white px-4 sm:px-5 py-1.5 sm:py-2 rounded-full font-sans text-[11px] sm:text-xs font-bold tracking-wider uppercase transition-colors">
                        SHOP OFFERS &rarr;
                    </a>
                </div>
                <div class="relative z-10 text-right pr-1 sm:pr-3">
                    <span class="block font-sans text-[9px] sm:text-[10px] tracking-widest uppercase font-semibold text-red-200">UP TO</span>
                    <span class="font-serif text-4xl sm:text-5xl lg:text-6xl font-black text-white leading-none">50<span class="text-xl sm:text-2xl font-bold">%<br><span class="text-[10px] sm:text-xs uppercase tracking-widest font-sans">OFF</span></span></span>
                </div>
            </div>
        </div>
    </section>

    <!-- 8. FEATURED COLLECTIONS SECTION -->
    <section class="max-w-[1440px] mx-auto px-3 sm:px-6 lg:px-8 pb-8 sm:pb-12 lg:pb-16" x-data="{ activeTab: 'all' }">
        <div class="flex flex-col sm:flex-row sm:items-end justify-between mb-4 sm:mb-6 gap-3 sm:gap-4">
            <div>
                <h2 class="font-serif text-xl sm:text-2xl lg:text-3xl font-bold text-[#0B1A2C]">Featured Collections</h2>
                <p class="font-sans text-[11px] sm:text-xs text-gray-500 mt-0.5">Handpicked styles you'll love</p>
            </div>

            <!-- Tab Pills (Scrollable on small mobile) -->
            <div class="flex items-center gap-1.5 overflow-x-auto no-scrollbar py-1">
                <button @click="activeTab = 'all'" :class="activeTab === 'all' ? 'bg-[#D8C3A5] text-[#0B1A2C]' : 'bg-gray-100 text-gray-700 hover:bg-gray-200'" class="px-3.5 sm:px-4 py-1 sm:py-1.5 rounded-full font-sans text-xs font-semibold transition-colors flex-shrink-0">All</button>
                <button @click="activeTab = 'women'" :class="activeTab === 'women' ? 'bg-[#D8C3A5] text-[#0B1A2C]' : 'bg-transparent text-gray-500 hover:bg-gray-100'" class="px-3 py-1 sm:py-1.5 rounded-full font-sans text-xs font-semibold transition-colors flex-shrink-0">Women</button>
                <button @click="activeTab = 'men'" :class="activeTab === 'men' ? 'bg-[#D8C3A5] text-[#0B1A2C]' : 'bg-transparent text-gray-500 hover:bg-gray-100'" class="px-3 py-1 sm:py-1.5 rounded-full font-sans text-xs font-semibold transition-colors flex-shrink-0">Men</button>
                <button @click="activeTab = 'watches'" :class="activeTab === 'watches' ? 'bg-[#D8C3A5] text-[#0B1A2C]' : 'bg-transparent text-gray-500 hover:bg-gray-100'" class="px-3 py-1 sm:py-1.5 rounded-full font-sans text-xs font-semibold transition-colors flex-shrink-0">Watches</button>
                <button @click="activeTab = 'bags'" :class="activeTab === 'bags' ? 'bg-[#D8C3A5] text-[#0B1A2C]' : 'bg-transparent text-gray-500 hover:bg-gray-100'" class="px-3 py-1 sm:py-1.5 rounded-full font-sans text-xs font-semibold transition-colors flex-shrink-0">Bags</button>
                <button @click="activeTab = 'footwear'" :class="activeTab === 'footwear' ? 'bg-[#D8C3A5] text-[#0B1A2C]' : 'bg-transparent text-gray-500 hover:bg-gray-100'" class="px-3 py-1 sm:py-1.5 rounded-full font-sans text-xs font-semibold transition-colors flex-shrink-0">Footwear</button>
                <button @click="activeTab = 'accessories'" :class="activeTab === 'accessories' ? 'bg-[#D8C3A5] text-[#0B1A2C]' : 'bg-transparent text-gray-500 hover:bg-gray-100'" class="px-3 py-1 sm:py-1.5 rounded-full font-sans text-xs font-semibold transition-colors flex-shrink-0">Accessories</button>
            </div>

            <a href="/category/featured" class="font-sans text-xs font-semibold text-gray-800 hover:text-[#0B1A2C] transition-colors hidden sm:flex items-center gap-1">
                View All <svg class="w-3.5 h-3.5 ml-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
            </a>
        </div>

        <!-- 6 Featured Products Grid (2:2 mobile) -->
        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-6 gap-2.5 sm:gap-4 lg:gap-5">
            @foreach($allFeaturedProducts as $product)
                @php
                    $catSlug = $product->category->slug ?? '';
                    $subSlug = $product->subcategory->slug ?? '';
                    $tag = 'all';
                    if (str_contains($catSlug, 'ladies') || str_contains($catSlug, 'women') || str_contains($subSlug, 'women')) $tag = 'women';
                    elseif (str_contains($catSlug, 'gents') || str_contains($catSlug, 'men') || str_contains($subSlug, 'men')) $tag = 'men';
                    elseif (str_contains($catSlug, 'watch') || str_contains($subSlug, 'watch')) $tag = 'watches';
                    elseif (str_contains($catSlug, 'bag') || str_contains($subSlug, 'bag')) $tag = 'bags';
                    elseif (str_contains($catSlug, 'footwear') || str_contains($catSlug, 'shoe') || str_contains($subSlug, 'footwear')) $tag = 'footwear';
                    elseif (str_contains($catSlug, 'accessories') || str_contains($subSlug, 'accessories')) $tag = 'accessories';
                @endphp
                <div x-show="activeTab === 'all' || activeTab === '{{ $tag }}'"
                     x-transition:enter="transition ease-out duration-200"
                     x-transition:enter-start="opacity-0 scale-95"
                     x-transition:enter-end="opacity-100 scale-100">
                    <x-product-card :product="$product" :showRating="false" :showSubtitle="false" />
                </div>
            @endforeach
        </div>
    </section>

    <!-- 9. BRAND STORY SECTION (CLASSIO - Inspired by You) -->
    <section class="max-w-[1440px] mx-auto px-3 sm:px-6 lg:px-8 pb-8 sm:pb-12 lg:pb-16">
        <div class="bg-[#F4F0E9] border border-gray-200/60 rounded-xl overflow-hidden grid grid-cols-1 lg:grid-cols-12 items-stretch">
            <!-- Left Wardrobe Photo -->
            <div class="lg:col-span-4 h-48 sm:h-64 lg:h-auto min-h-[220px] relative overflow-hidden">
                <img src="{{ asset('images/classio/brand_boutique.jpg') }}" alt="Classio Boutique" width="500" height="400" loading="lazy" decoding="async" class="w-full h-full object-cover">
            </div>

            <!-- Center Brand Story & Crest -->
            <div class="lg:col-span-4 p-6 sm:p-8 lg:p-10 flex flex-col justify-center items-center text-center border-y lg:border-y-0 lg:border-x border-gray-200/60">
                <div class="text-[#D8C3A5] mb-1.5 sm:mb-2">
                    <svg class="w-7 sm:w-8 h-5 sm:h-6" viewBox="0 0 36 24" fill="currentColor">
                        <path d="M18 1L21.5 8.5L29 3.5L25.5 13H10.5L7 3.5L14.5 8.5L18 1Z" opacity="0.9"/>
                        <path d="M8 15.5H28C28.8 15.5 29.5 16.2 29.5 17C29.5 17.8 28.8 18.5 28 18.5H8C7.2 18.5 6.5 17.8 6.5 17C6.5 16.2 7.2 15.5 8 15.5Z" />
                        <circle cx="18" cy="1" r="1.5"/>
                        <circle cx="7" cy="3.5" r="1.3"/>
                        <circle cx="29" cy="3.5" r="1.3"/>
                    </svg>
                </div>
                <h3 class="font-serif text-xl sm:text-2xl font-bold tracking-[0.2em] text-[#0B1A2C] leading-none mb-1">CLASSIO</h3>
                <span class="text-[6.5px] sm:text-[7px] tracking-[0.3em] text-gray-500 uppercase font-sans mb-3 sm:mb-4">INSPIRED BY YOU</span>
                
                <p class="font-sans text-xs text-gray-600 max-w-xs leading-relaxed mb-5 sm:mb-6">
                    Your ultimate destination for clothes, accessories, shoes, and more. Inspired by you.
                </p>

                <a href="/about" class="inline-flex items-center gap-1.5 bg-[#0B1A2C] text-white px-6 sm:px-7 py-2 sm:py-2.5 rounded-full font-sans text-xs font-semibold tracking-wider uppercase hover:bg-black transition-colors">
                    OUR STORY &rarr;
                </a>
            </div>

            <!-- Right 4 Quality Points -->
            <div class="lg:col-span-4 p-6 sm:p-8 lg:p-10 flex flex-col justify-center space-y-4 sm:space-y-5">
                <!-- Premium Quality -->
                <div class="flex items-center gap-3 sm:gap-4">
                    <div class="w-9 h-9 sm:w-10 sm:h-10 rounded-full border border-gray-300 flex items-center justify-center text-gray-700 flex-shrink-0">
                        <svg class="w-4 sm:w-5 h-4 sm:h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.6" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path></svg>
                    </div>
                    <div>
                        <h4 class="font-sans text-xs font-bold text-gray-900">Premium Quality</h4>
                        <p class="font-sans text-[10.5px] sm:text-[11px] text-gray-500">Carefully curated products</p>
                    </div>
                </div>

                <!-- Trendy Collections -->
                <div class="flex items-center gap-3 sm:gap-4">
                    <div class="w-9 h-9 sm:w-10 sm:h-10 rounded-full border border-gray-300 flex items-center justify-center text-gray-700 flex-shrink-0">
                        <svg class="w-4 sm:w-5 h-4 sm:h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.6" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"></path></svg>
                    </div>
                    <div>
                        <h4 class="font-sans text-xs font-bold text-gray-900">Trendy Collections</h4>
                        <p class="font-sans text-[10.5px] sm:text-[11px] text-gray-500">Latest styles every season</p>
                    </div>
                </div>

                <!-- Affordable Luxury -->
                <div class="flex items-center gap-3 sm:gap-4">
                    <div class="w-9 h-9 sm:w-10 sm:h-10 rounded-full border border-gray-300 flex items-center justify-center text-gray-700 flex-shrink-0">
                        <svg class="w-4 sm:w-5 h-4 sm:h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.6" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    </div>
                    <div>
                        <h4 class="font-sans text-xs font-bold text-gray-900">Affordable Luxury</h4>
                        <p class="font-sans text-[10.5px] sm:text-[11px] text-gray-500">Great style, great value</p>
                    </div>
                </div>

                <!-- Customer First -->
                <div class="flex items-center gap-3 sm:gap-4">
                    <div class="w-9 h-9 sm:w-10 sm:h-10 rounded-full border border-gray-300 flex items-center justify-center text-gray-700 flex-shrink-0">
                        <svg class="w-4 sm:w-5 h-4 sm:h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.6" d="M14.828 14.828a4 4 0 01-5.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    </div>
                    <div>
                        <h4 class="font-sans text-xs font-bold text-gray-900">Customer First</h4>
                        <p class="font-sans text-[10.5px] sm:text-[11px] text-gray-500">Your satisfaction matters</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- 10. VALUE PROPOSITIONS BAR -->
    <section class="border-y border-gray-200/80 bg-white">
        <div class="max-w-[1440px] mx-auto px-4 sm:px-6 lg:px-8 py-6 sm:py-7">
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4 sm:gap-6 text-center divide-x-0 md:divide-x divide-gray-100">
                <div class="flex flex-col items-center px-2 sm:px-4">
                    <div class="w-10 h-10 sm:w-11 sm:h-11 rounded-full border border-gray-200 flex items-center justify-center text-gray-800 mb-2 shadow-sm">
                        <svg class="w-4 sm:w-5 h-4 sm:h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4"></path></svg>
                    </div>
                    <h5 class="font-sans text-xs font-bold text-gray-900">Free Shipping</h5>
                    <p class="font-sans text-[10.5px] sm:text-[11px] text-gray-500 mt-0.5">On orders above ₹999</p>
                </div>
                <div class="flex flex-col items-center px-2 sm:px-4">
                    <div class="w-10 h-10 sm:w-11 sm:h-11 rounded-full border border-gray-200 flex items-center justify-center text-gray-800 mb-2 shadow-sm">
                        <svg class="w-4 sm:w-5 h-4 sm:h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path></svg>
                    </div>
                    <h5 class="font-sans text-xs font-bold text-gray-900">Easy Returns</h5>
                    <p class="font-sans text-[10.5px] sm:text-[11px] text-gray-500 mt-0.5">Hassle-free returns</p>
                </div>
                <div class="flex flex-col items-center px-2 sm:px-4">
                    <div class="w-10 h-10 sm:w-11 sm:h-11 rounded-full border border-gray-200 flex items-center justify-center text-gray-800 mb-2 shadow-sm">
                        <svg class="w-4 sm:w-5 h-4 sm:h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                    </div>
                    <h5 class="font-sans text-xs font-bold text-gray-900">Secure Payments</h5>
                    <p class="font-sans text-[10.5px] sm:text-[11px] text-gray-500 mt-0.5">100% safe & secure</p>
                </div>
                <div class="flex flex-col items-center px-2 sm:px-4">
                    <div class="w-10 h-10 sm:w-11 sm:h-11 rounded-full border border-gray-200 flex items-center justify-center text-gray-800 mb-2 shadow-sm">
                        <svg class="w-4 sm:w-5 h-4 sm:h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M9.172 9.172L5.636 5.636m3.536 9.192l-3.536 3.536M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-5 0a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                    </div>
                    <h5 class="font-sans text-xs font-bold text-gray-900">24/7 Support</h5>
                    <p class="font-sans text-[10.5px] sm:text-[11px] text-gray-500 mt-0.5">We're here to help</p>
                </div>
            </div>
        </div>
    </section>

    <!-- 11. REELS SHOWCASE -->
    <x-reels-section />

    <!-- 12. INSTAGRAM GALLERY -->
    <x-instagram-gallery />

    <!-- 12. NEWSLETTER SIGNUP BANNER (Stay in Style) -->
    <section class="bg-[#0B1A2C] text-white overflow-hidden relative">
        <div class="max-w-[1440px] mx-auto grid grid-cols-1 md:grid-cols-12 items-center">
            <div class="md:col-span-8 p-6 sm:p-10 lg:p-16 flex flex-col justify-center">
                <h3 class="font-script text-3xl sm:text-4xl lg:text-5xl text-[#E5D5BC] mb-2">Stay in Style</h3>
                <p class="font-sans text-xs sm:text-sm text-gray-300 mb-5 sm:mb-6">
                    Subscribe to get exclusive offers, new arrivals and fashion updates.
                </p>
                <form class="flex flex-col sm:flex-row w-full max-w-md shadow-lg gap-2 sm:gap-0" onsubmit="event.preventDefault(); alert('Subscribed successfully!');">
                    <input type="email" required placeholder="Enter your email address..." class="flex-1 bg-white border-0 px-4 py-2.5 sm:py-3 text-gray-900 font-sans text-xs focus:outline-none rounded sm:rounded-r-none">
                    <button type="submit" class="bg-[#D8C3A5] hover:bg-[#c9b291] text-[#0B1A2C] px-6 py-2.5 sm:py-3 font-sans text-xs font-bold tracking-wider uppercase transition-colors rounded sm:rounded-l-none flex items-center justify-center gap-1">
                        SUBSCRIBE &rarr;
                    </button>
                </form>
            </div>
            
            <!-- Right Model with Hat Photo (Hidden on small mobile screens to keep layout clean and tight) -->
            <div class="hidden md:block md:col-span-4 h-full min-h-[220px] md:min-h-[260px] relative overflow-hidden">
                <img src="{{ asset('images/classio/newsletter_model.jpg') }}" alt="Stay in Style" width="400" height="260" loading="lazy" decoding="async" class="w-full h-full object-cover object-top">
                <div class="absolute inset-0 bg-gradient-to-r from-[#0B1A2C] via-transparent to-transparent"></div>
            </div>
        </div>
    </section>
</x-layout.app>
