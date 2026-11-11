<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\User;
use App\Services\Consent\ConsentRecorder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    public function register(Request $request, ConsentRecorder $consents)
    {
        $validated = $request->validate([
            'name' => 'required|string|min:2|max:120',
            'email' => 'required|email|max:190|unique:users,email',
            'phone' => 'nullable|string|max:40',
            'password' => 'required|string|min:8|confirmed',
            'marketing_email' => 'sometimes|boolean',
        ], [
            'name.required' => __('runtime.tell_name'),
            'email.required' => __('runtime.enter_email'),
            'email.unique' => __('runtime.email_exists'),
            'password.required' => __('runtime.create_password'),
            'password.min' => __('runtime.password_min'),
            'password.confirmed' => __('runtime.password_mismatch'),
        ]);

        $oldSessionId = $request->session()->getId();
        $marketingOptIn = $request->boolean('marketing_email');

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'phone' => $validated['phone'] ?? null,
            'password' => Hash::make($validated['password']),
            'loyalty_tier' => 'member',
            'loyalty_points' => 0,
            'marketing_preferences' => ['email' => $marketingOptIn],
        ]);

        if ($marketingOptIn) {
            $consents->record($request, $user, 'marketing', true);
        }

        Auth::login($user, true);
        Cart::claimGuestCart($oldSessionId, (int) $user->id);
        $request->session()->regenerate();

        // The account works right away, but the address must be proven before
        // it can receive security notifications.
        $user->sendEmailVerificationNotification();

        return redirect()->route('account.dashboard')->with('welcome', true);
    }
}
