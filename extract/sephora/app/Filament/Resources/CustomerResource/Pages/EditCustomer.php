<?php

namespace App\Filament\Resources\CustomerResource\Pages;

use App\Filament\Resources\CustomerResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditCustomer extends EditRecord
{
    protected static string $resource = CustomerResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }

    protected function mutateFormDataBeforeSave(array $data): array
    {
        // Never allow a staff member to accidentally revoke their own access.
        if (($data['is_admin'] ?? false) === false && $this->getRecord()->id === auth()->id()) {
            $data['is_admin'] = true;
        }

        return $data;
    }
}
