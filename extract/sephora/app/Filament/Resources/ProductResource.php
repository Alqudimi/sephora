<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProductResource\Pages;
use App\Filament\Resources\ProductResource\RelationManagers;
use App\Models\Product;
use App\Services\Audit\AuditLogger;
use App\Support\CommerceSettings;
use Filament\Actions\Action;
use Filament\Actions\ActionGroup;
use Filament\Actions\BulkAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ExportBulkAction;
use Filament\Actions\ReplicateAction;
use Filament\Actions\ViewAction;
use Filament\Forms\Components\CheckboxList;
use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Notifications\Notification;
use Filament\Resources\Resource;
use Filament\Schemas\Components\Tabs as FormTabs;
use Filament\Schemas\Components\Tabs\Tab;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\TernaryFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;

class ProductResource extends Resource
{
    protected static ?string $model = Product::class;

    protected static string|\BackedEnum|null $navigationIcon = Heroicon::OutlinedShoppingBag;

    protected static string|\UnitEnum|null $navigationGroup = 'Catalog';

    protected static ?int $navigationSort = 1;

    protected static ?string $recordTitleAttribute = 'name';

    public static function getNavigationBadge(): ?string
    {
        $count = Product::query()->where('is_active', false)->count();

        return $count > 0 ? (string) $count : null;
    }

