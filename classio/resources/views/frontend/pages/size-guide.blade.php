<x-layout.app :categories="$categories">
    <div class="bg-[#FAF9F6] min-h-screen py-10 sm:py-16 select-none" x-data="{ activeTab: 'watches' }">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <!-- Breadcrumbs -->
            <nav class="flex text-xs font-sans text-gray-500 uppercase tracking-widest mb-8" aria-label="Breadcrumb">
                <ol class="inline-flex items-center space-x-2">
                    <li><a href="{{ route('home') }}" class="hover:text-[#0B1A2C] transition-colors">Home</a></li>
                    <li>/</li>
                    <li class="text-[#0B1A2C] font-semibold">Luxury Size Guide</li>
                </ol>
            </nav>

            <!-- Page Title -->
            <div class="text-center max-w-2xl mx-auto mb-10 sm:mb-12">
                <span class="text-[10px] sm:text-xs font-bold uppercase tracking-[0.25em] text-[#8C6D46] bg-[#FAF0E6] px-3.5 py-1 rounded-full border border-[#D8C3A5]/40 inline-block mb-3">
                    Precision Sizing & Fit
                </span>
                <h1 class="font-serif text-3xl sm:text-4xl font-bold text-[#0B1A2C] tracking-tight mb-3">
                    Classio Luxury Size Guide
                </h1>
                <p class="font-sans text-xs sm:text-sm text-gray-600 leading-relaxed">
                    Refer to our certified sizing charts to ensure an impeccable fit for timepieces, tailoring, ethnic silhouettes, and footwear.
                </p>
            </div>

            <!-- Tab Switcher -->
            <div class="flex flex-wrap items-center justify-center gap-2 mb-8">
                <button type="button" 
                        @click="activeTab = 'watches'" 
                        :class="activeTab === 'watches' ? 'bg-[#0B1A2C] text-white font-bold shadow' : 'bg-white text-gray-700 hover:bg-gray-100 font-medium'"
                        class="px-5 py-2.5 rounded-full text-xs uppercase tracking-wider transition-all duration-200 border border-gray-200">
                    Luxury Watches
                </button>
                <button type="button" 
                        @click="activeTab = 'mens'" 
                        :class="activeTab === 'mens' ? 'bg-[#0B1A2C] text-white font-bold shadow' : 'bg-white text-gray-700 hover:bg-gray-100 font-medium'"
                        class="px-5 py-2.5 rounded-full text-xs uppercase tracking-wider transition-all duration-200 border border-gray-200">
                    Men's Apparel
                </button>
                <button type="button" 
                        @click="activeTab = 'womens'" 
                        :class="activeTab === 'womens' ? 'bg-[#0B1A2C] text-white font-bold shadow' : 'bg-white text-gray-700 hover:bg-gray-100 font-medium'"
                        class="px-5 py-2.5 rounded-full text-xs uppercase tracking-wider transition-all duration-200 border border-gray-200">
                    Women's Apparel
                </button>
                <button type="button" 
                        @click="activeTab = 'shoes'" 
                        :class="activeTab === 'shoes' ? 'bg-[#0B1A2C] text-white font-bold shadow' : 'bg-white text-gray-700 hover:bg-gray-100 font-medium'"
                        class="px-5 py-2.5 rounded-full text-xs uppercase tracking-wider transition-all duration-200 border border-gray-200">
                    Footwear
                </button>
            </div>

            <!-- 1. WATCH SIZING TAB -->
            <div x-show="activeTab === 'watches'" x-transition:enter="transition ease-out duration-200" class="space-y-6">
                <div class="bg-white rounded-3xl p-6 sm:p-10 shadow-[0_4px_25px_rgba(11,26,44,0.06)] border border-gray-100">
                    <h2 class="font-serif text-xl sm:text-2xl font-bold text-[#0B1A2C] mb-2">Watch Case Diameter Guide</h2>
                    <p class="text-xs text-gray-500 mb-6">
                        Choosing the right case diameter ensures optimal wrist presence, comfort, and balance.
                    </p>

                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-8">
                        <div class="p-4 rounded-2xl bg-gray-50 border border-gray-100 text-center">
                            <span class="font-serif text-2xl font-bold text-[#0B1A2C] block mb-1">36 – 38mm</span>
                            <strong class="text-xs text-gray-900 block">Classic / Dress Profile</strong>
                            <p class="text-[11px] text-gray-500 mt-1">Ideal for wrist circumferences of 5.5" – 6.5". Timeless understated profile under French cuffs.</p>
                        </div>
                        <div class="p-4 rounded-2xl bg-gray-50 border border-gray-100 text-center">
                            <span class="font-serif text-2xl font-bold text-[#0B1A2C] block mb-1">40 – 41mm</span>
                            <strong class="text-xs text-gray-900 block">Universal Versatile</strong>
                            <p class="text-[11px] text-gray-500 mt-1">Fits 90% of wrists (6.0" – 7.2"). The gold standard for modern luxury horology.</p>
                        </div>
                        <div class="p-4 rounded-2xl bg-[#0B1A2C] text-white rounded-2xl p-4 text-center shadow">
                            <span class="font-serif text-2xl font-bold text-[#D8C3A5] block mb-1">42 – 43mm</span>
                            <strong class="text-xs text-white block">Mechanical Skeleton</strong>
                            <p class="text-[11px] text-gray-300 mt-1">Our signature skeleton and chronograph case size. Perfect wrist presence for 6.5" – 7.8" wrists.</p>
                        </div>
                        <div class="p-4 rounded-2xl bg-gray-50 border border-gray-100 text-center">
                            <span class="font-serif text-2xl font-bold text-[#0B1A2C] block mb-1">44 – 45mm</span>
                            <strong class="text-xs text-gray-900 block">Bold Statement</strong>
                            <p class="text-[11px] text-gray-500 mt-1">Designed for athletic or broader wrists (7.0"+) desiring commanding visual authority.</p>
                        </div>
                    </div>

                    <div class="border-t border-gray-100 pt-6">
                        <h3 class="font-serif text-sm font-bold text-[#0B1A2C] mb-2">Bracelet Link & Strap Adjustments</h3>
                        <p class="text-xs text-gray-600 leading-relaxed">
                            All Classio stainless steel bracelet timepieces feature removable links with push-pin assemblies. A complimentary link adjustment tool is included with select automatic collections, or you may bring your watch to our Patna boutique for instant professional resizing.
                        </p>
                    </div>
                </div>
            </div>

            <!-- 2. MEN'S APPAREL TAB -->
            <div x-show="activeTab === 'mens'" x-transition:enter="transition ease-out duration-200" style="display: none;">
                <div class="bg-white rounded-3xl p-6 sm:p-10 shadow-[0_4px_25px_rgba(11,26,44,0.06)] border border-gray-100">
                    <h2 class="font-serif text-xl sm:text-2xl font-bold text-[#0B1A2C] mb-2">Men's Shirts, Blazers & Chinos (Inches)</h2>
                    <p class="text-xs text-gray-500 mb-6">Measurements correspond to bodily dimensions. For relaxed silhouettes, choose one size higher.</p>

                    <div class="overflow-x-auto">
                        <table class="w-full text-left border border-gray-100 rounded-xl overflow-hidden text-xs">
                            <thead class="bg-[#0B1A2C] text-[#D8C3A5]">
                                <tr>
                                    <th class="p-3">Size Tag</th>
                                    <th class="p-3">Chest (Inches)</th>
                                    <th class="p-3">Waist (Inches)</th>
                                    <th class="p-3">Shoulder (Inches)</th>
                                    <th class="p-3">Length (Inches)</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100">
                                <tr>
                                    <td class="p-3 font-bold text-gray-900">S (Small - 38)</td>
                                    <td class="p-3 text-gray-600">38 – 39"</td>
                                    <td class="p-3 text-gray-600">30 – 32"</td>
                                    <td class="p-3 text-gray-600">17.0"</td>
                                    <td class="p-3 text-gray-600">28.5"</td>
                                </tr>
                                <tr class="bg-gray-50/50">
                                    <td class="p-3 font-bold text-gray-900">M (Medium - 40)</td>
                                    <td class="p-3 text-gray-600">40 – 41"</td>
                                    <td class="p-3 text-gray-600">32 – 34"</td>
                                    <td class="p-3 text-gray-600">17.5"</td>
                                    <td class="p-3 text-gray-600">29.0"</td>
                                </tr>
                                <tr>
                                    <td class="p-3 font-bold text-gray-900">L (Large - 42)</td>
                                    <td class="p-3 text-gray-600">42 – 43"</td>
                                    <td class="p-3 text-gray-600">34 – 36"</td>
                                    <td class="p-3 text-gray-600">18.2"</td>
                                    <td class="p-3 text-gray-600">29.5"</td>
                                </tr>
                                <tr class="bg-gray-50/50">
                                    <td class="p-3 font-bold text-gray-900">XL (Extra Large - 44)</td>
                                    <td class="p-3 text-gray-600">44 – 45"</td>
                                    <td class="p-3 text-gray-600">36 – 38"</td>
                                    <td class="p-3 text-gray-600">19.0"</td>
                                    <td class="p-3 text-gray-600">30.0"</td>
                                </tr>
                                <tr>
                                    <td class="p-3 font-bold text-gray-900">XXL (Double XL - 46)</td>
                                    <td class="p-3 text-gray-600">46 – 47"</td>
                                    <td class="p-3 text-gray-600">38 – 40"</td>
                                    <td class="p-3 text-gray-600">19.8"</td>
                                    <td class="p-3 text-gray-600">30.5"</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- 3. WOMEN'S APPAREL TAB -->
            <div x-show="activeTab === 'womens'" x-transition:enter="transition ease-out duration-200" style="display: none;">
                <div class="bg-white rounded-3xl p-6 sm:p-10 shadow-[0_4px_25px_rgba(11,26,44,0.06)] border border-gray-100">
                    <h2 class="font-serif text-xl sm:text-2xl font-bold text-[#0B1A2C] mb-2">Women's Kurtis, Dresses & Tops (Inches)</h2>
                    <p class="text-xs text-gray-500 mb-6">Designed to drape gracefully with comfortable ease allowances.</p>

                    <div class="overflow-x-auto">
                        <table class="w-full text-left border border-gray-100 rounded-xl overflow-hidden text-xs">
                            <thead class="bg-[#0B1A2C] text-[#D8C3A5]">
                                <tr>
                                    <th class="p-3">Size Tag</th>
                                    <th class="p-3">Bust (Inches)</th>
                                    <th class="p-3">Waist (Inches)</th>
                                    <th class="p-3">Hip (Inches)</th>
                                    <th class="p-3">Kurti Length (Inches)</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100">
                                <tr>
                                    <td class="p-3 font-bold text-gray-900">XS (34)</td>
                                    <td class="p-3 text-gray-600">34"</td>
                                    <td class="p-3 text-gray-600">28"</td>
                                    <td class="p-3 text-gray-600">36"</td>
                                    <td class="p-3 text-gray-600">42"</td>
                                </tr>
                                <tr class="bg-gray-50/50">
                                    <td class="p-3 font-bold text-gray-900">S (36)</td>
                                    <td class="p-3 text-gray-600">36"</td>
                                    <td class="p-3 text-gray-600">30"</td>
                                    <td class="p-3 text-gray-600">38"</td>
                                    <td class="p-3 text-gray-600">43"</td>
                                </tr>
                                <tr>
                                    <td class="p-3 font-bold text-gray-900">M (38)</td>
                                    <td class="p-3 text-gray-600">38"</td>
                                    <td class="p-3 text-gray-600">32"</td>
                                    <td class="p-3 text-gray-600">40"</td>
                                    <td class="p-3 text-gray-600">44"</td>
                                </tr>
                                <tr class="bg-gray-50/50">
                                    <td class="p-3 font-bold text-gray-900">L (40)</td>
                                    <td class="p-3 text-gray-600">40"</td>
                                    <td class="p-3 text-gray-600">34"</td>
                                    <td class="p-3 text-gray-600">42"</td>
                                    <td class="p-3 text-gray-600">44"</td>
                                </tr>
                                <tr>
                                    <td class="p-3 font-bold text-gray-900">XL (42)</td>
                                    <td class="p-3 text-gray-600">42"</td>
                                    <td class="p-3 text-gray-600">36"</td>
                                    <td class="p-3 text-gray-600">44"</td>
                                    <td class="p-3 text-gray-600">45"</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- 4. FOOTWEAR TAB -->
            <div x-show="activeTab === 'shoes'" x-transition:enter="transition ease-out duration-200" style="display: none;">
                <div class="bg-white rounded-3xl p-6 sm:p-10 shadow-[0_4px_25px_rgba(11,26,44,0.06)] border border-gray-100">
                    <h2 class="font-serif text-xl sm:text-2xl font-bold text-[#0B1A2C] mb-2">Luxury Footwear Conversion Chart</h2>
                    <p class="text-xs text-gray-500 mb-6">Standard UK / Indian shoe sizes mapped against European and US benchmarks.</p>

                    <div class="overflow-x-auto">
                        <table class="w-full text-left border border-gray-100 rounded-xl overflow-hidden text-xs">
                            <thead class="bg-[#0B1A2C] text-[#D8C3A5]">
                                <tr>
                                    <th class="p-3">UK / India Size</th>
                                    <th class="p-3">EU Size</th>
                                    <th class="p-3">US Size</th>
                                    <th class="p-3">Foot Length (CM)</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100">
                                <tr>
                                    <td class="p-3 font-bold text-gray-900">UK 6</td>
                                    <td class="p-3 text-gray-600">40</td>
                                    <td class="p-3 text-gray-600">7.0</td>
                                    <td class="p-3 text-gray-600">25.0 cm</td>
                                </tr>
                                <tr class="bg-gray-50/50">
                                    <td class="p-3 font-bold text-gray-900">UK 7</td>
                                    <td class="p-3 text-gray-600">41</td>
                                    <td class="p-3 text-gray-600">8.0</td>
                                    <td class="p-3 text-gray-600">25.8 cm</td>
                                </tr>
                                <tr>
                                    <td class="p-3 font-bold text-gray-900">UK 8</td>
                                    <td class="p-3 text-gray-600">42</td>
                                    <td class="p-3 text-gray-600">9.0</td>
                                    <td class="p-3 text-gray-600">26.7 cm</td>
                                </tr>
                                <tr class="bg-gray-50/50">
                                    <td class="p-3 font-bold text-gray-900">UK 9</td>
                                    <td class="p-3 text-gray-600">43</td>
                                    <td class="p-3 text-gray-600">10.0</td>
                                    <td class="p-3 text-gray-600">27.5 cm</td>
                                </tr>
                                <tr>
                                    <td class="p-3 font-bold text-gray-900">UK 10</td>
                                    <td class="p-3 text-gray-600">44</td>
                                    <td class="p-3 text-gray-600">11.0</td>
                                    <td class="p-3 text-gray-600">28.3 cm</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Need Sizing Guidance Card -->
            <div class="mt-8 bg-white rounded-2xl p-6 border border-gray-100 shadow-sm flex flex-col sm:flex-row items-center justify-between gap-4 text-xs">
                <div>
                    <h3 class="font-serif text-sm font-bold text-[#0B1A2C]">Still unsure about your exact fit?</h3>
                    <p class="text-gray-500 text-[11px] mt-0.5">Send your wrist or body measurements to our stylist on WhatsApp for personalized recommendations.</p>
                </div>
                <a href="https://wa.me/911234567890" target="_blank" rel="noopener noreferrer" class="px-5 py-2.5 rounded-full bg-[#25D366] text-white font-bold hover:bg-[#20ba59] transition-colors flex-shrink-0">
                    Ask a Stylist on WhatsApp &rarr;
                </a>
            </div>

        </div>
    </div>
</x-layout.app>
