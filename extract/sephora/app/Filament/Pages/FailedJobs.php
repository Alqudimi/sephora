<?php

namespace App\Filament\Pages;

use App\Models\FailedJob;
use Filament\Actions\Action;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;

/**
 * Queue operations: view, retry and discard failed jobs (e.g. stuck
 * confirmation emails) without SSH access to the server.
 */
class FailedJobs extends Page implements HasTable
{
    use InteractsWithTable;

    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-exclamation-triangle';

    protected static string|\UnitEnum|null $navigationGroup = 'System';

    protected static ?int $navigationSort = 6;

    protected static ?string $title = 'Failed Jobs';

    protected static ?string $navigationLabel = 'Failed Jobs';

    protected string $view = 'filament.pages.failed-jobs';

    public ?string $tableShouldRender = null;

    public static function canAccess(): bool
    {
        $user = auth()->user();

        return $user !== null && $user->isAdmin();
    }

    public static function getNavigationBadge(): ?string
    {
        $count = DB::table('failed_jobs')->count();

        return $count > 0 ? (string) $count : null;
    }

    public static function getNavigationBadgeColor(): ?string
    {
        return 'danger';
    }

    public function table(Table $table): Table
    {
        return $table
            ->query(FailedJob::query()->orderByDesc('failed_at'))
            ->columns([
                TextColumn::make('id')
                    ->label('#')
                    ->sortable(),

                TextColumn::make('queue')
                    ->badge()
                    ->color('info'),

                TextColumn::make('uuid')
                    ->limit(12)
                    ->copyable(),

                TextColumn::make('exception')
                    ->label('Error')
                    ->formatStateUsing(fn ($state): string => trim((string) strtok((string) $state, "\n")))
                    ->limit(90)
                    ->tooltip(fn ($state): string => mb_substr((string) $state, 0, 800)),

                TextColumn::make('failed_at')
                    ->dateTime('d M Y, H:i:s')
                    ->sortable(),
            ])
            ->actions([
                Action::make('retry')
                    ->label('Retry')
                    ->icon('heroicon-o-arrow-path')
                    ->color('success')
                    ->requiresConfirmation()
                    ->action(function (FailedJob $record): void {
                        Artisan::call('queue:retry', ['id' => [$record->uuid]]);

                        Notification::make()
                            ->title('Job queued for retry')
                            ->success()
                            ->send();
                    }),

                Action::make('delete')
                    ->label('Discard')
                    ->icon('heroicon-o-trash')
                    ->color('danger')
                    ->requiresConfirmation()
                    ->action(function (FailedJob $record): void {
                        $record->delete();

                        Notification::make()
                            ->title('Failed job discarded')
                            ->success()
                            ->send();
                    }),
            ])
            ->bulkActions([])
            ->emptyStateHeading('No failed jobs')
            ->emptyStateDescription('Everything in the queue is healthy.')
            ->poll('30s');
    }

    protected function getHeaderActions(): array
    {
        return [
            Action::make('retryAll')
                ->label('Retry all')
                ->icon('heroicon-o-arrow-path')
                ->color('success')
                ->requiresConfirmation()
                ->visible(fn (): bool => DB::table('failed_jobs')->count() > 0)
                ->action(function (): void {
                    Artisan::call('queue:retry all');

                    Notification::make()
                        ->title('All failed jobs queued for retry')
                        ->success()
                        ->send();
                }),

            Action::make('clear')
                ->label('Discard all')
                ->icon('heroicon-o-trash')
                ->color('danger')
                ->requiresConfirmation()
                ->visible(fn (): bool => DB::table('failed_jobs')->count() > 0)
                ->action(function (): void {
                    Artisan::call('queue:flush');

                    Notification::make()
                        ->title('Failed jobs discarded')
                        ->success()
                        ->send();
                }),
        ];
    }
}
