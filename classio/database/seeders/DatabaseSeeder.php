<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Category;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder {
    public function run(): void {
        $adminEmail = env('ADMIN_EMAIL');
        $adminPassword = env('ADMIN_PASSWORD');

        if ($adminEmail && $adminPassword) {
            User::factory()->create([
                'name' => 'Admin',
                'email' => $adminEmail,
                'password' => bcrypt($adminPassword),
            ]);
        } elseif (app()->environment('local')) {
            User::factory()->create([
                'name' => 'Local Admin',
                'email' => 'admin@classio.com',
                'password' => bcrypt('password'),
            ]);
        }

        $categories = [
            'Ladies Collection', 'Gents Collection', 'Watches & Perfumes', 'Fashion Accessories',
            'Bags Collection', 'Footwear', 'Gifts & Accessories', 'Electronics & Audio',
            'New Arrivals', 'Offers & Deals'
        ];

        foreach ($categories as $cat) {
            Category::create([
                'name' => $cat,
                'slug' => Str::slug($cat)
            ]);
        }
    }
}
