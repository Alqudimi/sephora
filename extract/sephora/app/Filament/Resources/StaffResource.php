<?php

namespace App\Filament\Resources;

use App\Filament\Resources\StaffResource\Pages;
use App\Filament\Resources\StaffResource\RelationManagers;
use App\Models\User;
use App\Policies\StaffPolicy;
use App\Services\Audit\AuditLogger;
use Filament\Actions\Action;
use Filament\Actions\ActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
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
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rules\Password;

/**
 * Admin-only management of panel accounts (admins, managers, support).
 * Customers live in CustomerResource — this surface never touches them.
 */
class StaffResource extends Resource
{
    protected static ?string $model = User::class;

    protected static string|\BackedEnum|null $navigationIcon = Heroicon::OutlinedIdentification;

    protected static string|\UnitEnum|null $navigationGroup = 'System';

    protected static ?int $navigationSort = 5;

    protected static ?string $recordTitleAttribute = 'name';

    public static function getNavigationLabel(): string
    {
        return 'Staff Accounts';
    }

    /**
     * Authorization is routed to StaffPolicy explicitly: the User model
     * is shared with CustomerResource, so policy auto-discovery cannot
     * pick the right policy by name.
     */
    public static function canViewAny(): bool
    {
        $user = auth()->user();

        return $user !== null && app(StaffPolicy::class)->viewAny($user);
    }

    public static function canCreate(): bool
    {
        $user = auth()->user();

        return $user !== null && app(StaffPolicy::class)->create($user);
    }

    public static function canView(Model $record): bool
    {
        $user = auth()->user();

        return $user !== null && app(StaffPolicy::class)->view($user, $record);
    }

    public static function canEdit(Model $record): bool
    {
        $user = auth()->user();

        return $user !== null && app(StaffPolicy::class)->update($user, $record);
    }

    public static function canDelete(Model $record): bool
    {
        $user = auth()->user();

        return $user !== null && app(StaffPolicy::class)->delete($user, $record);
    }

    public static function canDeleteAny(): bool
    {
        $user = auth()->user();

        return $user !== null && app(StaffPolicy::class)->deleteAny($user);
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->where(fn (Builder $query) => $query
                ->whereIn('role', ['admin', 'manager', 'support'])
                ->orWhere('is_admin', true))
            ->withCount('auditLogs');
    }

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Account')
                    ->icon('heroicon-o-user')
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
                            ->rule(Password::default())
                            ->helperText('Leave blank when editing to keep the current password.'),

