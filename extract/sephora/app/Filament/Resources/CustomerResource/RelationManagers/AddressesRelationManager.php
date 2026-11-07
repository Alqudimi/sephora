<?php

namespace App\Filament\Resources\CustomerResource\RelationManagers;

use Filament\Actions\CreateAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class AddressesRelationManager extends RelationManager
{
    protected static string $relationship = 'addresses';

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('label')
            ->columns([
                TextColumn::make('label')
                    ->badge(),

                TextColumn::make('full_name'),

                TextColumn::make('phone'),

                TextColumn::make('emirate')
                    ->badge()
                    ->color('info'),

                TextColumn::make('area')
                    ->limit(20),

                IconColumn::make('is_default')
                    ->label('Default')
                    ->boolean(),
            ])
            ->headerActions([
                CreateAction::make()
                    ->label('Add address'),
            ])
            ->actions([
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->bulkActions([
                DeleteBulkAction::make(),
            ]);
    }

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('label')
                    ->required()
                    ->maxLength(50)
                    ->placeholder('e.g. Home'),

                TextInput::make('full_name')
                    ->required()
                    ->maxLength(255),

                TextInput::make('phone')
                    ->required()
                    ->maxLength(40),

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

                TextInput::make('area')
                    ->required()
                    ->maxLength(255),

                TextInput::make('street_address')
                    ->required()
                    ->maxLength(255)
                    ->columnSpan(2),

                TextInput::make('building')
                    ->maxLength(255),

                Textarea::make('delivery_instructions')
                    ->rows(2)
                    ->columnSpan(2),

                Toggle::make('is_default')
                    ->label('Default address'),
            ]);
    }
}
