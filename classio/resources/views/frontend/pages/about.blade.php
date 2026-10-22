<x-layout.app :categories="$categories">
    <div class="bg-[#FAF9F6] min-h-screen py-10 sm:py-16 select-none">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <!-- Breadcrumbs -->
            <nav class="flex text-xs font-sans text-gray-500 uppercase tracking-widest mb-8" aria-label="Breadcrumb">
                <ol class="inline-flex items-center space-x-2">
                    <li><a href="{{ route('home') }}" class="hover:text-[#0B1A2C] transition-colors">Home</a></li>
                    <li>/</li>
                    <li class="text-[#0B1A2C] font-semibold">About Us</li>
                </ol>
            </nav>

            <!-- Hero Section -->
            <div class="text-center max-w-3xl mx-auto mb-12 sm:mb-16">
                <span class="text-[10px] sm:text-xs font-bold uppercase tracking-[0.25em] text-[#8C6D46] bg-[#FAF0E6] px-3.5 py-1 rounded-full border border-[#D8C3A5]/40 inline-block mb-3">
                    Our Heritage & Vision
                </span>
                <h1 class="font-serif text-3xl sm:text-4xl lg:text-5xl font-bold text-[#0B1A2C] tracking-tight leading-tight mb-4">
                    Handcrafted Excellence. Inspired By You.
                </h1>
                <p class="font-sans text-xs sm:text-sm text-gray-600 leading-relaxed">
                    Classio is an ultra-premium multi-category fashion and horology house dedicated to timeless elegance, authentic craftsmanship, and bespoke sartorial sophistication.
                </p>
            </div>

            <!-- Story Image & Philosophy Banner -->
            <div class="relative rounded-3xl overflow-hidden shadow-2xl mb-12 sm:mb-16 border border-[#D8C3A5]/30 bg-[#0B1A2C]">
                <img src="{{ asset('images/classio/brand_boutique.jpg') }}" alt="Classio Flagship Boutique" class="w-full h-72 sm:h-96 object-cover opacity-60">
                <div class="absolute inset-0 bg-gradient-to-t from-[#0B1A2C] via-[#0B1A2C]/60 to-transparent flex flex-col justify-end p-6 sm:p-12 text-white">
                    <span class="text-[10px] sm:text-xs uppercase tracking-widest text-[#D8C3A5] font-semibold mb-1">Established with Passion</span>
                    <h2 class="font-serif text-2xl sm:text-3xl font-bold text-white mb-2">Exhibition Road Flagship Boutique</h2>
                    <p class="text-xs sm:text-sm text-gray-300 max-w-2xl leading-relaxed">
                        From our iconic salon in Patna to discerning connoisseurs nationwide, Classio brings together authentic international Swiss-inspired timepieces, handcrafted textiles, and modern luxury essentials.
                    </p>
                </div>
            </div>

            <!-- Core Values Grid -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-12 sm:mb-16">
                <div class="bg-white rounded-2xl p-6 sm:p-8 border border-gray-100 shadow-sm">
                    <div class="w-12 h-12 rounded-xl bg-[#FAF0E6] text-[#8C6D46] flex items-center justify-center font-serif text-xl font-bold mb-4">
                        01
                    </div>
                    <h3 class="font-serif text-lg font-bold text-[#0B1A2C] mb-2">Artisanal Integrity</h3>
                    <p class="text-xs text-gray-600 leading-relaxed">
                        Every garment, timepiece, and leather accessory in our catalog undergoes rigorous multi-point authenticity and quality certification before dispatch.
                    </p>
                </div>

                <div class="bg-white rounded-2xl p-6 sm:p-8 border border-gray-100 shadow-sm">
                    <div class="w-12 h-12 rounded-xl bg-[#FAF0E6] text-[#8C6D46] flex items-center justify-center font-serif text-xl font-bold mb-4">
                        02
                    </div>
                    <h3 class="font-serif text-lg font-bold text-[#0B1A2C] mb-2">Connoisseur Curation</h3>
                    <p class="text-xs text-gray-600 leading-relaxed">
                        We curate only the finest silhouettes—from precision automatic skeleton timepieces to limited-edition festive designer wear and bespoke accessories.
                    </p>
                </div>

                <div class="bg-white rounded-2xl p-6 sm:p-8 border border-gray-100 shadow-sm">
                    <div class="w-12 h-12 rounded-xl bg-[#FAF0E6] text-[#8C6D46] flex items-center justify-center font-serif text-xl font-bold mb-4">
                        03
                    </div>
                    <h3 class="font-serif text-lg font-bold text-[#0B1A2C] mb-2">Personal Concierge</h3>
                    <p class="text-xs text-gray-600 leading-relaxed">
                        Our dedicated styling and support concierge is available seven days a week to provide bespoke consultation, custom sizing, and white-glove assistance.
                    </p>
                </div>
            </div>

            <!-- Call to Action -->
            <div class="bg-[#0B1A2C] rounded-3xl p-8 sm:p-12 text-center text-white relative overflow-hidden">
                <div class="relative z-10 max-w-xl mx-auto">
                    <h3 class="font-serif text-2xl sm:text-3xl font-bold text-[#D8C3A5] mb-3">Experience The Collection</h3>
                    <p class="text-xs sm:text-sm text-gray-300 mb-6 leading-relaxed">
                        Discover luxury timepieces, artisanal apparel, and exquisite footwear designed to elevate every occasion.
                    </p>
                    <div class="flex flex-wrap items-center justify-center gap-3">
                        <a href="{{ route('home') }}" class="px-6 py-2.5 rounded-full bg-[#D8C3A5] hover:bg-[#c9b291] text-[#0B1A2C] text-xs font-bold uppercase tracking-wider transition-colors shadow">
                            Explore Collections &rarr;
                        </a>
                        <a href="{{ route('stores') }}" class="px-6 py-2.5 rounded-full border border-white/30 hover:border-white text-white text-xs font-bold uppercase tracking-wider transition-colors">
                            Visit Our Boutique
                        </a>
                    </div>
                </div>
            </div>

        </div>
    </div>
</x-layout.app>
