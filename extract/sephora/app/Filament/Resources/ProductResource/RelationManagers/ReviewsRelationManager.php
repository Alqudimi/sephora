<?php

namespace App\Filament\Resources\ProductResource\RelationManagers;

use App\Models\Review;
use Filament\Actions\Action;
use Filament\Actions\BulkAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\CreateAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\TernaryFilter;
use Filament\Tables\Table;
use Illuminate\Support\Collection;

class ReviewsRelationManager extends RelationManager
{
    protected static string $relationship = 'allReviews';

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('title')
            ->defaultSort('created_at', 'desc')
            ->columns([
                TextColumn::make('author_name')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('rating')
                    ->formatStateUsing(fn (int $state): string => str_repeat('★', $state).str_repeat('☆', 5 - $state))
                    ->color(fn (int $state): string => match (true) {
                        $state >= 4 => 'success',
                        $state === 3 => 'warning',
                        default => 'danger',
                    }),

                TextColumn::make('title')
                    ->limit(30)
                    ->placeholder('—'),

                TextColumn::make('body')
                    ->limit(50)
                    ->wrap(),

                IconColumn::make('is_approved')
                    ->label('Approved')
                    ->boolean(),

                IconColumn::make('is_verified_purchase')
                    ->label('Verified')
                    ->boolean(),

                TextColumn::make('created_at')
                    ->since()
                    ->sortable(),
            ])
            ->filters([
                TernaryFilter::make('is_approved')
                    ->label('Approval'),
            ])
            ->headerActions([
                CreateAction::make()
                    ->label('Add review'),
            ])
            ->actions([
                Action::make('toggleApproval')
                    ->label(fn (Review $record) => $record->is_approved ? 'Reject' : 'Approve')
                    ->icon(fn (Review $record) => $record->is_approved ? 'heroicon-o-x-mark' : 'heroicon-o-check')
                    ->color(fn (Review $record) => $record->is_approved ? 'danger' : 'success')
                    ->requiresConfirmation()
                    ->action(function (Review $record): void {
                        $record->update(['is_approved' => ! $record->is_approved]);
                        $record->product?->recalculateRating();
                    }),
                EditAction::make()
                    ->after(fn (Review $record) => $record->product?->recalculateRating()),
                DeleteAction::make()
                    ->after(fn (Review $record) => $record->product?->recalculateRating()),
            ])
            ->bulkActions([
                BulkActionGroup::make([
                    BulkAction::make('approve')
                        ->label('Approve')
                        ->icon('heroicon-o-check-circle')
                        ->action(function (Collection $records): void {
                            $records->each->update(['is_approved' => true]);

                            $products = $records->pluck('product')->filter()->unique('id');
                            $products->each->recalculateRating();
                        }),
                    BulkAction::make('reject')
                        ->label('Reject')
                        ->icon('heroicon-o-x-circle')
                        ->color('danger')
                        ->action(function (Collection $records): void {
                            $records->each->update(['is_approved' => false]);

                            $products = $records->pluck('product')->filter()->unique('id');
                            $products->each->recalculateRating();
                        }),
                    DeleteBulkAction::make()
                        ->action(function (Collection $records): void {
                            $products = $records->pluck('product')->filter()->unique('id');
                            $records->each->delete();
                            $products->each->recalculateRating();
                        }),
                ]),
            ]);
    }

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('author_name')
                    ->required()
                    ->maxLength(120),

                TextInput::make('rating')
                    ->required()
                    ->numeric()
                    ->minValue(1)
                    ->maxValue(5),

                TextInput::make('title')
                    ->maxLength(150),

                Textarea::make('body')
                    ->required()
                    ->rows(4),

                Toggle::make('is_approved')
                    ->label('Approved (visible in store)')
                    ->default(false),

                Toggle::make('is_verified_purchase')
                    ->label('Verified purchase')
                    ->default(false),
            ]);
    }
}
