<x-layout.app :categories="$categories">
    <div class="bg-[#FAF9F6] min-h-screen pb-24" x-data="wishlistData()">
        
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
                            <span class="text-[#0F1A2C] font-semibold">Your Wishlist</span>
                        </div>
                    </li>
                </ol>
            </nav>
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            <div class="flex items-center justify-between mb-12">
                <h1 class="font-serif text-3xl md:text-4xl lg:text-5xl font-bold text-[#0F1A2C]">Saved Products</h1>
                <span class="font-sans text-sm font-semibold uppercase tracking-widest text-gray-400" x-show="!isLoading" x-text="itemCount + ' Items'" x-cloak></span>
            </div>

            <!-- Loading State -->
            <div x-show="isLoading" class="py-20 flex flex-col items-center justify-center text-gray-400">
                <svg class="animate-spin mb-4 h-10 w-10 text-[#0F1A2C]" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                </svg>
                <span class="font-sans text-sm font-bold uppercase tracking-widest text-[#0F1A2C]">Loading your wishlist...</span>
            </div>

            <!-- Empty Wishlist -->
            <div x-show="!isLoading && itemCount === 0" class="text-center py-20 border border-gray-200 bg-white" x-cloak>
                <svg class="w-16 h-16 mx-auto text-[#D8C3A5] mb-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path></svg>
                <h2 class="font-serif text-2xl font-bold text-[#0F1A2C] mb-4">Your wishlist is empty.</h2>
                <p class="font-sans text-gray-500 mb-8 max-w-md mx-auto">Save your favorite items here to review them later.</p>
                <a href="{{ route('home') }}" class="inline-block bg-[#0F1A2C] text-white px-8 py-3 font-sans text-xs font-bold uppercase tracking-widest hover:bg-[#D8C3A5] hover:text-[#0F1A2C] transition-colors focus:outline-none focus:ring-2 focus:ring-[#0F1A2C] focus:ring-offset-2">
                    Explore Collections
                </a>
            </div>

            <!-- Wishlist Content -->
            <div x-show="!isLoading && itemCount > 0" class="grid grid-cols-2 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-2.5 sm:gap-4 md:gap-6" x-html="productsHtml" x-cloak>
                <!-- HTML injected via AJAX -->
            </div>
            
        </div>
    </div>

    @push('scripts')
    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('wishlistData', () => ({
                items: JSON.parse(localStorage.getItem('wishlist') || '[]'),
                isLoading: true,
                productsHtml: '',
                
                get itemCount() {
                    return this.items.length;
                },
                
                async init() {
                    this.loadProducts();
                    
                    // Listen to cross-tab or global wishlist changes
                    window.addEventListener('wishlist-updated', () => {
                        let newItems = JSON.parse(localStorage.getItem('wishlist') || '[]');
                        // If items changed (e.g. removed), we could re-render, but it might flicker. 
                        // Instead, we just refresh if items count dropped (removed).
                        if (newItems.length !== this.items.length) {
                            this.items = newItems;
                            this.loadProducts();
                        }
                    });
                    
                    window.addEventListener('storage', (e) => {
                        if (e.key === 'wishlist') {
                            this.items = JSON.parse(e.newValue || '[]');
                            this.loadProducts();
                        }
                    });
                },
                
                async loadProducts() {
                    if (this.items.length === 0) {
                        this.productsHtml = '';
                        this.isLoading = false;
                        return;
                    }
                    
                    this.isLoading = true;
                    
                    try {
                        let ids = this.items.map(i => i.product_id).join(',');
                        let response = await fetch(`{{ route('wishlist.products') }}?ids=${ids}`, {
                            headers: {
                                'Accept': 'application/json'
                            }
                        });
                        
                        let data = await response.json();
                        
                        this.productsHtml = data.html;
                        
                        // Clean up invalid items from localStorage safely
                        let validIds = data.valid_ids || [];
                        let cleanedItems = this.items.filter(item => validIds.includes(item.product_id));
                        
                        if (cleanedItems.length !== this.items.length) {
                            this.items = cleanedItems;
                            localStorage.setItem('wishlist', JSON.stringify(this.items));
                            window.dispatchEvent(new CustomEvent('wishlist-updated'));
                        }
                        
                    } catch (error) {
                        console.error('Failed to load wishlist products:', error);
                    } finally {
                        this.isLoading = false;
                    }
                }
            }));
        });
    </script>
    @endpush
</x-layout.app>
