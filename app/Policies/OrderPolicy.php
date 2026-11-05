<?php

namespace App\Policies;

use App\Models\Order;
use App\Models\User;

class OrderPolicy
{
    public function viewAny(User $user): bool
    {
        return $user->isStaff();
    }

    public function view(User $user, Order $order): bool
    {
        return $user->isStaff();
    }

    /**
     * Support may move orders through fulfilment (including cancellation),
     * but money movement is restricted to administrators and managers.
     */
    public function updateStatus(User $user, Order $order): bool
    {
        return $user->isStaff();
    }

    public function refund(User $user, Order $order): bool
    {
        return (bool) $user->is_admin || $user->hasRole('admin', 'manager');
    }
}