    public static function getNavigationBadgeColor(): ?string
    {
        return 'warning';
    }

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                FormTabs::make('Product')
                    ->columns(3)
                    ->tabs([
                        Tab::make('General')
                            ->icon(Heroicon::OutlinedInformationCircle)
                            ->columns(3)
                            ->schema([
                                TextInput::make('name')
                                    ->required()
                                    ->maxLength(255)
                                    ->live(onBlur: true)
                                    ->afterStateUpdated(function ($state, callable $set, callable $get) {
                                        if (blank($get('slug'))) {
                                            $set('slug', (string) Str::of((string) $state)->slug());
                                        }
                                    })
                                    ->columnSpan(2),

                                TextInput::make('slug')
                                    ->required()
                                    ->maxLength(255)
                                    ->unique(ignoreRecord: true)
                                    ->alphaDash()
                                    ->helperText('Auto-generated from the name — can be edited.'),

                                Select::make('brand_id')
                                    ->relationship('brand', 'name')
                                    ->searchable()
                                    ->preload()
                                    ->createOptionForm([
                                        TextInput::make('name')->required(),
                                        TextInput::make('slug')->required()->unique(),
                                    ]),

                                CheckboxList::make('categories')
                                    ->relationship('categories', 'name')
                                    ->columns(3)
                                    ->searchable()
                                    ->columnSpanFull(),

                                RichEditor::make('description')
                                    ->required()
                                    ->toolbarButtons(['bold', 'italic', 'underline', 'bulletList', 'orderedList', 'link', 'redo', 'undo'])
                                    ->columnSpan(3),

                                Textarea::make('how_to_use')
                                    ->rows(3)
                                    ->columnSpan(3),

                                Textarea::make('ingredients')
                                    ->rows(3)
                                    ->columnSpan(3),
                            ]),

                        Tab::make('Pricing & Inventory')
                            ->icon(Heroicon::OutlinedBanknotes)
                            ->columns(3)
                            ->schema([
                                TextInput::make('price')
                                    ->numeric()
                                    ->prefix('AED')
                                    ->required()
                                    ->minValue(0)
                                    ->maxValue(999999.99),

                                TextInput::make('compare_at_price')
                                    ->numeric()
                                    ->prefix('AED')
                                    ->minValue(0)
                                    ->helperText('Original price — shows a discount badge when higher than price.'),

                                TextInput::make('stock')
                                    ->numeric()
                                    ->required()
                                    ->default(100)
                                    ->minValue(0),

                                TextInput::make('sku')
                                    ->label('SKU')
                                    ->unique(ignoreRecord: true)
                                    ->maxLength(100),

                                TextInput::make('size')
                                    ->maxLength(100)
                                    ->placeholder('e.g. 30 ml'),

                                Select::make('badge')
                                    ->options([
                                        'BEST SELLER' => 'Best Seller',
                                        'CLEAN' => 'Clean',
                                        'LUXURY' => 'Luxury',
                                        'EXCLUSIVE' => 'Exclusive',
                                        'NEW' => 'New',
                                        'LIMITED EDITION' => 'Limited Edition',
                                        'ONLY AT SEPHORA' => 'Only at Sephora',
                                        'VALUE SET' => 'Value Set',
                                    ]),

                                Placeholder::make('discount_preview')
                                    ->label('Discount')
                                    ->content(fn (?Product $record): string => $record?->compare_at_price && $record?->compare_at_price > $record?->price
                                        ? round((1 - $record->price / $record->compare_at_price) * 100).'% off'
                                        : '—')
                                    ->visibleOn('edit'),

                                Placeholder::make('rating_preview')
                                    ->label('Rating')
                                    ->content(fn (?Product $record): string => $record ? "{$record->rating} ★ ({$record->reviews_count} reviews)" : '—')
                                    ->visibleOn('edit'),
                            ]),

                        Tab::make('Visibility & Flags')
                            ->icon(Heroicon::OutlinedEye)
                            ->columns(2)
                            ->schema([
                                Toggle::make('is_active')
                                    ->label('Active (visible in store)')
                                    ->default(true)
                                    ->onColor('success')
                                    ->offColor('danger'),

                                Toggle::make('is_bestseller')
                                    ->label('Best seller'),

                                Toggle::make('is_new')
                                    ->label('New arrival'),

                                Toggle::make('is_clean')
                                    ->label('Clean beauty'),

                                Toggle::make('is_exclusive')
                                    ->label('Exclusive to Sephora'),

                                TextInput::make('sort_order')
                                    ->numeric()
                                    ->default(0)
                                    ->helperText('Lower values appear first.'),
                            ]),

                        Tab::make('SEO')
                            ->icon(Heroicon::OutlinedMagnifyingGlass)
                            ->columns(2)
                            ->schema([
                                TextInput::make('meta_title')
                                    ->maxLength(150)
                                    ->helperText('Overrides the product name in search results.'),

                                Placeholder::make('seo_preview')
                                    ->label('Slug preview')
                                    ->content(fn (?Product $record): string => $record?->slug
                                        ? url('/products/'.$record->slug)
                                        : '—'),

                                Textarea::make('meta_description')
                                    ->rows(3)
                                    ->maxLength(320)
                                    ->columnSpanFull()
                                    ->helperText('Meta description shown under the title in search results.'),
                            ]),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('first_image')
                    ->label('')
                    ->square()
                    ->size(44),

                TextColumn::make('name')
                    ->searchable()
                    ->sortable()
                    ->description(fn (Product $record): string => (string) $record->brand?->name)
                    ->limit(40),

                TextColumn::make('sku')
                    ->label('SKU')
                    ->searchable()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('price')
                    ->money('AED')
                    ->sortable(),

                TextColumn::make('compare_at_price')
                    ->money('AED')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('stock')
                    ->sortable()
                    ->badge()
                    ->color(fn (int $state): string => match (true) {
                        $state <= 0 => 'danger',
                        $state < CommerceSettings::lowStockThreshold() => 'warning',
                        default => 'success',
                    }),

                TextColumn::make('categories.name')
                    ->badge()
                    ->color('info')
                    ->limitList(2),

                IconColumn::make('is_active')
                    ->label('Active')
                    ->boolean(),

                IconColumn::make('is_bestseller')
                    ->label('Best')
                    ->boolean()
                    ->toggleable(isToggledHiddenByDefault: true),

                IconColumn::make('is_new')
                    ->label('New')
                    ->boolean()
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('rating')
                    ->sortable()
                    ->formatStateUsing(fn ($state) => "{$state} ★"),

                TextColumn::make('updated_at')
                    ->since()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                TernaryFilter::make('is_active')
                    ->label('Visibility')
                    ->placeholder('All products')
                    ->trueLabel('Active')
                    ->falseLabel('Hidden'),

                TernaryFilter::make('is_bestseller')
                    ->label('Best seller'),

                TernaryFilter::make('is_new')
                    ->label('New arrival'),

                SelectFilter::make('brand')
                    ->relationship('brand', 'name')
                    ->searchable()
                    ->preload(),

                SelectFilter::make('categories')
                    ->relationship('categories', 'name')
                    ->multiple()
                    ->preload(),

                Filter::make('low_stock')
                    ->label('Low stock')
                    ->query(fn (Builder $query) => $query
                        ->where('stock', '>', 0)
                        ->where('stock', '<', CommerceSettings::lowStockThreshold())),

                Filter::make('out_of_stock')
                    ->label('Out of stock')
                    ->query(fn (Builder $query) => $query->where('stock', '<=', 0)),
            ])
            ->actions([
                ActionGroup::make([
                    EditAction::make(),
                    ViewAction::make(),
                    ReplicateAction::make()
                        ->after(function (Product $replica): void {
                            $replica->update([
                                'sku' => null,
                                'slug' => $replica->slug.'-copy-'.Str::random(5),
                            ]);
                        }),
                    Action::make('toggleActive')
                        ->label(fn (Product $record) => $record->is_active ? 'Hide from store' : 'Show in store')
                        ->icon(fn (Product $record) => $record->is_active ? 'heroicon-o-eye-slash' : 'heroicon-o-eye')
                        ->requiresConfirmation()
                        ->action(function (Product $record): void {
                            $record->update(['is_active' => ! $record->is_active]);
                        }),
                    Action::make('adjustStock')
                        ->label('Adjust stock')
                        ->icon('heroicon-o-adjustments-vertical')
                        ->color('info')
                        ->form([
                            TextInput::make('new_stock')
                                ->label('New stock level')
                                ->numeric()
                                ->required()
                                ->minValue(0)
                                ->helperText(fn (Product $record): string => 'Current stock: '.(int) $record->stock),

                            Textarea::make('reason')
                                ->label('Reason')
                                ->required()
                                ->rows(2)
                                ->placeholder('e.g. received 50 units from PO-2214 / damaged in transit'),
                        ])
                        ->action(function (Product $record, array $data): void {
                            $old = (int) $record->stock;

                            $record->update(['stock' => (int) $data['new_stock']]);

                            AuditLogger::log(
                                $record,
                                'product.stock.adjusted',
                                ['stock' => $old],
                                ['stock' => (int) $data['new_stock'], 'reason' => $data['reason']],
                                "Product {$record->sku}: stock {$old} -> {$data['new_stock']} ({$data['reason']})",
                            );

                            Notification::make()
                                ->title('Stock updated')
                                ->body("{$record->name}: {$old} → {$data['new_stock']} (audit logged).")
                                ->success()
                                ->send();
                        }),
                    DeleteAction::make(),
                ]),
            ])
            ->bulkActions([
                BulkActionGroup::make([
                    ExportBulkAction::make(),
                    DeleteBulkAction::make(),
                    BulkAction::make('activate')
                        ->label('Activate')
                        ->icon('heroicon-o-check-circle')
                        ->action(function (Collection $records): void {
                            $records->each->update(['is_active' => true]);
                        }),
                    BulkAction::make('deactivate')
                        ->label('Hide')
                        ->icon('heroicon-o-eye-slash')
                        ->requiresConfirmation()
                        ->action(function (Collection $records): void {
                            $records->each->update(['is_active' => false]);
                        }),
                    BulkAction::make('adjustPrices')
                        ->label('Adjust prices…')
                        ->icon('heroicon-o-banknotes')
                        ->color('warning')
                        ->form([
                            Select::make('operation')
                                ->options([
                                    'increase_percent' => 'Increase by %',
                                    'decrease_percent' => 'Decrease by %',
                                    'increase_fixed' => 'Increase by fixed amount',
                                    'decrease_fixed' => 'Decrease by fixed amount',
                                ])
                                ->required()
                                ->default('increase_percent'),

                            TextInput::make('amount')
                                ->label('Amount')
                                ->numeric()
                                ->required()
                                ->minValue(0.01)
                                ->helperText('Percent (e.g. 10 = 10%) or AED amount, per the operation.'),

                            Toggle::make('round_to')
                                ->label('Round results to 2 decimals')
                                ->default(true),
                        ])
                        ->action(function (Collection $records, array $data): void {
                            $amount = (float) $data['amount'];
                            $round = ! empty($data['round_to']);

                            foreach ($records as $product) {
                                $old = (float) $product->price;
                                $new = match ($data['operation']) {
                                    'increase_percent' => $old * (1 + $amount / 100),
                                    'decrease_percent' => $old * (1 - $amount / 100),
                                    'increase_fixed' => $old + $amount,
                                    'decrease_fixed' => max(0, $old - $amount),
                                    default => $old,
                                };

                                if ($new < 0) {
                                    $new = 0;
                                }

                                $new = $round ? round($new, 2) : $new;

                                $product->update(['price' => $new]);

                                AuditLogger::log(
                                    $product,
                                    'product.price.bulk_updated',
                                    ['price' => $old],
                                    ['price' => $new, 'operation' => $data['operation'], 'amount' => $amount],
                                    "Product {$product->sku}: price {$old} -> {$new} ({$data['operation']} {$amount})",
                                );
                            }

                            Notification::make()
                                ->title('Prices updated')
                                ->body($records->count().' product(s) repriced and audit-logged.')
                                ->success()
                                ->send();
                        }),
                ]),
            ])
            ->defaultSort('sort_order')
            ->reorderable('sort_order')
            ->persistFiltersInSession()
            ->poll('60s');
    }

    public static function getRelations(): array
    {
        return [
            RelationManagers\ImagesRelationManager::class,
            RelationManagers\ShadesRelationManager::class,
            RelationManagers\ReviewsRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListProducts::route('/'),
            'create' => Pages\CreateProduct::route('/create'),
            'edit' => Pages\EditProduct::route('/{record}/edit'),
        ];
    }

    public static function getGlobalSearchResultDetails(Model $record): array
    {
        return [
            'Brand' => (string) $record->brand?->name,
            'Price' => 'AED '.number_format((float) $record->price, 2),
            'Stock' => (string) $record->stock,
        ];
    }

    public static function getGlobalSearchEloquentQuery(): Builder
    {
        return parent::getGlobalSearchEloquentQuery()->with('brand');
    }
}
