<?php

namespace App\Policies;

use App\Models\ProductShade;
use App\Models\User;

class ProductShadePolicy extends PanelPolicy
{
    /**
     * Guards the shades relation manager on the product edit page — it
     * must mirror the product permissions.
     */
    public function viewAny(User $user): bool
    {
        return $this->isStaff($user);
    }

    public function view(User $user, ProductShade $shade): bool
    {
        return $this->isStaff($user);
    }

    public function create(User $user): bool
    {
        return $this->managesContent($user);
    }

    public function update(User $user, ProductShade $shade): bool
    {
        return $this->managesContent($user);
    }

    public function delete(User $user, ProductShade $shade): bool
    {
        return $this->managesContent($user);
    }

    public function deleteAny(User $user): bool
    {
        return $this->managesContent($user);
    }
}
