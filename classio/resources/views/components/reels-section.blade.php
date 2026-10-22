@php
    $reels = [
        [
            'id' => 1,
            'title' => 'Royal Navy Bespoke Tuxedo Look',
            'desc' => 'Handcrafted tailoring with Italian wool blend and satin lapel. Perfect for galas and royal celebrations.',
            'creator' => '@_classio_07_',
            'duration' => '0:24',
            'views' => '34.2K',
            'likes' => 4820,
            'image' => 'images/classio/hero_model.jpg',
            'product_name' => 'Royal Bespoke Tailored Suit',
            'product_price' => '₹4,999',
            'product_mrp' => '₹8,999',
            'product_url' => route('category.show', 'gents-collection'),
            'wa_text' => 'Hi Classio, I want to order the Royal Bespoke Suit featured in your Reel #1!',
        ],
        [
            'id' => 2,
            'title' => 'Silk Organza Embroidered Saree',
            'desc' => 'Intricate zari craftsmanship on lightweight silk organza with custom handcrafted blouse.',
            'creator' => '@_classio_07_',
            'duration' => '0:19',
            'views' => '28.6K',
            'likes' => 3940,
            'image' => 'images/classio/ladies_saree.jpg',
            'product_name' => 'Bespoke Silk Embroidered Saree',
            'product_price' => '₹3,899',
            'product_mrp' => '₹6,499',
            'product_url' => route('category.show', 'ladies-collection'),
            'wa_text' => 'Hi Classio, I want to order the Silk Embroidered Saree from your Reel #2!',
        ],
        [
            'id' => 3,
            'title' => 'Skeleton Automatic Horology Drop',
            'desc' => 'Exquisite exposed skeleton movement, sapphire crystal and premium stainless steel chassis.',
            'creator' => '@_classio_07_',
            'duration' => '0:16',
            'views' => '41.5K',
            'likes' => 6180,
            'image' => 'images/classio/trending_watch.jpg',
            'product_name' => 'Skeleton Mechanical Heritage Watch',
            'product_price' => '₹5,499',
            'product_mrp' => '₹9,999',
            'product_url' => route('category.show', 'watches-perfumes'),
            'wa_text' => 'Hi Classio, I want to inquire about the Skeleton Mechanical Watch from Reel #3!',
        ],
        [
            'id' => 4,
            'title' => 'Parisian Luxury Monogram Handbag',
            'desc' => 'Artisanal vegan leather with gold-tone hardware and adjustable strap for everyday elegance.',
            'creator' => '@_classio_07_',
            'duration' => '0:21',
            'views' => '19.7K',
            'likes' => 2750,
            'image' => 'images/classio/feat_handbag.jpg',
            'product_name' => 'Artisanal Parisian Tote Bag',
            'product_price' => '₹2,499',
            'product_mrp' => '₹4,199',
            'product_url' => route('category.show', 'bags-collection'),
            'wa_text' => 'Hi Classio, I want to buy the Parisian Tote Bag seen in Reel #4!',
        ],
        [
            'id' => 5,
            'title' => 'Chic Velvet Kurti & Dupatta Set',
            'desc' => 'Royal festive ensemble with delicate mirror work and luxurious silk velvet fabric.',
            'creator' => '@_classio_07_',
            'duration' => '0:27',
            'views' => '25.3K',
            'likes' => 3620,
            'image' => 'images/classio/trending_anarkali.jpg',
            'product_name' => 'Festive Velvet Kurti Ensemble',
            'product_price' => '₹3,299',
            'product_mrp' => '₹5,999',
            'product_url' => route('category.show', 'ladies-collection'),
            'wa_text' => 'Hi Classio, I want to order the Festive Velvet Kurti Ensemble from Reel #5!',
        ],
    ];
@endphp

