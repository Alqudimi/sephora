<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CustomerResource\Pages;
use App\Filament\Resources\CustomerResource\RelationManagers;
use App\Models\User;
use App\Policies\CustomerPolicy;
use App\Services\Audit\AuditLogger;
use Filament\Actions\Action;
use Filament\Actions\ActionGroup;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Forms\Components\CheckboxList;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Notifications\Notification;
use Filament\Resources\Resource;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\TernaryFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Password;
use Illuminate\Validation\Rules\Password as PasswordRule;

class CustomerResource extends Resource
{
    protected static ?string $model = User::class;

    protected static string|\BackedEnum|null $navigationIcon = Heroicon::OutlinedUsers;

    protected static string|\UnitEnum|null $navigationGroup = 'Customers';

    protected static ?int $navigationSort = 1;

    protected static ?string $recordTitleAttribute = 'name';

    public static function getNavigationLabel(): string
    {
        return 'Customers & Staff';
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->withCount('orders')
            ->withSum('orders', 'total');
    }

    /**
     * Authorization is routed to CustomerPolicy explicitly: the User
     * model is shared with StaffResource, so Laravel's policy discovery
     * (User -> UserPolicy) cannot resolve the right policy by name.
     * Without this, Filament would allow every staff member to edit or
     * delete customer records.
     */
    public static function canViewAny(): bool
    {
        $user = auth()->user();

        return $user !== null && app(CustomerPolicy::class)->viewAny($user);
    }

    public static function canCreate(): bool
    {
        $user = auth()->user();

        return $user !== null && app(CustomerPolicy::class)->create($user);
    }

    public static function canView(Model $record): bool
    {
        $user = auth()->user();

        return $user !== null && app(CustomerPolicy::class)->view($user, $record);
    }

    public static function canEdit(Model $record): bool
    {
        $user = auth()->user();

        return $user !== null && app(CustomerPolicy::class)->update($user, $record);
    }

    public static function canDelete(Model $record): bool
    {
        $user = auth()->user();

        return $user !== null && app(CustomerPolicy::class)->delete($user, $record);
    }

    public static function canDeleteAny(): bool
    {
        $user = auth()->user();

        return $user !== null && app(CustomerPolicy::class)->deleteAny($user);
    }

    public static function canExport(): bool
    {
        $user = auth()->user();

        return $user !== null && app(CustomerPolicy::class)->export($user);
    }

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Account')
                    ->columns(3)
                    ->schema([
                        TextInput::make('name')
                            ->required()
                            ->maxLength(255),

                        TextInput::make('email')
                            ->email()
                            ->required()
                            ->unique(ignoreRecord: true)
                            ->maxLength(255),

                        TextInput::make('password')
                            ->password()
                            ->revealable()
                            ->required(fn (string $operation): bool => $operation === 'create')
                            ->dehydrated(fn ($state): bool => filled($state))
                            ->rule(PasswordRule::default()),

                        TextInput::make('phone')
                            ->tel()
                            ->maxLength(40),

                        DatePicker::make('date_of_birth')
                            ->maxDate(now()),

                        Select::make('gender')
                            ->options([
                                'female' => 'Female',
                                'male' => 'Male',
                                'other' => 'Other',
                                'prefer_not' => 'Prefer not to say',
                            ]),

                        Select::make('preferred_language')
                            ->options([
                                'en' => 'English',
                                'ar' => 'العربية',
                            ])
                            ->default('en'),

                        TextInput::make('preferred_store')
                            ->maxLength(255)
                            ->placeholder('e.g. Dubai Mall'),
                    ]),

                Section::make('Marketing preferences')
                    ->icon('heroicon-o-envelope-open')
                    ->description('Channels the customer opted into (GDPR record of consent).')
                    ->columns(2)
                    ->schema([
                        CheckboxList::make('marketing_preferences')
                            ->options([
                                'email' => 'Email — newsletters & offers',
                                'sms' => 'SMS — order updates & promotions',
                                'whatsapp' => 'WhatsApp — service messages',
                            ])
                            ->columns(1)
                            ->columnSpanFull()
                            ->bulkToggleable(),
                    ]),

                Section::make('Beauty Pass (Loyalty)')
                    ->icon('heroicon-o-star')
                    ->columns(3)
                    ->schema([
                        Select::make('loyalty_tier')
                            ->options([
                                'member' => 'Member',
                                'silver' => 'Silver',
                                'gold' => 'Gold',
                                'platinum' => 'Platinum',
                            ])
                            ->default('member'),

                        TextInput::make('loyalty_points')
                            ->numeric()
                            ->default(0)
                            ->minValue(0),

                        Placeholder::make('lifetime_preview')
                            ->label('Lifetime value')
                            ->content(fn (?User $record): string => $record
                                ? 'AED '.number_format((float) ($record->orders_sum_total ?? $record->orders()->sum('total')), 2)
                                : '—')
                            ->visibleOn('edit'),
                    ]),

