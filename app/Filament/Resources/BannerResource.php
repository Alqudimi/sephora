<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BannerResource\Pages;
use App\Models\Banner;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ReplicateAction;
use Filament\Forms\Components\DateTimePicker;
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

class BannerResource extends Resource
{
    protected static ?string $model = Banner::class;

    protected static string|\BackedEnum|null $navigationIcon = Heroicon::OutlinedPhoto;

    protected static string|\UnitEnum|null $navigationGroup = 'Content';

    protected static ?int $navigationSort = 1;

    protected static ?string $recordTitleAttribute = 'title';

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Banner Content (محتوى البانر والواجهة)')
                    ->columns(2)
                    ->schema([
                        TextInput::make('title')
                            ->label('Title (العنوان الرئيسي)')
                            ->required()
                            ->maxLength(255)
                            ->columnSpanFull(),

                        TextInput::make('badge')
                            ->label('Badge / Tag (الشارة العلوية)')
                            ->placeholder('e.g. NEW LAUNCH, EXCLUSIVE FRAGRANCE, ANNIVERSARY')
                            ->maxLength(60),

                        TextInput::make('cta_label')
                            ->label('Button Label (نص زر الإجراء)')
                            ->default('Shop Now')
                            ->maxLength(60),

                        Textarea::make('subtitle')
                            ->label('Subtitle / Description (النص التوضيحي)')
                            ->rows(2)
                            ->maxLength(500)
                            ->columnSpanFull(),

                        TextInput::make('link')
                            ->label('Target Link (الرابط المستهدف)')
                            ->placeholder('e.g. /brands/nars or /shop/fragrance')
                            ->maxLength(255)
                            ->columnSpanFull(),
                    ]),

                Section::make('Image & Display (الصور والعرض)')
                    ->columns(2)
                    ->schema([
                        TextInput::make('image_path')
                            ->label('Image URL / Path (رابط أو مسار الصورة)')
                            ->required()
                            ->maxLength(1000)
                            ->helperText('You can enter a full image URL or upload an image file below.')
                            ->columnSpan(2),

                        FileUpload::make('image_upload')
                            ->label('Upload Image (رفع ملف صورة)')
                            ->image()
                            ->disk('public')
                            ->directory('banners')
                            ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/webp', 'image/gif'])
                            ->maxSize(5120)
                            ->dehydrated(false)
                            ->afterStateUpdated(function ($state, callable $set) {
                                if ($state) {
                                    $set('image_path', '/storage/'.$state);
                                }
                            })
                            ->columnSpan(2),

                        Select::make('position')
                            ->label('Position / Placement (مكان العرض في المتجر)')
                            ->options([
                                'hero_carousel' => 'Homepage Hero Carousel (سلايدر الصفحة الرئيسية)',
                                'secondary_editorial' => 'Secondary Editorial Grid (الشبكة التحريرية)',
                                'announcement_banner' => 'Announcement Banner (بانر الإعلانات)',
                                'category_hero' => 'Category Hero (ترويسة الأقسام)',
                            ])
                            ->default('hero_carousel')
                            ->required(),

                        TextInput::make('sort_order')
                            ->label('Sort Order (ترتيب الظهور)')
                            ->numeric()
                            ->default(0)
                            ->helperText('Lower numbers appear first.'),

                        Toggle::make('is_active')
                            ->label('Active / Published (مفعّل ومعروض)')
                            ->default(true)
                            ->onColor('success')
                            ->offColor('danger')
                            ->columnSpanFull(),

                        DateTimePicker::make('starts_at')
                            ->label('Start Schedule (تاريخ بدء الظهور)')
                            ->helperText('Optional. Leave empty for immediate activation.'),

                        DateTimePicker::make('ends_at')
                            ->label('End Schedule (تاريخ انتهاء الظهور)')
                            ->helperText('Optional. Leave empty for permanent activation.'),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('image_path')
                    ->label('Preview')
                    ->circular(false)
                    ->extraImgAttributes(['class' => 'object-cover rounded'])
                    ->width(80)
                    ->height(48),

                TextColumn::make('title')
                    ->label('Title')
                    ->searchable()
                    ->sortable()
                    ->description(fn (Banner $record): string => (string) $record->badge),

                TextColumn::make('position')
                    ->label('Placement')
                    ->badge()
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'hero_carousel' => 'Hero Slider',
                        'secondary_editorial' => 'Editorial',
                        'announcement_banner' => 'Announcement',
                        'category_hero' => 'Category',
                        default => $state,
                    })
                    ->colors([
                        'primary' => 'hero_carousel',
                        'info' => 'secondary_editorial',
                        'warning' => 'announcement_banner',
                        'gray' => 'category_hero',
                    ])
                    ->sortable(),

                TextColumn::make('sort_order')
                    ->label('Sort')
                    ->sortable(),

                IconColumn::make('is_active')
                    ->label('Active')
                    ->boolean()
                    ->sortable(),

                TextColumn::make('created_at')
                    ->dateTime('d M Y')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->defaultSort('sort_order', 'asc')
            ->filters([
                SelectFilter::make('position')
                    ->options([
                        'hero_carousel' => 'Hero Carousel',
                        'secondary_editorial' => 'Secondary Editorial',
                        'announcement_banner' => 'Announcement Banner',
                        'category_hero' => 'Category Hero',
                    ]),

                TernaryFilter::make('is_active')
                    ->label('Active'),
            ])
            ->actions([
                EditAction::make(),
                ReplicateAction::make(),
                DeleteAction::make(),
            ])
            ->bulkActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListBanners::route('/'),
            'create' => Pages\CreateBanner::route('/create'),
            'edit' => Pages\EditBanner::route('/{record}/edit'),
        ];
    }
}

