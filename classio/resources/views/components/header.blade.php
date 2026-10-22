@props(['categories' => []])
<header class="w-full z-50 sticky top-0 bg-[#0B1A2C] shadow-md select-none" x-data="{ 
    mobileMenuOpen: false, 
    searchOpen: false,
    cartCount: 0,
    wishlistCount: 0,
    updateCounters() {
        try {
            let cart = JSON.parse(localStorage.getItem('cart') || '[]');
            this.cartCount = cart.reduce((total, item) => total + (item.quantity || 1), 0);
            let wishlist = JSON.parse(localStorage.getItem('wishlist') || '[]');
            this.wishlistCount = wishlist.length;
        } catch(e) {}
    }
}" x-init="updateCounters()" @cart-updated.window="updateCounters()" @wishlist-updated.window="updateCounters()">

    <!-- Main Navbar -->
    <div class="bg-[#0B1A2C] text-white">
        <div class="max-w-[1440px] mx-auto px-3 sm:px-6">
            <div class="flex items-center justify-between h-14 sm:h-20 gap-2 sm:gap-3">
                <!-- Mobile / Tablet Menu Button -->
                <div class="flex items-center lg:hidden">
                    <button @click="mobileMenuOpen = true" class="text-gray-300 hover:text-white p-2 -ml-2 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#D8C3A5]" aria-label="Open navigation menu">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path></svg>
                    </button>
                    <!-- Mobile Search Trigger Button -->
                    <button @click="searchOpen = !searchOpen" class="text-gray-300 hover:text-white p-2 rounded-lg focus:outline-none sm:hidden" aria-label="Toggle search">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                    </button>
                </div>

                <!-- Brand Logo (Centered on mobile, left on desktop) -->
                <div class="flex-shrink-0 flex items-center">
                    <a href="/" class="flex flex-col items-center group">
                        <div class="text-[#D8C3A5] mb-0.5 sm:mb-1">
                            <svg class="w-6 sm:w-7 h-4 sm:h-5" viewBox="0 0 36 24" fill="currentColor">
                                <path d="M18 1L21.5 8.5L29 3.5L25.5 13H10.5L7 3.5L14.5 8.5L18 1Z" opacity="0.9"/>
                                <path d="M8 15.5H28C28.8 15.5 29.5 16.2 29.5 17C29.5 17.8 28.8 18.5 28 18.5H8C7.2 18.5 6.5 17.8 6.5 17C6.5 16.2 7.2 15.5 8 15.5Z" />
                                <circle cx="18" cy="1" r="1.5"/>
                                <circle cx="7" cy="3.5" r="1.3"/>
                                <circle cx="29" cy="3.5" r="1.3"/>
                            </svg>
                        </div>
                        <span class="font-serif text-[19px] sm:text-[23px] tracking-[0.22em] font-extrabold text-[#D8C3A5] leading-none">CLASSIO</span>
                        <span class="text-[6px] sm:text-[6.5px] tracking-[0.32em] text-[#D8C3A5]/80 font-sans uppercase mt-0.5 leading-none">INSPIRED BY YOU</span>
                    </a>
                </div>

                <!-- Center Navigation Links (Clean, Organized, Non-crowded) -->
                <nav class="hidden lg:flex items-center space-x-3 xl:space-x-5 text-[11px] xl:text-xs font-sans font-semibold tracking-wider uppercase text-white/90">
                    <a href="/category/gents-collection" class="hover:text-[#D8C3A5] transition-colors py-2 whitespace-nowrap">Men</a>
                    <a href="/category/ladies-collection" class="hover:text-[#D8C3A5] transition-colors py-2 whitespace-nowrap">Women</a>
                    <a href="/category/watches-perfumes" class="hover:text-[#D8C3A5] transition-colors py-2 whitespace-nowrap">Watches & Perfumes</a>
                    <a href="/category/bags-collection" class="hover:text-[#D8C3A5] transition-colors py-2 whitespace-nowrap">Bags</a>
                    <a href="/category/footwear" class="hover:text-[#D8C3A5] transition-colors py-2 whitespace-nowrap">Footwear</a>
                    <a href="/category/fashion-accessories" class="hover:text-[#D8C3A5] transition-colors py-2 whitespace-nowrap">Accessories</a>
                    <a href="/category/new-arrivals" class="hover:text-[#D8C3A5] transition-colors py-2 whitespace-nowrap">New Arrivals</a>
                    <a href="/category/offers" class="hover:text-white transition-colors py-1.5 px-3 rounded-full bg-[#8E0F1E] hover:bg-[#a31223] text-white flex items-center gap-1 shadow-sm whitespace-nowrap">
                        <span>Offers</span>
                        <span class="font-bold text-[9px] bg-white/20 px-1 py-0.2 rounded-full">%</span>
                    </a>
                </nav>

                <!-- Right Utilities: Search, Account, Wishlist, Cart -->
                <div class="flex-shrink-0 flex items-center space-x-2.5 sm:space-x-3 lg:space-x-4">
                    <!-- Pill Search Input with Live Autocomplete -->
                    <div class="hidden sm:block relative" 
                         x-data="{
                            query: '',
                            results: { categories: [], products: [], total: 0 },
                            loading: false,
                            open: false,
                            timer: null,
                            onInput() {
                                clearTimeout(this.timer);
                                if (this.query.trim().length < 2) {
                                    this.open = false;
                                    this.results = { categories: [], products: [], total: 0 };
                                    return;
                                }
                                this.loading = true;
                                this.timer = setTimeout(() => {
                                    fetch('{{ route('search.suggest') }}?q=' + encodeURIComponent(this.query))
                                        .then(res => res.json())
                                        .then(data => {
                                            this.results = data;
                                            this.loading = false;
                                            this.open = true;
                                        })
                                        .catch(() => { this.loading = false; });
                                }, 250);
                            }
                         }"
                         @click.outside="open = false">
                        <form action="{{ route('search') }}" method="GET" class="relative">
                            <input type="text" 
                                   name="q" 
                                   x-model="query"
                                   @input="onInput()"
                                   @focus="if (query.trim().length >= 2 && results.total > 0) open = true"
                                   placeholder="Search products & categories..." 
                                   autocomplete="off"
                                   aria-label="Search" 
                                   class="bg-[#122238] text-xs text-white border border-white/20 rounded-full pl-3.5 pr-8 py-1.5 w-40 md:w-48 lg:w-56 xl:w-64 focus:outline-none focus:border-[#D8C3A5] placeholder-gray-400 transition-all duration-300">
                            <button type="submit" class="absolute right-2.5 top-1/2 -translate-y-1/2 text-gray-400 hover:text-white" aria-label="Submit search">
                                <template x-if="!loading">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                                </template>
                                <template x-if="loading">
                                    <svg class="animate-spin w-3.5 h-3.5 text-[#D8C3A5]" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8H4z"></path></svg>
                                </template>
                            </button>
                        </form>

                        <!-- Autocomplete Dropdown -->
                        <div x-show="open" 
                             x-transition:enter="transition ease-out duration-200"
                             x-transition:enter-start="opacity-0 translate-y-2"
                             x-transition:enter-end="opacity-100 translate-y-0"
                             x-transition:leave="transition ease-in duration-150"
                             x-transition:leave-start="opacity-100 translate-y-0"
                             x-transition:leave-end="opacity-0 translate-y-2"
                             class="absolute right-0 mt-2 w-80 md:w-96 bg-[#0E2034] border border-[#D8C3A5]/30 rounded-2xl shadow-2xl overflow-hidden z-50 text-left" 
                             style="display: none;">
                            
                            <!-- Categories Section -->
                            <template x-if="results.categories && results.categories.length > 0">
                                <div class="p-3 border-b border-white/10 bg-[#0A1828]">
                                    <div class="text-[10px] uppercase font-bold tracking-wider text-[#D8C3A5] mb-2 flex items-center justify-between">
                                        <span>Categories</span>
                                        <span class="text-[9px] text-gray-400" x-text="results.categories.length + ' matching'"></span>
                                    </div>
                                    <div class="flex flex-wrap gap-1.5">
                                        <template x-for="cat in results.categories" :key="cat.id">
                                            <a :href="cat.url" class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full bg-[#16293D] hover:bg-[#D8C3A5] text-gray-200 hover:text-[#0B1A2C] text-[11px] font-medium transition-colors border border-white/10">
                                                <span x-text="cat.name"></span>
                                                <span class="text-[9px] opacity-70" x-text="'(' + cat.count + ')'"></span>
                                            </a>
                                        </template>
                                    </div>
                                </div>
                            </template>

                            <!-- Products Section -->
                            <div class="max-h-80 overflow-y-auto p-2 divide-y divide-white/5">
                                <template x-if="results.products && results.products.length > 0">
                                    <div>
                                        <div class="px-2.5 py-1.5 text-[10px] uppercase font-bold tracking-wider text-[#D8C3A5]/80">
                                            Products
                                        </div>
                                        <template x-for="prod in results.products" :key="prod.id">
                                            <a :href="prod.url" class="flex items-center gap-3 p-2 hover:bg-white/5 rounded-xl transition-colors group">
                                                <div class="w-11 h-11 rounded-lg bg-[#16293D] overflow-hidden flex-shrink-0 border border-white/10">
                                                    <img :src="prod.image" :alt="prod.name" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                                                </div>
                                                <div class="flex-1 min-w-0">
                                                    <p class="text-xs font-semibold text-white truncate group-hover:text-[#D8C3A5] transition-colors" x-text="prod.name"></p>
                                                    <p class="text-[10px] text-gray-400 truncate" x-text="prod.category_name"></p>
                                                    <div class="flex items-center gap-2 mt-0.5">
                                                        <span class="text-xs font-bold text-[#E5D5BC]" x-text="'₹' + prod.price"></span>
                                                        <template x-if="prod.compare_at">
                                                            <span class="text-[10px] text-gray-500 line-through" x-text="'₹' + prod.compare_at"></span>
                                                        </template>
                                                    </div>
                                                </div>
                                                <svg class="w-4 h-4 text-gray-500 group-hover:text-[#D8C3A5] group-hover:translate-x-0.5 transition-all flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                                            </a>
                                        </template>
                                    </div>
                                </template>

                                <!-- No results -->
                                <template x-if="results.total === 0 && !loading && query.trim().length >= 2">
                                    <div class="p-6 text-center text-xs text-gray-400">
                                        <p class="font-medium text-gray-300">No results found</p>
                                        <p class="text-[11px] mt-1 text-gray-500">No products or categories found for "<span class="text-white" x-text="query"></span>".</p>
                                    </div>
                                </template>
                            </div>

                            <!-- View All Results Footer -->
                            <template x-if="results.total > 0">
                                <a :href="'{{ route('search') }}?q=' + encodeURIComponent(query)" class="block p-2.5 text-center bg-[#071321] hover:bg-[#D8C3A5] text-[#D8C3A5] hover:text-[#0B1A2C] text-xs font-semibold tracking-wider transition-colors border-t border-white/10">
                                    View all results for "<span x-text="query"></span>" &rarr;
                                </a>
                            </template>
                        </div>
                    </div>
                    
                    <!-- Account Icon (Dynamic based on Auth state) -->
                    @auth
                        @if(Auth::user()->email === 'admin@classio.com' || (Auth::user()->is_admin ?? false))
                            <a href="{{ route('admin.dashboard') }}" class="text-gray-300 hover:text-[#D8C3A5] transition-colors p-1 flex items-center gap-1.5" title="Admin Dashboard">
                                <span class="w-7 h-7 rounded-full bg-[#D8C3A5] text-[#0B1A2C] font-bold text-[11px] flex items-center justify-center shadow-sm">A</span>
                                <span class="hidden xl:inline text-[11px] text-[#D8C3A5] font-semibold">Admin</span>
                            </a>
                        @else
                            <a href="{{ route('account.index') }}" class="text-gray-300 hover:text-[#D8C3A5] transition-colors p-1 flex items-center gap-1.5" title="{{ Auth::user()->name }}">
                                <span class="w-7 h-7 rounded-full bg-[#D8C3A5] text-[#0B1A2C] font-bold text-[11px] flex items-center justify-center shadow-sm">{{ strtoupper(substr(Auth::user()->name, 0, 1)) }}</span>
                                <span class="hidden xl:inline text-[11px] text-gray-200">{{ Str::limit(Auth::user()->name, 12) }}</span>
                            </a>
                        @endif
                    @else
                        <a href="{{ route('login') }}" class="text-gray-300 hover:text-[#D8C3A5] transition-colors p-1 flex items-center gap-1" aria-label="Sign In" title="Customer / Admin Sign In">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.6" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                        </a>
                    @endauth
                    
                    <!-- Wishlist Icon (Reactive badge from localStorage) -->
                    <a href="{{ route('wishlist.index') }}" class="text-gray-300 hover:text-[#D8C3A5] transition-colors p-1 relative flex items-center" aria-label="Wishlist">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.6" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path></svg>
                        <span x-show="wishlistCount > 0" x-text="wishlistCount" class="absolute -top-1.5 -right-1.5 bg-[#B91C1C] text-white text-[9px] font-bold h-4 w-4 rounded-full flex items-center justify-center shadow-sm" style="display: none;"></span>
                    </a>
                    
                    <!-- Shopping Cart Icon (Reactive badge from localStorage) -->
                    <a href="{{ route('cart.index') }}" class="text-gray-300 hover:text-[#D8C3A5] transition-colors relative flex items-center p-1" aria-label="Shopping Cart">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.6" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                        <span x-show="cartCount > 0" x-text="cartCount" class="absolute -top-1.5 -right-1.5 bg-[#D8C3A5] text-[#0B1A2C] text-[9px] font-bold h-4 w-4 rounded-full flex items-center justify-center shadow-sm" style="display: none;"></span>
                    </a>
                </div>
            </div>

            <!-- Mobile Dropdown Search Field with Autocomplete -->
            <div x-show="searchOpen" 
                 x-transition.opacity.duration.200ms 
                 class="sm:hidden pb-3 pt-1 border-t border-white/10 relative" 
                 x-data="{
                    mQuery: '',
                    mResults: { categories: [], products: [], total: 0 },
                    mLoading: false,
                    mOpen: false,
                    mTimer: null,
                    onMobileInput() {
                        clearTimeout(this.mTimer);
                        if (this.mQuery.trim().length < 2) {
                            this.mOpen = false;
                            this.mResults = { categories: [], products: [], total: 0 };
                            return;
                        }
                        this.mLoading = true;
                        this.mTimer = setTimeout(() => {
                            fetch('{{ route('search.suggest') }}?q=' + encodeURIComponent(this.mQuery))
                                .then(res => res.json())
                                .then(data => {
                                    this.mResults = data;
                                    this.mLoading = false;
                                    this.mOpen = true;
                                })
                                .catch(() => { this.mLoading = false; });
                        }, 250);
                    }
                 }"
                 style="display: none;">
                <form action="{{ route('search') }}" method="GET" class="relative">
                    <input type="text" 
                           name="q" 
                           x-model="mQuery"
                           @input="onMobileInput()"
                           placeholder="Search products, categories..." 
                           autocomplete="off"
                           class="w-full bg-[#122238] text-xs text-white border border-white/20 rounded-full pl-4 pr-10 py-2.5 focus:outline-none focus:border-[#D8C3A5] placeholder-gray-400">
                    <button type="submit" class="absolute right-3.5 top-1/2 -translate-y-1/2 text-gray-400 hover:text-white" aria-label="Search">
                        <template x-if="!mLoading">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                        </template>
                        <template x-if="mLoading">
                            <svg class="animate-spin w-4 h-4 text-[#D8C3A5]" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8H4z"></path></svg>
                        </template>
                    </button>
                </form>

                <!-- Mobile Autocomplete Results -->
                <div x-show="mOpen && mResults.total > 0" class="mt-2 bg-[#0E2034] border border-[#D8C3A5]/30 rounded-xl overflow-hidden shadow-xl max-h-72 overflow-y-auto">
                    <template x-if="mResults.categories.length > 0">
                        <div class="p-2 border-b border-white/10 bg-[#0A1828]">
                            <span class="text-[9px] uppercase font-bold text-[#D8C3A5] block mb-1">Categories</span>
                            <div class="flex flex-wrap gap-1">
                                <template x-for="c in mResults.categories" :key="c.id">
                                    <a :href="c.url" class="px-2 py-0.5 rounded bg-[#16293D] text-[10px] text-gray-200 border border-white/10" x-text="c.name"></a>
                                </template>
                            </div>
                        </div>
                    </template>
                    <template x-for="p in mResults.products" :key="p.id">
                        <a :href="p.url" class="flex items-center gap-2 p-2 hover:bg-white/5 border-b border-white/5">
                            <img :src="p.image" :alt="p.name" class="w-8 h-8 rounded object-cover">
                            <div class="flex-1 min-w-0">
                                <p class="text-xs text-white truncate" x-text="p.name"></p>
                                <p class="text-[10px] text-[#E5D5BC] font-semibold" x-text="'₹' + p.price"></p>
                            </div>
                        </a>
                    </template>
                </div>
            </div>
        </div>
    </div>

    <!-- Mobile Navigation Drawer Overlay & Panel -->
    <div x-show="mobileMenuOpen" 
         x-transition:enter="transition-opacity ease-linear duration-300"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition-opacity ease-linear duration-200"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"
         class="fixed inset-0 z-50 bg-black/60 backdrop-blur-sm lg:hidden" 
         @click="mobileMenuOpen = false"
         style="display: none;">
    </div>

    <div x-show="mobileMenuOpen"
         x-transition:enter="transition ease-out duration-300 transform"
         x-transition:enter-start="-translate-x-full"
         x-transition:enter-end="translate-x-0"
         x-transition:leave="transition ease-in duration-200 transform"
         x-transition:leave-start="translate-x-0"
         x-transition:leave-end="-translate-x-full"
         class="fixed inset-y-0 left-0 z-50 w-full max-w-xs bg-[#0B1A2C] shadow-2xl flex flex-col justify-between overflow-y-auto lg:hidden"
         style="display: none;">
        
        <!-- Drawer Header -->
        <div>
            <div class="p-5 flex items-center justify-between border-b border-white/10">
                <a href="/" class="flex flex-col items-start" @click="mobileMenuOpen = false">
                    <span class="font-serif text-xl font-bold tracking-[0.2em] text-[#D8C3A5]">CLASSIO</span>
                    <span class="text-[6.5px] tracking-[0.25em] text-[#D8C3A5]/80 font-sans uppercase">INSPIRED BY YOU</span>
                </a>
                <button @click="mobileMenuOpen = false" class="p-2 text-gray-400 hover:text-white rounded-lg focus:outline-none" aria-label="Close menu">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                </button>
            </div>

            <!-- Search inside drawer -->
            <div class="p-4 border-b border-white/10">
                <form action="/search" method="GET" class="relative">
                    <input type="text" name="q" placeholder="Search collections..." class="w-full bg-[#122238] text-xs text-white border border-white/20 rounded-full pl-4 pr-9 py-2 focus:outline-none focus:border-[#D8C3A5]">
                    <button type="submit" class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-400" aria-label="Search">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                    </button>
                </form>
            </div>

            <!-- Categories Nav Links -->
            <div class="py-3 px-2">
                <div class="px-4 py-2 text-[10px] uppercase font-bold tracking-widest text-[#D8C3A5]/70">Categories</div>
                <nav class="space-y-1">
                    <a href="/category/gents-collection" @click="mobileMenuOpen = false" class="block px-4 py-2.5 text-xs font-semibold uppercase tracking-wider text-white hover:bg-white/5 rounded-lg transition-colors">Men's Fashion</a>
                    <a href="/category/ladies-collection" @click="mobileMenuOpen = false" class="block px-4 py-2.5 text-xs font-semibold uppercase tracking-wider text-white hover:bg-white/5 rounded-lg transition-colors">Women's Fashion</a>
                    <a href="/category/watches-perfumes" @click="mobileMenuOpen = false" class="block px-4 py-2.5 text-xs font-semibold uppercase tracking-wider text-white hover:bg-white/5 rounded-lg transition-colors">Watches & Perfumes</a>
                    <a href="/category/fashion-accessories" @click="mobileMenuOpen = false" class="block px-4 py-2.5 text-xs font-semibold uppercase tracking-wider text-white hover:bg-white/5 rounded-lg transition-colors">Accessories</a>
                    <a href="/category/bags-collection" @click="mobileMenuOpen = false" class="block px-4 py-2.5 text-xs font-semibold uppercase tracking-wider text-white hover:bg-white/5 rounded-lg transition-colors">Bags Collection</a>
                    <a href="/category/footwear" @click="mobileMenuOpen = false" class="block px-4 py-2.5 text-xs font-semibold uppercase tracking-wider text-white hover:bg-white/5 rounded-lg transition-colors">Footwear</a>
                    <a href="/category/gifts-accessories" @click="mobileMenuOpen = false" class="block px-4 py-2.5 text-xs font-semibold uppercase tracking-wider text-white hover:bg-white/5 rounded-lg transition-colors">Gifts & Accessories</a>
                    <a href="/category/electronics-audio" @click="mobileMenuOpen = false" class="block px-4 py-2.5 text-xs font-semibold uppercase tracking-wider text-white hover:bg-white/5 rounded-lg transition-colors">Electronics & Audio</a>
                    <a href="/category/new-arrivals" @click="mobileMenuOpen = false" class="block px-4 py-2.5 text-xs font-semibold uppercase tracking-wider text-white hover:bg-white/5 rounded-lg transition-colors">New Arrivals</a>
                    <a href="/category/offers" @click="mobileMenuOpen = false" class="block px-4 py-2.5 text-xs font-semibold uppercase tracking-wider text-[#E5D5BC] hover:bg-white/5 rounded-lg transition-colors flex items-center justify-between">
                        <span>Offers & Deals</span>
                        <span class="bg-[#991B1B] text-white text-[9px] font-bold px-1.5 py-0.5 rounded">UP TO 50%</span>
                    </a>
                </nav>
            </div>
        </div>

        <!-- Drawer Footer / Quick Utilities -->
        <div class="p-5 border-t border-white/10 bg-[#081524]">
            <div class="grid grid-cols-2 gap-2 text-xs text-gray-300 mb-4">
                <a href="{{ route('wishlist.index') }}" class="flex items-center gap-2 py-1.5 hover:text-[#D8C3A5]">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path></svg>
                    Wishlist
                </a>
                <a href="{{ route('cart.index') }}" class="flex items-center gap-2 py-1.5 hover:text-[#D8C3A5]">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                    Cart
                </a>
                <a href="{{ route('track-order') }}" class="flex items-center gap-2 py-1.5 hover:text-[#D8C3A5]">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 17a2 2 0 11-4 0 2 2 0 014 0zM19 17a2 2 0 11-4 0 2 2 0 014 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M13 16V6a1 1 0 00-1-1H4a1 1 0 00-1 1v10a1 1 0 001 1h1m8-1a1 1 0 01-1 1H9m4-1V8h4.586a1 1 0 01.707.293l3.414 3.414a1 1 0 01.293.707V16a1 1 0 01-1 1h-1m-6-1a1 1 0 001 1h2"/></svg>
                    Track Order
                </a>
                @auth
                    <a href="{{ (Auth::user()->email === 'admin@classio.com' || (Auth::user()->is_admin ?? false)) ? route('admin.dashboard') : route('account.index') }}" class="flex items-center gap-2 py-1.5 hover:text-[#D8C3A5]">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                        <span>Account</span>
                    </a>
                @else
                    <a href="{{ route('login') }}" class="flex items-center gap-2 py-1.5 hover:text-[#D8C3A5]">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                        <span>Login</span>
                    </a>
                @endauth
            </div>
            <p class="text-[10px] text-gray-500">Classio Fashion · Exhibition Road, Patna</p>
        </div>
    </div>
</header>
