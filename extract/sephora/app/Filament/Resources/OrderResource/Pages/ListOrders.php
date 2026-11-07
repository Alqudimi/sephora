<?php

namespace App\Filament\Resources\OrderResource\Pages;

use App\Filament\Exports\OrderCsvExport;
use App\Filament\Resources\OrderResource;
use Filament\Actions\Action;
use Filament\Resources\Pages\ListRecords;

class ListOrders extends ListRecords
{
    protected static string $resource = OrderResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Action::make('exportCsv')
                ->label('Export CSV')
                ->icon('heroicon-o-arrow-down-tray')
                ->modalDescription('Exports every order matching the active table filters (or all orders when no filters are set).')
                ->action(function () {
                    $query = $this->getTableQuery();

                    return app(OrderCsvExport::class)->download($query);
                }),
        ];
    }

    public function getTitle(): string
    {
        return 'Orders';
    }
}
