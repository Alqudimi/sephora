<?php

namespace App\Http\Controllers;

use App\Jobs\SendNewsletterWelcomeJob;
use App\Models\NewsletterSubscriber;
use Illuminate\Http\Request;

class NewsletterController extends Controller
{
    public function subscribe(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|email|max:190',
        ]);

        $subscriber = NewsletterSubscriber::firstOrCreate(
            ['email' => strtolower($validated['email'])],
            ['source' => 'footer', 'subscribed_at' => now()]
        );

        if ($subscriber->wasRecentlyCreated) {
            SendNewsletterWelcomeJob::dispatch($subscriber);
        }

        return response()->json([
            'success' => true,
            'message' => 'Welcome to the Sephora inner circle — check your inbox soon.',
        ]);
    }
}
