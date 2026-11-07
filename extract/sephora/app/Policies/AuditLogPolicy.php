<?php

namespace App\Policies;

use App\Models\AuditLog;
use App\Models\User;

class AuditLogPolicy extends PanelPolicy
{
    /**
     * The global audit trail is admin-only; the per-order relation
     * manager exposes individual entries to staff for context, which is
     * why `view` is wider than `viewAny`.
     */
    public function viewAny(User $user): bool
    {
        return $this->isAdmin($user);
    }

    public function view(User $user, AuditLog $auditLog): bool
    {
        return $this->isStaff($user);
    }

    public function create(User $user): bool
    {
        return false;
    }

    public function update(User $user, AuditLog $auditLog): bool
    {
        return false;
    }

    /**
     * Audit entries are append-only; even admins may not rewrite history.
     */
    public function delete(User $user, AuditLog $auditLog): bool
    {
        return false;
    }

    public function deleteAny(User $user): bool
    {
        return false;
    }
}
