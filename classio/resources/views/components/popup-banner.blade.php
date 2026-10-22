<div x-data="{
        open: false,
        copied: false,
        init() {
            // Check if user has already seen or closed the popup banner in this session
            const popupSeen = sessionStorage.getItem('classio_popup_seen');
            if (!popupSeen) {
                setTimeout(() => {
                    this.open = true;
                }, 5000);
            }
        },
        close() {
            this.open = false;
            sessionStorage.setItem('classio_popup_seen', 'true');
        },
        copyCode() {
            navigator.clipboard.writeText('CLASSIO15').then(() => {
                this.copied = true;
                setTimeout(() => { this.copied = false; }, 2500);
            }).catch(() => {
                this.copied = true;
                setTimeout(() => { this.copied = false; }, 2500);
            });
        }
    }"
    x-cloak
    x-show="open"
    class="fixed inset-0 z-50 overflow-y-auto flex items-center justify-center p-4 sm:p-6"
    role="dialog"
    aria-modal="true"
    aria-labelledby="promo-popup-title">

    <!-- Backdrop with blur -->
    <div x-show="open"
         x-transition:enter="ease-out duration-300"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="ease-in duration-200"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"
         @click="close()"
         class="fixed inset-0 bg-black/75 backdrop-blur-sm transition-opacity"></div>

    <!-- Modal Card -->
    <div x-show="open"
         x-transition:enter="ease-out duration-300"
         x-transition:enter-start="opacity-0 scale-95 translate-y-4"
         x-transition:enter-end="opacity-100 scale-100 translate-y-0"
         x-transition:leave="ease-in duration-200"
         x-transition:leave-start="opacity-100 scale-100 translate-y-0"
         x-transition:leave-end="opacity-0 scale-95 translate-y-4"
         class="relative bg-[#0B1A2C] text-white rounded-2xl sm:rounded-3xl max-w-lg w-full overflow-hidden shadow-2xl border border-[#D8C3A5]/30 z-10 my-auto">

        <!-- Top Decorative Gradient Glow -->
        <div class="absolute -top-24 -left-24 w-60 h-60 bg-[#D8C3A5]/15 rounded-full blur-3xl pointer-events-none"></div>
        <div class="absolute -bottom-24 -right-24 w-60 h-60 bg-[#D8C3A5]/10 rounded-full blur-3xl pointer-events-none"></div>

        <!-- Close Button -->
        <button @click="close()"
                type="button"
                aria-label="Close promotion modal"
                class="absolute top-3.5 right-3.5 z-20 w-8 h-8 sm:w-9 sm:h-9 rounded-full bg-white/10 hover:bg-white/20 text-gray-300 hover:text-white flex items-center justify-center transition-all duration-200 focus:outline-none">
            <svg class="w-4 h-4 sm:w-5 sm:h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
            </svg>
        </button>

        <!-- Content Area -->
        <div class="p-6 sm:p-8 text-center relative z-10 flex flex-col items-center">
            
            <!-- Luxury Crown / Sparkle Badge -->
            <div class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-[#D8C3A5]/20 border border-[#D8C3A5]/40 text-[#D8C3A5] text-[10.5px] sm:text-xs font-semibold tracking-widest uppercase mb-3 sm:mb-4">
                <svg class="w-3.5 h-3.5 fill-current" viewBox="0 0 24 24">
                    <path d="M12 2l2.4 7.4h7.6l-6.2 4.5 2.4 7.4-6.2-4.5-6.2 4.5 2.4-7.4-6.2-4.5h7.6z"/>
                </svg>
                <span>EXCLUSIVE WELCOME OFFER</span>
            </div>

            <!-- Brand Monogram / Accent -->
            <h2 id="promo-popup-title" class="font-serif text-2xl sm:text-3xl lg:text-4xl font-bold tracking-tight text-white mb-1.5">
                Step Into <span class="text-[#D8C3A5] italic">Luxury</span>
            </h2>
            <p class="text-xs sm:text-[13px] text-gray-300 max-w-sm mx-auto leading-relaxed mb-5">
                Enjoy <strong class="text-white font-semibold">15% OFF</strong> your first bespoke order + Free Express Shipping across India.
            </p>

            <!-- Promo Code Coupon Card -->
            <div class="w-full bg-white/5 border border-dashed border-[#D8C3A5]/60 rounded-xl sm:rounded-2xl p-3.5 sm:p-4 mb-5 flex items-center justify-between gap-3">
                <div class="text-left">
                    <span class="block text-[9.5px] sm:text-[10px] uppercase font-bold tracking-wider text-[#D8C3A5]">Coupon Code</span>
                    <span class="font-mono text-base sm:text-xl font-extrabold tracking-widest text-white">CLASSIO15</span>
                </div>
                <button @click="copyCode()"
                        type="button"
                        class="px-3.5 sm:px-4 py-2 rounded-lg font-sans text-xs font-bold tracking-wider uppercase transition-all duration-200 flex items-center gap-1.5 shadow-sm"
                        :class="copied ? 'bg-emerald-600 text-white' : 'bg-[#D8C3A5] hover:bg-[#c9b291] text-[#0B1A2C]'">
                    <template x-if="!copied">
                        <span class="flex items-center gap-1">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7v8a2 2 0 002 2h6M8 7V5a2 2 0 012-2h4.586a1 1 0 01.707.293l4.414 4.414a1 1 0 01.293.707V15a2 2 0 01-2 2h-2M8 7H6a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2v-2"></path>
                            </svg>
                            COPY
                        </span>
                    </template>
                    <template x-if="copied">
                        <span class="flex items-center gap-1">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"></path>
                            </svg>
                            COPIED!
                        </span>
                    </template>
                </button>
            </div>

            <!-- CTA Actions -->
            <div class="w-full flex flex-col sm:flex-row gap-2.5 sm:gap-3 mb-3">
                <a href="https://wa.me/919576517660?text=Hi%20Classio%2C%20I%20would%20like%20to%20claim%20my%2015%25%20welcome%20discount%20with%20code%20CLASSIO15!"
                   target="_blank"
                   rel="noopener noreferrer"
                   @click="close()"
                   class="flex-1 inline-flex items-center justify-center gap-2 px-5 py-3 rounded-xl bg-emerald-600 hover:bg-emerald-700 text-white font-sans text-xs sm:text-sm font-bold tracking-wide uppercase shadow-lg shadow-emerald-900/30 transition-all duration-200">
                    <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24">
                        <path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981zm11.387-5.464c-.074-.124-.272-.198-.57-.347-.297-.149-1.758-.868-2.031-.967-.272-.099-.47-.149-.669.149-.198.297-.768.967-.941 1.165-.173.198-.347.223-.644.074-.297-.149-1.255-.462-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.521.151-.172.2-.296.3-.495.099-.198.05-.372-.025-.521-.075-.148-.669-1.611-.916-2.206-.242-.579-.487-.501-.669-.51l-.57-.01c-.198 0-.52.074-.792.372s-1.04 1.016-1.04 2.479 1.065 2.876 1.213 3.074c.149.198 2.095 3.2 5.076 4.487.709.306 1.263.489 1.694.626.712.226 1.36.194 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.695.248-1.29.173-1.414z"/>
                    </svg>
                    <span>Claim on WhatsApp</span>
                </a>

                <a href="{{ route('category.show', 'new-arrivals') }}"
                   @click="close()"
                   class="flex-1 inline-flex items-center justify-center gap-1.5 px-5 py-3 rounded-xl bg-white/10 hover:bg-white/20 text-white font-sans text-xs sm:text-sm font-semibold tracking-wide uppercase transition-all duration-200 border border-white/20">
                    <span>Shop New Arrivals &rarr;</span>
                </a>
            </div>

            <button @click="close()"
                    type="button"
                    class="text-[11px] text-gray-400 hover:text-gray-200 transition-colors underline underline-offset-4 mt-1">
                No thanks, continue browsing
            </button>
        </div>
    </div>
</div>
