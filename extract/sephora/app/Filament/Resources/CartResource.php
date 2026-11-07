<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CartResource\Pages;
use App\Filament\Resources\CartResource\RelationManagers;
use App\Models\Cart;
use Filament\Actions\ViewAction;
use Filament\Resources\Resource;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\TernaryFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class CartResource extends Resource
{
    protected static ?string $model = Cart::class;

    protected static string|\BackedEnum|null $navigationIcon = Heroicon::OutlinedShoppingBag;

    protected static string|\UnitEnum|null $navigationGroup = 'Customers';

    protected static ?int $navigationSort = 3;

    protected static ?string $navigationLabel = 'Active Carts';

    public static function canCreate(): bool
    {
        return false;
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->whereHas('items')
            ->withCount('items');
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')
                    ->label('Cart'),

                TextColumn::make('user.name')
                    ->placeholder('Guest')
                    ->badge()
                    ->color(fn ($record): string => $record->user ? 'info' : 'gray'),

                TextColumn::make('items_count')
                    ->label('Items')
                    ->counts('items')
                    ->badge(),

                TextColumn::make('total')
                    ->label('Value')
                    ->money('AED')
                    ->state(fn (Cart $record): float => $record->items
                        ->loadMissing('product')
                        ->sum(fn ($item) => ($item->product?->price ?? 0) * $item->quantity)),

                TextColumn::make('updated_at')
                    ->label('Last activity')
                    ->since()
                    ->sortable(),
            ])
            ->filters([
                Filter::make('abandoned')
                    ->label('Abandoned (inactive > 24h)')
                    ->query(fn (Builder $query) => $query
                        ->where('updated_at', '<', now()->subDay())),

                TernaryFilter::make('user_id')
                    ->label('Account')
                    ->nullable()
                    ->queries(
                        true: fn (Builder $query) => $query->whereNotNull('user_id'),
                        false: fn (Builder $query) => $query->whereNull('user_id'),
                    ),
            ])
            ->actions([
                ViewAction::make(),
            ])
            ->defaultSort('updated_at', 'desc')
            ->poll('60s');
    }

    public static function getRelations(): array
    {
        return [
            RelationManagers\ItemsRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListCarts::route('/'),
            'view' => Pages\ViewCart::route('/{record}'),
        ];
    }
}
