<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;

class SettingsController extends Controller
{
    public function index()
    {
        // Query key_name to avoid SQL column missing error
        $settings = Setting::pluck('value', 'key_name')->toArray();
        
        // Provide sensible defaults if not yet set
        $defaults = [
            'store_name' => 'CLASSIO',
            'store_tagline' => 'INSPIRED BY YOU',
            'whatsapp_number' => '+91 91234 56789',
            'contact_email' => 'support@classio.com',
            'contact_phone' => '+91 91234 56789',
            'support_hours' => 'Mon - Sat: 10:00 AM - 8:00 PM IST',
            'store_address' => 'Classio Luxury Flagship Store, Linking Road, Bandra West, Mumbai 400050, India',
            'announcement_text' => 'Complimentary Express Delivery & Luxury Gift Packaging on All Orders',
            'announcement_active' => '1',
            'instagram_url' => 'https://instagram.com/classio_official',
            'facebook_url' => 'https://facebook.com/classio.luxury',
            'youtube_url' => 'https://youtube.com/@classio',
        ];

        $settings = array_merge($defaults, $settings);

        return view('admin.settings.index', compact('settings'));
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'store_name' => 'nullable|string|max:100',
            'store_tagline' => 'nullable|string|max:150',
            'whatsapp_number' => 'nullable|string|max:30',
            'contact_email' => 'nullable|email|max:100',
            'contact_phone' => 'nullable|string|max:30',
            'support_hours' => 'nullable|string|max:100',
            'store_address' => 'nullable|string|max:1000',
            'announcement_text' => 'nullable|string|max:500',
            'announcement_active' => 'nullable|in:0,1',
            'instagram_url' => 'nullable|url|max:255',
            'facebook_url' => 'nullable|url|max:255',
            'youtube_url' => 'nullable|url|max:255',
        ]);

        $keys = [
            'store_name',
            'store_tagline',
            'whatsapp_number',
            'contact_email',
            'contact_phone',
            'support_hours',
            'store_address',
            'announcement_text',
            'announcement_active',
            'instagram_url',
            'facebook_url',
            'youtube_url',
        ];

        foreach ($keys as $key) {
            Setting::updateOrCreate(
                ['key_name' => $key],
                ['value' => $request->input($key, '')]
            );
        }

        return redirect()->route('admin.settings.index')->with('success', 'Store settings updated successfully.');
    }
}