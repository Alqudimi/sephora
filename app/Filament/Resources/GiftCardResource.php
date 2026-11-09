<?php

namespace App\Filament\Resources;

use App\Filament\Resources\GiftCardResource\Pages;
use App\Models\GiftCard;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Resources\Resource;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\TernaryFilter;
use Filament\Tables\Table;

class GiftCardResource extends Resource
{
    protected static ?string $model = GiftCard::class;

    protected static string|\BackedEnum|null $navigationIcon = Heroicon::OutlinedCreditCard;

    protected static string|\UnitEnum|null $navigationGroup = 'Shop';

    protected static ?int $navigationSort = 3;

    protected static ?string $recordTitleAttribute = 'code';

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Gift Card Details')
                    ->columns(3)
                    ->schema([
                        TextInput::make('code')
                            ->required()
                            ->unique(ignoreRecord: true)
                            ->maxLength(32)
                            ->default(fn () => GiftCard::generateCode())
                            ->helperText('16-digit gift card number (auto-generated or custom).')
                            ->columnSpan(2),

                        TextInput::make('pin')
                            ->maxLength(8)
                            ->default(fn () => GiftCard::generatePin())
                            ->helperText('Security PIN for balance lookup and verification.')
                            ->columnSpan(1),

                        TextInput::make('initial_balance')
                            ->label('Initial Balance')
                            ->required()
                            ->numeric()
                            ->prefix('AED')
                            ->default(250.00)
                            ->columnSpan(1),

                        TextInput::make('balance')
                            ->label('Current Balance')
                            ->required()
                            ->numeric()
                            ->prefix('AED')
                            ->default(250.00)
                            ->helperText('Remaining funds available.')
                            ->columnSpan(1),

                        TextInput::make('currency')
                            ->required()
                            ->maxLength(3)
                            ->default('AED')
                            ->columnSpan(1),

                        Toggle::make('is_active')
                            ->label('Active & redeemable')
                            ->default(true)
                            ->columnSpan(1),

                        DateTimePicker::make('expires_at')
                            ->label('Expiration Date')
                            ->helperText('Leave empty for perpetual validity.')
                            ->columnSpan(2),
                    ]),

                Section::make('Recipient & Gifting Details (Optional)')
                    ->columns(2)
                    ->collapsed()
                    ->schema([
                        TextInput::make('recipient_name')
                            ->maxLength(120),

                        TextInput::make('recipient_email')
                            ->email()
                            ->maxLength(190),

                        TextInput::make('sender_name')
                            ->maxLength(120),

                        Textarea::make('message')
                            ->rows(3)
                            ->maxLength(1000)
                            ->columnSpanFull(),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('code')
                    ->formatStateUsing(fn (GiftCard $record): string => $record->formattedCode())
                    ->copyable()
                    ->searchable()
                    ->sortable()
                    ->weight('bold'),

                TextColumn::make('pin')
                    ->badge()
                    ->color('gray'),

                TextColumn::make('balance')
                    ->money('AED')
                    ->sortable()
                    ->weight('bold')
                    ->color(fn (GiftCard $record): string => $record->balance > 0 ? 'success' : 'danger'),

                TextColumn::make('initial_balance')
                    ->money('AED')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

                IconColumn::make('is_active')
                    ->boolean()
                    ->label('Active')
                    ->sortable(),

                TextColumn::make('recipient_email')
                    ->placeholder('—')
                    ->searchable()
                    ->toggleable(),

                TextColumn::make('expires_at')
                    ->dateTime('d M Y')
                    ->placeholder('Never')
                    ->sortable(),

                TextColumn::make('last_used_at')
                    ->since()
                    ->placeholder('Never used')
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                TernaryFilter::make('is_active')
                    ->label('Active status'),
            ])
            ->actions([
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->bulkActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('created_at', 'desc');
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListGiftCards::route('/'),
            'create' => Pages\CreateGiftCard::route('/create'),
            'edit' => Pages\EditGiftCard::route('/{record}/edit'),
        ];
    }
}

