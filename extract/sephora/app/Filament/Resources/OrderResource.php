<?php

namespace App\Filament\Resources;

use App\Filament\Resources\OrderResource\Pages;
use App\Filament\Resources\OrderResource\RelationManagers;
use App\Models\Order;
use App\Services\Commerce\ShippingCalculator;
use App\Services\Orders\OrderStateMachine;
use Filament\Actions\ActionGroup;
use Filament\Actions\BulkAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ExportBulkAction;
use Filament\Actions\ViewAction;
use Filament\Forms\Components\DatePicker;
use Filament\Resources\Resource;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class OrderResource extends Resource
{
    protected static ?string $model = Order::class;

    protected static string|\BackedEnum|null $navigationIcon = Heroicon::OutlinedShoppingCart;

    protected static string|\UnitEnum|null $navigationGroup = 'Shop';

    protected static ?int $navigationSort = 1;

    protected static ?string $recordTitleAttribute = 'order_number';

    public static function getNavigationBadge(): ?string
    {
        $count = Order::query()
            ->whereIn('status', ['pending', 'processing'])
            ->count();

        return $count > 0 ? (string) $count : null;
    }

    public static function getNavigationBadgeColor(): ?string
    {
        return 'danger';
    }

    public static function statusColors(): array
    {
        return [
            'pending' => 'warning',
            'processing' => 'info',
            'shipped' => 'info',
            'out_for_delivery' => 'info',
            'delivered' => 'success',
            'cancelled' => 'danger',
            'refunded' => 'gray',
        ];
    }

    public static function paymentStatusColors(): array
    {
        return [
            'pending' => 'warning',
            'paid' => 'success',
            'failed' => 'danger',
            'refunded' => 'gray',
        ];
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('order_number')
                    ->searchable()
                    ->sortable()
                    ->copyable()
                    ->weight('bold'),

                TextColumn::make('customer_name')
                    ->searchable()
                    ->sortable()
                    ->description(fn (Order $record): string => $record->user
                        ? $record->customer_email
                        : ($record->guest_email ?? $record->customer_email).' (guest)'),

                TextColumn::make('items_count')
                    ->label('Items')
                    ->counts('items')
                    ->sortable(),

                TextColumn::make('total')
                    ->money('AED')
                    ->sortable(),

                TextColumn::make('status')
                    ->badge()
                    ->formatStateUsing(fn (string $state): string => str($state)->headline())
                    ->colors(static::statusColors())
                    ->sortable(),

                TextColumn::make('payment_status')
                    ->badge()
                    ->formatStateUsing(fn (string $state): string => str($state)->headline())
                    ->colors(static::paymentStatusColors()),

                TextColumn::make('payment_method')
                    ->formatStateUsing(fn (Order $record): string => $record->payment_method_label)
                    ->badge(),

                TextColumn::make('delivery_method')
                    ->formatStateUsing(fn (Order $record): string => app(ShippingCalculator::class)->label($record->delivery_method))
                    ->badge(),

                TextColumn::make('placed_at')
                    ->since()
                    ->sortable()
                    ->description(fn (Order $record): string => $record->placed_at?->format('d M Y, H:i') ?? '—'),
            ])
            ->filters([
                SelectFilter::make('status')
                    ->options([
                        'pending' => 'Pending',
                        'processing' => 'Processing',
                        'shipped' => 'Shipped',
                        'out_for_delivery' => 'Out for Delivery',
                        'delivered' => 'Delivered',
                        'cancelled' => 'Cancelled',
                        'refunded' => 'Refunded',
                    ])
                    ->multiple(),

                SelectFilter::make('payment_status')
                    ->options([
                        'pending' => 'Pending',
                        'paid' => 'Paid',
                        'failed' => 'Failed',
                        'refunded' => 'Refunded',
                    ])
                    ->multiple(),

                SelectFilter::make('payment_method')
                    ->options([
                        'card' => 'Card',
                        'apple_pay' => 'Apple Pay',
                        'tabby' => 'Tabby',
                        'tamara' => 'Tamara',
                        'cod' => 'Cash on Delivery',
                    ])
                    ->multiple(),

                SelectFilter::make('delivery_method')
                    ->options([
                        'standard' => 'Standard Delivery',
                        'same_day' => 'Same-Day Delivery',
                        'click_collect' => 'Click & Collect',
                    ]),

                Filter::make('placed_at')
                    ->form([
                        DatePicker::make('placed_from'),
                        DatePicker::make('placed_until'),
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query
                            ->when($data['placed_from'] ?? null, fn (Builder $query, $date) => $query->whereDate('placed_at', '>=', $date))
                            ->when($data['placed_until'] ?? null, fn (Builder $query, $date) => $query->whereDate('placed_at', '<=', $date));
                    })
                    ->indicateUsing(function (array $data): array {
                        $indicators = [];

                        if ($data['placed_from'] ?? null) {
                            $indicators[] = 'From '.$data['placed_from'];
                        }
                        if ($data['placed_until'] ?? null) {
                            $indicators[] = 'Until '.$data['placed_until'];
                        }

                        return $indicators;
                    }),
            ])
            ->actions([
                ActionGroup::make([
                    ViewAction::make(),
                    EditAction::make()
                        ->label('Edit details'),
                ]),
            ])
            ->bulkActions([
                BulkActionGroup::make([
                    ExportBulkAction::make(),
                    BulkAction::make('markProcessing')
                        ->label('Mark as processing')
                        ->icon('heroicon-o-cog-6-tooth')
                        ->action(function (Collection $records): void {
                            $stateMachine = app(OrderStateMachine::class);

                            $records->each(function (Order $order) use ($stateMachine): void {
                                if ($stateMachine->canTransition($order, 'processing')) {
                                    $stateMachine->transition($order, 'processing');
                                }
                            });
                        }),
                    DeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('placed_at', 'desc')
            ->persistFiltersInSession()
            ->poll('60s');
    }

    public static function getRelations(): array
    {
        return [
            RelationManagers\ItemsRelationManager::class,
            RelationManagers\AuditLogsRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListOrders::route('/'),
            'view' => Pages\ViewOrder::route('/{record}'),
            'edit' => Pages\EditOrder::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->with(['user', 'store'])
            ->withCount('items');
    }

    public static function getGlobalSearchResultDetails(Model $record): array
    {
        return [
            'Customer' => $record->customer_name,
            'Total' => 'AED '.number_format((float) $record->total, 2),
            'Status' => str($record->status)->headline(),
        ];
    }

    public static function getGlobalSearchEloquentQuery(): Builder
    {
        return parent::getGlobalSearchEloquentQuery()->with(['user']);
    }
}
