<x-layout.app :categories="$categories">
    <div class="bg-[#FAF9F6] min-h-screen py-10 sm:py-16 select-none">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <!-- Breadcrumbs -->
            <nav class="flex text-xs font-sans text-gray-500 uppercase tracking-widest mb-8" aria-label="Breadcrumb">
                <ol class="inline-flex items-center space-x-2">
                    <li><a href="{{ route('home') }}" class="hover:text-[#0B1A2C] transition-colors">Home</a></li>
                    <li>/</li>
                    <li class="text-[#0B1A2C] font-semibold">Our Stores & Boutiques</li>
                </ol>
            </nav>

            <!-- Page Title -->
            <div class="text-center max-w-2xl mx-auto mb-10 sm:mb-14">
                <span class="text-[10px] sm:text-xs font-bold uppercase tracking-[0.25em] text-[#8C6D46] bg-[#FAF0E6] px-3.5 py-1 rounded-full border border-[#D8C3A5]/40 inline-block mb-3">
                    Boutique Locator & Salons
                </span>
                <h1 class="font-serif text-3xl sm:text-4xl font-bold text-[#0B1A2C] tracking-tight mb-3">
                    Experience Classio in Person
                </h1>
                <p class="font-sans text-xs sm:text-sm text-gray-600 leading-relaxed">
                    Step inside our luxury salons to try on handcrafted timepieces, explore designer fabrics, and receive personalized styling consultations.
                </p>
            </div>

            <!-- Flagship Boutique Card -->
            <div class="bg-white rounded-3xl overflow-hidden shadow-[0_10px_35px_rgba(11,26,44,0.08)] border border-gray-100 mb-12">
                <div class="grid grid-cols-1 lg:grid-cols-12">
                    <!-- Photo -->
                    <div class="lg:col-span-6 relative min-h-[280px] lg:min-h-[420px] bg-[#0B1A2C]">
                        <img src="{{ asset('images/classio/brand_boutique.jpg') }}" alt="Classio Flagship Boutique Patna" class="w-full h-full object-cover">
                        <div class="absolute top-4 left-4">
                            <span class="px-3 py-1 rounded-full bg-[#0B1A2C] text-[#D8C3A5] text-[10px] font-bold uppercase tracking-widest border border-[#D8C3A5]/30">
                                Flagship Boutique
                            </span>
                        </div>
                    </div>

                    <!-- Details -->
                    <div class="lg:col-span-6 p-6 sm:p-10 flex flex-col justify-between">
                        <div>
                            <span class="text-[11px] font-bold uppercase tracking-wider text-[#8C6D46]">Patna, Bihar</span>
                            <h2 class="font-serif text-2xl sm:text-3xl font-bold text-[#0B1A2C] mt-1 mb-4">Exhibition Road Flagship Salon</h2>
                            
                            <p class="text-xs text-gray-600 leading-relaxed mb-6">
                                Located in the heart of Patna's luxury commercial quarter, our flagship salon presents the complete Classio portfolio including horology, haute couture, accessories, and private consultation lounges.
                            </p>

                            <div class="space-y-3 text-xs text-gray-700 mb-6">
                                <div class="flex items-start gap-2.5">
                                    <svg class="w-4 h-4 text-[#8C6D46] flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                                    <span class="leading-relaxed">Address: 77, near Jaleshwar mandir, near Blinkit Office, LIC Colony, Jogipur, Kankarbagh, Bankman Colony, Patna, Bihar 800026</span>
                                </div>
                                <div class="flex items-center gap-2.5">
                                    <svg class="w-4 h-4 text-[#8C6D46] flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                                    <a href="tel:+919576517660" class="hover:underline font-semibold text-[#0B1A2C]">+91 95765 17660</a>
                                    <span class="text-gray-300">|</span>
                                    <a href="https://wa.me/919576517660" target="_blank" class="hover:underline font-semibold text-emerald-600 flex items-center gap-1">
                                        <span>WhatsApp</span>
                                    </a>
                                </div>
                                <div class="flex items-center gap-2.5">
                                    <svg class="w-4 h-4 text-[#8C6D46] flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                    <span>Open daily: 10:00 AM – 8:30 PM IST</span>
                                </div>
                            </div>

                            <div class="border-t border-gray-100 pt-4 mb-6">
                                <h4 class="text-[11px] font-bold uppercase tracking-wider text-gray-500 mb-2">Boutique In-Store Services</h4>
                                <div class="flex flex-wrap gap-2 text-[11px] text-gray-600">
                                    <span class="px-2.5 py-1 rounded-lg bg-gray-50 border border-gray-200">Watch Strap Adjustment</span>
                                    <span class="px-2.5 py-1 rounded-lg bg-gray-50 border border-gray-200">VIP Styling Suite</span>
                                    <span class="px-2.5 py-1 rounded-lg bg-gray-50 border border-gray-200">Custom Sizing Consultation</span>
                                    <span class="px-2.5 py-1 rounded-lg bg-gray-50 border border-gray-200">In-Store Pickup</span>
                                </div>
                            </div>
                        </div>

                        <div class="flex flex-wrap gap-3">
                            <a href="https://maps.app.goo.gl/oziQjtasd953vBiY7" target="_blank" rel="noopener noreferrer" class="px-5 py-2.5 rounded-full bg-[#0B1A2C] text-white hover:bg-[#12243d] text-xs font-bold uppercase tracking-wider transition-colors flex items-center gap-1.5 shadow">
                                <span>📍 View Pin on Google Maps</span> &rarr;
                            </a>
                            <a href="https://wa.me/919576517660?text={{ urlencode('Hello Classio! I would like to schedule a visit to the Patna boutique.') }}" target="_blank" class="px-5 py-2.5 rounded-full border border-gray-300 hover:border-[#0B1A2C] text-[#0B1A2C] text-xs font-bold uppercase tracking-wider transition-colors">
                                Book VIP Visit
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Interactive Map Section with Pin -->
            <div class="bg-white rounded-3xl overflow-hidden shadow-[0_10px_35px_rgba(11,26,44,0.08)] border border-gray-100 mb-12 p-6 sm:p-8">
                <div class="flex flex-col sm:flex-row sm:items-center justify-between pb-4 mb-4 border-b border-gray-100 gap-3">
                    <div>
                        <span class="text-[10px] sm:text-xs font-bold uppercase tracking-[0.2em] text-[#8C6D46]">Interactive Map</span>
                        <h3 class="font-serif text-xl sm:text-2xl font-bold text-[#0B1A2C]">Patna Boutique Location</h3>
                    </div>
                    <a href="https://maps.app.goo.gl/oziQjtasd953vBiY7" target="_blank" rel="noopener noreferrer" class="inline-flex items-center gap-2 px-5 py-2.5 rounded-full bg-[#0B1A2C] text-white hover:bg-[#12243d] text-xs font-bold uppercase tracking-wider transition-all shadow-md">
                        <span>📍 Open in Google Maps</span>
                        <span>&nearr;</span>
                    </a>
                </div>
                <div class="rounded-2xl overflow-hidden border border-gray-200 h-[360px] sm:h-[420px] relative bg-gray-100">
                    <iframe 
                        src="https://maps.google.com/maps?q=77,+near+Jaleshwar+mandir,+near+Blinkit+Office,+LIC+Colony,+Jogipur,+Kankarbagh,+Patna,+Bihar+800026&t=&z=16&ie=UTF8&iwloc=&output=embed" 
                        class="w-full h-full border-0" 
                        allowfullscreen="" 
                        loading="lazy" 
                        referrerpolicy="no-referrer-when-downgrade"
                        title="Classio Patna Flagship Location Map">
                    </iframe>
                </div>
                <div class="mt-4 flex flex-col sm:flex-row sm:items-center justify-between text-xs text-gray-500 gap-2">
                    <span>📍 77, near Jaleshwar mandir, near Blinkit Office, LIC Colony, Jogipur, Kankarbagh, Bankman Colony, Patna, Bihar 800026</span>
                    <a href="https://maps.app.goo.gl/oziQjtasd953vBiY7" target="_blank" class="text-[#8C6D46] font-semibold hover:underline shrink-0">Get Route & Directions ↗</a>
                </div>
            </div>

            <!-- Upcoming Experience Lounges -->
            <div class="mb-12">
                <h3 class="font-serif text-xl font-bold text-[#0B1A2C] mb-6">Upcoming Classio Salons</h3>
                
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div class="bg-white rounded-2xl p-6 border border-gray-100 shadow-sm flex flex-col justify-between">
                        <div>
                            <span class="text-[10px] font-bold uppercase tracking-widest text-emerald-700 bg-emerald-50 px-2.5 py-0.5 rounded-full border border-emerald-200 inline-block mb-3">Opening Q3 2025</span>
                            <h4 class="font-serif text-lg font-bold text-[#0B1A2C]">New Delhi</h4>
                            <p class="text-xs text-gray-500 mt-1">Connaught Place Outer Circle, Central Delhi</p>
                            <p class="text-[11px] text-gray-400 mt-3 leading-relaxed">Dedicated horology gallery and haute couture private viewing suites.</p>
                        </div>
                    </div>

                    <div class="bg-white rounded-2xl p-6 border border-gray-100 shadow-sm flex flex-col justify-between">
                        <div>
                            <span class="text-[10px] font-bold uppercase tracking-widest text-emerald-700 bg-emerald-50 px-2.5 py-0.5 rounded-full border border-emerald-200 inline-block mb-3">Opening Q4 2025</span>
                            <h4 class="font-serif text-lg font-bold text-[#0B1A2C]">Mumbai</h4>
                            <p class="text-xs text-gray-500 mt-1">Bandra West, Luxury Fashion District</p>
                            <p class="text-[11px] text-gray-400 mt-3 leading-relaxed">Curated lifestyle destination with seaside private styling terrace.</p>
                        </div>
                    </div>

                    <div class="bg-white rounded-2xl p-6 border border-gray-100 shadow-sm flex flex-col justify-between">
                        <div>
                            <span class="text-[10px] font-bold uppercase tracking-widest text-emerald-700 bg-emerald-50 px-2.5 py-0.5 rounded-full border border-emerald-200 inline-block mb-3">Opening Early 2026</span>
                            <h4 class="font-serif text-lg font-bold text-[#0B1A2C]">Kolkata</h4>
                            <p class="text-xs text-gray-500 mt-1">Park Street Heritage Corridor</p>
                            <p class="text-[11px] text-gray-400 mt-3 leading-relaxed">Colonial-inspired atelier showcasing bespoke fabrics and vintage horology.</p>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</x-layout.app>
