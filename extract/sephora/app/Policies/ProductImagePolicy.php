<?php

namespace App\Policies;

use App\Models\ProductImage;
use App\Models\User;

class ProductImagePolicy extends PanelPolicy
{
    /**
     * Guards the images relation manager on the product edit page — it
     * must mirror the product permissions.
     */
    public function viewAny(User $user): bool
    {
        return $this->isStaff($user);
    }

    public function view(User $user, ProductImage $image): bool
    {
        return $this->isStaff($user);
    }

    public function create(User $user): bool
    {
        return $this->managesContent($user);
    }

    public function update(User $user, ProductImage $image): bool
    {
        return $this->managesContent($user);
    }

    public function delete(User $user, ProductImage $image): bool
    {
        return $this->managesContent($user);
    }

    public function deleteAny(User $user): bool
    {
        return $this->managesContent($user);
    }
}
