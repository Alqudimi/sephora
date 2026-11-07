<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ConsentResource\Pages;
use App\Models\Consent;
use Filament\Resources\Resource;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class ConsentResource extends Resource
{
    protected static ?string $model = Consent::class;

    protected static string|\BackedEnum|null $navigationIcon = Heroicon::OutlinedShieldCheck;

    protected static string|\UnitEnum|null $navigationGroup = 'System';

    protected static ?int $navigationSort = 5;

    public static function canCreate(): bool
    {
        return false;
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('created_at')
                    ->dateTime('d M Y, H:i')
                    ->sortable(),

                TextColumn::make('email')
                    ->searchable()
                    ->copyable(),

                TextColumn::make('type')
                    ->badge()
                    ->color('info'),

                TextColumn::make('version'),

                IconColumn::make('accepted')
                    ->boolean()
                    ->trueIcon('heroicon-o-check-circle')
                    ->trueColor('success')
                    ->falseColor('danger'),

                TextColumn::make('ip_address')
                    ->copyable(),

                TextColumn::make('accepted_at')
                    ->dateTime('d M Y, H:i')
                    ->placeholder('—'),
            ])
            ->filters([
                SelectFilter::make('type')
                    ->options(fn (): array => Consent::query()
                        ->select('type')
                        ->distinct()
                        ->pluck('type', 'type')
                        ->all()),
            ])
            ->defaultSort('created_at', 'desc');
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListConsents::route('/'),
        ];
    }
}
