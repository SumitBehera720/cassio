@php
    $footerWa = \App\Models\Setting::where('key_name', 'whatsapp_number')->value('value') ?? '+91 95765 17660';
    $cleanFooterWa = preg_replace('/[^0-9]/', '', $footerWa);
    if (empty($cleanFooterWa)) {
        $cleanFooterWa = '919576517660';
    }
    $footerPhone = \App\Models\Setting::where('key_name', 'contact_phone')->value('value') ?? '+91 95765 17660';
    $footerAddress = \App\Models\Setting::where('key_name', 'store_address')->value('value') ?? '77, near Jaleshwar mandir, near Blinkit Office, LIC Colony, Jogipur, Kankarbagh, Bankman Colony, Patna, Bihar 800026';
    $footerMapsUrl = \App\Models\Setting::where('key_name', 'google_maps_url')->value('value') ?? 'https://maps.app.goo.gl/oziQjtasd953vBiY7';
    $footerIg = \App\Models\Setting::where('key_name', 'instagram_url')->value('value') ?? 'https://www.instagram.com/_classio_07_/';
    $footerFb = \App\Models\Setting::where('key_name', 'facebook_url')->value('value') ?? 'https://www.facebook.com/profile.php?id=61585512925640';
    $footerYt = \App\Models\Setting::where('key_name', 'youtube_url')->value('value') ?? 'https://youtube.com/@classio';
