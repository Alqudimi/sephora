<?php

namespace App\Policies;

use App\Models\Offer;
use App\Models\User;

class OfferPolicy extends PanelPolicy
{
    public function viewAny(User $user): bool
    {
        return $this->isStaff($user);
    }

    public function view(User $user, Offer $offer): bool
    {
        return $this->isStaff($user);
    }

    public function create(User $user): bool
    {
        return $this->managesContent($user);
    }

    public function update(User $user, Offer $offer): bool
    {
        return $this->managesContent($user);
    }

    public function delete(User $user, Offer $offer): bool
    {
        return $this->managesContent($user);
    }

    public function deleteAny(User $user): bool
    {
        return $this->managesContent($user);
    }

    public function replicate(User $user, Offer $offer): bool
    {
        return $this->managesContent($user);
    }
}
