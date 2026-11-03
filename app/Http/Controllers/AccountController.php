<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AccountController extends Controller
{
    public function dashboard()
    {
        $user = auth()->user()->loadCount('orders');
        $orders = $user->orders()->latest()->limit(5)->get();
        return view('account.dashboard', ['user' => $user, 'orders' => $orders]);
    }

    public function orders()
    {
        $orders = auth()->user()->orders()->with('items')->latest()->paginate(10);
        return view('account.orders', ['orders' => $orders]);
    }

    public function orderShow(string $orderNumber)
    {
        $order = auth()->user()->orders()->with('items.product.images')->where('order_number', $orderNumber)->firstOrFail();
        return view('account.order-detail', ['order' => $order]);
    }

    public function settings()
    {
        return view('account.settings', ['user' => auth()->user()]);
    }

    public function updateSettings(Request $request)
    {
        $user = auth()->user();
        $validated = $request->validate([
            'name' => 'required|string|min:2|max:120',
            'email' => 'required|email|max:190|unique:users,email,' . $user->id,
            'phone' => 'nullable|string|max:40',
            'date_of_birth' => 'nullable|date|before:today',
            'gender' => 'nullable|in:female,male,other,prefer_not',
            'preferred_store' => 'nullable|string|max:120',
            'current_password' => 'nullable|required_with:new_password|string',
            'new_password' => 'nullable|required_with:current_password|string|min:8|confirmed',
        ]);

        if (!empty($validated['current_password'])) {
            if (!Hash::check($validated['current_password'], $user->password)) {
                return back()->withErrors(['current_password' => 'The current password is incorrect.']);
            }
            $validated['password'] = Hash::make($validated['new_password']);
        }
        unset($validated['current_password'], $validated['new_password'], $validated['new_password_confirmation']);

        $user->update($validated);
        return back()->with('settings_saved', true);
    }

    public function countryLanguage()
    {
        return view('account.country-language', ['user' => auth()->user()]);
    }

    public function updateCountryLanguage(Request $request)
    {
        $validated = $request->validate([
            'preferred_language' => 'required|in:en,ar,fr',
        ]);
        auth()->user()->update($validated);
        return back()->with('language_saved', true);
    }

    public function addresses()
    {
        return view('account.addresses', ['addresses' => auth()->user()->addresses]);
    }

    public function storeAddress(Request $request)
    {
        $validated = $request->validate([
            'label' => 'nullable|string|max:50',
            'full_name' => 'required|string|max:150',
            'phone' => 'required|string|max:40',
            'emirate' => 'required|string|max:100',
            'area' => 'nullable|string|max:150',
            'street_address' => 'required|string|max:400',
            'building' => 'nullable|string|max:150',
            'delivery_instructions' => 'nullable|string|max:500',
            'is_default' => 'nullable|boolean',
        ]);

        if (!empty($validated['is_default'])) {
            auth()->user()->addresses()->update(['is_default' => false]);
        }

        auth()->user()->addresses()->create($validated);
        return back()->with('address_saved', true);
    }
}
