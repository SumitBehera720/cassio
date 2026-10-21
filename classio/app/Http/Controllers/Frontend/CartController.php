<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\ProductVariant;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        $categories = Category::where('is_active', true)->orderBy('sort_order')->get();
        return view('frontend.cart', compact('categories'));
    }

    public function validateCart(Request $request)
    {
        $items = $request->input('items', []);
        
        $validatedItems = [];
        $invalidItems = [];
        $hasErrors = false;
        $totalAmount = 0;
        $totalQuantity = 0;

        foreach ($items as $item) {
            if (!isset($item['variant_id']) || !isset($item['quantity'])) {
                continue;
            }

            $variant = ProductVariant::with('product')
                ->where('id', $item['variant_id'])
                ->first();

            if (!$variant || !$variant->product) {
                $hasErrors = true;
                $invalidItems[] = [
                    'variant_id' => $item['variant_id'],
                    'reason' => 'Product or variant no longer exists.'
                ];
                continue; // Variant or product doesn't exist anymore
            }

            if ($variant->product->status !== 'active') {
                $hasErrors = true;
                $invalidItems[] = [
                    'variant_id' => $item['variant_id'],
                    'product_name' => $variant->product->name,
                    'reason' => 'Product is no longer available.'
                ];
                continue;
            }

            if ($variant->availability !== 'in_stock') {
                $hasErrors = true;
                $invalidItems[] = [
                    'variant_id' => $item['variant_id'],
                    'product_name' => $variant->product->name,
                    'reason' => 'Variant is currently out of stock.'
                ];
                continue;
            }

            // Trust the server's price
            $unitPrice = $variant->price;
            $quantity = max(1, (int)$item['quantity']);
            
            $subtotal = $unitPrice * $quantity;
            $totalAmount += $subtotal;
            $totalQuantity += $quantity;

            $validatedItems[] = [
                'product_id' => $variant->product->id,
                'product_name' => $variant->product->name,
                'product_slug' => $variant->product->slug,
                'variant_id' => $variant->id,
                'variant_sku' => $variant->sku,
                'size' => $variant->size,
                'color' => $variant->color,
                'quantity' => $quantity,
                'unit_price' => $unitPrice,
                'subtotal' => $subtotal,
                // We don't overwrite image from client, but we could if we wanted
                'image' => $item['image'] ?? null
            ];
        }

        $whatsappNumber = \App\Models\Setting::where('key_name', 'whatsapp_number')->value('value');
        $cleanNumber = $whatsappNumber ? preg_replace('/[^0-9]/', '', $whatsappNumber) : null;

        // Build WhatsApp Message
        $message = "Hi Classio,\n\nI would like to order the following products:\n\n";
        $i = 1;
        foreach ($validatedItems as $vItem) {
            $message .= "{$i}. {$vItem['product_name']}\n";
            $message .= "   SKU: {$vItem['variant_sku']}\n";
            
            $attrs = [];
            if ($vItem['size']) $attrs[] = "Size: " . $vItem['size'];
            if ($vItem['color']) $attrs[] = "Color: " . $vItem['color'];
            if (!empty($attrs)) {
                $message .= "   Variant: " . implode(" / ", $attrs) . "\n";
            }
            
            $message .= "   Qty: {$vItem['quantity']}\n";
            $message .= "   Price: ₹" . number_format($vItem['unit_price'], 2) . "\n";
            $message .= "   Subtotal: ₹" . number_format($vItem['subtotal'], 2) . "\n\n";
            $i++;
        }

        $message .= "Total Items: {$totalQuantity}\n";
        $message .= "Total Amount: ₹" . number_format($totalAmount, 2) . "\n\n";
        $message .= "Please confirm availability and order details.";

        $whatsappUrl = $cleanNumber ? "https://wa.me/{$cleanNumber}?text=" . rawurlencode($message) : null;

        return response()->json([
            'success' => true,
            'has_errors' => $hasErrors,
            'validated_items' => $validatedItems,
            'invalid_items' => $invalidItems,
            'whatsapp_url' => $whatsappUrl
        ]);
    }
}