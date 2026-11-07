<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CategoryResource\Pages;
use App\Filament\Resources\CategoryResource\RelationManagers;
use App\Models\Category;
use Filament\Actions\ActionGroup;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Notifications\Notification;
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
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;

class CategoryResource extends Resource
{
    protected static ?string $model = Category::class;

    protected static string|\BackedEnum|null $navigationIcon = Heroicon::OutlinedSquares2x2;

    protected static string|\UnitEnum|null $navigationGroup = 'Catalog';

    protected static ?int $navigationSort = 3;

    protected static ?string $recordTitleAttribute = 'name';

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Category')
                    ->columns(3)
                    ->schema([
                        TextInput::make('name')
                            ->required()
                            ->maxLength(255)
                            ->live(onBlur: true)
                            ->afterStateUpdated(function ($state, callable $set, callable $get) {
                                if (blank($get('slug'))) {
                                    $set('slug', Str::slug((string) $state));
                                }
                            }),

                        TextInput::make('slug')
                            ->required()
                            ->maxLength(255)
                            ->unique(ignoreRecord: true)
                            ->alphaDash(),

                        Select::make('parent_id')
                            ->label('Parent category')
                            ->options(function (?Category $record) {
                                return Category::query()
                                    ->when($record, fn ($query) => $query->whereKeyNot($record->getKey()))
                                    ->orderBy('name')
                                    ->pluck('name', 'id');
                            })
                            ->searchable()
                            ->placeholder('Top-level category')
                            ->helperText('Leave empty for a top-level category.'),

                        TextInput::make('hero_title')
                            ->maxLength(150)
                            ->columnSpan(2),

                        FileUpload::make('hero_image')
                            ->image()
                            ->directory('categories')
                            ->disk('public')
                            ->columnSpan(1),

                        Textarea::make('hero_subtitle')
                            ->rows(2)
                            ->columnSpan(3),

                        Textarea::make('description')
                            ->rows(3)
                            ->columnSpan(3),

                        Toggle::make('is_active')
                            ->label('Active')
                            ->default(true),

                        Toggle::make('show_in_nav')
                            ->label('Show in navigation'),

                        TextInput::make('sort_order')
                            ->numeric()
                            ->default(0),

                        Placeholder::make('children_preview')
                            ->label('Subcategories')
                            ->content(fn (?Category $record): string => $record
                                ? $record->children()->pluck('name')->implode(', ') ?: '—'
                                : '—')
                            ->visibleOn('edit')
                            ->columnSpanFull(),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('hero_image')
                    ->label('')
                    ->size(44)
                    ->state(fn (Category $record): string => media_url($record->hero_image, 'images/placeholder.webp')),

                TextColumn::make('name')
                    ->searchable()
                    ->sortable()
                    ->description(fn (Category $record): string => $record->parent?->name ? 'under '.$record->parent->name : 'top-level'),

                TextColumn::make('parent.name')
                    ->label('Parent')
                    ->placeholder('—')
                    ->badge(),

                TextColumn::make('products_count')
                    ->label('Products')
                    ->counts('products'),

                IconColumn::make('is_active')
                    ->label('Active')
                    ->boolean(),

                IconColumn::make('show_in_nav')
                    ->label('In nav')
                    ->boolean(),

                TextColumn::make('sort_order')
                    ->sortable(),
            ])
            ->filters([
                TernaryFilter::make('is_active')
                    ->label('Active'),
                TernaryFilter::make('show_in_nav')
                    ->label('In navigation'),
                SelectFilter::make('parent')
                    ->relationship('parent', 'name')
                    ->searchable()
                    ->preload(),
            ])
            ->actions([
                ActionGroup::make([
                    EditAction::make(),
                    ViewAction::make(),
                    DeleteAction::make()
                        ->before(function (Category $record, DeleteAction $action): void {
                            $productsCount = $record->products()->count();

                            if ($productsCount > 0) {
                                Notification::make()
                                    ->title('Category cannot be deleted')
                                    ->body("This category still has {$productsCount} product(s) assigned to it. Reassign or detach them first to keep the catalogue consistent.")
                                    ->danger()
                                    ->persistent()
                                    ->send();

                                $action->halt();
                            }
                        }),
                ]),
            ])
            ->bulkActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make()
                        ->before(function (Collection $records, DeleteBulkAction $action): void {
                            $blocked = $records
                                ->filter(fn (Category $record): bool => $record->products()->exists())
                                ->count();

                            if ($blocked > 0) {
                                Notification::make()
                                    ->title('Categories cannot be deleted')
                                    ->body("{$blocked} selected category(ies) still have products assigned. Reassign or detach them first.")
                                    ->danger()
                                    ->persistent()
                                    ->send();

                                $action->halt();
                            }
                        }),
                ]),
            ])
            ->defaultSort('sort_order')
            ->reorderable('sort_order');
    }

    public static function getRelations(): array
    {
        return [
            RelationManagers\ProductsRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListCategories::route('/'),
            'create' => Pages\CreateCategory::route('/create'),
            'view' => Pages\ViewCategory::route('/{record}'),
            'edit' => Pages\EditCategory::route('/{record}/edit'),
        ];
    }

    public static function getGlobalSearchResultDetails(Model $record): array
    {
        return [
            'Parent' => (string) ($record->parent?->name ?? 'Top level'),
        ];
    }
}
