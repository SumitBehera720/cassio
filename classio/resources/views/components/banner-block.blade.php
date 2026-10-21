@props(['banners' => collect()])

<section x-data="{
    currentSlide: 0,
    paused: false,
    timer: null,
    slides: [
        {
            overline: 'Exclusive Menswear',
            title: 'MODERN<br class=\'hidden sm:inline\'> GENTLEMAN STYLE',
            subtitle: 'SUITS · BLAZERS · PREMIUM SHOES',
            ctaText: 'EXPLORE NOW',
            ctaLink: '/category/gents-collection',
            image: '{{ asset('images/classio/hero_model.jpg') }}'
        },
        {
            overline: 'Elegance in Every Detail',
            title: 'LADIES DESIGNER<br class=\'hidden sm:inline\'> LUXURY COLLECTION',
            subtitle: 'SAREES · ETHNIC SETS · WESTERN DRESSES',
            ctaText: 'SHOP WOMEN',
            ctaLink: '/category/ladies-collection',
            image: '{{ asset('images/classio/ladies_banner.jpg') }}'
        },
        {
            overline: 'Prestige Accessories',
            title: 'TIMELESS LUXURY<br class=\'hidden sm:inline\'> WATCHES & SCENTS',
            subtitle: 'CHRONOGRAPHS · SWISS MOVEMENTS · EDP',
            ctaText: 'DISCOVER MORE',
            ctaLink: '/category/watches-perfumes',
            image: '{{ asset('images/classio/watches_banner.jpg') }}'
        },
        {
            overline: 'Festive Season Special',
            title: 'EXCLUSIVE DEALS<br class=\'hidden sm:inline\'> UP TO 50% OFF',
            subtitle: 'HANDBAGS · FOOTWEAR · JEWELRY ESSENTIALS',
            ctaText: 'CLAIM OFFERS',
            ctaLink: '/category/offers',
            image: '{{ asset('images/classio/banner_offers.jpg') }}'
        }
    ],
    init() {
        this.startTimer();
    },
    startTimer() {
        this.timer = setInterval(() => {
            if (!this.paused) {
                this.next();
            }
        }, 5000);
    },
    next() {
        this.currentSlide = (this.currentSlide + 1) % this.slides.length;
    },
    prev() {
        this.currentSlide = (this.currentSlide - 1 + this.slides.length) % this.slides.length;
    },
    goTo(index) {
        this.currentSlide = index;
    }
}" @mouseenter="paused = true" @mouseleave="paused = false" class="relative w-full bg-[#0B1A2C] overflow-hidden select-none">
    
    <div class="max-w-[1440px] mx-auto px-4 sm:px-6 lg:px-8 py-8 sm:py-10 lg:py-14 relative">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-6 items-center min-h-[420px] sm:min-h-[460px] lg:min-h-[500px]">
            
            <!-- Left Editorial Text Content (Reactive to slide) -->
            <div class="lg:col-span-7 z-10 text-center lg:text-left lg:pl-6 xl:pl-10 flex flex-col items-center lg:items-start transition-opacity duration-300">
                <p class="font-script text-2xl sm:text-3xl lg:text-4xl text-[#E5D5BC] mb-1 sm:mb-2 tracking-wide" x-text="slides[currentSlide].overline"></p>
                <h1 class="font-serif font-black text-3xl sm:text-4xl md:text-5xl lg:text-[54px] text-white tracking-tight uppercase leading-[1.1] mb-3 sm:mb-4 min-h-[70px] sm:min-h-[90px] lg:min-h-[120px]" x-html="slides[currentSlide].title"></h1>
                <p class="font-sans text-[11px] sm:text-xs md:text-sm font-semibold tracking-[0.2em] sm:tracking-[0.25em] text-white/80 uppercase mb-6 sm:mb-8 max-w-md" x-text="slides[currentSlide].subtitle"></p>
                <div>
                    <a :href="slides[currentSlide].ctaLink" class="inline-flex items-center gap-2 px-7 sm:px-8 py-3 sm:py-3.5 rounded-full border border-white/40 text-white bg-white/5 hover:bg-white hover:text-[#0B1A2C] font-sans text-xs font-bold tracking-widest uppercase transition-all duration-300 shadow-lg">
                        <span x-text="slides[currentSlide].ctaText"></span>
                        <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                    </a>
                </div>
            </div>

            <!-- Right Image: Dynamic Banner with smooth transitions -->
            <div class="lg:col-span-5 relative flex justify-center lg:justify-end">
                <div class="relative w-full max-w-[320px] sm:max-w-[400px] lg:max-w-[460px] xl:max-w-[500px] rounded-2xl overflow-hidden shadow-2xl border border-white/10 aspect-[4/3] sm:aspect-[1.15/1]">
                    <template x-for="(slide, index) in slides" :key="index">
                        <img x-show="currentSlide === index" 
                             :src="slide.image" 
                             :alt="slide.overline" 
                             x-transition:enter="transition ease-out duration-500"
                             x-transition:enter-start="opacity-0 scale-95"
                             x-transition:enter-end="opacity-100 scale-100"
                             x-transition:leave="transition ease-in duration-300 absolute inset-0"
                             x-transition:leave-start="opacity-100 scale-100"
                             x-transition:leave-end="opacity-0 scale-105"
                             class="w-full h-full object-cover">
                    </template>
                    <!-- Subtle vignette gradient -->
                    <div class="absolute inset-0 bg-gradient-to-t from-[#0B1A2C]/40 via-transparent to-transparent pointer-events-none"></div>
                </div>
            </div>
        </div>

        <!-- Carousel Left & Right Arrow Buttons (Fully Functional) -->
        <button @click="prev()" class="flex absolute left-2 lg:left-4 top-1/2 -translate-y-1/2 w-9 h-9 lg:w-11 lg:h-11 rounded-full border border-white/20 bg-black/40 hover:bg-white/20 backdrop-blur-sm text-white/90 hover:text-white items-center justify-center transition-all duration-200 z-20 focus:outline-none focus:ring-2 focus:ring-[#D8C3A5]" aria-label="Previous slide">
            <svg class="w-4 h-4 lg:w-5 lg:h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
        </button>
        <button @click="next()" class="flex absolute right-2 lg:right-4 top-1/2 -translate-y-1/2 w-9 h-9 lg:w-11 lg:h-11 rounded-full border border-white/20 bg-black/40 hover:bg-white/20 backdrop-blur-sm text-white/90 hover:text-white items-center justify-center transition-all duration-200 z-20 focus:outline-none focus:ring-2 focus:ring-[#D8C3A5]" aria-label="Next slide">
            <svg class="w-4 h-4 lg:w-5 lg:h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
        </button>

        <!-- Carousel Indicators at Bottom Center (Clickable to jump) -->
        <div class="flex items-center justify-center space-x-2 pt-4 pb-1 z-20 relative">
            <template x-for="(slide, index) in slides" :key="index">
                <button @click="goTo(index)" 
                        :class="currentSlide === index ? 'w-7 bg-[#D8C3A5]' : 'w-2 bg-white/40 hover:bg-white/70'" 
                        class="h-2 rounded-full transition-all duration-300 focus:outline-none" 
                        :aria-label="'Go to slide ' + (index + 1)">
                </button>
            </template>
        </div>
    </div>
</section>
