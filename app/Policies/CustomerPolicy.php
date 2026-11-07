<?php

namespace App\Policies;

use App\Models\User;

class CustomerPolicy extends PanelPolicy
{
    /**
     * The customer resource manages App\Models\User records.
     *
     * Support needs read access to resolve orders and tickets; profile
     * edits belong to managers; deleting accounts is an admin decision.
     */
    public function viewAny(User $user): bool
    {
        return $this->isStaff($user);
    }

    public function view(User $user, User $record): bool
    {
        return $this->isStaff($user);
    }

    public function create(User $user): bool
    {
        return $this->managesContent($user);
    }

    public function update(User $user, User $record): bool
    {
        return $this->managesContent($user);
    }

    public function delete(User $user, User $record): bool
    {
        return $this->isAdmin($user);
    }

    public function deleteAny(User $user): bool
    {
        return $this->isAdmin($user);
    }

    /**
     * Customer CSV exports contain PII — managers and admins only.
     */
    public function export(User $user): bool
    {
        return $this->managesContent($user);
    }

    /**
     * Staff accounts must never be edited or deleted from the customer
     * resource — use role management instead.
     */
    public function replicate(User $user, User $record): bool
    {
        return $this->isAdmin($user);
    }
}
