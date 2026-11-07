<?php

namespace App\Filament\Resources;

use App\Filament\Resources\StoreResource\Pages;
use App\Models\Store;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\KeyValue;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Resources\Resource;
use Filament\Schemas\Components\Tabs;
use Filament\Schemas\Components\Tabs\Tab;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\TernaryFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Model;

class StoreResource extends Resource
{
    protected static ?string $model = Store::class;

    protected static string|\BackedEnum|null $navigationIcon = Heroicon::OutlinedBuildingStorefront;

    protected static string|\UnitEnum|null $navigationGroup = 'Content';

    protected static ?int $navigationSort = 2;

    protected static ?string $recordTitleAttribute = 'name';

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Tabs::make('Store')
                    ->columns(2)
                    ->tabs([
                        Tab::make('Details')
                            ->icon(Heroicon::OutlinedBuildingStorefront)
                            ->schema([
                                TextInput::make('name')
                                    ->required()
                                    ->maxLength(255),

                                TextInput::make('city')
                                    ->required()
                                    ->maxLength(100),

                                Select::make('emirate')
                                    ->options([
                                        'Dubai' => 'Dubai',
                                        'Abu Dhabi' => 'Abu Dhabi',
                                        'Sharjah' => 'Sharjah',
                                        'Ajman' => 'Ajman',
                                        'Al Ain' => 'Al Ain',
                                        'Ras Al Khaimah' => 'Ras Al Khaimah',
                                        'Fujairah' => 'Fujairah',
                                        'Umm Al Quwain' => 'Umm Al Quwain',
                                    ])
                                    ->required(),

                                TextInput::make('phone')
                                    ->tel()
                                    ->maxLength(40),

                                Textarea::make('address')
                                    ->required()
                                    ->rows(2)
                                    ->columnSpanFull(),

                                TextInput::make('sort_order')
                                    ->numeric()
                                    ->default(0),

                                Toggle::make('is_active')
                                    ->label('Open (accepts Click & Collect orders)')
                                    ->default(true)
                                    ->columnSpanFull(),
                            ]),

                        Tab::make('Opening hours')
                            ->icon(Heroicon::OutlinedClock)
                            ->schema([
                                KeyValue::make('opening_hours')
                                    ->keyLabel('Day')
                                    ->valueLabel('Hours')
                                    ->keyPlaceholder('Monday')
                                    ->valuePlaceholder('10:00 – 22:00')
                                    ->columnSpanFull(),
                            ]),

                        Tab::make('Location & services')
                            ->icon(Heroicon::OutlinedMapPin)
                            ->schema([
                                TextInput::make('latitude')
                                    ->numeric()
                                    ->step(0.0000001)
                                    ->helperText('Used for the store locator map.'),

                                TextInput::make('longitude')
                                    ->numeric()
                                    ->step(0.0000001),

                                KeyValue::make('services')
                                    ->keyLabel('Service')
                                    ->valueLabel('Description')
                                    ->columnSpanFull(),

                                Toggle::make('has_brow_bar')
                                    ->label('Brow bar'),

                                Toggle::make('has_beauty_bar')
                                    ->label('Beauty bar'),
                            ]),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('city')
                    ->searchable()
                    ->badge()
                    ->color('info'),

                TextColumn::make('emirate'),

                TextColumn::make('phone')
                    ->copyable(),

                IconColumn::make('has_brow_bar')
                    ->label('Brow')
                    ->boolean(),

                IconColumn::make('has_beauty_bar')
                    ->label('Beauty')
                    ->boolean(),

                IconColumn::make('is_active')
                    ->label('Open')
                    ->boolean(),
            ])
            ->filters([
                TernaryFilter::make('is_active')
                    ->label('Open'),
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
            ->defaultSort('sort_order')
            ->reorderable('sort_order');
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListStores::route('/'),
            'create' => Pages\CreateStore::route('/create'),
            'edit' => Pages\EditStore::route('/{record}/edit'),
        ];
    }

    public static function getGlobalSearchResultDetails(Model $record): array
    {
        return [
            'City' => $record->city,
            'Emirate' => $record->emirate,
        ];
    }
}
