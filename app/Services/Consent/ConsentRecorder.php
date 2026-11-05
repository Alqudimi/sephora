<?php

namespace App\Services\Consent;

use App\Models\Consent;
use App\Models\User;
use Illuminate\Http\Request;

class ConsentRecorder
{
    /**
     * Persist a consent decision as the audit trail. The user's
     * marketing_preferences column holds the latest state for quick reads;
     * this table keeps the history.
     */
    public function record(Request $request, User $user, string $type, bool $accepted, string $version = '1.0'): Consent
    {
        return Consent::create([
            'user_id' => $user->id,
            'email' => $user->email,
            'type' => $type,
            'version' => $version,
            'accepted' => $accepted,
            'ip_address' => $request->ip(),
            'accepted_at' => now(),
        ]);
    }
}
