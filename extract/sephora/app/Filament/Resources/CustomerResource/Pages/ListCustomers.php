<?php

namespace App\Filament\Resources\CustomerResource\Pages;

use App\Filament\Resources\CustomerResource;
use App\Models\User;
use Filament\Actions\Action;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;
use Symfony\Component\HttpFoundation\StreamedResponse;

class ListCustomers extends ListRecords
{
    protected static string $resource = CustomerResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),

            Action::make('exportCsv')
                ->label('Export CSV')
                ->icon('heroicon-o-arrow-down-tray')
                ->visible(fn (): bool => CustomerResource::canExport())
                ->action(fn () => $this->exportCsv()),
        ];
    }

    /**
     * Streaming CSV of the customer base (memory-safe for large datasets).
     */
    public function exportCsv(): StreamedResponse
    {
        $filename = 'customers-'.now()->format('Ymd-His').'.csv';

        return response()->streamDownload(function (): void {
            $out = fopen('php://output', 'w');
            fwrite($out, "\xEF\xBB\xBF");

            fputcsv($out, [
                'id', 'name', 'email', 'phone', 'loyalty_tier', 'loyalty_points',
                'orders', 'lifetime_value_aed', 'email_verified', 'marketing_preferences',
                'created_at',
            ]);

            // NULL-safe customer scope: staff = role in (admin, manager,
            // support) OR is_admin. Three-valued logic makes whereNot()
            // drop rows with NULL role, so match the complement directly.
            User::query()
                ->where(fn ($query) => $query
                    ->whereNull('role')
                    ->orWhereNotIn('role', ['admin', 'manager', 'support']))
                ->where(fn ($query) => $query
                    ->where('is_admin', false)
                    ->orWhereNull('is_admin'))
                ->withCount('orders')
                ->withSum('orders', 'total')
                ->orderBy('id')
                ->chunk(500, function ($customers) use ($out): void {
                    foreach ($customers as $customer) {
                        fputcsv($out, [
                            $customer->id,
                            $customer->name,
                            $customer->email,
                            $customer->phone,
                            $customer->loyalty_tier,
                            $customer->loyalty_points,
                            $customer->orders_count,
                            $customer->orders_sum_total,
                            $customer->email_verified_at ? 'yes' : 'no',
                            implode('|', $customer->marketing_preferences ?? []),
                            $customer->created_at?->format('Y-m-d H:i:s'),
                        ]);
                    }
                });

            fclose($out);
        }, $filename, [
            'Content-Type' => 'text/csv; charset=UTF-8',
        ]);
    }
}
