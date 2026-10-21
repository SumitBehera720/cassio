<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;
use App\Models\Category;
use App\Models\Product;

class AdminTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_requires_authentication()
    {
        $response = $this->get('/admin/dashboard');
        $response->assertRedirect('/admin/login');
    }

    public function test_admin_dashboard_loads_for_authenticated_user()
    {
        $admin = User::create(['name' => 'Admin', 'email' => 'admin2@classio.com', 'password' => bcrypt('password')]);
        
        $response = $this->actingAs($admin)->get('/admin/dashboard');
        $response->assertStatus(200);
    }

    public function test_category_crud_authorization()
    {
        $admin = User::create(['name' => 'Admin', 'email' => 'admin3@classio.com', 'password' => bcrypt('password')]);

        // Unauthenticated denied
        $response = $this->post('/admin/categories', ['name' => 'Test']);
        $response->assertRedirect('/admin/login');

        // Admin allowed
        $response = $this->actingAs($admin)->post('/admin/categories', ['name' => 'Test', 'slug' => 'test-cat']);
        $response->assertRedirect();
        $this->assertDatabaseHas('categories', ['name' => 'Test']);
    }

    public function test_product_crud_authorization()
    {
        $admin = User::create(['name' => 'Admin', 'email' => 'admin4@classio.com', 'password' => bcrypt('password')]);
        $category = Category::create(['name' => 'Cat', 'slug' => 'cat']);

        // Admin allowed
        $response = $this->actingAs($admin)->post('/admin/products', [
            'name' => 'Test Product',
            'category_id' => $category->id,
            'status' => 'active'
        ]);
        
        $response->assertRedirect();
        $this->assertDatabaseHas('products', ['name' => 'Test Product']);
    }
}
