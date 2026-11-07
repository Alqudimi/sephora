<?php

namespace App\Filament\Resources\ContactMessageResource\Pages;

use App\Filament\Resources\ContactMessageResource;
use Filament\Actions\Action;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\ViewRecord;

class ViewContactMessage extends ViewRecord
{
    protected static string $resource = ContactMessageResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Action::make('reply')
                ->icon('heroicon-o-paper-airplane')
                ->color('success')
                ->url(fn (): string => 'mailto:'.$this->getRecord()->email.'?subject=Re: '.rawurlencode($this->getRecord()->subject))
                ->openUrlInNewTab(),

            Action::make('markReplied')
                ->icon('heroicon-o-check-circle')
                ->color('success')
                ->requiresConfirmation()
                ->action(function (): void {
                    $this->getRecord()->update(['status' => 'replied']);
                }),

            DeleteAction::make(),
        ];
    }

    protected function afterFill(): void
    {
        if ($this->getRecord()->status === 'new') {
            $this->getRecord()->update(['status' => 'read']);
        }
    }
}
