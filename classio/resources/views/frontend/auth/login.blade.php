<x-layout.app :categories="$categories">
    <div class="bg-[#FAF9F6] min-h-[85vh] py-12 sm:py-16 px-4 sm:px-6 lg:px-8 flex items-center justify-center select-none"
         x-data="{ activeTab: '{{ $errors->has('name') || old('form_type') === 'register' ? 'register' : 'login' }}', showPass: false, showRegPass: false }">
        
        <div class="w-full max-w-md">
            <!-- Brand Badge -->
            <div class="text-center mb-6">
                <a href="{{ route('home') }}" class="inline-flex flex-col items-center group">
                    <div class="text-[#0B1A2C] mb-1">
                        <svg class="w-8 h-6 text-[#0B1A2C]" viewBox="0 0 36 24" fill="currentColor">
                            <path d="M18 1L21.5 8.5L29 3.5L25.5 13H10.5L7 3.5L14.5 8.5L18 1Z" opacity="0.9"/>
                            <path d="M8 15.5H28C28.8 15.5 29.5 16.2 29.5 17C29.5 17.8 28.8 18.5 28 18.5H8C7.2 18.5 6.5 17.8 6.5 17C6.5 16.2 7.2 15.5 8 15.5Z" />
                            <circle cx="18" cy="1" r="1.5"/>
                            <circle cx="7" cy="3.5" r="1.3"/>
                            <circle cx="29" cy="3.5" r="1.3"/>
                        </svg>
                    </div>
                    <span class="font-serif text-2xl font-bold tracking-[0.25em] text-[#0B1A2C]">CLASSIO</span>
                    <span class="text-[7px] tracking-[0.35em] text-[#0B1A2C]/70 font-sans uppercase">INSPIRED BY YOU</span>
                </a>
            </div>

            <!-- Card Container -->
            <div class="bg-white rounded-2xl shadow-[0_10px_35px_rgba(11,26,44,0.08)] border border-gray-100 overflow-hidden">
                <!-- Navigation Tabs -->
                <div class="grid grid-cols-2 border-b border-gray-100 bg-[#FAF9F6]">
                    <button type="button" 
                            @click="activeTab = 'login'" 
                            :class="activeTab === 'login' ? 'bg-white text-[#0B1A2C] border-b-2 border-[#0B1A2C] font-bold' : 'text-gray-500 hover:text-gray-900 font-medium'"
                            class="py-3.5 text-xs uppercase tracking-wider transition-all duration-200">
                        Sign In
                    </button>
                    <button type="button" 
                            @click="activeTab = 'register'" 
                            :class="activeTab === 'register' ? 'bg-white text-[#0B1A2C] border-b-2 border-[#0B1A2C] font-bold' : 'text-gray-500 hover:text-gray-900 font-medium'"
                            class="py-3.5 text-xs uppercase tracking-wider transition-all duration-200">
                        Create Account
                    </button>
                </div>

                <div class="p-6 sm:p-8">
                    <!-- Session Status / Errors -->
                    @if (session('success'))
                        <div class="mb-5 p-3.5 rounded-xl bg-emerald-50 border border-emerald-200 text-emerald-800 text-xs flex items-center gap-2">
                            <svg class="w-4 h-4 text-emerald-600 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
                            <span>{{ session('success') }}</span>
                        </div>
                    @endif

                    @if (session('info'))
                        <div class="mb-5 p-3.5 rounded-xl bg-blue-50 border border-blue-200 text-blue-800 text-xs flex items-center gap-2">
                            <svg class="w-4 h-4 text-blue-600 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"/></svg>
                            <span>{{ session('info') }}</span>
                        </div>
                    @endif

                    @if ($errors->any())
                        <div class="mb-5 p-3.5 rounded-xl bg-rose-50 border border-rose-200 text-rose-800 text-xs">
                            <p class="font-semibold mb-1">Please correct the following errors:</p>
                            <ul class="list-disc list-inside space-y-0.5">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <!-- LOGIN TAB CONTENT -->
                    <div x-show="activeTab === 'login'" x-transition:enter="transition ease-out duration-200">
                        <div class="mb-6">
                            <h2 class="font-serif text-xl sm:text-2xl font-bold text-[#0B1A2C]">Welcome Back</h2>
                            <p class="font-sans text-xs text-gray-500 mt-1">
                                Sign in to your Classio luxury account.
                            </p>
                        </div>

                        <form action="{{ route('login.submit') }}" method="POST" class="space-y-4">
                            @csrf
                            <div>
                                <label for="login_email" class="block text-xs font-semibold uppercase tracking-wider text-gray-700 mb-1.5">Email Address</label>
                                <div class="relative">
                                    <input type="email" 
                                           id="login_email" 
                                           name="email" 
                                           value="{{ old('email') }}" 
                                           required 
                                           autocomplete="email"
                                           placeholder="name@domain.com"
                                           class="w-full px-4 py-2.5 rounded-xl border border-gray-200 bg-gray-50/50 text-xs text-gray-900 focus:bg-white focus:outline-none focus:ring-2 focus:ring-[#0B1A2C] focus:border-transparent transition-all">
                                </div>
                            </div>

                            <div>
                                <div class="flex items-center justify-between mb-1.5">
                                    <label for="login_password" class="block text-xs font-semibold uppercase tracking-wider text-gray-700">Password</label>
                                    <a href="{{ route('customer-service') }}" class="text-[11px] text-gray-500 hover:text-[#0B1A2C] transition-colors">Forgot password?</a>
                                </div>
                                <div class="relative">
                                    <input :type="showPass ? 'text' : 'password'" 
                                           id="login_password" 
                                           name="password" 
                                           required 
                                           autocomplete="current-password"
                                           placeholder="••••••••"
                                           class="w-full px-4 py-2.5 pr-10 rounded-xl border border-gray-200 bg-gray-50/50 text-xs text-gray-900 focus:bg-white focus:outline-none focus:ring-2 focus:ring-[#0B1A2C] focus:border-transparent transition-all">
                                    <button type="button" 
                                            @click="showPass = !showPass" 
                                            class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 hover:text-gray-600 focus:outline-none p-1"
                                            aria-label="Toggle password visibility">
                                        <svg x-show="!showPass" class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                                        <svg x-show="showPass" class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="display: none;"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l18 18"/></svg>
                                    </button>
                                </div>
                            </div>

                            <div class="flex items-center justify-between pt-1">
                                <label class="flex items-center gap-2 cursor-pointer">
                                    <input type="checkbox" name="remember" class="w-3.5 h-3.5 rounded text-[#0B1A2C] focus:ring-[#0B1A2C] border-gray-300">
                                    <span class="text-xs text-gray-600">Remember me</span>
                                </label>
                            </div>

                            <button type="submit" class="w-full py-3 px-4 rounded-xl bg-[#0B1A2C] hover:bg-[#12243d] text-white text-xs font-bold uppercase tracking-wider shadow-md hover:shadow-lg transition-all duration-200 flex items-center justify-center gap-2">
                                <span>Sign In</span>
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                            </button>
                        </form>
                    </div>

                    <!-- REGISTER TAB CONTENT -->
                    <div x-show="activeTab === 'register'" x-transition:enter="transition ease-out duration-200" style="display: none;">
                        <div class="mb-6">
                            <h2 class="font-serif text-xl sm:text-2xl font-bold text-[#0B1A2C]">Join Classio</h2>
                            <p class="font-sans text-xs text-gray-500 mt-1">
                                Create an account to track orders, save wishlists, and receive bespoke privileges.
                            </p>
                        </div>

                        <form action="{{ route('register.submit') }}" method="POST" class="space-y-4">
                            @csrf
                            <input type="hidden" name="form_type" value="register">

                            <div>
                                <label for="reg_name" class="block text-xs font-semibold uppercase tracking-wider text-gray-700 mb-1.5">Full Name</label>
                                <input type="text" 
                                       id="reg_name" 
                                       name="name" 
                                       value="{{ old('name') }}" 
                                       required 
                                       autocomplete="name"
                                       placeholder="e.g. Rahul Sharma"
                                       class="w-full px-4 py-2.5 rounded-xl border border-gray-200 bg-gray-50/50 text-xs text-gray-900 focus:bg-white focus:outline-none focus:ring-2 focus:ring-[#0B1A2C] focus:border-transparent transition-all">
                            </div>

                            <div>
                                <label for="reg_email" class="block text-xs font-semibold uppercase tracking-wider text-gray-700 mb-1.5">Email Address</label>
                                <input type="email" 
                                       id="reg_email" 
                                       name="email" 
                                       value="{{ old('email') }}" 
                                       required 
                                       autocomplete="email"
                                       placeholder="name@domain.com"
                                       class="w-full px-4 py-2.5 rounded-xl border border-gray-200 bg-gray-50/50 text-xs text-gray-900 focus:bg-white focus:outline-none focus:ring-2 focus:ring-[#0B1A2C] focus:border-transparent transition-all">
                            </div>

                            <div>
                                <label for="reg_password" class="block text-xs font-semibold uppercase tracking-wider text-gray-700 mb-1.5">Password</label>
                                <div class="relative">
                                    <input :type="showRegPass ? 'text' : 'password'" 
                                           id="reg_password" 
                                           name="password" 
                                           required 
                                           minlength="6"
                                           autocomplete="new-password"
                                           placeholder="At least 6 characters"
                                           class="w-full px-4 py-2.5 pr-10 rounded-xl border border-gray-200 bg-gray-50/50 text-xs text-gray-900 focus:bg-white focus:outline-none focus:ring-2 focus:ring-[#0B1A2C] focus:border-transparent transition-all">
                                    <button type="button" 
                                            @click="showRegPass = !showRegPass" 
                                            class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 hover:text-gray-600 focus:outline-none p-1"
                                            aria-label="Toggle password visibility">
                                        <svg x-show="!showRegPass" class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                                        <svg x-show="showRegPass" class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="display: none;"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l18 18"/></svg>
                                    </button>
                                </div>
                            </div>

                            <div>
                                <label for="reg_password_confirmation" class="block text-xs font-semibold uppercase tracking-wider text-gray-700 mb-1.5">Confirm Password</label>
                                <input type="password" 
                                       id="reg_password_confirmation" 
                                       name="password_confirmation" 
                                       required 
                                       autocomplete="new-password"
                                       placeholder="Re-enter password"
                                       class="w-full px-4 py-2.5 rounded-xl border border-gray-200 bg-gray-50/50 text-xs text-gray-900 focus:bg-white focus:outline-none focus:ring-2 focus:ring-[#0B1A2C] focus:border-transparent transition-all">
                            </div>

                            <p class="text-[11px] text-gray-500 leading-relaxed">
                                By creating an account, you agree to Classio's 
                                <a href="{{ route('terms') }}" class="text-[#0B1A2C] underline">Terms & Conditions</a> and 
                                <a href="{{ route('privacy-policy') }}" class="text-[#0B1A2C] underline">Privacy Policy</a>.
                            </p>

                            <button type="submit" class="w-full py-3 px-4 rounded-xl bg-[#0B1A2C] hover:bg-[#12243d] text-white text-xs font-bold uppercase tracking-wider shadow-md hover:shadow-lg transition-all duration-200 flex items-center justify-center gap-2">
                                <span>Create Luxury Account</span>
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Bottom Assistance Link -->
            <div class="mt-6 text-center text-xs text-gray-500">
                Need concierge assistance? 
                <a href="{{ route('customer-service') }}" class="text-[#0B1A2C] font-semibold hover:underline">Contact Classio Support</a>
            </div>
        </div>
    </div>
</x-layout.app>
