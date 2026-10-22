<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class PageController extends Controller
{
    private function getCategories()
    {
        return Category::where('is_active', true)->orderBy('sort_order')->get();
    }

    public function about()
    {
        $categories = $this->getCategories();
        return view('frontend.pages.about', compact('categories'));
    }

    public function contact()
    {
        $categories = $this->getCategories();
        return view('frontend.pages.contact', compact('categories'));
    }

    public function contactSubmit(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|email|max:150',
            'phone' => 'nullable|string|max:20',
            'subject' => 'required|string|max:150',
            'message' => 'required|string|max:2000',
        ]);

        return back()->with('success', 'Thank you for reaching out to Classio! Our luxury concierge team has received your message and will respond within 24 hours.');
    }

    public function stores()
    {
        $categories = $this->getCategories();
        return view('frontend.pages.stores', compact('categories'));
    }

    public function customerService()
    {
        $categories = $this->getCategories();
        return view('frontend.pages.customer-service', compact('categories'));
    }

    public function faq()
    {
        $categories = $this->getCategories();
        return view('frontend.pages.faq', compact('categories'));
    }

    public function trackOrder(Request $request)
    {
        $categories = $this->getCategories();
        $trackingNumber = trim($request->get('order_id', ''));
        return view('frontend.pages.track-order', compact('categories', 'trackingNumber'));
    }

    public function shippingPolicy()
    {
        $categories = $this->getCategories();
        return view('frontend.pages.shipping-policy', compact('categories'));
    }

    public function returnPolicy()
    {
        $categories = $this->getCategories();
        return view('frontend.pages.return-policy', compact('categories'));
    }

    public function privacyPolicy()
    {
        $categories = $this->getCategories();
        return view('frontend.pages.privacy-policy', compact('categories'));
    }

    public function terms()
    {
        $categories = $this->getCategories();
        return view('frontend.pages.terms', compact('categories'));
    }

    public function sizeGuide()
    {
        $categories = $this->getCategories();
        return view('frontend.pages.size-guide', compact('categories'));
    }
}
