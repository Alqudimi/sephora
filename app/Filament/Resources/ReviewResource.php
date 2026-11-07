<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ReviewResource\Pages;
use App\Models\Review;
use Filament\Actions\Action;
use Filament\Actions\BulkAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Resources\Resource;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\TernaryFilter;
use Filament\Tables\Table;
use Illuminate\Support\Collection;

class ReviewResource extends Resource
{
    protected static ?string $model = Review::class;

    protected static string|\BackedEnum|null $navigationIcon = Heroicon::OutlinedStar;

    protected static string|\UnitEnum|null $navigationGroup = 'Engagement';

    protected static ?int $navigationSort = 1;

    public static function getNavigationBadge(): ?string
    {
        $count = Review::query()->where('is_approved', false)->count();

        return $count > 0 ? (string) $count : null;
    }

    public static function getNavigationBadgeColor(): ?string
    {
        return 'danger';
    }

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Review')
                    ->columns(2)
                    ->schema([
                        Select::make('product_id')
                            ->relationship('product', 'name')
                            ->searchable()
                            ->preload()
                            ->required(),

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
                            ->rows(4)
                            ->columnSpanFull(),

                        Toggle::make('is_approved')
                            ->label('Approved (visible in store)'),

                        Toggle::make('is_verified_purchase')
                            ->label('Verified purchase'),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('product.name')
                    ->limit(30)
                    ->searchable()
                    ->sortable()
                    ->url(fn (Review $record): string => ProductResource::getUrl('edit', ['record' => $record->product])),

                TextColumn::make('author_name')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('rating')
                    ->formatStateUsing(fn (int $state): string => str_repeat('★', $state).str_repeat('☆', 5 - $state))
                    ->color(fn (int $state): string => match (true) {
                        $state >= 4 => 'success',
                        $state === 3 => 'warning',
                        default => 'danger',
                    })
                    ->sortable(),

                TextColumn::make('title')
                    ->limit(30)
                    ->placeholder('—'),

                TextColumn::make('body')
                    ->limit(60)
                    ->wrap()
                    ->toggleable(),

                IconColumn::make('is_approved')
                    ->label('Approved')
                    ->boolean(),

                IconColumn::make('is_verified_purchase')
                    ->label('Verified')
                    ->boolean()
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('created_at')
                    ->since()
                    ->sortable(),
            ])
            ->filters([
                TernaryFilter::make('is_approved')
                    ->label('Approval')
                    ->placeholder('All reviews')
                    ->trueLabel('Approved')
                    ->falseLabel('Pending moderation'),

                TernaryFilter::make('is_verified_purchase')
                    ->label('Verified purchase'),

                SelectFilter::make('rating')
                    ->options([
                        5 => '★★★★★',
                        4 => '★★★★',
                        3 => '★★★',
                        2 => '★★',
                        1 => '★',
                    ]),
            ])
            ->actions([
                Action::make('approve')
                    ->icon('heroicon-o-check-circle')
                    ->color('success')
                    ->requiresConfirmation()
                    ->visible(fn (Review $record): bool => ! $record->is_approved
                        && auth()->user()?->can('update', $record))
                    ->action(function (Review $record): void {
                        // Re-checked at execution time: visibility alone does
                        // not stop crafted Livewire requests.
                        abort_unless(auth()->user()?->can('update', $record), 403);

                        $record->update(['is_approved' => true]);
                        $record->product?->recalculateRating();
                    }),

                Action::make('reject')
                    ->icon('heroicon-o-x-circle')
                    ->color('danger')
                    ->requiresConfirmation()
                    ->visible(fn (Review $record): bool => $record->is_approved
                        && auth()->user()?->can('update', $record))
                    ->action(function (Review $record): void {
                        abort_unless(auth()->user()?->can('update', $record), 403);

                        $record->update(['is_approved' => false]);
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
                        ->label('Approve selected')
                        ->icon('heroicon-o-check-circle')
                        ->color('success')
                        ->visible(fn (): bool => auth()->user()?->can('updateAny', Review::class))
                        ->action(function (Collection $records): void {
                            $records->each->update(['is_approved' => true]);
                            $records->pluck('product')->filter()->unique('id')->each->recalculateRating();
                        }),

                    BulkAction::make('reject')
                        ->label('Reject selected')
                        ->icon('heroicon-o-x-circle')
                        ->color('danger')
                        ->visible(fn (): bool => auth()->user()?->can('updateAny', Review::class))
                        ->action(function (Collection $records): void {
                            $records->each->update(['is_approved' => false]);
                            $records->pluck('product')->filter()->unique('id')->each->recalculateRating();
                        }),

                    DeleteBulkAction::make()
                        ->action(function (Collection $records): void {
                            $records->pluck('product')->filter()->unique('id')->each->recalculateRating();
                            $records->each->delete();
                        }),
                ]),
            ])
            ->defaultSort('created_at', 'desc');
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListReviews::route('/'),
            'edit' => Pages\EditReview::route('/{record}/edit'),
        ];
    }
}