@endphp
<footer class="bg-[#0B1A2C] text-white pt-12 sm:pt-14 select-none border-t border-[#D8C3A5]/15">
    <div class="max-w-[1440px] mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8 sm:gap-10 pb-10 sm:pb-12">
            <!-- Branding -->
            <div class="flex flex-col">
                <a href="{{ route('home') }}" class="flex flex-col items-start mb-3 sm:mb-4 group">
                    <div class="text-[#D8C3A5] mb-1">
                        <svg class="w-6 sm:w-7 h-4 sm:h-5" viewBox="0 0 36 24" fill="currentColor">
                            <path d="M18 1L21.5 8.5L29 3.5L25.5 13H10.5L7 3.5L14.5 8.5L18 1Z" opacity="0.9"/>
                            <path d="M8 15.5H28C28.8 15.5 29.5 16.2 29.5 17C29.5 17.8 28.8 18.5 28 18.5H8C7.2 18.5 6.5 17.8 6.5 17C6.5 16.2 7.2 15.5 8 15.5Z" />
                            <circle cx="18" cy="1" r="1.5"/>
                            <circle cx="7" cy="3.5" r="1.3"/>
                            <circle cx="29" cy="3.5" r="1.3"/>
                        </svg>
                    </div>
                    <span class="font-serif text-[20px] sm:text-[22px] font-bold tracking-[0.25em] text-[#D8C3A5] leading-none">CLASSIO</span>
                    <span class="text-[6px] sm:text-[6.5px] tracking-[0.35em] text-[#D8C3A5]/80 font-sans uppercase mt-1 leading-none">INSPIRED BY YOU</span>
                </a>
                <p class="font-sans text-xs text-gray-300/80 leading-relaxed mb-5 max-w-xs">
                    Your ultimate destination for luxury watches, designer apparel, premium accessories, and footwear. Handcrafted excellence, inspired by you.
                </p>
                <div class="flex space-x-3">
                    <a href="{{ $footerIg }}" target="_blank" rel="noopener noreferrer" class="w-8 h-8 rounded-full border border-white/20 flex items-center justify-center text-gray-300 hover:text-[#D8C3A5] hover:border-[#D8C3A5] transition-colors" aria-label="Instagram">
                        <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zM12 0C8.741 0 8.333.014 7.053.072 2.695.272.273 2.69.073 7.052.014 8.333 0 8.741 0 12c0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98C8.333 23.986 8.741 24 12 24c3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98C15.668.014 15.259 0 12 0zm0 5.838a6.162 6.162 0 100 12.324 6.162 6.162 0 000-12.324zM12 16a4 4 0 110-8 4 4 0 010 8zm6.406-11.845a1.44 1.44 0 100 2.881 1.44 1.44 0 000-2.881z"/></svg>
                    </a>
                    <a href="{{ $footerFb }}" target="_blank" rel="noopener noreferrer" class="w-8 h-8 rounded-full border border-white/20 flex items-center justify-center text-gray-300 hover:text-[#D8C3A5] hover:border-[#D8C3A5] transition-colors" aria-label="Facebook">
                        <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 24 24"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.469h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.469h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
                    </a>
                    <a href="{{ $footerYt }}" target="_blank" rel="noopener noreferrer" class="w-8 h-8 rounded-full border border-white/20 flex items-center justify-center text-gray-300 hover:text-[#D8C3A5] hover:border-[#D8C3A5] transition-colors" aria-label="YouTube">
                        <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 24 24"><path d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/></svg>
                    </a>
                    <a href="https://wa.me/{{ $cleanFooterWa }}" target="_blank" rel="noopener noreferrer" class="w-8 h-8 rounded-full border border-white/20 flex items-center justify-center text-gray-300 hover:text-[#D8C3A5] hover:border-[#D8C3A5] transition-colors" aria-label="WhatsApp">
                        <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 24 24"><path d="M12.031 0C5.385 0 0 5.385 0 12.031c0 2.12.553 4.184 1.6 6L.515 24l6.115-1.603c1.745.955 3.738 1.458 5.401 1.458 6.646 0 12.031-5.385 12.031-12.031S18.677 0 12.031 0zm3.565 17.202c-.15.429-.861.815-1.2.86-.312.042-.718.118-2.072-.444-1.642-.683-2.695-2.355-2.775-2.463-.075-.107-.665-.884-.665-1.688s.416-1.192.56-1.353c.143-.161.312-.201.417-.201.104 0 .21.002.296.006.095.004.22-.036.335.241.12.285.405.992.44 1.064.036.075.06.161.008.267-.052.107-.078.174-.156.267-.078.095-.164.205-.233.285-.078.084-.162.176-.07.336.091.161.405.674.871 1.091.603.538 1.109.704 1.268.784.161.078.252.062.348-.046.094-.108.406-.474.516-.638.109-.161.218-.135.362-.08.143.052.909.43 1.064.507.156.078.26.118.298.183.037.062.037.37-.113.8z"/></svg>
                    </a>
                </div>
            </div>

            <!-- Quick Links -->
            <div>
                <h4 class="font-sans text-[11px] font-bold uppercase tracking-widest text-[#E5D5BC] mb-4 sm:mb-5">Quick Links</h4>
                <ul class="space-y-2 sm:space-y-2.5 font-sans text-xs text-gray-300/80">
                    <li><a href="{{ route('about') }}" class="hover:text-[#D8C3A5] transition-colors">About Us</a></li>
                    <li><a href="{{ route('contact') }}" class="hover:text-[#D8C3A5] transition-colors">Contact Us</a></li>
                    <li><a href="{{ route('stores') }}" class="hover:text-[#D8C3A5] transition-colors">Our Stores & Boutiques</a></li>
                    <li><a href="{{ route('return-policy') }}" class="hover:text-[#D8C3A5] transition-colors">Return Policy</a></li>
                    <li><a href="{{ route('shipping-policy') }}" class="hover:text-[#D8C3A5] transition-colors">Shipping Policy</a></li>
                    <li><a href="{{ route('privacy-policy') }}" class="hover:text-[#D8C3A5] transition-colors">Privacy Policy</a></li>
                    <li><a href="{{ route('terms') }}" class="hover:text-[#D8C3A5] transition-colors">Terms & Conditions</a></li>
                </ul>
            </div>

            <!-- Customer Service -->
            <div>
                <h4 class="font-sans text-[11px] font-bold uppercase tracking-widest text-[#E5D5BC] mb-4 sm:mb-5">Customer Service</h4>
                <ul class="space-y-2 sm:space-y-2.5 font-sans text-xs text-gray-300/80">
                    <li><a href="{{ route('login') }}" class="hover:text-[#D8C3A5] transition-colors">My Account / Login</a></li>
                    <li><a href="{{ route('track-order') }}" class="hover:text-[#D8C3A5] transition-colors">Track Order</a></li>
                    <li><a href="{{ route('customer-service') }}" class="hover:text-[#D8C3A5] transition-colors">Help & Concierge Support</a></li>
                    <li><a href="{{ route('wishlist.index') }}" class="hover:text-[#D8C3A5] transition-colors">Wishlist</a></li>
                    <li><a href="{{ route('faq') }}" class="hover:text-[#D8C3A5] transition-colors">Frequently Asked Questions</a></li>
                    <li><a href="{{ route('size-guide') }}" class="hover:text-[#D8C3A5] transition-colors">Luxury Size Guide</a></li>
                </ul>
            </div>

            <!-- Store Information -->
            <div>
                <h4 class="font-sans text-[11px] font-bold uppercase tracking-widest text-[#E5D5BC] mb-4 sm:mb-5">Flagship Boutique</h4>
                <ul class="space-y-3 sm:space-y-4 font-sans text-xs text-gray-300/80">
                    <li class="flex items-start">
                        <svg class="w-4 h-4 mr-3 text-[#D8C3A5] flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                        <div>
                            <span class="text-white font-medium block">Classio Flagship Boutique</span>
                            <span class="text-gray-300/80 leading-relaxed block">{{ $footerAddress }}</span>
                            <a href="{{ $footerMapsUrl }}" target="_blank" rel="noopener noreferrer" class="inline-flex items-center gap-1 text-[11px] text-[#D8C3A5] hover:underline mt-1.5 font-semibold">
                                <span>📍 Open in Google Maps Pin</span>
                                <span>&nearr;</span>
                            </a>
                        </div>
                    </li>
                    <li class="flex items-center">
                        <svg class="w-4 h-4 mr-3 text-[#D8C3A5] flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path></svg>
                        <a href="tel:{{ preg_replace('/[^0-9+]/', '', $footerPhone) }}" class="hover:text-white transition-colors font-medium">{{ $footerPhone }}</a>
                    </li>
                    <li class="flex items-center">
                        <svg class="w-4 h-4 mr-3 text-[#D8C3A5] flex-shrink-0" fill="currentColor" viewBox="0 0 24 24"><path d="M12.031 0C5.385 0 0 5.385 0 12.031c0 2.12.553 4.184 1.6 6L.515 24l6.115-1.603c1.745.955 3.738 1.458 5.401 1.458 6.646 0 12.031-5.385 12.031-12.031S18.677 0 12.031 0zm3.565 17.202c-.15.429-.861.815-1.2.86-.312.042-.718.118-2.072-.444-1.642-.683-2.695-2.355-2.775-2.463-.075-.107-.665-.884-.665-1.688s.416-1.192.56-1.353c.143-.161.312-.201.417-.201.104 0 .21.002.296.006.095.004.22-.036.335.241.12.285.405.992.44 1.064.036.075.06.161.008.267-.052.107-.078.174-.156.267-.078.095-.164.205-.233.285-.078.084-.162.176-.07.336.091.161.405.674.871 1.091.603.538 1.109.704 1.268.784.161.078.252.062.348-.046.094-.108.406-.474.516-.638.109-.161.218-.135.362-.08.143.052.909.43 1.064.507.156.078.26.118.298.183.037.062.037.37-.113.8z"/></svg>
                        <a href="https://wa.me/{{ $cleanFooterWa }}" target="_blank" rel="noopener noreferrer" class="hover:text-white transition-colors">WhatsApp Order: {{ $footerWa }}</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <!-- Bottom Copyright & Payment Methods (Deep Midnight Bar) -->
    <div class="bg-[#071321] py-4 border-t border-white/5">
        <div class="max-w-[1440px] mx-auto px-4 sm:px-6 lg:px-8 flex flex-col sm:flex-row justify-between items-center text-[10.5px] sm:text-[11px] font-sans text-gray-300 gap-3 text-center sm:text-left">
            <p>&copy; 2025 Classio Fashion. All Rights Reserved. | Designed with elegance for connoisseurs.</p>
            <div class="flex flex-wrap justify-center space-x-1.5 sm:space-x-2">
                <span class="px-2.5 sm:px-3 py-0.5 border border-white/20 rounded text-[9px] sm:text-[9.5px] text-[#D8C3A5] font-bold uppercase tracking-wider">VISA</span>
                <span class="px-2.5 sm:px-3 py-0.5 border border-white/20 rounded text-[9px] sm:text-[9.5px] text-[#D8C3A5] font-bold uppercase tracking-wider">MASTERCARD</span>
                <span class="px-2.5 sm:px-3 py-0.5 border border-white/20 rounded text-[9px] sm:text-[9.5px] text-[#D8C3A5] font-bold uppercase tracking-wider">UPI</span>
                <span class="px-2.5 sm:px-3 py-0.5 border border-white/20 rounded text-[9px] sm:text-[9.5px] text-[#D8C3A5] font-bold uppercase tracking-wider">RUPAY</span>
            </div>
        </div>
    </div>
