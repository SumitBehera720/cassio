<x-layout.app :categories="$categories">
    <div class="bg-[#FAF9F6] min-h-screen py-10 sm:py-16 select-none">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <!-- Breadcrumbs -->
            <nav class="flex text-xs font-sans text-gray-500 uppercase tracking-widest mb-8" aria-label="Breadcrumb">
                <ol class="inline-flex items-center space-x-2">
                    <li><a href="{{ route('home') }}" class="hover:text-[#0B1A2C] transition-colors">Home</a></li>
                    <li>/</li>
                    <li class="text-[#0B1A2C] font-semibold">Return & Exchange Policy</li>
                </ol>
            </nav>

            <!-- Page Title -->
            <div class="text-center max-w-2xl mx-auto mb-10 sm:mb-12">
                <span class="text-[10px] sm:text-xs font-bold uppercase tracking-[0.25em] text-[#8C6D46] bg-[#FAF0E6] px-3.5 py-1 rounded-full border border-[#D8C3A5]/40 inline-block mb-3">
                    Customer Satisfaction Guarantee
                </span>
                <h1 class="font-serif text-3xl sm:text-4xl font-bold text-[#0B1A2C] tracking-tight mb-3">
                    7-Day Return & Exchange Policy
                </h1>
                <p class="font-sans text-xs sm:text-sm text-gray-600 leading-relaxed">
                    We want you to adore your Classio acquisitions. If sizing, fit, or expectation does not match, return or exchange with absolute ease.
                </p>
            </div>

            <!-- Content Card -->
            <div class="bg-white rounded-3xl p-6 sm:p-10 shadow-[0_4px_25px_rgba(11,26,44,0.06)] border border-gray-100 space-y-8 text-xs sm:text-sm text-gray-700 leading-relaxed">
                
                <section>
                    <h2 class="font-serif text-lg sm:text-xl font-bold text-[#0B1A2C] mb-2">1. 7-Day Window</h2>
                    <p class="text-gray-600">
                        You may initiate a return or exchange request within <strong>7 days from the delivery timestamp</strong> of your package.
                    </p>
                </section>

                <section>
                    <h2 class="font-serif text-lg sm:text-xl font-bold text-[#0B1A2C] mb-2">2. Condition Guidelines for Returns</h2>
                    <p class="text-gray-600 mb-3">
                        To maintain pristine luxury standards for our community, items returned must comply with the following criteria:
                    </p>
                    <ul class="list-disc list-inside space-y-2 text-gray-600 pl-2">
                        <li><strong>Apparel & Footwear:</strong> Unworn, unwashed, free of stains or fragrance, with all original brand tags, security labels, and dust bags intact.</li>
                        <li><strong>Watches & Horology:</strong> Unworn, protective bezel and caseback plastic films untampered, original manufacturer presentation box, manual, and warranty certificates included.</li>
                        <li><strong>Perfumes & Fragrances:</strong> Unopened and sealed in the original cellophane wrapping due to hygiene and authenticity protocols.</li>
                    </ul>
                </section>

                <section>
                    <h2 class="font-serif text-lg sm:text-xl font-bold text-[#0B1A2C] mb-2">3. Zero-Cost Reverse Pickup</h2>
                    <p class="text-gray-600">
                        Classio organizes doorstep courier pickup from your delivery address at <strong>zero additional reverse freight charge</strong>. Our courier will inspect the package seal and issue an acknowledgment receipt.
                    </p>
                </section>

                <section>
                    <h2 class="font-serif text-lg sm:text-xl font-bold text-[#0B1A2C] mb-2">4. Rapid Refund Settlement</h2>
                    <p class="text-gray-600 mb-2">
                        Upon receiving the returned item at our Patna facility, our quality team conducts inspection within 24 hours.
                    </p>
                    <p class="text-gray-600">
                        Approved refunds are remitted to your original source of payment (UPI, Credit/Debit card, or Net Banking) within <strong>24 to 48 business hours</strong>. Cash on Delivery refunds are credited directly to your provided bank account or UPI ID.
                    </p>
                </section>

                <section>
                    <h2 class="font-serif text-lg sm:text-xl font-bold text-[#0B1A2C] mb-2">5. How to Initiate a Return or Exchange</h2>
                    <p class="text-gray-600 mb-4">
                        You can initiate a return or exchange in under 60 seconds through any of the following channels:
                    </p>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div class="p-4 rounded-xl bg-gray-50 border border-gray-100">
                            <strong class="font-serif text-gray-900 block mb-1">Direct WhatsApp Concierge</strong>
                            <p class="text-xs text-gray-500 mb-2">Share Order ID and item photo for instant return authorization.</p>
                            <a href="https://wa.me/911234567890" target="_blank" rel="noopener noreferrer" class="text-xs text-emerald-700 font-bold hover:underline">Chat on WhatsApp &rarr;</a>
                        </div>
                        <div class="p-4 rounded-xl bg-gray-50 border border-gray-100">
                            <strong class="font-serif text-gray-900 block mb-1">Online Support Ticket</strong>
                            <p class="text-xs text-gray-500 mb-2">Submit an exchange ticket through our client care desk.</p>
                            <a href="{{ route('contact') }}" class="text-xs text-[#0B1A2C] font-bold hover:underline">Submit Ticket &rarr;</a>
                        </div>
                    </div>
                </section>

            </div>

        </div>
    </div>
</x-layout.app>
