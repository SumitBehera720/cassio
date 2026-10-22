<x-layout.app :categories="$categories">
    <div class="bg-[#FAF9F6] min-h-screen py-10 sm:py-16 select-none">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <!-- Breadcrumbs -->
            <nav class="flex text-xs font-sans text-gray-500 uppercase tracking-widest mb-8" aria-label="Breadcrumb">
                <ol class="inline-flex items-center space-x-2">
                    <li><a href="{{ route('home') }}" class="hover:text-[#0B1A2C] transition-colors">Home</a></li>
                    <li>/</li>
                    <li class="text-[#0B1A2C] font-semibold">Shipping Policy</li>
                </ol>
            </nav>

            <!-- Page Title -->
            <div class="text-center max-w-2xl mx-auto mb-10 sm:mb-12">
                <span class="text-[10px] sm:text-xs font-bold uppercase tracking-[0.25em] text-[#8C6D46] bg-[#FAF0E6] px-3.5 py-1 rounded-full border border-[#D8C3A5]/40 inline-block mb-3">
                    Logistics & Delivery Standards
                </span>
                <h1 class="font-serif text-3xl sm:text-4xl font-bold text-[#0B1A2C] tracking-tight mb-3">
                    Shipping & Transit Policy
                </h1>
                <p class="font-sans text-xs sm:text-sm text-gray-600 leading-relaxed">
                    Ensuring your handcrafted luxury apparel and precision horology reach you securely, promptly, and in pristine condition.
                </p>
            </div>

            <!-- Content Card -->
            <div class="bg-white rounded-3xl p-6 sm:p-10 shadow-[0_4px_25px_rgba(11,26,44,0.06)] border border-gray-100 space-y-8 text-xs sm:text-sm text-gray-700 leading-relaxed">
                
                <section>
                    <h2 class="font-serif text-lg sm:text-xl font-bold text-[#0B1A2C] mb-2">1. Dispatch Timelines</h2>
                    <p class="text-gray-600 mb-2">
                        All orders placed on Classio undergo a mandatory authenticity and quality inspection at our Patna fulfillment hub. Products in stock are dispatched within <strong>24 to 48 business hours</strong> following payment authorization.
                    </p>
                    <p class="text-gray-600">
                        Orders placed on weekends or national gazetted holidays are processed the subsequent business day.
                    </p>
                </section>

                <section>
                    <h2 class="font-serif text-lg sm:text-xl font-bold text-[#0B1A2C] mb-2">2. Estimated Delivery Windows</h2>
                    <div class="overflow-x-auto my-3">
                        <table class="w-full text-left border border-gray-100 rounded-xl overflow-hidden text-xs">
                            <thead class="bg-[#0B1A2C] text-[#D8C3A5]">
                                <tr>
                                    <th class="p-3 font-semibold">Region / Destination</th>
                                    <th class="p-3 font-semibold">Courier Partner</th>
                                    <th class="p-3 font-semibold">Transit Time</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100">
                                <tr>
                                    <td class="p-3 font-medium text-gray-900">Patna & Surrounding Bihar</td>
                                    <td class="p-3 text-gray-600">Classio Boutique Priority Courier</td>
                                    <td class="p-3 text-gray-900 font-semibold">1 – 2 Business Days</td>
                                </tr>
                                <tr>
                                    <td class="p-3 font-medium text-gray-900">Metros (Delhi, Mumbai, Bengaluru, Kolkata)</td>
                                    <td class="p-3 text-gray-600">BlueDart / Delhivery Air Express</td>
                                    <td class="p-3 text-gray-900 font-semibold">2 – 4 Business Days</td>
                                </tr>
                                <tr>
                                    <td class="p-3 font-medium text-gray-900">Rest of India</td>
                                    <td class="p-3 text-gray-600">Express Surface & Air Network</td>
                                    <td class="p-3 text-gray-900 font-semibold">4 – 6 Business Days</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </section>

                <section>
                    <h2 class="font-serif text-lg sm:text-xl font-bold text-[#0B1A2C] mb-2">3. Complimentary Shipping Threshold</h2>
                    <p class="text-gray-600">
                        Classio provides <strong>Complimentary Insured Shipping</strong> across India on all prepaid orders exceeding ₹999. Orders below this threshold incur a nominal standard courier fee of ₹99.
                    </p>
                </section>

                <section>
                    <h2 class="font-serif text-lg sm:text-xl font-bold text-[#0B1A2C] mb-2">4. Luxury Packaging & Transit Insurance</h2>
                    <p class="text-gray-600 mb-2">
                        Timepieces, perfumes, and apparel are encased in Classio luxury presentation cases and sealed in tamper-evident outer cartons with serial numbered security tape.
                    </p>
                    <p class="text-gray-600">
                        Every shipment is 100% transit-insured against accidental loss, damage, or courier theft until physical handover at your destination.
                    </p>
                </section>

                <section>
                    <h2 class="font-serif text-lg sm:text-xl font-bold text-[#0B1A2C] mb-2">5. Live Tracking & Handover Protocol</h2>
                    <p class="text-gray-600">
                        Once dispatched, an automated tracking notification with an active tracking AWB number is sent via SMS and Email. High-value timepiece deliveries require OTP authorization at the time of doorstep handover.
                    </p>
                </section>

            </div>

            <!-- Footer Assistance -->
            <div class="mt-8 text-center text-xs text-gray-500">
                Questions regarding shipment or custom address instructions? 
                <a href="{{ route('customer-service') }}" class="text-[#0B1A2C] font-semibold underline">Contact Classio Logistics Desk</a>
            </div>

        </div>
    </div>
</x-layout.app>
