<x-layout.app :categories="$categories">
    <div class="bg-[#FAF9F6] min-h-screen pb-24" x-data="cartData()">
        
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
                            <span class="text-[#0F1A2C] font-semibold">Your Cart</span>
                        </div>
                    </li>
                </ol>
            </nav>
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            <h1 class="font-serif text-3xl md:text-4xl lg:text-5xl font-bold text-[#0F1A2C] mb-12">Your Cart</h1>

            <!-- Loading State -->
            <div x-show="isProcessing" class="fixed inset-0 z-50 flex items-center justify-center bg-white/80 backdrop-blur-sm" x-cloak>
                <div class="flex flex-col items-center">
                    <svg class="animate-spin -ml-1 mr-3 h-10 w-10 text-[#0F1A2C]" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                    </svg>
                    <p class="mt-4 font-sans text-sm font-semibold uppercase tracking-widest text-[#0F1A2C]">Preparing Request...</p>
                </div>
            </div>

            <!-- Validation Error Alert -->
            <div x-show="errorMsg" class="mb-8 p-4 bg-[#991B1B]/10 border border-[#991B1B]/20 text-[#991B1B] font-sans text-sm flex flex-col" x-cloak>
                <div class="flex items-start">
                    <svg class="w-5 h-5 mr-3 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    <span x-text="errorMsg" class="font-bold"></span>
                </div>
                <template x-if="invalidItems && invalidItems.length > 0">
                    <ul class="mt-3 ml-8 list-disc space-y-1">
                        <template x-for="inv in invalidItems">
                            <li x-text="(inv.product_name || 'An item') + ': ' + inv.reason"></li>
                        </template>
                    </ul>
                </template>
            </div>

            <!-- Empty Cart -->
            <div x-show="items.length === 0" class="text-center py-20 border border-gray-200 bg-white" x-cloak>
                <svg class="w-16 h-16 mx-auto text-gray-300 mb-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
                <h2 class="font-serif text-2xl font-bold text-[#0F1A2C] mb-4">Your cart is empty.</h2>
                <p class="font-sans text-gray-500 mb-8 max-w-md mx-auto">Discover our latest collections and find something you love.</p>
                <a href="{{ route('home') }}#new-arrivals" class="inline-block bg-[#0F1A2C] text-white px-8 py-3 font-sans text-xs font-bold uppercase tracking-widest hover:bg-[#D8C3A5] hover:text-[#0F1A2C] transition-colors focus:outline-none focus:ring-2 focus:ring-[#0F1A2C] focus:ring-offset-2">
                    Browse Collections
                </a>
            </div>

            <!-- Cart Content -->
            <div x-show="items.length > 0" class="flex flex-col lg:flex-row gap-12" x-cloak>
                
                <!-- Left: Items -->
                <div class="w-full lg:w-2/3">
                    <!-- Desktop Header -->
                    <div class="hidden md:grid grid-cols-12 gap-4 pb-4 border-b border-gray-200 font-sans text-xs font-bold uppercase tracking-widest text-gray-500">
                        <div class="col-span-6">Product</div>
                        <div class="col-span-2 text-center">Price</div>
                        <div class="col-span-2 text-center">Quantity</div>
                        <div class="col-span-2 text-right">Subtotal</div>
                    </div>

                    <!-- Items List -->
                    <div class="divide-y divide-gray-200 border-b border-gray-200">
                        <template x-for="(item, index) in items" :key="item.variant_id">
                            <div class="py-8 grid grid-cols-1 md:grid-cols-12 gap-6 items-center relative">
                                
                                <!-- Product Info -->
                                <div class="col-span-1 md:col-span-6 flex items-start gap-4">
                                    <!-- Mobile Remove (Absolute Top Right) -->
                                    <button @click="removeItem(index)" class="absolute top-8 right-0 md:hidden text-gray-400 hover:text-[#991B1B] p-2" aria-label="Remove item">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                                    </button>

                                    <!-- Image -->
                                    <div class="w-24 h-32 md:w-28 md:h-36 bg-gray-100 flex-shrink-0">
                                        <template x-if="item.image">
                                            <a :href="'/product/' + item.product_slug"><img :src="item.image" :alt="item.product_name" class="w-full h-full object-cover"></a>
                                        </template>
                                        <template x-if="!item.image">
                                            <div class="w-full h-full flex items-center justify-center text-gray-300">
                                                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                            </div>
                                        </template>
                                    </div>

                                    <!-- Details -->
                                    <div class="flex flex-col pt-1 w-full pr-8 md:pr-0">
                                        <a :href="'/product/' + item.product_slug" class="font-serif text-lg font-bold text-[#0F1A2C] hover:text-[#D8C3A5] transition-colors line-clamp-2 mb-2" x-text="item.product_name"></a>
                                        <span class="font-sans text-xs text-gray-500 uppercase tracking-widest mb-2" x-text="'SKU: ' + item.variant_sku"></span>
                                        
                                        <!-- Variant Attributes -->
                                        <div class="flex flex-col gap-1 mb-4">
                                            <template x-if="item.size">
                                                <span class="font-sans text-xs text-gray-600">Size: <span class="font-semibold" x-text="item.size"></span></span>
                                            </template>
                                            <template x-if="item.color">
                                                <span class="font-sans text-xs text-gray-600">Color: <span class="font-semibold" x-text="item.color"></span></span>
                                            </template>
                                        </div>

                                        <!-- Mobile Price (Hidden on Desktop) -->
                                        <div class="md:hidden font-sans text-sm font-medium text-[#0F1A2C] mb-4" x-text="'₹' + Number(item.unit_price).toLocaleString('en-IN')"></div>

                                        <!-- Mobile Quantity (Hidden on Desktop) -->
                                        <div class="md:hidden flex items-center border border-gray-300 w-28 shrink-0">
                                            <button @click="updateQuantity(index, item.quantity - 1)" class="w-8 h-10 flex items-center justify-center text-gray-500 hover:text-[#0F1A2C] focus:outline-none focus:bg-gray-100 transition-colors" aria-label="Decrease quantity">
                                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4"></path></svg>
                                            </button>
                                            <input type="number" x-model.number="item.quantity" @change="updateQuantity(index, item.quantity)" min="1" class="w-full text-center font-sans text-sm border-none focus:ring-0 p-0 text-[#0F1A2C] bg-transparent" aria-label="Quantity">
                                            <button @click="updateQuantity(index, item.quantity + 1)" class="w-8 h-10 flex items-center justify-center text-gray-500 hover:text-[#0F1A2C] focus:outline-none focus:bg-gray-100 transition-colors" aria-label="Increase quantity">
                                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                                            </button>
                                        </div>
                                    </div>
                                </div>

                                <!-- Desktop Price -->
                                <div class="hidden md:block col-span-2 text-center font-sans text-sm font-medium text-[#0F1A2C]" x-text="'₹' + Number(item.unit_price).toLocaleString('en-IN')"></div>

                                <!-- Desktop Quantity -->
                                <div class="hidden md:flex col-span-2 justify-center">
                                    <div class="flex items-center border border-gray-300 w-24 shrink-0">
                                        <button @click="updateQuantity(index, item.quantity - 1)" class="w-8 h-10 flex items-center justify-center text-gray-500 hover:text-[#0F1A2C] focus:outline-none focus:bg-gray-100 transition-colors" aria-label="Decrease quantity">
                                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4"></path></svg>
                                        </button>
                                        <input type="number" x-model.number="item.quantity" @change="updateQuantity(index, item.quantity)" min="1" class="w-full text-center font-sans text-sm border-none focus:ring-0 p-0 text-[#0F1A2C] bg-transparent" aria-label="Quantity">
                                        <button @click="updateQuantity(index, item.quantity + 1)" class="w-8 h-10 flex items-center justify-center text-gray-500 hover:text-[#0F1A2C] focus:outline-none focus:bg-gray-100 transition-colors" aria-label="Increase quantity">
                                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                                        </button>
                                    </div>
                                </div>

                                <!-- Desktop Subtotal & Remove -->
                                <div class="hidden md:flex col-span-2 items-center justify-end gap-6">
                                    <span class="font-sans text-sm font-bold text-[#0F1A2C]" x-text="'₹' + Number(item.unit_price * item.quantity).toLocaleString('en-IN')"></span>
                                    <button @click="removeItem(index)" class="text-gray-400 hover:text-[#991B1B] transition-colors p-1" aria-label="Remove item">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                                    </button>
                                </div>
                                
                            </div>
                        </template>
                    </div>

                    <!-- Clear Cart Action -->
                    <div class="mt-8">
                        <button @click="clearCart()" class="font-sans text-xs font-bold uppercase tracking-widest text-gray-400 hover:text-[#991B1B] transition-colors focus:outline-none underline">
                            Clear Cart
                        </button>
                    </div>

                </div>

                <!-- Right: Summary -->
                <div class="w-full lg:w-1/3">
                    <div class="bg-white border border-gray-200 p-6 md:p-8 sticky top-24">
                        <h2 class="font-serif text-xl font-bold text-[#0F1A2C] mb-6 border-b border-gray-100 pb-4">Order Summary</h2>
                        
                        <div class="space-y-4 font-sans text-sm mb-6">
                            <div class="flex justify-between text-gray-600">
                                <span>Total Items</span>
                                <span class="font-medium" x-text="totalQuantity"></span>
                            </div>
                            <div class="flex justify-between text-[#0F1A2C] text-lg font-bold border-t border-gray-100 pt-4 mt-4">
                                <span>Estimated Total</span>
                                <span x-text="'₹' + Number(totalAmount).toLocaleString('en-IN')"></span>
                            </div>
                        </div>

                        <p class="font-sans text-xs text-gray-500 mb-8 italic">Please note: The final availability and price will be confirmed by our team on WhatsApp.</p>

                        <div class="flex flex-col gap-4">
                            <button @click="checkout()" 
                                    :disabled="isProcessing"
                                    class="w-full flex items-center justify-center gap-3 bg-[#25D366] text-white px-6 py-4 font-sans text-sm font-bold uppercase tracking-widest hover:bg-[#128C7E] transition-colors focus:outline-none focus:ring-2 focus:ring-[#25D366] focus:ring-offset-2">
                                <svg class="w-5 h-5 fill-white" viewBox="0 0 32 32"><path fill-rule="evenodd" clip-rule="evenodd" d="M16 2C8.268 2 2 8.268 2 16C2 18.67 2.75 21.17 4.05 23.31L2.24 29.84L8.98 28.09C11.05 29.32 13.44 30 16 30C23.732 30 30 23.732 30 16C30 8.268 23.732 2 16 2ZM16 27.65C13.75 27.65 11.66 27.02 9.87 25.92L9.45 25.66L5.34 26.73L6.44 22.72L6.16 22.28C4.98 20.4 4.35 18.25 4.35 16C4.35 9.57 9.57 4.35 16 4.35C22.43 4.35 27.65 9.57 27.65 16C27.65 22.43 22.43 27.65 16 27.65ZM22.42 19.34C22.07 19.16 20.35 18.32 20.03 18.2C19.71 18.08 19.48 18.02 19.25 18.38C19.01 18.73 18.33 19.54 18.12 19.78C17.92 20.01 17.71 20.04 17.36 19.86C17.01 19.68 15.88 19.31 14.54 18.11C13.5 17.18 12.8 16.03 12.59 15.68C12.38 15.33 12.57 15.14 12.74 14.96C12.9 14.8 13.1 14.54 13.27 14.34C13.45 14.14 13.51 13.99 13.63 13.76C13.75 13.53 13.69 13.32 13.6 13.15C13.51 12.97 12.8 11.23 12.51 10.53C12.23 9.85 11.93 9.94 11.73 9.93C11.53 9.92 11.3 9.92 11.06 9.92C10.83 9.92 10.45 10.01 10.13 10.36C9.81 10.71 8.9 11.56 8.9 13.29C8.9 15.02 10.16 16.69 10.34 16.92C10.51 17.15 12.81 20.68 16.32 22.2C17.15 22.56 17.8 22.78 18.31 22.94C19.15 23.21 19.91 23.17 20.52 23.08C21.2 22.98 22.61 22.22 22.9 21.4C23.2 20.57 23.2 19.87 23.11 19.72C23.02 19.58 22.77 19.52 22.42 19.34Z"/></svg>
                                Order on WhatsApp
                            </button>
                            <a href="{{ route('home') }}" class="w-full flex items-center justify-center border border-[#0F1A2C] text-[#0F1A2C] px-6 py-4 font-sans text-sm font-bold uppercase tracking-widest hover:bg-[#0F1A2C] hover:text-white transition-colors focus:outline-none focus:ring-2 focus:ring-[#0F1A2C] focus:ring-offset-2">
                                Continue Shopping
                            </a>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('cartData', () => ({
                items: JSON.parse(localStorage.getItem('cart') || '[]'),
                isProcessing: false,
                errorMsg: null,
                invalidItems: [],
                
                get totalAmount() {
                    return this.items.reduce((sum, item) => sum + (item.unit_price * item.quantity), 0);
                },
                
                get totalQuantity() {
                    return this.items.reduce((sum, item) => sum + item.quantity, 0);
                },
                
                saveCart() {
                    localStorage.setItem('cart', JSON.stringify(this.items));
                    window.dispatchEvent(new CustomEvent('cart-updated'));
                },
                
                updateQuantity(index, newQty) {
                    if (newQty < 1 || isNaN(newQty)) {
                        this.removeItem(index);
                        return;
                    }
                    this.items[index].quantity = newQty;
                    this.saveCart();
                },
                
                removeItem(index) {
                    this.items.splice(index, 1);
                    this.saveCart();
                },
                
                clearCart() {
                    this.items = [];
                    this.saveCart();
                },
                
                async checkout() {
                    if (this.items.length === 0) return;
                    
                    this.isProcessing = true;
                    this.errorMsg = null;
                    
                    try {
                        let token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
                        let response = await fetch('{{ route('cart.validate') }}', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': token,
                                'Accept': 'application/json'
                            },
                            body: JSON.stringify({ items: this.items })
                        });
                        
                        let data = await response.json();
                        
                        if (data.has_errors) {
                            this.errorMsg = "Some items in your cart have been updated or are no longer available. Please review the changes.";
                            this.invalidItems = data.invalid_items || [];
                        } else {
                            this.invalidItems = [];
                        }
                        
                        // Update cart with strictly validated items (price sync, inactive removed)
                        this.items = data.validated_items || [];
                        this.saveCart();
                        
                        // Only proceed to WhatsApp if there were no errors and URL is generated
                        if (!data.has_errors && data.whatsapp_url) {
                            window.location.href = data.whatsapp_url;
                        } else if (!data.has_errors && !data.whatsapp_url) {
                            this.errorMsg = "Store WhatsApp number is not configured properly.";
                        }
                    } catch (error) {
                        console.error(error);
                        this.errorMsg = "An error occurred while preparing your order request. Please try again.";
                    } finally {
                        this.isProcessing = false;
                    }
                }
            }));
        });
    </script>
    @endpush
</x-layout.app>
