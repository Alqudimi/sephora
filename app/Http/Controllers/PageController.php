<?php

namespace App\Http\Controllers;

use App\Jobs\SendContactAlertJob;
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
            ->where(function ($q) {
                $q->whereHas('categories', fn ($c) => $c->whereIn('slug', ['gifts', 'sets', 'minis-more']))
                  ->orWhere('name', 'like', '%Set%')
                  ->orWhere('name', 'like', '%Kit%')
                  ->orWhere('name', 'like', '%Vault%')
                  ->orWhere('name', 'like', '%Holiday%');
            })
            ->with(['brand', 'images'])
            ->orderBy('sort_order')
            ->limit(8)
            ->get();

        if ($holidayProducts->count() < 8) {
            $holidayProducts = Product::active()->with(['brand', 'images'])->orderBy('sort_order')->limit(8)->get();
        }

        $holidayIds = $holidayProducts->pluck('id')->all();

        $fragrances = Product::active()
            ->whereNotIn('id', $holidayIds)
            ->whereHas('categories', fn ($q) => $q->where('slug', 'fragrance'))
            ->where('name', 'not like', '%Gift Set%')
            ->with(['brand', 'images'])
            ->orderBy('sort_order')
            ->limit(8)
            ->get();

        if ($fragrances->count() < 8) {
            $fragrances = Product::active()->whereNotIn('id', $holidayIds)->whereHas('categories', fn ($q) => $q->where('slug', 'fragrance'))->with(['brand', 'images'])->limit(8)->get();
        }

        $usedIds = array_merge($holidayIds, $fragrances->pluck('id')->all());

        $bestsellers = Product::active()
            ->whereNotIn('id', $usedIds)
            ->where('is_bestseller', true)
            ->with(['brand', 'images'])
            ->orderBy('sort_order')
            ->limit(8)
            ->get();

        if ($bestsellers->count() < 8) {
            $bestsellers = Product::active()->whereNotIn('id', $usedIds)->where('rating', '>=', 4.0)->with(['brand', 'images'])->orderByDesc('reviews_count')->limit(8)->get();
        }

        $usedIds = array_merge($usedIds, $bestsellers->pluck('id')->all());

        $justDropped = Product::active()
            ->whereNotIn('id', $usedIds)
            ->where(function ($q) {
                $q->where('is_new', true)
                  ->orWhereHas('categories', fn ($c) => $c->where('slug', 'new'));
            })
            ->with(['brand', 'images'])
            ->orderByDesc('id')
            ->limit(8)
            ->get();

        if ($justDropped->count() < 8) {
            $justDropped = Product::active()->whereNotIn('id', $usedIds)->with(['brand', 'images'])->orderByDesc('id')->limit(8)->get();
        }

        $sephoraCollection = Product::active()
            ->whereHas('brand', fn ($q) => $q->where('name', 'like', '%Sephora Collection%'))
            ->with(['brand', 'images'])
            ->orderBy('sort_order')
            ->limit(8)
            ->get();

        if ($sephoraCollection->count() < 4) {
            $sephoraCollection = Product::active()->with(['brand', 'images'])->limit(8)->get();
        }

        $featuredBrands = \App\Models\Brand::whereIn('slug', [
            'kayali', 'huda-beauty', 'sephora-collection', 'chloe', 'color-wow',
            'starface', 'yves-saint-laurent', 'tarte', 'nars', 'fenty-beauty'
        ])->select('id', 'name', 'slug')->get();

        $offers = Offer::where('is_active', true)->orderBy('sort_order')->limit(12)->get();
        $heroBanners = \App\Models\Banner::position('hero_carousel')->active()->orderBy('sort_order')->get();

        return view('pages.home', [
            'holidayProducts' => $holidayProducts,
            'fragrances' => $fragrances,
            'bestsellers' => $bestsellers,
            'justDropped' => $justDropped,
            'sephoraCollection' => $sephoraCollection,
            'featuredBrands' => $featuredBrands,
            'offers' => $offers,
            'heroBanners' => $heroBanners,
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

        $contactRecord = ContactMessage::create($validated);

        SendContactAlertJob::dispatch($contactRecord);

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
        $request->validate([
            'card_number' => 'required|string',
            'card_pin' => 'nullable|string|max:8',
        ]);

        $rawNumber = (string) $request->input('card_number');
        $cleanNumber = preg_replace('/\D/', '', $rawNumber);
        $pin = (string) $request->input('card_pin', '');

        $card = \App\Models\GiftCard::where('code', $cleanNumber)
            ->orWhere('code', $rawNumber)
            ->first();

        if (! $card) {
            return response()->json([
                'success' => true,
                'valid' => false,
                'balance' => '0.00',
                'message' => 'Card number not recognized. Please verify your 16-digit card number.',
            ]);
        }

        if (! $card->is_active) {
            return response()->json([
                'success' => true,
                'valid' => false,
                'balance' => '0.00',
                'message' => 'This gift card is currently deactivated. Please contact client concierge.',
            ]);
        }

        if ($card->expires_at !== null && $card->expires_at->isPast()) {
            return response()->json([
                'success' => true,
                'valid' => false,
                'balance' => '0.00',
                'message' => 'This gift card expired on '.$card->expires_at->format('d M Y').'.',
            ]);
        }

        if ($card->pin !== null && $card->pin !== '' && $pin !== '') {
            if ($card->pin !== $pin) {
                return response()->json([
                    'success' => true,
                    'valid' => false,
                    'balance' => '0.00',
                    'message' => 'The security PIN entered is incorrect.',
                ]);
            }
        }

        return response()->json([
            'success' => true,
            'valid' => true,
            'balance' => number_format((float) $card->balance, 2),
            'currency' => $card->currency ?? 'AED',
            'expires_at' => $card->expires_at?->format('d M Y') ?? 'Never',
            'message' => 'Card is active and ready to spend.',
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
