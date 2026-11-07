<?php

namespace App\Policies;

use App\Models\Product;
use App\Models\User;

class ProductPolicy extends PanelPolicy
{
    /**
     * Every staff role may browse the catalogue from the admin panel.
     */
    public function viewAny(User $user): bool
    {
        return $user->isStaff();
    }

    public function view(User $user, Product $product): bool
    {
        return $user->isStaff();
    }

    /**
     * Only administrators and managers may change the catalogue; support
     * keeps read-only visibility.
     */
    public function create(User $user): bool
    {
        return $this->managesContent($user);
    }

    public function update(User $user, Product $product): bool
    {
        return $this->managesContent($user);
    }

    public function delete(User $user, Product $product): bool
    {
        return $this->managesContent($user);
    }

    public function deleteAny(User $user): bool
    {
        return $this->managesContent($user);
    }

    public function replicate(User $user, Product $product): bool
    {
        return $this->managesContent($user);
    }

    /**
     * CSV exports of the catalogue are read operations — any staff
     * member who can browse products can export them.
     */
    public function export(User $user): bool
    {
        return $this->isStaff($user);
    }
}
