<?php

namespace App\Filament\Resources\CustomerResource\RelationManagers;

use App\Filament\Resources\OrderResource;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class CouponRedemptionsRelationManager extends RelationManager
{
    protected static string $relationship = 'couponRedemptions';

    public function isReadOnly(): bool
    {
        return true;
    }

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextColumn::make('coupon.code'),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('coupon_code')
            ->columns([
                TextColumn::make('coupon.code')
                    ->label('Code')
                    ->badge()
                    ->color('info')
                    ->sortable(),

                TextColumn::make('order.order_number')
                    ->label('Order')
                    ->url(fn ($record): string => $record->order
                        ? OrderResource::getUrl('view', ['record' => $record->order])
                        : '#')
                    ->placeholder('—'),

                TextColumn::make('amount')
                    ->money('AED')
                    ->sortable(),

                TextColumn::make('created_at')
                    ->label('Redeemed')
                    ->dateTime('d M Y, H:i')
                    ->sortable(),
            ])
            ->defaultSort('created_at', 'desc')
            ->bulkActions([]);
    }
}
