@extends('admin.layout')

@section('title', 'Settings')

@section('content')
<div class="md:flex md:items-center md:justify-between mb-8">
    <div class="min-w-0 flex-1">
        <h2 class="text-2xl font-bold leading-7 text-gray-900 sm:truncate sm:text-3xl sm:tracking-tight">Store Settings</h2>
        <p class="mt-2 text-sm text-gray-700">Manage contact information and social media links displayed on the storefront.</p>
    </div>
</div>

<form action="{{ route('admin.settings.update') }}" method="POST" class="bg-white shadow-sm ring-1 ring-gray-900/5 sm:rounded-xl md:col-span-2">
    @csrf
    <div class="px-4 py-6 sm:p-8">
        <div class="grid max-w-2xl grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
            
            <div class="sm:col-span-4">
                <label for="whatsapp_number" class="block text-sm font-medium leading-6 text-gray-900">WhatsApp Number</label>
                <div class="mt-2">
                    <input type="text" name="whatsapp_number" id="whatsapp_number" value="{{ old('whatsapp_number', $settings['whatsapp_number'] ?? '') }}" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-classio-navy sm:text-sm sm:leading-6" placeholder="e.g. +1234567890">
                </div>
                <p class="mt-1 text-xs text-gray-500">Used for WhatsApp ordering. Include country code.</p>
                @error('whatsapp_number')<p class="mt-2 text-sm text-red-600">{{ $message }}</p>@enderror
            </div>

            <div class="sm:col-span-4">
                <label for="contact_email" class="block text-sm font-medium leading-6 text-gray-900">Contact Email</label>
                <div class="mt-2">
                    <input type="email" name="contact_email" id="contact_email" value="{{ old('contact_email', $settings['contact_email'] ?? '') }}" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-classio-navy sm:text-sm sm:leading-6">
                </div>
                @error('contact_email')<p class="mt-2 text-sm text-red-600">{{ $message }}</p>@enderror
            </div>

            <div class="sm:col-span-4">
                <label for="facebook_url" class="block text-sm font-medium leading-6 text-gray-900">Facebook URL</label>
                <div class="mt-2">
                    <input type="url" name="facebook_url" id="facebook_url" value="{{ old('facebook_url', $settings['facebook_url'] ?? '') }}" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-classio-navy sm:text-sm sm:leading-6" placeholder="https://facebook.com/...">
                </div>
                @error('facebook_url')<p class="mt-2 text-sm text-red-600">{{ $message }}</p>@enderror
            </div>

            <div class="sm:col-span-4">
                <label for="instagram_url" class="block text-sm font-medium leading-6 text-gray-900">Instagram URL</label>
                <div class="mt-2">
                    <input type="url" name="instagram_url" id="instagram_url" value="{{ old('instagram_url', $settings['instagram_url'] ?? '') }}" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-classio-navy sm:text-sm sm:leading-6" placeholder="https://instagram.com/...">
                </div>
                @error('instagram_url')<p class="mt-2 text-sm text-red-600">{{ $message }}</p>@enderror
            </div>

            <div class="col-span-full">
                <label for="store_address" class="block text-sm font-medium leading-6 text-gray-900">Store Address</label>
                <div class="mt-2">
                    <textarea id="store_address" name="store_address" rows="3" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-classio-navy sm:text-sm sm:leading-6">{{ old('store_address', $settings['store_address'] ?? '') }}</textarea>
                </div>
                @error('store_address')<p class="mt-2 text-sm text-red-600">{{ $message }}</p>@enderror
            </div>

        </div>
    </div>
    <div class="flex items-center justify-end gap-x-6 border-t border-gray-900/10 px-4 py-4 sm:px-8">
        <button type="submit" class="rounded-md bg-classio-navy px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-gray-800">Save Settings</button>
    </div>
</form>
@endsection