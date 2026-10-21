<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class WishlistController extends Controller
{
    public function index()
    {
        $categories = Category::where('is_active', true)->orderBy('sort_order')->get();
        return view('frontend.wishlist', compact('categories'));
    }

    public function getProducts(Request $request)
    {
        $ids = $request->query('ids', '');
        if (empty($ids)) {
            return response()->json(['products' => []]);
        }
        
        $idArray = explode(',', $ids);
        
        // Limit to 50 items to prevent abuse
        $idArray = array_slice($idArray, 0, 50);

        // Ensure all are integers to prevent any injection/error
        $idArray = array_map('intval', $idArray);

        $products = Product::whereIn('id', $idArray)
            ->where('status', 'active')
            ->with([
                'images' => function($q) {
                    $q->orderBy('sort_order', 'asc')->orderBy('id', 'asc');
                },
                'variants' => function($q) {
                    $q->orderBy('is_default', 'desc')->orderBy('id', 'asc');
                }
            ])
            ->get();
            
        // Return fully rendered product cards as HTML or JSON? JSON is easier.
        // Wait, the wishlist.blade.php uses `<x-product-card>` component. We can't render blade component purely from JSON on client side easily unless we build the HTML.
        // If we want to reuse `<x-product-card>`, we can render the HTML on the server and return it!
        // That is very robust and avoids duplicating the card UI in Alpine.
        
        $html = '';
        foreach ($products as $product) {
            $html .= view('components.product-card', ['product' => $product])->render();
        }

        // We also need to return the valid IDs so the client can clean up its localStorage
        $validIds = $products->pluck('id')->toArray();

        return response()->json([
            'html' => $html,
            'valid_ids' => $validIds
        ]);
    }
}
