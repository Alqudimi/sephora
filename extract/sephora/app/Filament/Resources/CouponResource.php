<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CouponResource\Pages;
use App\Filament\Resources\CouponResource\RelationManagers;
use App\Models\Coupon;
use Filament\Actions\ActionGroup;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Resources\Resource;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\TernaryFilter;
use Filament\Tables\Table;

class CouponResource extends Resource
{
    protected static ?string $model = Coupon::class;

    protected static string|\BackedEnum|null $navigationIcon = Heroicon::OutlinedTicket;

    protected static string|\UnitEnum|null $navigationGroup = 'Shop';

    protected static ?int $navigationSort = 2;

    protected static ?string $recordTitleAttribute = 'code';

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Coupon')
                    ->columns(3)
                    ->schema([
                        TextInput::make('code')
                            ->required()
                            ->unique(ignoreRecord: true)
                            ->maxLength(30)
                            ->uppercase()
                            ->live(onBlur: true)
                            ->afterStateUpdated(fn ($state, callable $set) => $set('code', strtoupper((string) $state)))
                            ->helperText('Customers enter this code at checkout.'),

                        Select::make('type')
                            ->options([
                                'percent' => 'Percentage discount',
                                'fixed' => 'Fixed amount discount',
                            ])
                            ->required()
                            ->default('percent')
                            ->live(),

                        TextInput::make('value')
                            ->required()
                            ->numeric()
                            ->minValue(0)
                            ->prefix(fn (Get $get): string => $get('type') === 'fixed' ? 'AED' : '%')
                            ->rules([
                                fn (Get $get): \Illuminate\Validation\Closure => function (string $attribute, $value, \Closure $fail) use ($get) {
                                    if ($get('type') === 'percent' && (float) $value > 100) {
                                        $fail('A percentage discount cannot exceed 100%.');
                                    }
                                },
                            ]),

                        TextInput::make('min_order')
                            ->label('Minimum order value')
                            ->numeric()
                            ->prefix('AED')
                            ->default(0)
                            ->minValue(0),

                        Textarea::make('description')
                            ->columnSpan(3)
                            ->rows(2),

                        DatePicker::make('starts_at')
                            ->label('Active from')
                            ->default(now()),

                        DatePicker::make('expires_at')
                            ->label('Expires on')
                            ->afterOrEqual('starts_at'),

                        TextInput::make('usage_limit')
                            ->label('Total usage limit')
                            ->numeric()
                            ->minValue(1)
                            ->helperText('Leave empty for unlimited redemptions.'),

                        TextInput::make('per_user_limit')
                            ->label('Per-customer limit')
                            ->numeric()
                            ->minValue(1)
                            ->helperText('Leave empty for no per-customer limit.'),

                        Toggle::make('is_active')
                            ->label('Active')
                            ->default(true)
                            ->columnSpan(1),

                        Placeholder::make('usage_preview')
                            ->label('Usage')
                            ->content(fn (?Coupon $record): string => $record
                                ? ($record->usage_limit
                                    ? "{$record->used_count} / {$record->usage_limit} used"
                                    : "{$record->used_count} used")
                                : '—')
                            ->visibleOn('edit')
                            ->columnSpan(2),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('code')
                    ->searchable()
                    ->sortable()
                    ->copyable()
                    ->weight('bold')
                    ->badge(),

                TextColumn::make('type')
                    ->badge()
                    ->formatStateUsing(fn (string $state): string => $state === 'percent' ? 'Percentage' : 'Fixed'),

                TextColumn::make('value')
                    ->formatStateUsing(fn (Coupon $record): string => $record->type === 'percent'
                        ? $record->value.'%'
                        : 'AED '.number_format((float) $record->value, 2)),

                TextColumn::make('min_order')
                    ->money('AED')
                    ->sortable(),

                TextColumn::make('usage')
                    ->label('Usage')
                    ->formatStateUsing(fn (Coupon $record): string => $record->usage_limit
                        ? "{$record->used_count} / {$record->usage_limit}"
                        : (string) $record->used_count)
                    ->color(fn (Coupon $record): string => $record->usage_limit && $record->used_count >= $record->usage_limit ? 'danger' : 'gray')
                    ->badge(),

                TextColumn::make('expires_at')
                    ->date('d M Y')
                    ->sortable()
                    ->color(fn (Coupon $record): string => $record->isExpired() ? 'danger' : 'gray'),

                ToggleColumn::make('is_active')
                    ->label('Active')
                    ->disabled(fn (Coupon $record): bool => $record->isExpired()),
            ])
            ->filters([
                TernaryFilter::make('is_active')
                    ->label('Active'),
                SelectFilter::make('type')
                    ->options([
                        'percent' => 'Percentage',
                        'fixed' => 'Fixed amount',
                    ]),
            ])
            ->actions([
                ActionGroup::make([
                    EditAction::make(),
                    DeleteAction::make(),
                ]),
            ])
            ->bulkActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('created_at', 'desc');
    }

    public static function getRelations(): array
    {
        return [
            RelationManagers\RedemptionsRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListCoupons::route('/'),
            'create' => Pages\CreateCoupon::route('/create'),
            'edit' => Pages\EditCoupon::route('/{record}/edit'),
        ];
    }
}
