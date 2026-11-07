<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PaymentWebhookEventResource\Pages;
use App\Models\PaymentWebhookEvent;
use App\Services\Payments\WebhookProcessor;
use Filament\Actions\Action;
use Filament\Actions\ActionGroup;
use Filament\Notifications\Notification;
use Filament\Resources\Resource;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\TernaryFilter;
use Filament\Tables\Table;

class PaymentWebhookEventResource extends Resource
{
    protected static ?string $model = PaymentWebhookEvent::class;

    protected static string|\BackedEnum|null $navigationIcon = Heroicon::OutlinedSignal;

    protected static string|\UnitEnum|null $navigationGroup = 'System';

    protected static ?int $navigationSort = 4;

    public static function canCreate(): bool
    {
        return false;
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('created_at')
                    ->dateTime('d M Y, H:i:s')
                    ->sortable(),

                TextColumn::make('gateway')
                    ->badge()
                    ->color('info'),

                TextColumn::make('event_id')
                    ->copyable()
                    ->limit(25),

                TextColumn::make('type')
                    ->badge(),

                IconColumn::make('processed_at')
                    ->label('Processed')
                    ->boolean()
                    ->trueIcon('heroicon-o-check-circle')
                    ->falseIcon('heroicon-o-clock'),

                TextColumn::make('payload')
                    ->formatStateUsing(fn ($state): string => is_array($state) ? json_encode($state) : (string) $state)
                    ->limit(60)
                    ->toggleable(),
            ])
            ->filters([
                SelectFilter::make('gateway')
                    ->options(fn (): array => PaymentWebhookEvent::query()
                        ->select('gateway')
                        ->distinct()
                        ->pluck('gateway', 'gateway')
                        ->all()),

                TernaryFilter::make('processed_at')
                    ->label('Processed')
                    ->nullable()
                    ->queries(
                        true: fn ($query) => $query->whereNotNull('processed_at'),
                        false: fn ($query) => $query->whereNull('processed_at'),
                    ),
            ])
            ->actions([
                ActionGroup::make([
                    Action::make('view')
                        ->label('View payload')
                        ->icon('heroicon-o-eye')
                        ->modalContent(fn (PaymentWebhookEvent $record): string => '<pre class="max-h-96 overflow-auto rounded bg-gray-100 p-4 text-xs dark:bg-gray-800">'
                            .json_encode($record->payload, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES)
                            .'</pre>')
                        ->modalSubmitAction(false)
                        ->modalCancelActionLabel('Close'),

                    Action::make('reprocess')
                        ->label('Reprocess')
                        ->icon('heroicon-o-arrow-path')
                        ->color('warning')
                        ->requiresConfirmation()
                        ->modalDescription('Runs the stored payload through the webhook processor again (payment marked as paid when the order is still pending). Already-processed events are skipped.')
                        ->visible(fn (PaymentWebhookEvent $record): bool => $record->processed_at === null)
                        ->action(function (PaymentWebhookEvent $record): void {
                            $result = app(WebhookProcessor::class)->process($record);

                            Notification::make()
                                ->title($result['applied']
                                    ? 'Order payment applied'
                                    : 'Event processed')
                                ->body($result['applied']
                                    ? "Order {$result['order_number']} marked as paid."
                                    : 'No payment change was required for this event.')
                                ->success()
                                ->send();
                        }),
                ]),
            ])
            ->defaultSort('created_at', 'desc');
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPaymentWebhookEvents::route('/'),
        ];
    }
}