<section x-data="{
        modalOpen: false,
        activeReelIndex: 0,
        isPlaying: true,
        isMuted: true,
        likedMap: {},
        likeCounts: {},
        copied: false,
        reels: {{ json_encode($reels) }},
        init() {
            this.reels.forEach((r, idx) => {
                this.likeCounts[idx] = r.likes;
                this.likedMap[idx] = false;
            });
        },
        openModal(idx) {
            this.activeReelIndex = idx;
            this.modalOpen = true;
            this.isPlaying = true;
            document.body.classList.add('overflow-hidden');
        },
        closeModal() {
            this.modalOpen = false;
            this.isPlaying = false;
            document.body.classList.remove('overflow-hidden');
        },
        nextReel() {
            this.activeReelIndex = (this.activeReelIndex + 1) % this.reels.length;
        },
        prevReel() {
            this.activeReelIndex = (this.activeReelIndex - 1 + this.reels.length) % this.reels.length;
        },
        toggleLike(idx) {
            if (this.likedMap[idx]) {
                this.likedMap[idx] = false;
                this.likeCounts[idx]--;
            } else {
                this.likedMap[idx] = true;
                this.likeCounts[idx]++;
            }
        },
        copyReelLink(idx) {
            const url = 'https://www.instagram.com/_classio_07_/reels/';
            navigator.clipboard.writeText(url).then(() => {
                this.copied = true;
                setTimeout(() => { this.copied = false; }, 2000);
            });
        }
    }"
    class="max-w-[1440px] mx-auto px-3 sm:px-6 lg:px-8 py-10 sm:py-14 select-none relative">

    <!-- Section Header -->
    <div class="flex flex-col sm:flex-row sm:items-end justify-between gap-4 mb-6 sm:mb-8">
        <div>
            <div class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-gradient-to-r from-[#833AB4] via-[#FD1D1D] to-[#FCB045] text-white text-[10px] sm:text-[11px] font-bold uppercase tracking-widest mb-2 shadow-sm">
                <!-- Reel Icon -->
                <svg class="w-3.5 h-3.5 fill-current" viewBox="0 0 24 24">
                    <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 14.5v-9l6 4.5-6 4.5z"/>
                </svg>
                <span>CASSIO REELS</span>
            </div>
            <h2 class="font-serif text-2xl sm:text-3xl lg:text-4xl font-bold text-[#0B1A2C] tracking-tight">
                Watch &amp; Shop The Look
            </h2>
            <p class="font-sans text-xs sm:text-sm text-gray-500 mt-1 max-w-xl">
                Explore our signature designs in motion. Tap any reel to watch styling inspiration and shop the exact pieces.
            </p>
        </div>

        <div class="flex items-center gap-2">
            <a href="https://www.instagram.com/_classio_07_/reels/" 
               target="_blank" 
               rel="noopener noreferrer"
               class="inline-flex items-center gap-2 px-4 py-2 rounded-full border border-gray-300 hover:border-[#0B1A2C] bg-white text-gray-800 hover:text-[#0B1A2C] font-sans text-xs font-semibold tracking-wide transition-all shadow-sm group">
                <svg class="w-4 h-4 fill-[#E1306C] group-hover:scale-110 transition-transform" viewBox="0 0 24 24">
                    <path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zM12 0C8.741 0 8.333.014 7.053.072 2.695.272.273 2.69.073 7.052.014 8.333 0 8.741 0 12c0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98C8.333 23.986 8.741 24 12 24c3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98C15.668.014 15.259 0 12 0zm0 5.838a6.162 6.162 0 100 12.324 6.162 6.162 0 000-12.324zM12 16a4 4 0 110-8 4 4 0 010 8zm6.406-11.845a1.44 1.44 0 100 2.881 1.44 1.44 0 000-2.881z"/>
                </svg>
                <span>Follow @_classio_07_</span>
            </a>
        </div>
    </div>

    <!-- 5 Reels Vertical Cards Grid (Scrollable on small mobile) -->
    <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-5 gap-3 sm:gap-4 lg:gap-5">
        @foreach($reels as $idx => $reel)
            <div @click="openModal({{ $idx }})"
                 class="group relative aspect-[9/16] rounded-2xl overflow-hidden bg-[#0B1A2C] shadow-md hover:shadow-2xl transition-all duration-300 cursor-pointer transform hover:-translate-y-1">
                
                <!-- Reel Poster Image -->
                <img src="{{ asset($reel['image']) }}" 
                     alt="{{ $reel['title'] }}" 
                     loading="lazy" 
                     class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700">

                <!-- Ambient Vignette & Gradient Overlays -->
                <div class="absolute inset-0 bg-gradient-to-b from-black/40 via-transparent to-black/90 pointer-events-none"></div>

                <!-- Top Header on Card: Reel Icon & Views -->
                <div class="absolute top-2.5 sm:top-3 inset-x-2.5 sm:inset-x-3 flex items-center justify-between text-white text-[11px] font-medium z-10">
                    <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded-full bg-black/40 backdrop-blur-md text-[10px]">
                        <svg class="w-3 h-3 fill-white" viewBox="0 0 24 24">
                            <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 14.5v-9l6 4.5-6 4.5z"/>
                        </svg>
                        <span>Reel</span>
                    </span>

                    <span class="inline-flex items-center gap-1 text-[10.5px] text-gray-200 bg-black/40 backdrop-blur-md px-2 py-0.5 rounded-full">
                        <svg class="w-3 h-3 fill-current" viewBox="0 0 24 24">
                            <path d="M12 4.5C7 4.5 2.73 7.61 1 12c1.73 4.39 6 7.5 11 7.5s9.27-3.11 11-7.5c-1.73-4.39-6-7.5-11-7.5zM12 17c-2.76 0-5-2.24-5-5s2.24-5 5-5 5 2.24 5 5-2.24 5-5 5zm0-8c-1.66 0-3 1.34-3 3s1.34 3 3 3 3-1.34 3-3-1.34-3-3-3z"/>
                        </svg>
                        {{ $reel['views'] }}
                    </span>
                </div>

                <!-- Center Animated Play Button on Hover -->
                <div class="absolute inset-0 flex items-center justify-center z-10 pointer-events-none">
                    <div class="w-12 h-12 sm:w-14 sm:h-14 rounded-full bg-white/20 backdrop-blur-md border border-white/40 text-white flex items-center justify-center shadow-lg group-hover:scale-115 group-hover:bg-[#D8C3A5] group-hover:text-[#0B1A2C] transition-all duration-300">
                        <svg class="w-6 h-6 fill-current translate-x-0.5" viewBox="0 0 24 24">
                            <path d="M8 5v14l11-7z"/>
                        </svg>
                    </div>
                </div>

                <!-- Bottom Tagged Product Card Overlay -->
                <div class="absolute bottom-2.5 sm:bottom-3 inset-x-2.5 sm:inset-x-3 z-10">
                    <div class="bg-black/60 backdrop-blur-md border border-white/15 rounded-xl p-2.5 text-white">
                        <div class="flex items-center justify-between mb-1">
                            <span class="text-[9.5px] uppercase font-bold tracking-wider text-[#D8C3A5] flex items-center gap-1">
                                <span class="w-1.5 h-1.5 rounded-full bg-emerald-400 animate-pulse"></span>
                                Tagged Product
                            </span>
                            <span class="text-[9px] text-gray-300">{{ $reel['duration'] }}</span>
                        </div>
                        <p class="text-xs font-semibold leading-tight line-clamp-1 mb-1">{{ $reel['product_name'] }}</p>
                        <div class="flex items-center justify-between">
                            <span class="text-xs font-bold text-white">{{ $reel['product_price'] }}</span>
                            <span class="inline-flex items-center gap-0.5 text-[10px] font-bold text-[#D8C3A5] group-hover:translate-x-0.5 transition-transform">
                                Shop Look &rarr;
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <!-- MODAL REEL VIEWER -->
    <div x-cloak
         x-show="modalOpen"
         @keydown.escape.window="closeModal()"
         class="fixed inset-0 z-50 overflow-hidden flex items-center justify-center p-2 sm:p-4 md:p-6"
         role="dialog"
         aria-modal="true">

        <!-- Dark Blurred Backdrop -->
        <div x-show="modalOpen"
             x-transition:enter="ease-out duration-300"
             x-transition:enter-start="opacity-0"
             x-transition:enter-end="opacity-100"
             x-transition:leave="ease-in duration-200"
             x-transition:leave-start="opacity-100"
             x-transition:leave-end="opacity-0"
             @click="closeModal()"
             class="fixed inset-0 bg-black/90 backdrop-blur-md transition-opacity"></div>

        <!-- Reel Container (Vertical 9:16 Frame) -->
        <div x-show="modalOpen"
             x-transition:enter="ease-out duration-300"
             x-transition:enter-start="opacity-0 scale-95"
             x-transition:enter-end="opacity-100 scale-100"
             x-transition:leave="ease-in duration-200"
             x-transition:leave-start="opacity-100 scale-100"
             x-transition:leave-end="opacity-0 scale-95"
             class="relative w-full max-w-[390px] h-[85vh] sm:h-[90vh] max-h-[760px] bg-black rounded-3xl overflow-hidden shadow-2xl border border-white/20 z-10 flex flex-col justify-between">

            <!-- Reel Background Image with Slow Zoom Animation -->
            <div class="absolute inset-0 overflow-hidden">
                <img :src="'{{ asset('') }}' + reels[activeReelIndex].image" 
                     :alt="reels[activeReelIndex].title" 
                     class="w-full h-full object-cover transition-all duration-700 scale-105">
                <div class="absolute inset-0 bg-gradient-to-t from-black/95 via-black/20 to-black/60 pointer-events-none"></div>
            </div>

            <!-- Top Header Inside Modal: Progress Bar + User Handle + Close -->
            <div class="relative z-20 p-4 pb-2">
                <!-- Story / Reel Progress Bar -->
                <div class="w-full h-1 bg-white/20 rounded-full overflow-hidden mb-3">
                    <div class="h-full bg-white rounded-full transition-all duration-300"
                         :style="'width: ' + ((activeReelIndex + 1) / reels.length * 100) + '%'"></div>
                </div>

                <div class="flex items-center justify-between text-white">
                    <div class="flex items-center gap-2">
                        <div class="w-8 h-8 rounded-full bg-gradient-to-tr from-[#FCB045] via-[#FD1D1D] to-[#833AB4] p-[1.5px]">
                            <div class="w-full h-full rounded-full bg-[#0B1A2C] flex items-center justify-center">
                                <span class="font-serif font-bold text-xs text-[#D8C3A5]">C</span>
                            </div>
                        </div>
                        <div>
                            <span class="block text-xs font-bold leading-none" x-text="reels[activeReelIndex].creator"></span>
                            <span class="text-[9.5px] text-gray-300">Inspired By You</span>
                        </div>
                    </div>

                    <div class="flex items-center gap-2">
                        <!-- Sound Toggle -->
                        <button @click="isMuted = !isMuted"
                                type="button"
                                class="w-8 h-8 rounded-full bg-black/40 backdrop-blur-md text-white flex items-center justify-center hover:bg-black/60 transition-colors">
                            <template x-if="isMuted">
                                <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24"><path d="M16.5 12c0-1.77-1.02-3.29-2.5-4.03v2.21l2.45 2.45c.03-.2.05-.41.05-.63zm2.5 0c0 .94-.2 1.82-.54 2.64l1.51 1.51C20.63 14.91 21 13.5 21 12c0-4.28-2.99-7.86-7-8.77v2.06c2.89.86 5 3.54 5 6.71zM4.27 3L3 4.27 7.73 9H3v6h4l5 5v-6.73l4.25 4.25c-.67.52-1.42.93-2.25 1.18v2.06c1.38-.31 2.63-.95 3.69-1.81L19.73 21 21 19.73l-9-9L4.27 3zM12 4L9.91 6.09 12 8.18V4z"/></svg>
                            </template>
                            <template x-if="!isMuted">
                                <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24"><path d="M3 9v6h4l5 5V4L7 9H3zm13.5 3c0-1.77-1.02-3.29-2.5-4.03v8.05c1.48-.73 2.5-2.25 2.5-4.02zM14 3.23v2.06c2.89.86 5 3.54 5 6.71s-2.11 5.85-5 6.71v2.06c4.01-.91 7-4.49 7-8.77s-2.99-7.86-7-8.77z"/></svg>
                            </template>
                        </button>

                        <!-- Close Button -->
                        <button @click="closeModal()"
                                type="button"
                                class="w-8 h-8 rounded-full bg-black/40 backdrop-blur-md text-white flex items-center justify-center hover:bg-black/60 transition-colors">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Floating Right Side Interaction Bar -->
            <div class="absolute right-3.5 bottom-32 z-20 flex flex-col items-center gap-4 text-white">
                <!-- Like Button -->
                <button @click="toggleLike(activeReelIndex)"
                        type="button"
                        class="flex flex-col items-center gap-1 group">
                    <div class="w-10 h-10 rounded-full bg-black/40 backdrop-blur-md flex items-center justify-center transition-transform active:scale-125"
                         :class="likedMap[activeReelIndex] ? 'text-red-500 bg-red-500/20' : 'text-white hover:bg-black/60'">
                        <svg class="w-5 h-5 fill-current" viewBox="0 0 24 24">
                            <path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/>
                        </svg>
                    </div>
                    <span class="text-[10px] font-semibold" x-text="likeCounts[activeReelIndex]"></span>
                </button>

                <!-- WhatsApp Order Button -->
                <a :href="'https://wa.me/919576517660?text=' + encodeURIComponent(reels[activeReelIndex].wa_text)"
                   target="_blank"
                   rel="noopener noreferrer"
                   class="flex flex-col items-center gap-1 group">
                    <div class="w-10 h-10 rounded-full bg-emerald-600/90 hover:bg-emerald-600 text-white flex items-center justify-center shadow-lg transition-transform hover:scale-110">
                        <svg class="w-5 h-5 fill-current" viewBox="0 0 24 24">
                            <path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981zm11.387-5.464c-.074-.124-.272-.198-.57-.347-.297-.149-1.758-.868-2.031-.967-.272-.099-.47-.149-.669.149-.198.297-.768.967-.941 1.165-.173.198-.347.223-.644.074-.297-.149-1.255-.462-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.521.151-.172.2-.296.3-.495.099-.198.05-.372-.025-.521-.075-.148-.669-1.611-.916-2.206-.242-.579-.487-.501-.669-.51l-.57-.01c-.198 0-.52.074-.792.372s-1.04 1.016-1.04 2.479 1.065 2.876 1.213 3.074c.149.198 2.095 3.2 5.076 4.487.709.306 1.263.489 1.694.626.712.226 1.36.194 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.695.248-1.29.173-1.414z"/>
                        </svg>
                    </div>
                    <span class="text-[10px] font-semibold">Order</span>
                </a>

                <!-- Share Link Button -->
                <button @click="copyReelLink(activeReelIndex)"
                        type="button"
                        class="flex flex-col items-center gap-1 group">
                    <div class="w-10 h-10 rounded-full bg-black/40 backdrop-blur-md text-white flex items-center justify-center hover:bg-black/60 transition-colors">
                        <svg class="w-5 h-5 fill-current" viewBox="0 0 24 24">
                            <path d="M18 16.08c-.76 0-1.44.3-1.96.77L8.91 12.7c.05-.23.09-.46.09-.7s-.04-.47-.09-.7l7.05-4.11c.54.5 1.25.81 2.04.81 1.66 0 3-1.34 3-3s-1.34-3-3-3-3 1.34-3 3c0 .24.04.47.09.7L8.04 9.81C7.5 9.31 6.79 9 6 9c-1.66 0-3 1.34-3 3s1.34 3 3 3c.79 0 1.5-.31 2.04-.81l7.12 4.16c-.05.21-.08.43-.08.65 0 1.61 1.31 2.92 2.92 2.92s2.92-1.31 2.92-2.92c0-1.61-1.31-2.92-2.92-2.92z"/>
                        </svg>
                    </div>
                    <span class="text-[10px] font-semibold" x-text="copied ? 'Copied!' : 'Share'"></span>
                </button>
            </div>

            <!-- Bottom Information & Tagged Product Banner -->
            <div class="relative z-20 p-4 pt-0">
                <!-- Caption -->
                <div class="mb-3 text-white max-w-[280px]">
                    <h3 class="font-serif text-base font-bold leading-tight" x-text="reels[activeReelIndex].title"></h3>
                    <p class="text-xs text-gray-300 mt-1 line-clamp-2" x-text="reels[activeReelIndex].desc"></p>
                </div>

                <!-- Featured Tagged Product Floating Box -->
                <div class="bg-black/70 backdrop-blur-md border border-white/20 rounded-2xl p-3 text-white flex items-center justify-between gap-3">
                    <div class="flex items-center gap-2.5 min-w-0">
                        <img :src="'{{ asset('') }}' + reels[activeReelIndex].image" 
                             :alt="reels[activeReelIndex].product_name" 
                             class="w-12 h-12 rounded-xl object-cover border border-white/20 flex-shrink-0">
                        <div class="min-w-0">
                            <span class="block text-[9.5px] uppercase font-bold text-[#D8C3A5]">Featured Look</span>
                            <h4 class="text-xs font-semibold truncate" x-text="reels[activeReelIndex].product_name"></h4>
                            <div class="flex items-center gap-2 mt-0.5">
                                <span class="text-xs font-bold text-white" x-text="reels[activeReelIndex].product_price"></span>
                                <span class="text-[10px] text-gray-400 line-through" x-text="reels[activeReelIndex].product_mrp"></span>
                            </div>
                        </div>
                    </div>

                    <a :href="'https://wa.me/919576517660?text=' + encodeURIComponent(reels[activeReelIndex].wa_text)"
                       target="_blank"
                       rel="noopener noreferrer"
                       class="px-3.5 py-2 rounded-xl bg-[#D8C3A5] hover:bg-[#c9b291] text-[#0B1A2C] font-sans text-xs font-bold tracking-wider uppercase transition-colors flex-shrink-0 shadow-md">
                        Shop &rarr;
                    </a>
                </div>
            </div>

            <!-- Left & Right Arrow Navigation -->
            <button @click.stop="prevReel()"
                    type="button"
                    aria-label="Previous Reel"
                    class="absolute -left-12 top-1/2 -translate-y-1/2 w-10 h-10 rounded-full bg-white/20 hover:bg-white text-white hover:text-black hidden md:flex items-center justify-center transition-all">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
            </button>
            <button @click.stop="nextReel()"
                    type="button"
                    aria-label="Next Reel"
                    class="absolute -right-12 top-1/2 -translate-y-1/2 w-10 h-10 rounded-full bg-white/20 hover:bg-white text-white hover:text-black hidden md:flex items-center justify-center transition-all">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
            </button>
        </div>
    </div>
</section>
