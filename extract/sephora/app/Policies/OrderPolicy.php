<?php

namespace App\Policies;

use App\Models\Order;
use App\Models\User;

class OrderPolicy extends PanelPolicy
{
    public function viewAny(User $user): bool
    {
        return $this->isStaff($user);
    }

    public function view(User $user, Order $order): bool
    {
        return $this->isStaff($user);
    }

    /**
     * Support may move orders through fulfilment (including cancellation),
     * but money movement is restricted to administrators and managers.
     */
    public function updateStatus(User $user, Order $order): bool
    {
        return $this->isStaff($user);
    }

    public function refund(User $user, Order $order): bool
    {
        return $this->managesContent($user);
    }

    /**
     * Editing fulfilment details (tracking, addresses) follows the same
     * rule as status changes.
     */
    public function update(User $user, Order $order): bool
    {
        return $this->isStaff($user);
    }

    /**
     * Orders are financial records — hard deletes are an admin decision,
     * and the audit log keeps the trail.
     */
    public function delete(User $user, Order $order): bool
    {
        return $this->isAdmin($user);
    }

    public function deleteAny(User $user): bool
    {
        return $this->isAdmin($user);
    }

    /**
     * CSV exports contain customer PII but are part of daily operations.
     */
    public function export(User $user): bool
    {
        return $this->isStaff($user);
    }
}
