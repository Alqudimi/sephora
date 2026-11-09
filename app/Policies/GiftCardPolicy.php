<?php

namespace App\Policies;

use App\Models\GiftCard;
use App\Models\User;

class GiftCardPolicy extends PanelPolicy
{
    /**
     * Gift cards represent real monetary value — support may read them to assist
     * customers, but only managers and admins may create, update, or void them.
     */
    public function viewAny(User $user): bool
    {
        return $this->isStaff($user);
    }

    public function view(User $user, GiftCard $card): bool
    {
        return $this->isStaff($user);
    }

    public function create(User $user): bool
    {
        return $this->managesContent($user);
    }

    public function update(User $user, GiftCard $card): bool
    {
        return $this->managesContent($user);
    }

    public function delete(User $user, GiftCard $card): bool
    {
        return $this->managesContent($user);
    }

    public function deleteAny(User $user): bool
    {
        return $this->managesContent($user);
    }
}

