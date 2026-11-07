<?php

namespace App\Policies;

use App\Models\Consent;
use App\Models\User;

class ConsentPolicy extends PanelPolicy
{
    /**
     * Cookie/privacy consents are GDPR-grade personal data — hard admins
     * only, with no delete shortcut (retention is handled by the app).
     */
    public function viewAny(User $user): bool
    {
        return $this->isAdmin($user);
    }

    public function view(User $user, Consent $consent): bool
    {
        return $this->isAdmin($user);
    }

    public function create(User $user): bool
    {
        return false;
    }

    public function update(User $user, Consent $consent): bool
    {
        return false;
    }

    public function delete(User $user, Consent $consent): bool
    {
        return $this->isAdmin($user);
    }

    public function deleteAny(User $user): bool
    {
        return $this->isAdmin($user);
    }
}
