<x-layout.app :categories="$categories">
    <div class="bg-[#FAF9F6] min-h-screen py-10 sm:py-16 select-none">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <!-- Breadcrumbs -->
            <nav class="flex text-xs font-sans text-gray-500 uppercase tracking-widest mb-8" aria-label="Breadcrumb">
                <ol class="inline-flex items-center space-x-2">
                    <li><a href="{{ route('home') }}" class="hover:text-[#0B1A2C] transition-colors">Home</a></li>
                    <li>/</li>
                    <li class="text-[#0B1A2C] font-semibold">Terms & Conditions</li>
                </ol>
            </nav>

            <!-- Page Title -->
            <div class="text-center max-w-2xl mx-auto mb-10 sm:mb-12">
                <span class="text-[10px] sm:text-xs font-bold uppercase tracking-[0.25em] text-[#8C6D46] bg-[#FAF0E6] px-3.5 py-1 rounded-full border border-[#D8C3A5]/40 inline-block mb-3">
                    Legal & Operational Framework
                </span>
                <h1 class="font-serif text-3xl sm:text-4xl font-bold text-[#0B1A2C] tracking-tight mb-3">
                    Terms & Conditions of Service
                </h1>
                <p class="font-sans text-xs sm:text-sm text-gray-600 leading-relaxed">
                    Please review the terms governing your access to and purchases from the Classio digital salon and boutiques.
                </p>
            </div>

            <!-- Content Card -->
            <div class="bg-white rounded-3xl p-6 sm:p-10 shadow-[0_4px_25px_rgba(11,26,44,0.06)] border border-gray-100 space-y-8 text-xs sm:text-sm text-gray-700 leading-relaxed">
                
                <section>
                    <h2 class="font-serif text-lg sm:text-xl font-bold text-[#0B1A2C] mb-2">1. Acceptance of Terms</h2>
                    <p class="text-gray-600">
                        By visiting, registering an account with, or purchasing from Classio Fashion, you agree to be bound by these Terms & Conditions and our accompanying Policies. If you do not agree, you may refrain from accessing the service.
                    </p>
                </section>

                <section>
                    <h2 class="font-serif text-lg sm:text-xl font-bold text-[#0B1A2C] mb-2">2. Pricing, Invoicing & Taxes</h2>
                    <p class="text-gray-600 mb-2">
                        All prices listed on Classio are in Indian Rupees (INR) and inclusive of all applicable Goods and Services Tax (GST).
                    </p>
                    <p class="text-gray-600">
                        While we strive for precision in all catalog listings, Classio reserves the right to cancel orders arising from demonstrable typographical or algorithmic pricing errors prior to dispatch.
                    </p>
                </section>

                <section>
                    <h2 class="font-serif text-lg sm:text-xl font-bold text-[#0B1A2C] mb-2">3. Product Descriptions & Photography</h2>
                    <p class="text-gray-600">
                        We capture our timepieces and garments with high-fidelity studio lighting to represent actual tones, finishes, and textures faithfully. Slight variations in fabric hue or watch dial luster may occur depending on individual monitor calibrations.
                    </p>
                </section>

                <section>
                    <h2 class="font-serif text-lg sm:text-xl font-bold text-[#0B1A2C] mb-2">4. Horology Warranty Terms</h2>
                    <p class="text-gray-600 mb-2">
                        Classio guarantees timepiece mechanical and quartz movement functionality for a period of 1 Year from purchase date.
                    </p>
                    <p class="text-gray-600">
                        Warranty does not cover normal wear-and-tear of straps, accidental crystal fractures, moisture intrusion resulting from operating watch crowns underwater, or unauthorized servicing by third-party jewelers.
                    </p>
                </section>

                <section>
                    <h2 class="font-serif text-lg sm:text-xl font-bold text-[#0B1A2C] mb-2">5. Intellectual Property</h2>
                    <p class="text-gray-600">
                        All brand marks, logos, website layout assets, text, photography, and digital graphics are proprietary property of Classio Fashion. Unauthorized commercial replication or scraping is strictly prohibited.
                    </p>
                </section>

                <section>
                    <h2 class="font-serif text-lg sm:text-xl font-bold text-[#0B1A2C] mb-2">6. Jurisdiction & Disputes</h2>
                    <p class="text-gray-600">
                        These Terms and any dispute arising from consumer transactions shall be governed by and construed in accordance with the laws of India, subject to the exclusive jurisdiction of the competent courts of <strong>Patna, Bihar</strong>.
                    </p>
                </section>

            </div>

        </div>
    </div>
</x-layout.app>
