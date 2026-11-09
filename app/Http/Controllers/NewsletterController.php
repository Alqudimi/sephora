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

        $subscriber = NewsletterSubscriber::firstOrCreate(
            ['email' => strtolower($validated['email'])],
            ['source' => 'footer', 'subscribed_at' => now()]
        );

        if ($subscriber->wasRecentlyCreated) {
            try {
                \Illuminate\Support\Facades\Mail::to($subscriber->email)
                    ->send(new \App\Mail\NewsletterWelcomeMail($subscriber));
            } catch (\Throwable $e) {
                \Illuminate\Support\Facades\Log::warning('Newsletter welcome email failed: '.$e->getMessage());
            }
        }

        return response()->json([
            'success' => true,
            'message' => 'Welcome to the Sephora inner circle — check your inbox soon.',
        ]);
    }
}
