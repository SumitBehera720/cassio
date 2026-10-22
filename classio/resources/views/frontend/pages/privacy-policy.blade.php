<x-layout.app :categories="$categories">
    <div class="bg-[#FAF9F6] min-h-screen py-10 sm:py-16 select-none">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <!-- Breadcrumbs -->
            <nav class="flex text-xs font-sans text-gray-500 uppercase tracking-widest mb-8" aria-label="Breadcrumb">
                <ol class="inline-flex items-center space-x-2">
                    <li><a href="{{ route('home') }}" class="hover:text-[#0B1A2C] transition-colors">Home</a></li>
                    <li>/</li>
                    <li class="text-[#0B1A2C] font-semibold">Privacy Policy</li>
                </ol>
            </nav>

            <!-- Page Title -->
            <div class="text-center max-w-2xl mx-auto mb-10 sm:mb-12">
                <span class="text-[10px] sm:text-xs font-bold uppercase tracking-[0.25em] text-[#8C6D46] bg-[#FAF0E6] px-3.5 py-1 rounded-full border border-[#D8C3A5]/40 inline-block mb-3">
                    Data Security & Trust
                </span>
                <h1 class="font-serif text-3xl sm:text-4xl font-bold text-[#0B1A2C] tracking-tight mb-3">
                    Classio Privacy Policy
                </h1>
                <p class="font-sans text-xs sm:text-sm text-gray-600 leading-relaxed">
                    How Classio Fashion safeguards your personal information, encrypted transactions, and privacy.
                </p>
            </div>

            <!-- Content Card -->
            <div class="bg-white rounded-3xl p-6 sm:p-10 shadow-[0_4px_25px_rgba(11,26,44,0.06)] border border-gray-100 space-y-8 text-xs sm:text-sm text-gray-700 leading-relaxed">
                
                <section>
                    <h2 class="font-serif text-lg sm:text-xl font-bold text-[#0B1A2C] mb-2">1. Commitment to Privacy</h2>
                    <p class="text-gray-600">
                        At Classio Fashion, we hold your trust with the highest esteem. We do not sell, rent, or trade your personal data to third-party marketing brokers under any circumstances.
                    </p>
                </section>

                <section>
                    <h2 class="font-serif text-lg sm:text-xl font-bold text-[#0B1A2C] mb-2">2. Information We Collect</h2>
                    <p class="text-gray-600 mb-2">
                        To fulfill bespoke orders, provide tracking updates, and personalize your experience, we may collect:
                    </p>
                    <ul class="list-disc list-inside space-y-1 text-gray-600 pl-2">
                        <li>Contact credentials: Full Name, email address, telephone number, and delivery street address.</li>
                        <li>Account data: Encrypted authentication credentials and order histories.</li>
                        <li>Technical identifiers: Browser cookies, device type, and IP address for fraud prevention and performance optimization.</li>
                    </ul>
                </section>

                <section>
                    <h2 class="font-serif text-lg sm:text-xl font-bold text-[#0B1A2C] mb-2">3. Payment Security & Encryption</h2>
                    <p class="text-gray-600">
                        Classio does not store full credit/debit card numbers or CVV codes on our servers. All transactions are processed through RBI-authorized, PCI-DSS Level 1 compliant payment gateways using industry-standard <strong>256-bit SSL encryption</strong>.
                    </p>
                </section>

                <section>
                    <h2 class="font-serif text-lg sm:text-xl font-bold text-[#0B1A2C] mb-2">4. Communications & Opt-Out</h2>
                    <p class="text-gray-600">
                        We send order updates, tracking information, and periodic curated newsletter announcements. You may opt out of promotional emails at any moment by clicking the unsubscribe link or contacting our concierge desk.
                    </p>
                </section>

                <section>
                    <h2 class="font-serif text-lg sm:text-xl font-bold text-[#0B1A2C] mb-2">5. Data Retention & User Rights</h2>
                    <p class="text-gray-600">
                        You have the right under Indian Information Technology laws to request access to, correction of, or permanent erasure of your personal account data by writing to our Privacy Officer at <a href="mailto:support@classiofashion.com" class="text-[#0B1A2C] font-semibold underline">support@classiofashion.com</a>.
                    </p>
                </section>

            </div>

        </div>
    </div>
</x-layout.app>
