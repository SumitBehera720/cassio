<x-layout.app :categories="$categories">
    <div class="bg-[#FAF9F6] min-h-screen py-10 sm:py-16 select-none">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <!-- Breadcrumbs -->
            <nav class="flex text-xs font-sans text-gray-500 uppercase tracking-widest mb-8" aria-label="Breadcrumb">
                <ol class="inline-flex items-center space-x-2">
                    <li><a href="{{ route('home') }}" class="hover:text-[#0B1A2C] transition-colors">Home</a></li>
                    <li>/</li>
                    <li class="text-[#0B1A2C] font-semibold">Contact Us</li>
                </ol>
            </nav>

            <!-- Page Title -->
            <div class="text-center max-w-2xl mx-auto mb-10 sm:mb-14">
                <span class="text-[10px] sm:text-xs font-bold uppercase tracking-[0.25em] text-[#8C6D46] bg-[#FAF0E6] px-3.5 py-1 rounded-full border border-[#D8C3A5]/40 inline-block mb-3">
                    Concierge & Client Care
                </span>
                <h1 class="font-serif text-3xl sm:text-4xl font-bold text-[#0B1A2C] tracking-tight mb-3">
                    We Are At Your Service
                </h1>
                <p class="font-sans text-xs sm:text-sm text-gray-600 leading-relaxed">
                    Have an inquiry regarding luxury timepieces, sizing consultations, order tracking, or boutique appointments? Our team is available 24/7.
                </p>
            </div>

            <!-- Flash Success Message -->
            @if(session('success'))
                <div class="mb-8 p-4 rounded-2xl bg-emerald-50 border border-emerald-200 text-emerald-800 text-xs flex items-center gap-3 shadow-sm">
                    <svg class="w-5 h-5 text-emerald-600 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
                    <span>{{ session('success') }}</span>
                </div>
            @endif

            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
                <!-- Left: Boutique & Contact Info -->
                <div class="lg:col-span-5 space-y-6">
                    <div class="bg-[#0B1A2C] text-white rounded-3xl p-6 sm:p-8 shadow-xl border border-[#D8C3A5]/25">
                        <h2 class="font-serif text-xl font-bold text-[#D8C3A5] mb-4">Classio Flagship Boutique</h2>
                        
                        <div class="space-y-4 text-xs text-gray-300">
                            <div class="flex items-start gap-3">
                                <svg class="w-5 h-5 text-[#D8C3A5] flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                                <div>
                                    <strong class="text-white block text-sm">Exhibition Road Flagship</strong>
                                    Exhibition Road, Near Dak Bungalow Chowk, Patna, Bihar - 800001
                                </div>
                            </div>

                            <div class="flex items-center gap-3">
                                <svg class="w-5 h-5 text-[#D8C3A5] flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path></svg>
                                <div>
                                    <span class="block text-gray-400 text-[11px]">Phone Concierge</span>
                                    <a href="tel:+911234567890" class="text-white font-medium hover:text-[#D8C3A5]">+91 12345 67890</a>
                                </div>
                            </div>

                            <div class="flex items-center gap-3">
                                <svg class="w-5 h-5 text-[#D8C3A5] flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                                <div>
                                    <span class="block text-gray-400 text-[11px]">Direct Email</span>
                                    <a href="mailto:support@classiofashion.com" class="text-white font-medium hover:text-[#D8C3A5]">support@classiofashion.com</a>
                                </div>
                            </div>

                            <div class="flex items-center gap-3">
                                <svg class="w-5 h-5 text-[#D8C3A5] flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                <div>
                                    <span class="block text-gray-400 text-[11px]">Boutique Hours</span>
                                    <span class="text-white font-medium">Monday – Sunday: 10:30 AM – 9:30 PM</span>
                                </div>
                            </div>
                        </div>

                        <div class="mt-6 pt-5 border-t border-white/10 flex items-center justify-between">
                            <span class="text-[11px] text-gray-400">Prefer instant messaging?</span>
                            <a href="https://wa.me/911234567890" target="_blank" rel="noopener noreferrer" class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full bg-[#25D366] text-white text-[11px] font-bold hover:bg-[#20ba59] transition-colors">
                                WhatsApp Concierge &rarr;
                            </a>
                        </div>
                    </div>

                    <!-- Quick Support Links -->
                    <div class="bg-white rounded-2xl p-6 border border-gray-100 shadow-sm text-xs space-y-3">
                        <h3 class="font-serif text-sm font-bold text-[#0B1A2C]">Instant Assistance</h3>
                        <p class="text-gray-500 text-[11px]">Looking for answers right away? Check these resources:</p>
                        <div class="flex flex-col gap-2 font-medium">
                            <a href="{{ route('track-order') }}" class="text-[#0B1A2C] hover:text-[#8C6D46] flex items-center justify-between">
                                <span>Track An Existing Order</span> &rarr;
                            </a>
                            <a href="{{ route('faq') }}" class="text-[#0B1A2C] hover:text-[#8C6D46] flex items-center justify-between">
                                <span>Frequently Asked Questions</span> &rarr;
                            </a>
                            <a href="{{ route('return-policy') }}" class="text-[#0B1A2C] hover:text-[#8C6D46] flex items-center justify-between">
                                <span>Return & Exchange Guidelines</span> &rarr;
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Right: Contact Form -->
                <div class="lg:col-span-7 bg-white rounded-3xl p-6 sm:p-10 shadow-[0_4px_25px_rgba(11,26,44,0.06)] border border-gray-100">
                    <h2 class="font-serif text-xl sm:text-2xl font-bold text-[#0B1A2C] mb-2">Send Us A Message</h2>
                    <p class="font-sans text-xs text-gray-500 mb-6">
                        Complete the inquiry form below and a luxury client advisor will attend to your request.
                    </p>

                    <form action="{{ route('contact.submit') }}" method="POST" class="space-y-4">
                        @csrf
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div>
                                <label for="c_name" class="block text-xs font-semibold uppercase tracking-wider text-gray-700 mb-1.5">Full Name *</label>
                                <input type="text" id="c_name" name="name" required value="{{ old('name') }}" placeholder="Your name" class="w-full px-4 py-2.5 rounded-xl border border-gray-200 text-xs text-gray-900 focus:outline-none focus:ring-2 focus:ring-[#0B1A2C]">
                            </div>

                            <div>
                                <label for="c_email" class="block text-xs font-semibold uppercase tracking-wider text-gray-700 mb-1.5">Email Address *</label>
                                <input type="email" id="c_email" name="email" required value="{{ old('email') }}" placeholder="name@domain.com" class="w-full px-4 py-2.5 rounded-xl border border-gray-200 text-xs text-gray-900 focus:outline-none focus:ring-2 focus:ring-[#0B1A2C]">
                            </div>
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div>
                                <label for="c_phone" class="block text-xs font-semibold uppercase tracking-wider text-gray-700 mb-1.5">Phone Number (Optional)</label>
                                <input type="tel" id="c_phone" name="phone" value="{{ old('phone') }}" placeholder="+91 98765 43210" class="w-full px-4 py-2.5 rounded-xl border border-gray-200 text-xs text-gray-900 focus:outline-none focus:ring-2 focus:ring-[#0B1A2C]">
                            </div>

                            <div>
                                <label for="c_subject" class="block text-xs font-semibold uppercase tracking-wider text-gray-700 mb-1.5">Subject *</label>
                                <select id="c_subject" name="subject" required class="w-full px-4 py-2.5 rounded-xl border border-gray-200 text-xs text-gray-900 focus:outline-none focus:ring-2 focus:ring-[#0B1A2C]">
                                    <option value="Product Sizing & Inquiries">Product Sizing & Inquiries</option>
                                    <option value="Watch Authenticity & Warranty">Watch Authenticity & Warranty</option>
                                    <option value="Order Tracking & Shipping">Order Tracking & Shipping</option>
                                    <option value="Returns & Exchanges">Returns & Exchanges</option>
                                    <option value="Boutique VIP Appointment">Boutique VIP Appointment</option>
                                    <option value="Other Assistance">Other Assistance</option>
                                </select>
                            </div>
                        </div>

                        <div>
                            <label for="c_message" class="block text-xs font-semibold uppercase tracking-wider text-gray-700 mb-1.5">Message / Inquiry Details *</label>
                            <textarea id="c_message" name="message" rows="5" required placeholder="How may our luxury concierge assist you today?" class="w-full px-4 py-2.5 rounded-xl border border-gray-200 text-xs text-gray-900 focus:outline-none focus:ring-2 focus:ring-[#0B1A2C]"></textarea>
                        </div>

                        <button type="submit" class="w-full py-3 px-6 rounded-xl bg-[#0B1A2C] hover:bg-[#12243d] text-white text-xs font-bold uppercase tracking-wider transition-all duration-200 shadow-md hover:shadow-lg flex items-center justify-center gap-2">
                            <span>Submit Inquiry</span>
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                        </button>
                    </form>
                </div>
            </div>

        </div>
    </div>
</x-layout.app>
