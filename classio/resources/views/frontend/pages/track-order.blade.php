<x-layout.app :categories="$categories">
    <div class="bg-[#FAF9F6] min-h-screen py-10 sm:py-16 select-none"
         x-data="{ 
            orderId: '{{ $trackingNumber }}', 
            contactInfo: '', 
            tracked: {{ !empty($trackingNumber) ? 'true' : 'false' }},
            loading: false,
            track() {
                if (!this.orderId.trim()) return;
                this.loading = true;
                setTimeout(() => {
                    this.loading = false;
                    this.tracked = true;
                }, 600);
            }
         }">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <!-- Breadcrumbs -->
            <nav class="flex text-xs font-sans text-gray-500 uppercase tracking-widest mb-8" aria-label="Breadcrumb">
                <ol class="inline-flex items-center space-x-2">
                    <li><a href="{{ route('home') }}" class="hover:text-[#0B1A2C] transition-colors">Home</a></li>
                    <li>/</li>
                    <li class="text-[#0B1A2C] font-semibold">Track Order</li>
                </ol>
            </nav>

            <!-- Page Title -->
            <div class="text-center max-w-2xl mx-auto mb-10 sm:mb-12">
                <span class="text-[10px] sm:text-xs font-bold uppercase tracking-[0.25em] text-[#8C6D46] bg-[#FAF0E6] px-3.5 py-1 rounded-full border border-[#D8C3A5]/40 inline-block mb-3">
                    Shipment Milestones
                </span>
                <h1 class="font-serif text-3xl sm:text-4xl font-bold text-[#0B1A2C] tracking-tight mb-3">
                    Track Your Luxury Delivery
                </h1>
                <p class="font-sans text-xs sm:text-sm text-gray-600 leading-relaxed">
                    Enter your Classio Order ID and contact details to monitor live dispatch status and transit updates.
                </p>
            </div>

            <!-- Tracking Input Form Card -->
            <div class="bg-white rounded-3xl p-6 sm:p-10 shadow-[0_4px_25px_rgba(11,26,44,0.06)] border border-gray-100 mb-10">
                <form @submit.prevent="track()" class="grid grid-cols-1 sm:grid-cols-12 gap-4 items-end">
                    <div class="sm:col-span-5">
                        <label for="order_id" class="block text-xs font-semibold uppercase tracking-wider text-gray-700 mb-1.5">Order ID *</label>
                        <input type="text" 
                               id="order_id" 
                               x-model="orderId" 
                               required 
                               placeholder="e.g. CLS-84920" 
                               class="w-full px-4 py-2.5 rounded-xl border border-gray-200 text-xs text-gray-900 focus:outline-none focus:ring-2 focus:ring-[#0B1A2C]">
                    </div>

                    <div class="sm:col-span-4">
                        <label for="contact_info" class="block text-xs font-semibold uppercase tracking-wider text-gray-700 mb-1.5">Phone or Email *</label>
                        <input type="text" 
                               id="contact_info" 
                               x-model="contactInfo" 
                               placeholder="Registered mobile / email" 
                               class="w-full px-4 py-2.5 rounded-xl border border-gray-200 text-xs text-gray-900 focus:outline-none focus:ring-2 focus:ring-[#0B1A2C]">
                    </div>

                    <div class="sm:col-span-3">
                        <button type="submit" 
                                :disabled="loading" 
                                class="w-full py-2.5 px-4 rounded-xl bg-[#0B1A2C] hover:bg-[#12243d] text-white text-xs font-bold uppercase tracking-wider transition-all duration-200 shadow flex items-center justify-center gap-1.5 disabled:opacity-50">
                            <template x-if="!loading">
                                <span>Track Order</span>
                            </template>
                            <template x-if="loading">
                                <span>Verifying...</span>
                            </template>
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                        </button>
                    </div>
                </form>
            </div>

            <!-- Dynamic Tracking Results Timeline -->
            <div x-show="tracked" x-transition:enter="transition ease-out duration-300" class="bg-white rounded-3xl p-6 sm:p-10 shadow-[0_4px_25px_rgba(11,26,44,0.06)] border border-gray-100 mb-10">
                <div class="flex flex-col sm:flex-row sm:items-center justify-between pb-6 border-b border-gray-100 gap-3">
                    <div>
                        <span class="text-[11px] font-bold uppercase tracking-wider text-emerald-700 bg-emerald-50 px-2.5 py-0.5 rounded-full border border-emerald-200 inline-block mb-1">
                            In Transit · Express Courier
                        </span>
                        <h2 class="font-serif text-xl sm:text-2xl font-bold text-[#0B1A2C]">
                            Order <span x-text="orderId"></span>
                        </h2>
                    </div>
                    <div class="text-xs text-gray-500 sm:text-right">
                        <span class="block font-semibold text-gray-900">Estimated Delivery: 2 Days</span>
                        <span class="text-[11px]">Courier: BlueDart Luxury Express</span>
                    </div>
                </div>

                <!-- 5 Steps Milestone Progress Bar -->
                <div class="py-8">
                    <div class="relative">
                        <div class="absolute top-5 left-6 right-6 h-0.5 bg-gray-200 -z-0 hidden sm:block"></div>
                        <div class="absolute top-5 left-6 w-3/5 h-0.5 bg-[#0B1A2C] -z-0 hidden sm:block"></div>

                        <div class="grid grid-cols-1 sm:grid-cols-4 gap-6 relative z-10">
                            <!-- Step 1 -->
                            <div class="flex sm:flex-col items-center sm:items-center gap-3 sm:gap-2">
                                <div class="w-10 h-10 rounded-full bg-[#0B1A2C] text-[#D8C3A5] flex items-center justify-center font-bold text-xs shadow">
                                    ✓
                                </div>
                                <div class="sm:text-center">
                                    <h4 class="font-serif text-xs font-bold text-[#0B1A2C]">Order Placed</h4>
                                    <p class="text-[10px] text-gray-400">Payment verified</p>
                                </div>
                            </div>

                            <!-- Step 2 -->
                            <div class="flex sm:flex-col items-center sm:items-center gap-3 sm:gap-2">
                                <div class="w-10 h-10 rounded-full bg-[#0B1A2C] text-[#D8C3A5] flex items-center justify-center font-bold text-xs shadow">
                                    ✓
                                </div>
                                <div class="sm:text-center">
                                    <h4 class="font-serif text-xs font-bold text-[#0B1A2C]">Quality Inspection</h4>
                                    <p class="text-[10px] text-gray-400">Boutique certified</p>
                                </div>
                            </div>

                            <!-- Step 3 (Current) -->
                            <div class="flex sm:flex-col items-center sm:items-center gap-3 sm:gap-2">
                                <div class="w-10 h-10 rounded-full bg-[#D8C3A5] text-[#0B1A2C] flex items-center justify-center font-bold text-xs shadow ring-4 ring-[#D8C3A5]/30 animate-pulse">
                                    ●
                                </div>
                                <div class="sm:text-center">
                                    <h4 class="font-serif text-xs font-bold text-[#0B1A2C]">Dispatched / In Transit</h4>
                                    <p class="text-[10px] text-gray-500 font-medium">En route to hub</p>
                                </div>
                            </div>

                            <!-- Step 4 -->
                            <div class="flex sm:flex-col items-center sm:items-center gap-3 sm:gap-2">
                                <div class="w-10 h-10 rounded-full bg-gray-100 text-gray-400 flex items-center justify-center font-bold text-xs border border-gray-200">
                                    4
                                </div>
                                <div class="sm:text-center">
                                    <h4 class="font-serif text-xs font-bold text-gray-400">Delivered</h4>
                                    <p class="text-[10px] text-gray-400">Doorstep handover</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Courier Notes -->
                <div class="p-4 rounded-2xl bg-gray-50 border border-gray-100 text-xs text-gray-600 space-y-1">
                    <p class="font-semibold text-gray-900">Shipment Details & Instructions:</p>
                    <p>• Secured with tamper-evident seal and OTP verification upon delivery.</p>
                    <p>• Live driver tracking link will be transmitted to your registered mobile number via SMS on the morning of delivery.</p>
                </div>
            </div>

            <!-- Need Help Card -->
            <div class="bg-white rounded-2xl p-6 border border-gray-100 shadow-sm flex flex-col sm:flex-row items-center justify-between gap-4 text-xs">
                <div>
                    <h3 class="font-serif text-sm font-bold text-[#0B1A2C]">Have questions about your delivery?</h3>
                    <p class="text-gray-500 text-[11px] mt-0.5">Contact our logistics desk with your Order ID for real-time priority intervention.</p>
                </div>
                <div class="flex items-center gap-2 flex-shrink-0">
                    <a href="https://wa.me/911234567890" target="_blank" rel="noopener noreferrer" class="px-4 py-2 rounded-xl bg-[#25D366] text-white font-bold hover:bg-[#20ba59] transition-colors">
                        WhatsApp Concierge
                    </a>
                    <a href="{{ route('contact') }}" class="px-4 py-2 rounded-xl border border-gray-300 text-gray-700 hover:text-black font-semibold transition-colors">
                        Inquiry Form
                    </a>
                </div>
            </div>

        </div>
    </div>
</x-layout.app>
