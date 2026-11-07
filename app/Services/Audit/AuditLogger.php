<?php

namespace App\Services\Audit;

use App\Models\AuditLog;
use Illuminate\Database\Eloquent\Model;

/**
 * Central audit-trail writer so every admin surface (resources, pages,
 * bulk actions) records changes with the same shape as the order
 * workflow logs.
 */
class AuditLogger
{
    public static function log(
        Model $subject,
        string $action,
        array $oldValues = [],
        array $newValues = [],
        ?string $description = null,
    ): AuditLog {
        return AuditLog::create([
            'user_id' => auth()->id(),
            'action' => $action,
            'auditable_type' => $subject->getMorphClass(),
            'auditable_id' => $subject->getKey(),
            'description' => $description ?? $action,
            'ip_address' => request()?->ip(),
            'user_agent' => substr((string) request()?->userAgent(), 0, 500),
            'old_values' => $oldValues ?: null,
            'new_values' => $newValues ?: null,
        ]);
    }
}
