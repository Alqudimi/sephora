<?php

namespace App\Filament\Resources\ProductResource\Pages;

use App\Filament\Resources\ProductResource;
use Filament\Actions\Action;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditProduct extends EditRecord
{
    protected static string $resource = ProductResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Action::make('viewInStore')
                ->label('View in store')
                ->icon('heroicon-o-arrow-top-right-on-square')
                ->url(fn () => url('/products/'.$this->getRecord()->slug))
                ->openUrlInNewTab(),
            DeleteAction::make(),
        ];
    }
}
