<?php

namespace App\Http\Controllers;

use App\Models\ContactMessage;
use App\Models\Faq;
use App\Models\Offer;
use App\Models\Product;
use App\Models\Store;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function home()
    {
        $holidayProducts = Product::active()
            ->whereHas('categories', fn ($q) => $q->where('slug', 'gifts'))
            ->with(['brand', 'images'])
            ->orderBy('sort_order')
            ->limit(4)
            ->get();

        $justDropped = Product::active()
            ->whereHas('categories', fn ($q) => $q->where('slug', 'new'))
            ->with(['brand', 'images'])
            ->orderBy('sort_order')
            ->limit(4)
            ->get();

        return view('pages.home', [
            'holidayProducts' => $holidayProducts->count() >= 4 ? $holidayProducts : Product::active()->with(['brand', 'images'])->orderBy('sort_order')->limit(4)->get(),
            'justDropped' => $justDropped->count() >= 4 ? $justDropped : Product::active()->with(['brand', 'images'])->orderByDesc('id')->limit(4)->get(),
        ]);
    }

    public function beautyOffers()
    {
        $offers = Offer::where('is_active', true)->orderBy('sort_order')->get();

        return view('pages.beauty-offers', ['offers' => $offers]);
    }

    public function beautyOffersAlt()
    {
        $offers = Offer::where('is_active', true)->orderBy('sort_order')->get();

        return view('pages.beauty-offers-alt', ['offers' => $offers]);
    }

    public function contact()
    {
        return view('pages.contact');
    }

    public function contactSubmit(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:120',
            'email' => 'required|email|max:190',
            'phone' => 'nullable|string|max:40',
            'subject' => 'nullable|string|max:150',
            'message' => 'required|string|max:4000',
        ]);

        ContactMessage::create($validated);

        if ($request->expectsJson()) {
            return response()->json(['success' => true, 'message' => 'Thank you! Our client concierge will reply within 24 hours.']);
        }

        return back()->with('contact_success', true);
    }

    public function stores()
    {
        $stores = Store::orderBy('sort_order')->get();

        return view('pages.stores', ['stores' => $stores]);
    }

    public function giftCards()
    {
        return view('pages.gift-cards');
    }

    public function giftCardBalance(Request $request)
    {
        $request->validate(['card_number' => 'required|string']);

        // Deterministic demo balance: a production build would call the gift-card provider API.
        $number = preg_replace('/\D/', '', $request->input('card_number'));
        $valid = strlen($number) === 16 && str_starts_with($number, '6046');

        return response()->json([
            'success' => true,
            'valid' => $valid,
            'balance' => $valid ? number_format((int) substr($number, -4) % 2500 + 50, 2) : '0.00',
            'message' => $valid ? 'Card is active.' : 'Card number not recognized. Please verify the 16-digit number.',
        ]);
    }

    public function downloadApp()
    {
        return view('pages.download-app');
    }

    public function cleanPlanetAware()
    {
        $cleanProducts = Product::active()->where('is_clean', true)->with(['brand', 'images'])->orderBy('sort_order')->limit(8)->get();

        return view('pages.clean', ['cleanProducts' => $cleanProducts]);
    }

    public function faq()
    {
        $faqs = Faq::category('general')->get();

        return view('pages.faq', ['faqs' => $faqs]);
    }

    public function faqDelivery()
    {
        $faqs = Faq::category('delivery')->get();

        return view('pages.faq-delivery', ['faqs' => $faqs]);
    }

    public function faqCancellation()
    {
        $faqs = Faq::category('cancellation_refund')->get();

        return view('pages.faq-cancellation', ['faqs' => $faqs]);
    }

    public function terms()
    {
        return view('pages.terms');
    }
}
