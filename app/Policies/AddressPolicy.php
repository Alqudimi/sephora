<?php

namespace App\Policies;

use App\Models\Address;
use App\Models\User;

class AddressPolicy extends PanelPolicy
{
    /**
     * Guards the addresses relation manager on the customer view page.
     */
    public function viewAny(User $user): bool
    {
        return $this->isStaff($user);
    }

    public function view(User $user, Address $address): bool
    {
        return $this->isStaff($user);
    }

    public function create(User $user): bool
    {
        return $this->managesContent($user);
    }

    public function update(User $user, Address $address): bool
    {
        return $this->managesContent($user);
    }

    public function delete(User $user, Address $address): bool
    {
        return $this->managesContent($user);
    }

    public function deleteAny(User $user): bool
    {
        return $this->managesContent($user);
    }
}
