@extends('admin.layout')

@section('title', 'Store Settings')

@section('content')
<div class="max-w-6xl mx-auto space-y-6">
    <!-- Header -->
    <div class="sm:flex sm:items-center sm:justify-between pb-4 border-b border-gray-200">
        <div>
            <h1 class="text-2xl font-bold tracking-tight text-gray-900">Store Settings</h1>
            <p class="mt-1 text-sm text-gray-500">Configure global storefront information, WhatsApp ordering, contact details, and social links.</p>
        </div>
        <div class="mt-4 sm:mt-0 flex items-center gap-3">
            <a href="{{ route('home') }}" target="_blank" class="inline-flex items-center gap-1.5 px-3 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 shadow-sm transition">
                <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                View Live Store
            </a>
            <button form="settings-form" type="submit" class="inline-flex items-center gap-1.5 px-4 py-2 text-sm font-semibold text-white bg-classio-navy rounded-lg hover:bg-gray-800 shadow-sm transition">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                Save Changes
            </button>
        </div>
    </div>

    @if(session('success'))
        <div class="p-4 rounded-xl bg-emerald-50 border border-emerald-200 text-emerald-800 flex items-center justify-between">
            <div class="flex items-center gap-3">
                <div class="w-8 h-8 rounded-full bg-emerald-100 flex items-center justify-center shrink-0 text-emerald-600">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                </div>
                <div>
                    <h3 class="font-semibold text-sm">Success</h3>
                    <p class="text-xs text-emerald-700">{{ session('success') }}</p>
                </div>
            </div>
            <button type="button" onclick="this.parentElement.remove()" class="text-emerald-500 hover:text-emerald-700 text-sm font-medium">Dismiss</button>
        </div>
    @endif

    <form id="settings-form" action="{{ route('admin.settings.update') }}" method="POST" class="space-y-6">
        @csrf

        <!-- Card 1: Brand & Top Announcement Bar -->
        <div class="bg-white rounded-2xl shadow-sm ring-1 ring-gray-900/5 p-6 sm:p-8">
            <div class="flex items-center gap-3 mb-6 pb-4 border-b border-gray-100">
                <div class="w-10 h-10 rounded-xl bg-amber-50 text-amber-700 flex items-center justify-center font-bold">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z"/></svg>
                </div>
                <div>
                    <h2 class="text-lg font-semibold text-gray-900">Brand & Top Announcement Bar</h2>
                    <p class="text-xs text-gray-500">Configure your store branding and the highlight banner shown at the very top of all pages.</p>
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                <div>
                    <label for="store_name" class="block text-xs font-semibold uppercase tracking-wider text-gray-700 mb-1.5">Store Brand Name</label>
                    <input type="text" name="store_name" id="store_name" value="{{ old('store_name', $settings['store_name'] ?? 'CLASSIO') }}" class="w-full rounded-lg border-gray-300 py-2.5 px-3.5 text-sm shadow-sm focus:border-classio-navy focus:ring-classio-navy">
                </div>

                <div>
                    <label for="store_tagline" class="block text-xs font-semibold uppercase tracking-wider text-gray-700 mb-1.5">Store Tagline</label>
                    <input type="text" name="store_tagline" id="store_tagline" value="{{ old('store_tagline', $settings['store_tagline'] ?? 'INSPIRED BY YOU') }}" class="w-full rounded-lg border-gray-300 py-2.5 px-3.5 text-sm shadow-sm focus:border-classio-navy focus:ring-classio-navy">
                </div>

                <div class="sm:col-span-2">
                    <label for="announcement_text" class="block text-xs font-semibold uppercase tracking-wider text-gray-700 mb-1.5">Top Announcement Bar Text</label>
                    <div class="flex gap-3">
                        <input type="text" name="announcement_text" id="announcement_text" value="{{ old('announcement_text', $settings['announcement_text'] ?? '') }}" placeholder="e.g. Complimentary Express Delivery & Luxury Gift Packaging on All Orders" class="flex-1 rounded-lg border-gray-300 py-2.5 px-3.5 text-sm shadow-sm focus:border-classio-navy focus:ring-classio-navy">
                        <div class="w-44 shrink-0">
                            <select name="announcement_active" id="announcement_active" class="w-full rounded-lg border-gray-300 py-2.5 px-3 text-sm shadow-sm focus:border-classio-navy focus:ring-classio-navy">
                                <option value="1" {{ ($settings['announcement_active'] ?? '1') == '1' ? 'selected' : '' }}>🟢 Banner Active</option>
                                <option value="0" {{ ($settings['announcement_active'] ?? '1') == '0' ? 'selected' : '' }}>⚪ Banner Hidden</option>
                            </select>
                        </div>
                    </div>
                    <p class="mt-1.5 text-xs text-gray-400">Appears above the navigation header across the website.</p>
                </div>
            </div>
        </div>

        <!-- Card 2: WhatsApp & Customer Care -->
        <div class="bg-white rounded-2xl shadow-sm ring-1 ring-gray-900/5 p-6 sm:p-8">
            <div class="flex items-center gap-3 mb-6 pb-4 border-b border-gray-100">
                <div class="w-10 h-10 rounded-xl bg-emerald-50 text-emerald-700 flex items-center justify-center font-bold">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                </div>
                <div>
                    <h2 class="text-lg font-semibold text-gray-900">WhatsApp & Direct Customer Care</h2>
                    <p class="text-xs text-gray-500">Enable one-click WhatsApp chat ordering and configure support contact points.</p>
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                <div>
                    <label for="whatsapp_number" class="block text-xs font-semibold uppercase tracking-wider text-gray-700 mb-1.5">WhatsApp Ordering Number</label>
                    <div class="relative rounded-lg shadow-sm">
                        <input type="text" name="whatsapp_number" id="whatsapp_number" value="{{ old('whatsapp_number', $settings['whatsapp_number'] ?? '') }}" placeholder="e.g. +91 91234 56789" class="w-full rounded-lg border-gray-300 py-2.5 px-3.5 text-sm focus:border-classio-navy focus:ring-classio-navy">
                    </div>
                    <p class="mt-1.5 text-xs text-gray-400">Used for direct WhatsApp order buttons and concierge inquiries.</p>
                </div>

                <div>
                    <label for="contact_phone" class="block text-xs font-semibold uppercase tracking-wider text-gray-700 mb-1.5">Support Phone Line</label>
                    <input type="text" name="contact_phone" id="contact_phone" value="{{ old('contact_phone', $settings['contact_phone'] ?? '') }}" placeholder="e.g. +91 91234 56789" class="w-full rounded-lg border-gray-300 py-2.5 px-3.5 text-sm shadow-sm focus:border-classio-navy focus:ring-classio-navy">
                    <p class="mt-1.5 text-xs text-gray-400">Displayed on the Customer Service & Contact pages.</p>
                </div>

                <div>
                    <label for="contact_email" class="block text-xs font-semibold uppercase tracking-wider text-gray-700 mb-1.5">Customer Support Email</label>
                    <input type="email" name="contact_email" id="contact_email" value="{{ old('contact_email', $settings['contact_email'] ?? '') }}" placeholder="support@classio.com" class="w-full rounded-lg border-gray-300 py-2.5 px-3.5 text-sm shadow-sm focus:border-classio-navy focus:ring-classio-navy">
                </div>

                <div>
                    <label for="support_hours" class="block text-xs font-semibold uppercase tracking-wider text-gray-700 mb-1.5">Concierge / Working Hours</label>
                    <input type="text" name="support_hours" id="support_hours" value="{{ old('support_hours', $settings['support_hours'] ?? 'Mon - Sat: 10:00 AM - 8:00 PM IST') }}" placeholder="Mon - Sat: 10:00 AM - 8:00 PM IST" class="w-full rounded-lg border-gray-300 py-2.5 px-3.5 text-sm shadow-sm focus:border-classio-navy focus:ring-classio-navy">
                </div>
            </div>
        </div>

        <!-- Card 3: Physical Flagship Store & Location -->
        <div class="bg-white rounded-2xl shadow-sm ring-1 ring-gray-900/5 p-6 sm:p-8">
            <div class="flex items-center gap-3 mb-6 pb-4 border-b border-gray-100">
                <div class="w-10 h-10 rounded-xl bg-blue-50 text-blue-700 flex items-center justify-center font-bold">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                </div>
                <div>
                    <h2 class="text-lg font-semibold text-gray-900">Physical Store & Address</h2>
                    <p class="text-xs text-gray-500">Official address shown on footer, Our Stores, and Contact Us page.</p>
                </div>
            </div>

            <div>
                <label for="store_address" class="block text-xs font-semibold uppercase tracking-wider text-gray-700 mb-1.5">Flagship Store Full Address</label>
                <textarea id="store_address" name="store_address" rows="3" class="w-full rounded-lg border-gray-300 py-2.5 px-3.5 text-sm shadow-sm focus:border-classio-navy focus:ring-classio-navy">{{ old('store_address', $settings['store_address'] ?? '') }}</textarea>
                <p class="mt-1.5 text-xs text-gray-400">Include building number, street, landmark, city, and pincode.</p>
            </div>
        </div>

        <!-- Card 4: Social Media Accounts -->
        <div class="bg-white rounded-2xl shadow-sm ring-1 ring-gray-900/5 p-6 sm:p-8">
            <div class="flex items-center gap-3 mb-6 pb-4 border-b border-gray-100">
                <div class="w-10 h-10 rounded-xl bg-purple-50 text-purple-700 flex items-center justify-center font-bold">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"/></svg>
                </div>
                <div>
                    <h2 class="text-lg font-semibold text-gray-900">Social Media Profiles</h2>
                    <p class="text-xs text-gray-500">Direct links to your brand channels displayed on the footer and social gallery.</p>
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-3 gap-6">
                <div>
                    <label for="instagram_url" class="block text-xs font-semibold uppercase tracking-wider text-gray-700 mb-1.5">Instagram URL</label>
                    <input type="url" name="instagram_url" id="instagram_url" value="{{ old('instagram_url', $settings['instagram_url'] ?? '') }}" placeholder="https://instagram.com/yourhandle" class="w-full rounded-lg border-gray-300 py-2.5 px-3.5 text-sm shadow-sm focus:border-classio-navy focus:ring-classio-navy">
                </div>

                <div>
                    <label for="facebook_url" class="block text-xs font-semibold uppercase tracking-wider text-gray-700 mb-1.5">Facebook URL</label>
                    <input type="url" name="facebook_url" id="facebook_url" value="{{ old('facebook_url', $settings['facebook_url'] ?? '') }}" placeholder="https://facebook.com/yourpage" class="w-full rounded-lg border-gray-300 py-2.5 px-3.5 text-sm shadow-sm focus:border-classio-navy focus:ring-classio-navy">
                </div>

                <div>
                    <label for="youtube_url" class="block text-xs font-semibold uppercase tracking-wider text-gray-700 mb-1.5">YouTube URL</label>
                    <input type="url" name="youtube_url" id="youtube_url" value="{{ old('youtube_url', $settings['youtube_url'] ?? '') }}" placeholder="https://youtube.com/@yourchannel" class="w-full rounded-lg border-gray-300 py-2.5 px-3.5 text-sm shadow-sm focus:border-classio-navy focus:ring-classio-navy">
                </div>
            </div>
        </div>

        <!-- Submit Bar -->
        <div class="flex items-center justify-end gap-4 pt-4">
            <button type="submit" class="inline-flex items-center gap-2 rounded-xl bg-classio-navy px-6 py-3 text-sm font-semibold text-white shadow-md hover:bg-gray-800 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-classio-navy transition">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                Save All Settings
            </button>
        </div>
    </form>
</div>
@endsection