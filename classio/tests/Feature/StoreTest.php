<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductVariant;

class StoreTest extends TestCase
{
    use RefreshDatabase;

    public function test_homepage_loads()
    {
        $response = $this->get('/');
        $response->assertStatus(200);
    }

    public function test_active_category_loads()
    {
        $category = Category::create(['name' => 'Active Cat', 'slug' => 'active-cat', 'is_active' => true]);
        $response = $this->get("/category/{$category->slug}");
        $response->assertStatus(200);
    }

    public function test_inactive_category_returns_404()
    {
        $category = Category::create(['name' => 'Inactive Cat', 'slug' => 'inactive-cat', 'is_active' => false]);
        $response = $this->get("/category/{$category->slug}");
        $response->assertStatus(404);
    }

    public function test_active_product_loads()
    {
        $category = Category::create(['name' => 'Cat', 'slug' => 'cat', 'is_active' => true]);
        $product = Product::create(['name' => 'Active Prod', 'slug' => 'active-prod', 'category_id' => $category->id, 'status' => 'active']);
        
        $response = $this->get("/product/{$product->slug}");
        $response->assertStatus(200);
    }

    public function test_inactive_product_returns_404()
    {
        $category = Category::create(['name' => 'Cat', 'slug' => 'cat', 'is_active' => true]);
        $product = Product::create(['name' => 'Draft Prod', 'slug' => 'draft-prod', 'category_id' => $category->id, 'status' => 'inactive']);
        
        $response = $this->get("/product/{$product->slug}");
        $response->assertStatus(404);
    }

    public function test_cart_validation_rejects_invalid_product()
    {
        $response = $this->postJson('/cart/validate', [
            'items' => [
                ['product_id' => 9999, 'variant_id' => 9999, 'quantity' => 1]
            ]
        ]);
        
        $response->assertStatus(200);
        $this->assertEquals(0, count($response->json('validated_items')));
    }

    public function test_cart_validation_rejects_out_of_stock_variant()
    {
        $category = Category::create(['name' => 'Cat', 'slug' => 'cat', 'is_active' => true]);
        $product = Product::create(['name' => 'Prod', 'slug' => 'prod', 'category_id' => $category->id, 'status' => 'active']);
        $variant = ProductVariant::create([
            'sku' => 'SKU1',
            'product_id' => $product->id, 
            'availability' => 'out_of_stock',
            'price' => 100
        ]);

        $response = $this->postJson('/cart/validate', [
            'items' => [
                ['product_id' => $product->id, 'variant_id' => $variant->id, 'quantity' => 1]
            ]
        ]);

        $response->assertStatus(200);
        $this->assertEquals(0, count($response->json('validated_items')));
    }

    public function test_cart_validation_uses_current_database_price()
    {
        $category = Category::create(['name' => 'Cat', 'slug' => 'cat', 'is_active' => true]);
        $product = Product::create(['name' => 'Prod', 'slug' => 'prod', 'category_id' => $category->id, 'status' => 'active']);
        $variant = ProductVariant::create([
            'sku' => 'SKU2',
            'product_id' => $product->id, 
            'availability' => 'in_stock',
            'price' => 500
        ]);

        $response = $this->postJson('/cart/validate', [
            'items' => [
                ['product_id' => $product->id, 'variant_id' => $variant->id, 'quantity' => 2, 'unit_price' => 100]
            ]
        ]);

        $response->assertStatus(200);
        $validItems = $response->json('validated_items');
        $this->assertEquals(1, count($validItems));
        $this->assertEquals(500, $validItems[0]['unit_price']);
    }

    public function test_wishlist_product_resolver_excludes_inactive_products()
    {
        $category = Category::create(['name' => 'Cat', 'slug' => 'cat', 'is_active' => true]);
        $activeProduct = Product::create(['name' => 'Prod1', 'slug' => 'prod1', 'category_id' => $category->id, 'status' => 'active']);
        $inactiveProduct = Product::create(['name' => 'Prod2', 'slug' => 'prod2', 'category_id' => $category->id, 'status' => 'inactive']);

        $response = $this->getJson("/wishlist/products?ids={$activeProduct->id},{$inactiveProduct->id}");
        
        $response->assertStatus(200);
        $validIds = $response->json('valid_ids');
        
        $this->assertContains($activeProduct->id, $validIds);
        $this->assertNotContains($inactiveProduct->id, $validIds);
    }
}
