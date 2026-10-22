<x-layout.app :categories="$categories">
    <div class="bg-[#FAF9F6] min-h-screen py-10 sm:py-16 select-none">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <!-- Breadcrumbs -->
            <nav class="flex text-xs font-sans text-gray-500 uppercase tracking-widest mb-8" aria-label="Breadcrumb">
                <ol class="inline-flex items-center space-x-2">
                    <li><a href="{{ route('home') }}" class="hover:text-[#0B1A2C] transition-colors">Home</a></li>
                    <li>/</li>
                    <li class="text-[#0B1A2C] font-semibold">Customer Service & Concierge</li>
                </ol>
            </nav>

            <!-- Page Title -->
            <div class="text-center max-w-2xl mx-auto mb-10 sm:mb-14">
                <span class="text-[10px] sm:text-xs font-bold uppercase tracking-[0.25em] text-[#8C6D46] bg-[#FAF0E6] px-3.5 py-1 rounded-full border border-[#D8C3A5]/40 inline-block mb-3">
                    Concierge Client Services
                </span>
                <h1 class="font-serif text-3xl sm:text-4xl font-bold text-[#0B1A2C] tracking-tight mb-3">
                    How May We Assist You?
                </h1>
                <p class="font-sans text-xs sm:text-sm text-gray-600 leading-relaxed">
                    Our dedicated client advisors are committed to delivering an exceptional luxury experience before, during, and after your purchase.
                </p>
            </div>

            <!-- 4 Quick Support Pillars -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 sm:gap-6 mb-12">
                <a href="{{ route('track-order') }}" class="bg-white rounded-2xl p-6 border border-gray-100 hover:border-[#D8C3A5] shadow-sm hover:shadow-md transition-all text-center group">
                    <div class="w-12 h-12 rounded-xl bg-[#FAF0E6] text-[#8C6D46] group-hover:bg-[#0B1A2C] group-hover:text-[#D8C3A5] mx-auto flex items-center justify-center mb-3 transition-colors">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M9 17a2 2 0 11-4 0 2 2 0 014 0zM19 17a2 2 0 11-4 0 2 2 0 014 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M13 16V6a1 1 0 00-1-1H4a1 1 0 00-1 1v10a1 1 0 001 1h1m8-1a1 1 0 01-1 1H9m4-1V8h4.586a1 1 0 01.707.293l3.414 3.414a1 1 0 01.293.707V16a1 1 0 01-1 1h-1m-6-1a1 1 0 001 1h2"/></svg>
                    </div>
                    <h3 class="font-serif text-sm font-bold text-[#0B1A2C]">Track Order</h3>
                    <p class="text-[11px] text-gray-500 mt-1">Real-time courier progress</p>
                </a>

                <a href="{{ route('return-policy') }}" class="bg-white rounded-2xl p-6 border border-gray-100 hover:border-[#D8C3A5] shadow-sm hover:shadow-md transition-all text-center group">
                    <div class="w-12 h-12 rounded-xl bg-[#FAF0E6] text-[#8C6D46] group-hover:bg-[#0B1A2C] group-hover:text-[#D8C3A5] mx-auto flex items-center justify-center mb-3 transition-colors">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/></svg>
                    </div>
                    <h3 class="font-serif text-sm font-bold text-[#0B1A2C]">Returns & Exchange</h3>
                    <p class="text-[11px] text-gray-500 mt-1">7-Day doorstep pickup</p>
                </a>

                <a href="{{ route('size-guide') }}" class="bg-white rounded-2xl p-6 border border-gray-100 hover:border-[#D8C3A5] shadow-sm hover:shadow-md transition-all text-center group">
                    <div class="w-12 h-12 rounded-xl bg-[#FAF0E6] text-[#8C6D46] group-hover:bg-[#0B1A2C] group-hover:text-[#D8C3A5] mx-auto flex items-center justify-center mb-3 transition-colors">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M4 6h16M4 12h16M4 18h7"/></svg>
                    </div>
                    <h3 class="font-serif text-sm font-bold text-[#0B1A2C]">Luxury Size Guide</h3>
                    <p class="text-[11px] text-gray-500 mt-1">Apparel & watch wrist sizing</p>
                </a>

                <a href="{{ route('faq') }}" class="bg-white rounded-2xl p-6 border border-gray-100 hover:border-[#D8C3A5] shadow-sm hover:shadow-md transition-all text-center group">
                    <div class="w-12 h-12 rounded-xl bg-[#FAF0E6] text-[#8C6D46] group-hover:bg-[#0B1A2C] group-hover:text-[#D8C3A5] mx-auto flex items-center justify-center mb-3 transition-colors">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    </div>
                    <h3 class="font-serif text-sm font-bold text-[#0B1A2C]">Instant FAQ</h3>
                    <p class="text-[11px] text-gray-500 mt-1">Answers to common queries</p>
                </a>
            </div>

            <!-- Direct Support Options -->
            <div class="bg-[#0B1A2C] rounded-3xl p-6 sm:p-10 text-white shadow-xl mb-12">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 text-center md:text-left">
                    <div class="flex flex-col items-center md:items-start">
                        <div class="w-10 h-10 rounded-full bg-[#D8C3A5] text-[#0B1A2C] flex items-center justify-center mb-3">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                        </div>
                        <h4 class="font-serif text-base font-bold text-[#D8C3A5]">Telephone Concierge</h4>
                        <p class="text-xs text-gray-300 mt-1">Direct priority client advisor line</p>
                        <a href="tel:+919576517660" class="text-sm font-bold text-white mt-2 hover:text-[#D8C3A5]">+91 95765 17660</a>
                    </div>

                    <div class="flex flex-col items-center md:items-start">
                        <div class="w-10 h-10 rounded-full bg-[#25D366] text-white flex items-center justify-center mb-3">
                            <svg class="w-5 h-5 fill-current" viewBox="0 0 24 24"><path d="M12.031 0C5.385 0 0 5.385 0 12.031c0 2.12.553 4.184 1.6 6L.515 24l6.115-1.603c1.745.955 3.738 1.458 5.401 1.458 6.646 0 12.031-5.385 12.031-12.031S18.677 0 12.031 0zm3.565 17.202c-.15.429-.861.815-1.2.86-.312.042-.718.118-2.072-.444-1.642-.683-2.695-2.355-2.775-2.463-.075-.107-.665-.884-.665-1.688s.416-1.192.56-1.353c.143-.161.312-.201.417-.201.104 0 .21.002.296.006.095.004.22-.036.335.241.12.285.405.992.44 1.064.036.075.06.161.008.267-.052.107-.078.174-.156.267-.078.095-.164.205-.233.285-.078.084-.162.176-.07.336.091.161.405.674.871 1.091.603.538 1.109.704 1.268.784.161.078.252.062.348-.046.094-.108.406-.474.516-.638.109-.161.218-.135.362-.08.143.052.909.43 1.064.507.156.078.26.118.298.183.037.062.037.37-.113.8z"/></svg>
                        </div>
                        <h4 class="font-serif text-base font-bold text-[#D8C3A5]">WhatsApp Live</h4>
                        <p class="text-xs text-gray-300 mt-1">Instant replies for styling & stock</p>
                        <a href="https://wa.me/919576517660" target="_blank" rel="noopener noreferrer" class="text-sm font-bold text-white mt-2 hover:text-[#25D366]">Chat on WhatsApp &rarr;</a>
                    </div>

                    <div class="flex flex-col items-center md:items-start">
                        <div class="w-10 h-10 rounded-full bg-[#D8C3A5] text-[#0B1A2C] flex items-center justify-center mb-3">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                        </div>
                        <h4 class="font-serif text-base font-bold text-[#D8C3A5]">Email Advisory</h4>
                        <p class="text-xs text-gray-300 mt-1">Detailed inquiries & order issues</p>
                        <a href="mailto:support@classio.com" class="text-sm font-bold text-white mt-2 hover:text-[#D8C3A5]">support@classio.com</a>
                    </div>
                </div>
            </div>

            <!-- Send a Message CTA Card -->
            <div class="bg-white rounded-3xl p-6 sm:p-8 border border-gray-100 shadow-sm flex flex-col sm:flex-row items-center justify-between gap-4">
                <div>
                    <h3 class="font-serif text-lg font-bold text-[#0B1A2C]">Looking for Bespoke Styling or Corporate Gifting?</h3>
                    <p class="text-xs text-gray-500 mt-0.5">Submit an inquiry form and our VIP team will reach out with a curated catalog.</p>
                </div>
                <a href="{{ route('contact') }}" class="px-6 py-2.5 rounded-full bg-[#0B1A2C] hover:bg-[#12243d] text-white text-xs font-bold uppercase tracking-wider transition-colors shadow flex-shrink-0">
                    Contact Us &rarr;
                </a>
            </div>

        </div>
    </div>
</x-layout.app>
