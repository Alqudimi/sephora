<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|min:2|max:120',
            'email' => 'required|email|max:190|unique:users,email',
            'phone' => 'nullable|string|max:40',
            'password' => 'required|string|min:8|confirmed',
        ], [
            'name.required' => 'Please tell us your name.',
            'email.required' => 'Please enter your email address.',
            'email.unique' => 'An account with this email already exists. Please sign in instead.',
            'password.required' => 'Please create a password.',
            'password.min' => 'Your password must be at least 8 characters.',
            'password.confirmed' => 'Passwords do not match.',
        ]);

        $oldSessionId = $request->session()->getId();

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'phone' => $validated['phone'] ?? null,
            'password' => Hash::make($validated['password']),
            'loyalty_tier' => 'member',
            'loyalty_points' => 0,
        ]);

        Auth::login($user, true);
        Cart::claimGuestCart($oldSessionId, (int) $user->id);
        $request->session()->regenerate();

        return redirect()->route('account.dashboard')->with('welcome', true);
    }
}
