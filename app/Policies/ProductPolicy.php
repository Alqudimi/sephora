<?php

namespace App\Policies;

use App\Models\Product;
use App\Models\User;

class ProductPolicy
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
        return $this->managesCatalogue($user);
    }

    public function update(User $user, Product $product): bool
    {
        return $this->managesCatalogue($user);
    }

    public function delete(User $user, Product $product): bool
    {
        return $this->managesCatalogue($user);
    }

    private function managesCatalogue(User $user): bool
    {
        return (bool) $user->is_admin || $user->hasRole('admin', 'manager');
    }
}