                Section::make('Staff access')
                    ->icon('heroicon-o-shield-check')
                    ->description('Grant admin panel access. Staff members can log into /admin according to their role.')
                    ->columns(3)
                    ->visible(fn (): bool => auth()->user()?->isAdmin())
                    ->schema([
                        Toggle::make('is_admin')
                            ->label('Administrator')
                            ->helperText('Full access to everything.'),

                        Select::make('role')
                            ->options([
                                'admin' => 'Admin',
                                'manager' => 'Manager',
                                'support' => 'Support',
                            ])
                            ->placeholder('Customer (no staff access)'),

                        Placeholder::make('two_factor_preview')
                            ->label('Two-factor auth')
                            ->content(fn (?User $record): string => $record?->hasTwoFactorEnabled()
                                ? 'Enabled since '.$record->two_factor_confirmed_at->format('d M Y')
                                : 'Disabled')
                            ->visibleOn('edit'),

                        Placeholder::make('last_login_preview')
                            ->label('Last login')
                            ->content(fn (?User $record): string => $record?->last_login_at
                                ? $record->last_login_at->format('d M Y, H:i')
                                : 'Never')
                            ->visibleOn('edit')
                            ->columnSpan(2),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->searchable()
                    ->sortable()
                    ->description(fn (User $record): string => (string) $record->email),

                IconColumn::make('email_verified_at')
                    ->label('Verified')
                    ->boolean()
                    ->trueIcon('heroicon-o-check-badge')
                    ->falseIcon('heroicon-o-x-mark')
                    ->trueColor('success')
                    ->falseColor('gray'),

                TextColumn::make('loyalty_tier')
                    ->badge()
                    ->colors([
                        'gray' => 'member',
                        'info' => 'silver',
                        'warning' => 'gold',
                        'danger' => 'platinum',
                    ]),

                TextColumn::make('loyalty_points')
                    ->label('Points')
                    ->sortable()
                    ->badge()
                    ->color('success'),

                TextColumn::make('orders_count')
                    ->label('Orders')
                    ->counts('orders')
                    ->sortable(),

                TextColumn::make('orders_sum_total')
                    ->label('Lifetime value')
                    ->sum('orders', 'total')
                    ->money('AED')
                    ->sortable(),

                IconColumn::make('is_admin')
                    ->label('Admin')
                    ->boolean(),

                TextColumn::make('last_login_at')
                    ->since()
                    ->placeholder('never')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                TernaryFilter::make('is_admin')
                    ->label('Administrators'),

                SelectFilter::make('loyalty_tier')
                    ->options([
                        'member' => 'Member',
                        'silver' => 'Silver',
                        'gold' => 'Gold',
                        'platinum' => 'Platinum',
                    ]),

                TernaryFilter::make('email_verified')
                    ->label('Email verified')
                    ->queries(
                        true: fn (Builder $query) => $query->whereNotNull('email_verified_at'),
                        false: fn (Builder $query) => $query->whereNull('email_verified_at'),
                    ),
            ])
            ->actions([
                ActionGroup::make([
                    EditAction::make(),
                    ViewAction::make(),
                    Action::make('sendPasswordReset')
                        ->label('Send password reset')
                        ->icon('heroicon-o-key')
                        ->color('info')
                        ->requiresConfirmation()
                        ->modalDescription('Emails a password-reset link to this customer.')
                        ->visible(fn (User $record): bool => $record->role === null && ! $record->is_admin)
                        ->action(function (User $record): void {
                            $status = Password::sendResetLink(['email' => $record->email]);

                            if ($status === Password::RESET_LINK_SENT) {
                                AuditLogger::log(
                                    $record,
                                    'customer.password_reset.sent',
                                    [],
                                    ['email' => $record->email],
                                    "Password reset link sent to {$record->email}",
                                );

                                Notification::make()
                                    ->title('Reset link sent')
                                    ->success()
                                    ->send();
                            } else {
                                Notification::make()
                                    ->title('Could not send reset link')
                                    ->body(__($status))
                                    ->danger()
                                    ->send();
                            }
                        }),
                    Action::make('resetTwoFactor')
                        ->label('Reset 2FA')
                        ->icon('heroicon-o-key')
                        ->color('warning')
                        ->requiresConfirmation()
                        ->modalDescription('The user will need to re-enable two-factor authentication on their next login.')
                        ->visible(fn (User $record): bool => $record->hasTwoFactorEnabled())
                        ->action(function (User $record): void {
                            $record->forceFill([
                                'two_factor_secret' => null,
                                'two_factor_recovery_codes' => null,
                                'two_factor_confirmed_at' => null,
                            ])->save();
                        }),
                    DeleteAction::make(),
                ]),
            ])
            ->bulkActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('created_at', 'desc');
    }

    public static function getRelations(): array
    {
        return [
            RelationManagers\OrdersRelationManager::class,
            RelationManagers\AddressesRelationManager::class,
            RelationManagers\WishlistRelationManager::class,
            RelationManagers\CouponRedemptionsRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListCustomers::route('/'),
            'create' => Pages\CreateCustomer::route('/create'),
            'view' => Pages\ViewCustomer::route('/{record}'),
            'edit' => Pages\EditCustomer::route('/{record}/edit'),
        ];
    }

    public static function getGlobalSearchResultDetails(Model $record): array
    {
        return [
            'Email' => $record->email,
            'Orders' => (string) $record->orders()->count(),
        ];
    }
}
