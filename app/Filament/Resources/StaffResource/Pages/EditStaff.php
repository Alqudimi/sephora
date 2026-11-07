<?php

namespace App\Filament\Resources\StaffResource\Pages;

use App\Filament\Resources\StaffResource;
use App\Services\Audit\AuditLogger;
use Filament\Resources\Pages\EditRecord;

class EditStaff extends EditRecord
{
    protected static string $resource = StaffResource::class;

    protected function mutateFormDataBeforeSave(array $data): array
    {
        // Role demotion protection for self / last admin (belt & braces —
        // the form disables the fields, this guards crafted requests).
        $protected = StaffResource::isProtected($this->getRecord());

        if ($protected) {
            $data['role'] = $this->getRecord()->role;
            $data['is_admin'] = $this->getRecord()->is_admin;
        }

        return $data;
    }

    protected function afterSave(): void
    {
        AuditLogger::log(
            $this->getRecord(),
            'staff.updated',
            ['name' => $this->getRecord()->getOriginal('name'), 'email' => $this->getRecord()->getOriginal('email')],
            ['name' => $this->getRecord()->name, 'email' => $this->getRecord()->email, 'role' => $this->getRecord()->role],
            'Staff account '.$this->getRecord()->email.' updated',
        );
    }

    protected function getRedirectUrl(): string
    {
        return StaffResource::getUrl('index');
    }
}
