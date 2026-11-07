<?php

namespace App\Http\Controllers;

use App\Models\NewsletterSubscriber;
use Illuminate\Http\Request;

class NewsletterController extends Controller
{
    public function subscribe(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|email|max:190',
        ]);

        NewsletterSubscriber::firstOrCreate(
            ['email' => strtolower($validated['email'])],
            ['source' => 'footer', 'subscribed_at' => now()]
        );

        return response()->json([
            'success' => true,
            'message' => 'Welcome to the Sephora inner circle — check your inbox soon.',
        ]);
    }
}
