<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Read/write model over Laravel's failed_jobs table so the admin panel
 * can list, retry and discard queue failures.
 */
class FailedJob extends Model
{
    public const UPDATED_AT = null;

    protected $table = 'failed_jobs';

    protected $guarded = [];

    protected function casts(): array
    {
        return [
            'failed_at' => 'datetime',
        ];
    }
}
