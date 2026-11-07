<?php

namespace App\Policies;

use App\Models\User;

/**
 * Shared role helpers for admin panel policies.
 *
 * Role model:
 *  - admin    — full access (role "admin" or the legacy is_admin flag)
 *  - manager  — catalogue, marketing, orders, refunds, customers, content
 *  - support  — read-only operations + order fulfilment + review moderation
 */
abstract class PanelPolicy
{
    /**
     * Every staff role (admin, manager, support) — read access to
     * operational data.
     */
    protected function isStaff(User $user): bool
    {
        return $user->isStaff();
    }

    /**
     * Roles allowed to change catalogue, marketing and content data.
     */
    protected function managesContent(User $user): bool
    {
        return $user->isAdmin() || $user->hasRole('manager');
    }

    /**
     * Hard admins only — privacy data, audit logs, destructive actions.
     */
    protected function isAdmin(User $user): bool
    {
        return $user->isAdmin();
    }
}
