<?php

namespace App\Policies;

use App\Models\Cart;
use App\Models\User;

class CartPolicy extends PanelPolicy
{
    /**
     * Carts are operational debugging data — support may inspect them to
     * resolve customer issues, but only managers may remove abandoned ones.
     */
    public function viewAny(User $user): bool
    {
        return $this->isStaff($user);
    }

    public function view(User $user, Cart $cart): bool
    {
        return $this->isStaff($user);
    }

    public function create(User $user): bool
    {
        return $this->managesContent($user);
    }

    public function update(User $user, Cart $cart): bool
    {
        return $this->managesContent($user);
    }

    public function delete(User $user, Cart $cart): bool
    {
        return $this->managesContent($user);
    }

    public function deleteAny(User $user): bool
    {
        return $this->managesContent($user);
    }
}
