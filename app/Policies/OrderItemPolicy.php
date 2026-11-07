<?php

namespace App\Policies;

use App\Models\OrderItem;
use App\Models\User;

class OrderItemPolicy extends PanelPolicy
{
    /**
     * Line items are financial history: staff may read them, but they
     * must never be mutated or removed after checkout — refunds and
     * cancellations go through the order state machine instead.
     */
    public function viewAny(User $user): bool
    {
        return $this->isStaff($user);
    }

    public function view(User $user, OrderItem $orderItem): bool
    {
        return $this->isStaff($user);
    }

    public function create(User $user): bool
    {
        return false;
    }

    public function update(User $user, OrderItem $orderItem): bool
    {
        return false;
    }

    public function delete(User $user, OrderItem $orderItem): bool
    {
        return $this->isAdmin($user);
    }

    public function deleteAny(User $user): bool
    {
        return $this->isAdmin($user);
    }
}
