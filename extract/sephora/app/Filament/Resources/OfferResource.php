<?php

namespace App\Filament\Resources;

use App\Filament\Resources\OfferResource\Pages;
use App\Models\Offer;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Resources\Resource;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\TernaryFilter;
use Filament\Tables\Table;

class OfferResource extends Resource
{
    protected static ?string $model = Offer::class;

    protected static string|\BackedEnum|null $navigationIcon = Heroicon::OutlinedSparkles;

    protected static string|\UnitEnum|null $navigationGroup = 'Content';

    protected static ?int $navigationSort = 3;

    protected static ?string $recordTitleAttribute = 'title';

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Offer')
                    ->columns(3)
                    ->schema([
                        TextInput::make('title')
                            ->required()
                            ->maxLength(255)
                            ->columnSpan(2),

                        Select::make('brand_id')
                            ->relationship('brand', 'name')
                            ->searchable()
                            ->preload()
                            ->helperText('Optional — link the offer to a brand page.'),

                        TextInput::make('brand_name')
                            ->maxLength(255)
                            ->helperText('Display name when no brand is linked.'),

                        Select::make('category')
                            ->options([
                                'gift' => 'Gift',
                                'promotion' => 'Promotion',
                                'event' => 'Event',
                                'sale' => 'Sale',
                                'new' => 'New',
                            ])
                            ->default('gift')
                            ->required(),

                        TextInput::make('link')
                            ->url()
                            ->maxLength(255)
                            ->placeholder('https://… or /shop/makeup')
                            ->columnSpan(2),

                        Textarea::make('description')
                            ->rows(3)
                            ->columnSpan(3),

                        FileUpload::make('image_path')
                            ->label('Banner image')
                            ->image()
                            ->imageEditor()
                            ->directory('offers')
                            ->disk('public')
                            ->columnSpan(2),

                        DatePicker::make('valid_until')
                            ->label('Valid until')
                            ->columnSpan(1),

                        TextInput::make('sort_order')
                            ->numeric()
                            ->default(0),

                        Toggle::make('is_active')
                            ->label('Active')
                            ->default(true),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('image_path')
                    ->label('Banner')
                    ->size(60)
                    ->state(fn (Offer $record): string => media_url($record->image_path)),

                TextColumn::make('title')
                    ->searchable()
                    ->limit(40),

                TextColumn::make('brand.name')
                    ->placeholder('—'),

                TextColumn::make('category')
                    ->badge()
                    ->color('info'),

                TextColumn::make('valid_until')
                    ->date('d M Y')
                    ->sortable(),

                IconColumn::make('is_active')
                    ->label('Active')
                    ->boolean(),
            ])
            ->filters([
                TernaryFilter::make('is_active')
                    ->label('Active'),
                SelectFilter::make('category')
                    ->options([
                        'gift' => 'Gift',
                        'promotion' => 'Promotion',
                        'event' => 'Event',
                        'sale' => 'Sale',
                        'new' => 'New',
                    ]),
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
            'index' => Pages\ListOffers::route('/'),
            'create' => Pages\CreateOffer::route('/create'),
            'edit' => Pages\EditOffer::route('/{record}/edit'),
        ];
    }
}
