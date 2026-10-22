<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Setting;

class StoreSettingsSeeder extends Seeder
{
    public function run(): void
    {
        $settings = [
            'site_name' => 'Classio',
            'tagline' => 'Inspired By You',
            'store_address' => '77, near Jaleshwar mandir, near Blinkit Office, LIC Colony, Jogipur, Kankarbagh, Bankman Colony, Patna, Bihar 800026',
            'google_maps_url' => 'https://maps.app.goo.gl/oziQjtasd953vBiY7',
            'contact_phone' => '+91 95765 17660',
            'whatsapp_number' => '+91 95765 17660',
            'contact_email' => 'support@classio.com',
            'instagram_url' => 'https://www.instagram.com/_classio_07_/',
            'facebook_url' => 'https://www.facebook.com/profile.php?id=61585512925640',
            'youtube_url' => 'https://youtube.com/@classio',
        ];

        foreach ($settings as $key => $value) {
            Setting::updateOrCreate(
                ['key_name' => $key],
                ['value' => $value]
            );
        }

        $this->command->info('Classio store settings seeded successfully!');
    }
}
