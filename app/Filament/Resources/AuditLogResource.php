<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AuditLogResource\Pages;
use App\Models\AuditLog;
use Filament\Resources\Resource;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class AuditLogResource extends Resource
{
    protected static ?string $model = AuditLog::class;

    protected static string|\BackedEnum|null $navigationIcon = Heroicon::OutlinedClipboardDocumentList;

    protected static string|\UnitEnum|null $navigationGroup = 'System';

    protected static ?int $navigationSort = 3;

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

                TextColumn::make('user.name')
                    ->placeholder('system')
                    ->badge()
                    ->color('info'),

                TextColumn::make('action')
                    ->badge()
                    ->colors([
                        'info' => ['order.status.updated'],
                        'success' => ['order.payment.marked_paid', 'order.payment.confirmed'],
                        'danger' => ['order.cancelled', 'order.refunded'],
                    ]),

                TextColumn::make('description')
                    ->limit(70)
                    ->wrap(),

                TextColumn::make('auditable_type')
                    ->label('On')
                    ->formatStateUsing(fn (?string $state): string => $state ? class_basename($state) : '—')
                    ->badge(),

                TextColumn::make('ip_address')
                    ->placeholder('—')
                    ->copyable(),

                TextColumn::make('old_values')
                    ->formatStateUsing(fn ($state): string => is_array($state) ? json_encode($state) : (string) $state)
                    ->limit(40)
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('new_values')
                    ->formatStateUsing(fn ($state): string => is_array($state) ? json_encode($state) : (string) $state)
                    ->limit(40)
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                SelectFilter::make('action')
                    ->options(fn (): array => AuditLog::query()
                        ->select('action')
                        ->distinct()
                        ->orderBy('action')
                        ->pluck('action', 'action')
                        ->all()),

                SelectFilter::make('user')
                    ->relationship('user', 'name')
                    ->searchable()
                    ->preload(),
            ])
            ->defaultSort('created_at', 'desc')
            ->poll('30s');
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListAuditLogs::route('/'),
        ];
    }
}
