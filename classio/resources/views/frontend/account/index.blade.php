<x-layout.app :categories="$categories">
    <div class="bg-[#FAF9F6] min-h-[85vh] py-10 sm:py-14 select-none">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <!-- Breadcrumbs -->
            <nav class="flex text-xs font-sans text-gray-500 uppercase tracking-widest mb-6" aria-label="Breadcrumb">
                <ol class="inline-flex items-center space-x-2">
                    <li><a href="{{ route('home') }}" class="hover:text-[#0B1A2C] transition-colors">Home</a></li>
                    <li>/</li>
                    <li class="text-[#0B1A2C] font-semibold">My Account</li>
                </ol>
            </nav>

            <!-- Admin Notice Banner (If user has admin permissions) -->
            @if($user->email === 'admin@classio.com' || ($user->is_admin ?? false))
                <div class="mb-6 p-4 rounded-2xl bg-[#0B1A2C] text-white flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4 shadow-lg border border-[#D8C3A5]/30">
                    <div class="flex items-center gap-3">
                        <span class="w-10 h-10 rounded-full bg-[#D8C3A5] text-[#0B1A2C] font-extrabold flex items-center justify-center text-sm shadow">
                            VIP
                        </span>
                        <div>
                            <h3 class="font-serif text-sm sm:text-base font-bold text-[#D8C3A5]">Classio Administrative Privileges Detected</h3>
                            <p class="text-xs text-gray-300">You are signed in with store administration authority.</p>
                        </div>
                    </div>
                    <a href="{{ route('admin.dashboard') }}" class="px-5 py-2.5 rounded-full bg-[#D8C3A5] hover:bg-[#c9b291] text-[#0B1A2C] text-xs font-bold uppercase tracking-wider transition-colors shadow">
                        Open Admin Console &rarr;
                    </a>
                </div>
            @endif

            <!-- Profile Header Card -->
            <div class="bg-white rounded-3xl p-6 sm:p-8 shadow-[0_4px_25px_rgba(11,26,44,0.06)] border border-gray-100 mb-8 flex flex-col md:flex-row items-start md:items-center justify-between gap-6">
                <div class="flex items-center gap-4 sm:gap-6">
                    <div class="w-16 h-16 sm:w-20 sm:h-20 rounded-2xl bg-[#0B1A2C] text-[#D8C3A5] font-serif text-2xl sm:text-3xl font-bold flex items-center justify-center shadow-md">
                        {{ strtoupper(substr($user->name, 0, 1)) }}
                    </div>
                    <div>
                        <div class="flex items-center gap-2 mb-1">
                            <h1 class="font-serif text-2xl sm:text-3xl font-bold text-[#0B1A2C]">{{ $user->name }}</h1>
                            <span class="px-2.5 py-0.5 rounded-full bg-[#FAF0E6] text-[#8C6D46] text-[10px] font-bold uppercase tracking-wider border border-[#D8C3A5]/40">
                                Classio VIP Member
                            </span>
                        </div>
                        <p class="font-sans text-xs text-gray-500">{{ $user->email }}</p>
                        <p class="font-sans text-[11px] text-gray-400 mt-0.5">Member since {{ $user->created_at ? $user->created_at->format('F Y') : '2025' }}</p>
                    </div>
                </div>

                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="px-5 py-2 rounded-xl border border-gray-300 hover:border-red-400 hover:text-red-600 text-xs font-semibold text-gray-700 transition-colors flex items-center gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
                        <span>Sign Out</span>
                    </button>
                </form>
            </div>

            <!-- Quick Action Cards Grid -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 sm:gap-6">
                <!-- Track Orders -->
                <a href="{{ route('track-order') }}" class="group bg-white rounded-2xl p-6 border border-gray-100 hover:border-[#D8C3A5] shadow-sm hover:shadow-md transition-all">
                    <div class="w-12 h-12 rounded-xl bg-[#FAF9F6] group-hover:bg-[#0B1A2C] text-[#0B1A2C] group-hover:text-[#D8C3A5] flex items-center justify-center mb-4 transition-colors">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M9 17a2 2 0 11-4 0 2 2 0 014 0zM19 17a2 2 0 11-4 0 2 2 0 014 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M13 16V6a1 1 0 00-1-1H4a1 1 0 00-1 1v10a1 1 0 001 1h1m8-1a1 1 0 01-1 1H9m4-1V8h4.586a1 1 0 01.707.293l3.414 3.414a1 1 0 01.293.707V16a1 1 0 01-1 1h-1m-6-1a1 1 0 001 1h2"/></svg>
                    </div>
                    <h3 class="font-serif text-base font-bold text-[#0B1A2C] mb-1">Track Orders</h3>
                    <p class="font-sans text-xs text-gray-500 leading-relaxed">Check real-time dispatch and courier shipment milestones for your purchases.</p>
                </a>

                <!-- Wishlist -->
                <a href="{{ route('wishlist.index') }}" class="group bg-white rounded-2xl p-6 border border-gray-100 hover:border-[#D8C3A5] shadow-sm hover:shadow-md transition-all">
                    <div class="w-12 h-12 rounded-xl bg-[#FAF9F6] group-hover:bg-[#0B1A2C] text-[#0B1A2C] group-hover:text-[#D8C3A5] flex items-center justify-center mb-4 transition-colors">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/></svg>
                    </div>
                    <h3 class="font-serif text-base font-bold text-[#0B1A2C] mb-1">Your Wishlist</h3>
                    <p class="font-sans text-xs text-gray-500 leading-relaxed">Access saved luxury timepieces, apparel, and bespoke selections.</p>
                </a>

                <!-- Shopping Bag -->
                <a href="{{ route('cart.index') }}" class="group bg-white rounded-2xl p-6 border border-gray-100 hover:border-[#D8C3A5] shadow-sm hover:shadow-md transition-all">
                    <div class="w-12 h-12 rounded-xl bg-[#FAF9F6] group-hover:bg-[#0B1A2C] text-[#0B1A2C] group-hover:text-[#D8C3A5] flex items-center justify-center mb-4 transition-colors">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                    </div>
                    <h3 class="font-serif text-base font-bold text-[#0B1A2C] mb-1">Shopping Bag</h3>
                    <p class="font-sans text-xs text-gray-500 leading-relaxed">Review selected luxury items, apply promo codes, and complete checkout.</p>
                </a>

                <!-- Flagship Stores -->
                <a href="{{ route('stores') }}" class="group bg-white rounded-2xl p-6 border border-gray-100 hover:border-[#D8C3A5] shadow-sm hover:shadow-md transition-all">
                    <div class="w-12 h-12 rounded-xl bg-[#FAF9F6] group-hover:bg-[#0B1A2C] text-[#0B1A2C] group-hover:text-[#D8C3A5] flex items-center justify-center mb-4 transition-colors">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
                    </div>
                    <h3 class="font-serif text-base font-bold text-[#0B1A2C] mb-1">Our Boutiques</h3>
                    <p class="font-sans text-xs text-gray-500 leading-relaxed">Visit our Patna flagship salon and upcoming luxury experience lounges.</p>
                </a>

                <!-- Customer Service & Concierge -->
                <a href="{{ route('customer-service') }}" class="group bg-white rounded-2xl p-6 border border-gray-100 hover:border-[#D8C3A5] shadow-sm hover:shadow-md transition-all">
                    <div class="w-12 h-12 rounded-xl bg-[#FAF9F6] group-hover:bg-[#0B1A2C] text-[#0B1A2C] group-hover:text-[#D8C3A5] flex items-center justify-center mb-4 transition-colors">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M9.172 9.172L5.636 5.636m3.536 9.192l-3.536 3.536M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-5 0a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
                    </div>
                    <h3 class="font-serif text-base font-bold text-[#0B1A2C] mb-1">Concierge Help</h3>
                    <p class="font-sans text-xs text-gray-500 leading-relaxed">24/7 dedicated support for sizing, custom styling, orders, and inquiries.</p>
                </a>

                <!-- Size Guide -->
                <a href="{{ route('size-guide') }}" class="group bg-white rounded-2xl p-6 border border-gray-100 hover:border-[#D8C3A5] shadow-sm hover:shadow-md transition-all">
                    <div class="w-12 h-12 rounded-xl bg-[#FAF9F6] group-hover:bg-[#0B1A2C] text-[#0B1A2C] group-hover:text-[#D8C3A5] flex items-center justify-center mb-4 transition-colors">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M4 6h16M4 12h16M4 18h7"/></svg>
                    </div>
                    <h3 class="font-serif text-base font-bold text-[#0B1A2C] mb-1">Luxury Size Guide</h3>
                    <p class="font-sans text-xs text-gray-500 leading-relaxed">International wrist sizing, apparel measurements, and footwear charts.</p>
                </a>
            </div>
        </div>
    </div>
</x-layout.app>
