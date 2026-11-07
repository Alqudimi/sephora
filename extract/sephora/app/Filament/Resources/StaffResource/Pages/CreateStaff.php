<?php

namespace App\Filament\Resources\StaffResource\Pages;

use App\Filament\Resources\StaffResource;
use Filament\Resources\Pages\CreateRecord;

class CreateStaff extends CreateRecord
{
    protected static string $resource = StaffResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        // New staff accounts always confirm their email + 2FA themselves.
        $data['email_verified_at'] ??= null;

        return $data;
    }

    protected function getRedirectUrl(): string
    {
        return StaffResource::getUrl('index');
    }
}
