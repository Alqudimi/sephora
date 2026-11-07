<?php

namespace App\Filament\Resources\ProductResource\RelationManagers;

use App\Models\ProductImage;
use Filament\Actions\CreateAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class ImagesRelationManager extends RelationManager
{
    protected static string $relationship = 'images';

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('alt')
            ->reorderable('sort_order')
            ->defaultSort('sort_order')
            ->columns([
                ImageColumn::make('path')
                    ->label('Image')
                    ->square()
                    ->size(64)
                    ->state(fn (ProductImage $record): string => media_url($record->path)),

                TextColumn::make('path')
                    ->limit(40)
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('alt')
                    ->placeholder('—')
                    ->limit(40),

                TextColumn::make('sort_order')
                    ->label('Order')
                    ->sortable(),
            ])
            ->headerActions([
                CreateAction::make()
                    ->label('Add image'),
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
                FileUpload::make('path')
                    ->label('Image')
                    ->image()
                    ->imageEditor()
                    ->imageEditorAspectRatios([null, '1:1', '4:5'])
                    ->directory('products')
                    ->disk('public')
                    ->required()
                    ->maxSize(8192),

                TextInput::make('alt')
                    ->label('Alt text')
                    ->maxLength(255)
                    ->helperText('Accessibility & SEO description of the image.'),

                TextInput::make('sort_order')
                    ->numeric()
                    ->default(0)
                    ->helperText('0 = primary image shown first in the gallery.'),
            ]);
    }
}
