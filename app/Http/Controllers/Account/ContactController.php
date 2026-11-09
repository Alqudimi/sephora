<?php

namespace App\Http\Controllers\Account;

use App\Http\Controllers\Controller;
use App\Jobs\SendContactAlertJob;
use App\Models\ContactMessage;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index()
    {
        return view('account.contact-us');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:120',
            'email' => 'required|email|max:190',
            'phone' => 'nullable|string|max:40',
            'subject' => 'nullable|string|max:150',
            'message' => 'required|string|min:10|max:4000',
        ]);

        $contactRecord = ContactMessage::create($validated + ['status' => 'new']);

        SendContactAlertJob::dispatch($contactRecord);

        return back()->with('contact_success', true);
    }
}
