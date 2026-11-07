<?php

namespace App\Policies;

use App\Models\User;

/**
 * Staff account management is a hard-admin capability. Destructive and
 * session-related abilities additionally refuse the acting user's own
 * account so an admin can never lock themselves out.
 */
class StaffPolicy extends PanelPolicy
{
    public function viewAny(User $user): bool
    {
        return $this->isAdmin($user);
    }

    public function view(User $user, User $staff): bool
    {
        return $this->isAdmin($user);
    }

    public function create(User $user): bool
    {
        return $this->isAdmin($user);
    }

    public function update(User $user, User $staff): bool
    {
        return $this->isAdmin($user);
    }

    public function delete(User $user, User $staff): bool
    {
        return $this->isAdmin($user)
            && $staff->isNot($user)
            && ! $this->isLastAdministrator($staff);
    }

    public function deleteAny(User $user): bool
    {
        return $this->isAdmin($user);
    }

    public function forceLogout(User $user, User $staff): bool
    {
        return $this->isAdmin($user) && $staff->isNot($user);
    }

    public function resetTwoFactor(User $user, User $staff): bool
    {
        return $this->isAdmin($user);
    }

    /**
     * Guard: the account being changed is the only remaining administrator.
     */
    public function isLastAdministrator(User $staff): bool
    {
        if (! $staff->isAdmin()) {
            return false;
        }

        $administrators = User::query()
            ->whereKeyNot($staff->getKey())
            ->where(fn ($query) => $query
                ->where('role', 'admin')
                ->orWhere('is_admin', true))
            ->count();

        return $administrators === 0;
    }
}
