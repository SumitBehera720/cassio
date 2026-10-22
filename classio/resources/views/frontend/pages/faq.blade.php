<x-layout.app :categories="$categories">
    <div class="bg-[#FAF9F6] min-h-screen py-10 sm:py-16 select-none" x-data="{ openFaq: 1 }">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <!-- Breadcrumbs -->
            <nav class="flex text-xs font-sans text-gray-500 uppercase tracking-widest mb-8" aria-label="Breadcrumb">
                <ol class="inline-flex items-center space-x-2">
                    <li><a href="{{ route('home') }}" class="hover:text-[#0B1A2C] transition-colors">Home</a></li>
                    <li>/</li>
                    <li class="text-[#0B1A2C] font-semibold">Frequently Asked Questions</li>
                </ol>
            </nav>

            <!-- Page Title -->
            <div class="text-center max-w-2xl mx-auto mb-10 sm:mb-14">
                <span class="text-[10px] sm:text-xs font-bold uppercase tracking-[0.25em] text-[#8C6D46] bg-[#FAF0E6] px-3.5 py-1 rounded-full border border-[#D8C3A5]/40 inline-block mb-3">
                    Help & Clarity
                </span>
                <h1 class="font-serif text-3xl sm:text-4xl font-bold text-[#0B1A2C] tracking-tight mb-3">
                    Frequently Asked Questions
                </h1>
                <p class="font-sans text-xs sm:text-sm text-gray-600 leading-relaxed">
                    Find comprehensive answers regarding horology authenticity, shipping, sizing, payments, and our seamless return process.
                </p>
            </div>

            <!-- FAQs Accordion List -->
            @php
                $faqs = [
                    [
                        'id' => 1,
                        'category' => 'Horology & Authenticity',
                        'q' => 'Are Classio watches genuine and authentic?',
                        'a' => 'Yes, 100% unconditionally. All timepieces in our collection—including Fossil Automatic Skeleton, Rado Automatic Skeleton, Tissot 1853 Chronograph, and Tommy Hilfiger Lorenzo—feature authentic mechanical and quartz calibers, scratch-resistant sapphire or hardened mineral crystals, and come with manufacturer presentation packaging, serial tags, and official Classio Authenticity Cards.'
                    ],
                    [
                        'id' => 2,
                        'category' => 'Horology & Authenticity',
                        'q' => 'What warranty coverage is included with timepieces?',
                        'a' => 'Every luxury watch purchased from Classio includes a 1-Year Comprehensive Movement Warranty covering manufacturing defects and internal caliber precision. Our horology service desk in Patna also assists with battery replacements, link adjustments, and routine care.'
                    ],
                    [
                        'id' => 3,
                        'category' => 'Shipping & Delivery',
                        'q' => 'How long does domestic delivery take?',
                        'a' => 'Orders are processed and dispatched from our Patna fulfillment center within 24–48 business hours. Express courier deliveries to metro cities (Delhi, Mumbai, Bengaluru, Kolkata, Patna) typically arrive within 2–4 days. Other regions in India arrive within 4–6 business days.'
                    ],
                    [
                        'id' => 4,
                        'category' => 'Shipping & Delivery',
                        'q' => 'How is my luxury purchase packaged?',
                        'a' => 'Every order is packed in a heavy-duty tamper-evident outer box with foam shock padding and sealed with security tape to guarantee complete protection and privacy during transit.'
                    ],
                    [
                        'id' => 5,
                        'category' => 'Returns & Exchanges',
                        'q' => 'What is your return & exchange policy?',
                        'a' => 'We offer a 7-Day Hassle-Free Doorstep Return & Exchange Policy. If you are not satisfied with size, fit, or finish, simply notify us within 7 days of delivery. Our courier partners will pick up the item from your doorstep at zero reverse shipping cost.'
                    ],
                    [
                        'id' => 6,
                        'category' => 'Returns & Exchanges',
                        'q' => 'How soon will I receive my refund after a return?',
                        'a' => 'Once the returned item is inspected at our salon, refunds are processed back to your original payment method (UPI, credit/debit card, or bank account) within 24 to 48 business hours.'
                    ],
                    [
                        'id' => 7,
                        'category' => 'Orders & Payments',
                        'q' => 'What payment options do you support?',
                        'a' => 'We accept all major payment methods through encrypted SSL gateways: UPI (Google Pay, PhonePe, Paytm), Credit & Debit Cards (Visa, MasterCard, RuPay), Net Banking across 50+ Indian banks, and Cash on Delivery (COD) on eligible pin codes.'
                    ],
                    [
                        'id' => 8,
                        'category' => 'Boutique & Stores',
                        'q' => 'Can I pick up or exchange my online order in-store?',
                        'a' => 'Yes. Customers in or visiting Patna can visit our flagship salon on Exhibition Road to try on products, adjust timepiece straps, or complete hassle-free in-person exchanges.'
                    ],
                ];
            @endphp

            <div class="space-y-4 mb-12">
                @foreach($faqs as $item)
                    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden transition-all">
                        <button type="button" 
                                @click="openFaq = (openFaq === {{ $item['id'] }} ? 0 : {{ $item['id'] }})"
                                class="w-full px-6 py-4.5 text-left flex items-center justify-between gap-4 focus:outline-none">
                            <div>
                                <span class="text-[9.5px] uppercase font-bold tracking-wider text-[#8C6D46] block mb-1">
                                    {{ $item['category'] }}
                                </span>
                                <span class="font-serif text-sm sm:text-base font-bold text-[#0B1A2C]">
                                    {{ $item['q'] }}
                                </span>
                            </div>
                            <div class="w-7 h-7 rounded-full bg-[#FAF9F6] border border-gray-200 flex items-center justify-center text-gray-500 flex-shrink-0 transition-transform duration-200"
                                 :class="openFaq === {{ $item['id'] }} ? 'rotate-180 bg-[#0B1A2C] text-white border-transparent' : ''">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                            </div>
                        </button>
                        <div x-show="openFaq === {{ $item['id'] }}" 
                             x-transition:enter="transition ease-out duration-200"
                             x-transition:enter-start="opacity-0 -translate-y-1"
                             x-transition:enter-end="opacity-100 translate-y-0"
                             class="px-6 pb-5 text-xs text-gray-600 leading-relaxed border-t border-gray-50 pt-3">
                            {{ $item['a'] }}
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Still have questions footer card -->
            <div class="bg-[#0B1A2C] rounded-3xl p-6 sm:p-8 text-center text-white shadow-xl">
                <h3 class="font-serif text-lg sm:text-xl font-bold text-[#D8C3A5] mb-2">Still Have Questions?</h3>
                <p class="text-xs text-gray-300 max-w-md mx-auto mb-5 leading-relaxed">
                    Our luxury client advisors are available via live chat, telephone, or email to assist you with any requirement.
                </p>
                <div class="flex flex-wrap justify-center gap-3">
                    <a href="https://wa.me/911234567890" target="_blank" rel="noopener noreferrer" class="px-5 py-2.5 rounded-full bg-[#25D366] hover:bg-[#20ba59] text-white text-xs font-bold transition-colors">
                        Chat on WhatsApp &rarr;
                    </a>
                    <a href="{{ route('contact') }}" class="px-5 py-2.5 rounded-full border border-white/30 hover:border-white text-white text-xs font-bold transition-colors">
                        Contact Concierge
                    </a>
                </div>
            </div>

        </div>
    </div>
</x-layout.app>
