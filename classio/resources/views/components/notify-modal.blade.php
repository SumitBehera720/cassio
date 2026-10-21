@php
    $autoNotifyProduct = null;
    if (request('notify')) {
        $autoNotifyProduct = \App\Models\Product::with(['images', 'variants'])->find(request('notify'));
    }
@endphp

<div x-data="{
    isOpen: false,
    product: {
        id: null,
        name: '',
        image: '',
        price: ''
    },
    email: '',
    phone: '',
    whatsappAlert: false,
    submitted: false,
    errorMsg: '',

    init() {
        @if($autoNotifyProduct)
            this.$nextTick(() => {
                this.open({
                    id: {{ $autoNotifyProduct->id }},
                    name: '{{ addslashes($autoNotifyProduct->name) }}',
                    image: '{{ asset($autoNotifyProduct->images->first()->image_path ?? 'images/classio/product_coming_soon.jpg') }}',
                    price: '{{ number_format($autoNotifyProduct->variants->first()->price ?? 999, 0) }}'
                });
            });
        @endif
    },

    open(data) {
        this.product = data || {};
        this.email = '';
        this.phone = '';
        this.whatsappAlert = false;
        this.submitted = false;
        this.errorMsg = '';
        this.isOpen = true;
        document.body.classList.add('overflow-hidden');
    },

    close() {
        this.isOpen = false;
        document.body.classList.remove('overflow-hidden');
    },

    submitNotify() {
        if (!this.email || !this.email.includes('@')) {
            this.errorMsg = 'Please enter a valid email address';
            return;
        }

        try {
            let list = JSON.parse(localStorage.getItem('classio_notify_list') || '[]');
            list.push({
                productId: this.product.id,
                productName: this.product.name,
                email: this.email,
                phone: this.phone,
                timestamp: new Date().toISOString()
            });
            localStorage.setItem('classio_notify_list', JSON.stringify(list));
        } catch(e) {}

        this.submitted = true;
    }
}"
@open-notify-modal.window="open($event.detail)"
@keydown.escape.window="if(isOpen) close()"
x-cloak>

    <!-- Modal Backdrop -->
    <div x-show="isOpen"
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"
         class="fixed inset-0 z-50 bg-black/75 backdrop-blur-sm flex items-center justify-center p-4 sm:p-6"
         @click="close()"
         style="display: none;">

        <!-- Modal Dialog Box -->
        <div x-show="isOpen"
             x-transition:enter="transition ease-out duration-300 transform"
             x-transition:enter-start="opacity-0 translate-y-4 scale-95"
             x-transition:enter-end="opacity-100 translate-y-0 scale-100"
             x-transition:leave="transition ease-in duration-200 transform"
             x-transition:leave-start="opacity-100 translate-y-0 scale-100"
             x-transition:leave-end="opacity-0 translate-y-4 scale-95"
             class="bg-[#0B1A2C] border border-[#D8C3A5]/50 text-white w-full max-w-md rounded-2xl p-6 sm:p-8 shadow-2xl relative overflow-hidden text-left"
             @click.stop>

            <!-- Subtle gold ambient glow in top corner -->
            <div class="absolute -top-16 -right-16 w-36 h-36 bg-[#D8C3A5]/10 rounded-full blur-2xl pointer-events-none"></div>

            <!-- Close Button (X) -->
            <button @click="close()" 
                    class="absolute top-4 right-4 text-gray-400 hover:text-white p-1.5 rounded-full hover:bg-white/10 transition-colors focus:outline-none" 
                    aria-label="Close modal">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
            </button>

            <!-- Initial Form View -->
            <div x-show="!submitted">
                <!-- Header Badge -->
                <div class="flex items-center gap-1.5 mb-2">
                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-[10px] font-bold tracking-widest uppercase bg-[#8E0F1E] text-white">
                        COMING SOON
                    </span>
                    <span class="text-[11px] font-sans text-[#D8C3A5] font-semibold tracking-wider">
                        ✦ Exclusive Launch Waitlist
                    </span>
                </div>

                <h3 class="font-serif text-xl sm:text-2xl font-bold text-white mb-1.5 leading-snug">
                    Get Notified on Launch
                </h3>
                <p class="font-sans text-xs text-gray-300 mb-5 leading-relaxed">
                    Be the very first to get notified via email when this curated piece becomes available to order.
                </p>

                <!-- Product Preview Card -->
                <div class="flex items-center gap-3.5 bg-[#122238] border border-white/10 p-3 rounded-xl mb-5">
                    <div class="w-14 h-14 rounded-lg overflow-hidden bg-gray-800 flex-shrink-0 border border-white/10">
                        <img :src="product.image || '{{ asset('images/classio/product_coming_soon.jpg') }}'" :alt="product.name" class="w-full h-full object-cover">
                    </div>
                    <div class="flex-1 min-w-0">
                        <h4 class="font-sans text-xs font-bold text-white truncate" x-text="product.name || 'Classio Designer Item'"></h4>
                        <div class="flex items-center gap-2 mt-1">
                            <span class="font-sans text-sm font-semibold text-white" x-text="'₹' + (product.price || '999')"></span>
                        </div>
                    </div>
                </div>

                <!-- Form -->
                <form @submit.prevent="submitNotify()" class="space-y-4">
                    <div>
                        <label class="block font-sans text-[11px] font-bold uppercase tracking-wider text-gray-300 mb-1.5">
                            Your Email Address <span class="text-red-400">*</span>
                        </label>
                        <div class="relative">
                            <input type="email" 
                                   x-model="email" 
                                   required 
                                   placeholder="name@example.com"
                                   class="w-full bg-[#071321] border border-white/20 rounded-xl px-4 py-3 text-xs sm:text-sm text-white placeholder-gray-500 focus:outline-none focus:border-[#D8C3A5] focus:ring-1 focus:ring-[#D8C3A5] transition-colors">
                            <svg class="w-4 h-4 text-gray-400 absolute right-3.5 top-1/2 -translate-y-1/2 pointer-events-none" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.6" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                        </div>
                        <p x-show="errorMsg" x-text="errorMsg" class="text-red-400 text-[11px] mt-1" style="display: none;"></p>
                    </div>

                    <!-- WhatsApp Optional Toggle -->
                    <div class="bg-[#122238]/60 border border-white/5 p-3 rounded-xl">
                        <label class="flex items-center gap-2.5 cursor-pointer">
                            <input type="checkbox" x-model="whatsappAlert" class="rounded border-gray-600 text-[#25D366] focus:ring-0 w-4 h-4 bg-gray-900">
                            <span class="font-sans text-xs text-gray-300">Also notify me via WhatsApp for early VIP access</span>
                        </label>
                        <div x-show="whatsappAlert" class="mt-2.5" style="display: none;">
                            <input type="tel" 
                                   x-model="phone" 
                                   placeholder="+91 98765 43210" 
                                   class="w-full bg-[#071321] border border-white/20 rounded-lg px-3.5 py-2 text-xs text-white placeholder-gray-500 focus:outline-none focus:border-[#25D366]">
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <button type="submit" 
                            class="w-full py-3.5 rounded-xl bg-[#D8C3A5] hover:bg-[#c9b291] text-[#0B1A2C] font-sans font-bold text-xs uppercase tracking-widest transition-all duration-200 shadow-lg flex items-center justify-center gap-2 focus:outline-none focus:ring-2 focus:ring-[#D8C3A5] focus:ring-offset-2 focus:ring-offset-[#0B1A2C]">
                        <span>NOTIFY ME ON DROP</span>
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                    </button>
                </form>

                <p class="text-[10px] text-gray-400 text-center font-sans mt-4">
                    🔒 No spam ever. We only email you once when this product is available to buy.
                </p>
            </div>

            <!-- Success State -->
            <div x-show="submitted" class="py-4 text-center flex flex-col items-center justify-center" style="display: none;">
                <div class="w-14 h-14 rounded-full bg-emerald-500/20 text-emerald-400 border border-emerald-500/40 flex items-center justify-center mb-4">
                    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"></path></svg>
                </div>
                <h3 class="font-serif text-2xl font-bold text-white mb-2">You're on the Waitlist!</h3>
                <p class="font-sans text-xs text-gray-300 max-w-xs mx-auto mb-6 leading-relaxed">
                    We've saved your notification request for <strong class="text-white" x-text="product.name"></strong>. We will email you at <strong class="text-[#D8C3A5]" x-text="email"></strong> the moment it drops!
                </p>
                <button @click="close()" class="px-6 py-2.5 rounded-full bg-white/10 hover:bg-white/20 text-white font-sans text-xs font-semibold tracking-wider uppercase transition-colors">
                    Close Window
                </button>
            </div>

        </div>
    </div>
</div>