</footer>

<!-- Official Floating WhatsApp Action Button in Bottom Right -->
<div class="fixed bottom-4 right-4 sm:bottom-6 sm:right-6 z-50 group flex items-center gap-2">
    <!-- Tooltip on hover -->
    <span class="hidden sm:inline-block pointer-events-none opacity-0 group-hover:opacity-100 transition-opacity duration-200 bg-[#0B1A2C] text-white text-xs font-semibold px-3 py-1.5 rounded-full shadow-lg border border-white/10 whitespace-nowrap">
        Chat with us on WhatsApp
    </span>
    
    <a href="https://wa.me/{{ $cleanFooterWa }}?text={{ urlencode('Hello Classio! I would like to inquire about your collections.') }}" 
       target="_blank" 
       rel="noopener noreferrer" 
       class="relative w-12 h-12 sm:w-14 sm:h-14 rounded-full bg-[#25D366] hover:bg-[#20ba59] text-white flex items-center justify-center shadow-[0_4px_16px_rgba(0,0,0,0.3)] hover:shadow-[0_6px_24px_rgba(37,211,102,0.6)] hover:scale-105 active:scale-95 transition-all duration-300 focus:outline-none" 
       aria-label="Chat on WhatsApp"
       title="Chat with Classio on WhatsApp">
        <!-- Official WhatsApp Icon -->
        <svg class="w-7 h-7 sm:w-8 sm:h-8 fill-white drop-shadow-sm pointer-events-none" viewBox="0 0 32 32">
            <path fill-rule="evenodd" clip-rule="evenodd" d="M16 2C8.268 2 2 8.268 2 16C2 18.67 2.75 21.17 4.05 23.31L2.24 29.84L8.98 28.09C11.05 29.32 13.44 30 16 30C23.732 30 30 23.732 30 16C30 8.268 23.732 2 16 2ZM16 27.65C13.75 27.65 11.66 27.02 9.87 25.92L9.45 25.66L5.34 26.73L6.44 22.72L6.16 22.28C4.98 20.4 4.35 18.25 4.35 16C4.35 9.57 9.57 4.35 16 4.35C22.43 4.35 27.65 9.57 27.65 16C27.65 22.43 22.43 27.65 16 27.65ZM22.42 19.34C22.07 19.16 20.35 18.32 20.03 18.2C19.71 18.08 19.48 18.02 19.25 18.38C19.01 18.73 18.33 19.54 18.12 19.78C17.92 20.01 17.71 20.04 17.36 19.86C17.01 19.68 15.88 19.31 14.54 18.11C13.5 17.18 12.8 16.03 12.59 15.68C12.38 15.33 12.57 15.14 12.74 14.96C12.9 14.8 13.1 14.54 13.27 14.34C13.45 14.14 13.51 13.99 13.63 13.76C13.75 13.53 13.69 13.32 13.6 13.15C13.51 12.97 12.8 11.23 12.51 10.53C12.23 9.85 11.93 9.94 11.73 9.93C11.53 9.92 11.3 9.92 11.06 9.92C10.83 9.92 10.45 10.01 10.13 10.36C9.81 10.71 8.9 11.56 8.9 13.29C8.9 15.02 10.16 16.69 10.34 16.92C10.51 17.15 12.81 20.68 16.32 22.2C17.15 22.56 17.8 22.78 18.31 22.94C19.15 23.21 19.91 23.17 20.52 23.08C21.2 22.98 22.61 22.22 22.9 21.4C23.2 20.57 23.2 19.87 23.11 19.72C23.02 19.58 22.77 19.52 22.42 19.34Z"/>
        </svg>
    </a>
</div>