                        TextInput::make('phone')
                            ->tel()
                            ->maxLength(40),
                    ]),

                Section::make('Panel access')
                    ->icon('heroicon-o-shield-check')
                    ->description('Roles define what the account can reach. Two-factor is enforced at the first login.')
                    ->columns(3)
                    ->schema([
                        Select::make('role')
                            ->options([
                                'admin' => 'Admin — full access',
                                'manager' => 'Manager — catalogue, orders, refunds',
                                'support' => 'Support — operations & moderation',
                            ])
                            ->required()
                            ->default('support')
                            ->disabled(fn (?User $record): bool => self::isProtected($record))
                            ->helperText(fn (?User $record): string => self::isProtected($record)
                                ? 'Protected: you cannot change your own role, or the last administrator.'
                                : ''),

                        Toggle::make('is_admin')
                            ->label('Administrator flag')
                            ->helperText('Legacy boolean grant — full access regardless of role.')
                            ->disabled(fn (?User $record): bool => self::isProtected($record)),

                        Placeholder::make('two_factor_preview')
                            ->label('Two-factor auth')
                            ->content(fn (?User $record): string => $record?->hasTwoFactorEnabled()
                                ? 'Enabled since '.$record->two_factor_confirmed_at->format('d M Y')
                                : 'Not set up — they will be prompted at next login')
                            ->visibleOn('edit'),

                        Placeholder::make('last_login_preview')
                            ->label('Last login')
                            ->content(fn (?User $record): string => $record?->last_login_at
                                ? $record->last_login_at->format('d M Y, H:i')
                                : 'Never')
                            ->visibleOn('edit'),

                        Placeholder::make('sessions_preview')
                            ->label('Active sessions')
                            ->content(fn (?User $record): string => $record
                                ? (string) DB::table('sessions')->where('user_id', $record->id)->count()
                                : '—')
                            ->visibleOn('edit'),
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

                TextColumn::make('role')
                    ->badge()
                    ->formatStateUsing(fn (?string $state): string => $state ? str($state)->title() : '—')
                    ->colors([
                        'danger' => 'admin',
                        'warning' => 'manager',
                        'info' => 'support',
                        'gray' => fn (?string $state): bool => blank($state),
                    ])
                    ->sortable(),

                IconColumn::make('is_admin')
                    ->label('Admin flag')
                    ->boolean(),

                IconColumn::make('two_factor_confirmed_at')
                    ->label('2FA')
                    ->boolean()
                    ->trueIcon('heroicon-o-lock-closed')
                    ->falseIcon('heroicon-o-lock-open')
                    ->trueColor('success')
                    ->falseColor('danger')
                    ->sortable(),

                TextColumn::make('audit_logs_count')
                    ->label('Audit entries')
                    ->counts('auditLogs')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('last_login_at')
                    ->label('Last login')
                    ->since()
                    ->placeholder('never')
                    ->sortable(),

                TextColumn::make('created_at')
                    ->date('d M Y')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                SelectFilter::make('role')
                    ->options([
                        'admin' => 'Admin',
                        'manager' => 'Manager',
                        'support' => 'Support',
                    ]),

                TernaryFilter::make('two_factor_confirmed_at')
                    ->label('Two-factor confirmed')
                    ->nullable()
                    ->queries(
                        true: fn (Builder $query) => $query->whereNotNull('two_factor_confirmed_at'),
                        false: fn (Builder $query) => $query->whereNull('two_factor_confirmed_at'),
                    ),

                TernaryFilter::make('is_admin')
                    ->label('Administrator flag'),
            ])
            ->actions([
                ActionGroup::make([
                    EditAction::make(),
                    ViewAction::make(),

                    Action::make('forceLogout')
                        ->label('Force logout')
                        ->icon('heroicon-o-arrow-right-on-rectangle')
                        ->color('danger')
                        ->requiresConfirmation()
                        ->modalDescription('All of this account\'s sessions will be destroyed immediately. They will need to log in again.')
                        ->visible(fn (User $record): bool => auth()->user() !== null
                            && app(StaffPolicy::class)->forceLogout(auth()->user(), $record)
                            && DB::table('sessions')->where('user_id', $record->id)->exists())
                        ->action(function (User $record): void {
                            DB::table('sessions')->where('user_id', $record->id)->delete();

                            AuditLogger::log($record, 'staff.force_logout', [], [
                                'sessions_cleared' => true,
                            ], "Staff {$record->email}: all sessions revoked by admin");

                            Notification::make()
                                ->title('Sessions revoked')
                                ->body("{$record->name} has been signed out everywhere.")
                                ->success()
                                ->send();
                        }),

                    Action::make('resetTwoFactor')
                        ->label('Reset 2FA')
                        ->icon('heroicon-o-key')
                        ->color('warning')
                        ->requiresConfirmation()
                        ->modalDescription('The staff member must set up two-factor authentication again at their next login.')
                        ->visible(fn (User $record): bool => $record->hasTwoFactorEnabled()
                            && auth()->user() !== null
                            && app(StaffPolicy::class)->resetTwoFactor(auth()->user(), $record))
                        ->action(function (User $record): void {
                            $record->forceFill([
                                'two_factor_secret' => null,
                                'two_factor_recovery_codes' => null,
                                'two_factor_confirmed_at' => null,
                            ])->save();

                            DB::table('sessions')->where('user_id', $record->id)->delete();

                            AuditLogger::log($record, 'staff.two_factor.reset', [], [
                                'two_factor_confirmed_at' => null,
                            ], "Staff {$record->email}: two-factor reset by admin");

                            Notification::make()
                                ->title('Two-factor reset')
                                ->success()
                                ->send();
                        }),

                    DeleteAction::make()
                        ->visible(fn (User $record): bool => static::canDelete($record)),
                ]),
            ])
            ->defaultSort('created_at', 'desc');
    }

    public static function getRelations(): array
    {
        return [
            RelationManagers\AuditLogsRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListStaff::route('/'),
            'create' => Pages\CreateStaff::route('/create'),
            'view' => Pages\ViewStaff::route('/{record}'),
            'edit' => Pages\EditStaff::route('/{record}/edit'),
        ];
    }

    /**
     * The acting admin may not demote themselves or the last remaining
     * administrator through this form.
     */
    public static function isProtected(?User $record): bool
    {
        if ($record === null) {
            return false;
        }

        if ($record->is(auth()->user())) {
            return true;
        }

        return app(StaffPolicy::class)->isLastAdministrator($record);
    }
}
