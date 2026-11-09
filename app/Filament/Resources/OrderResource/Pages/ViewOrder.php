<?php

namespace App\Filament\Resources\OrderResource\Pages;

use App\Filament\Resources\OrderResource;
use App\Mail\OrderConfirmationMail;
use App\Mail\OrderRefundedMail;
use App\Mail\OrderShippedMail;
use App\Models\AuditLog;
use App\Models\Order;
use App\Services\Commerce\ShippingCalculator;
use App\Services\Orders\OrderStateMachine;
use Filament\Actions\Action;
use Filament\Actions\DeleteAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Infolists\Components\RepeatableEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\ViewRecord;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\ValidationException;

class ViewOrder extends ViewRecord
{
    protected static string $resource = OrderResource::class;

    public function infolist(Schema $schema): Schema
    {
        return $schema
            ->components([
                Grid::make(4)
                    ->schema([
                        Section::make('Order')
                            ->icon('heroicon-o-shopping-cart')
                            ->columnSpan(1)
                            ->schema([
                                TextEntry::make('order_number')
                                    ->weight('bold')
                                    ->copyable(),

                                TextEntry::make('placed_at')
                                    ->dateTime('d M Y, H:i')
                                    ->placeholder('—'),

                                TextEntry::make('status')
                                    ->badge()
                                    ->formatStateUsing(fn ($state): string => str($state)->headline())
                                    ->colors(OrderResource::statusColors()),

                                TextEntry::make('payment_status')
                                    ->badge()
                                    ->formatStateUsing(fn ($state): string => str($state)->headline())
                                    ->colors(OrderResource::paymentStatusColors()),

                                TextEntry::make('payment_method')
                                    ->formatStateUsing(fn ($record): string => $record->payment_method_label)
                                    ->badge(),

                                TextEntry::make('payment_reference')
                                    ->placeholder('—')
                                    ->copyable()
                                    ->visible(fn ($record): bool => filled($record->payment_reference)),
                            ]),

                        Section::make('Customer')
                            ->icon('heroicon-o-user')
                            ->columnSpan(1)
                            ->schema([
                                TextEntry::make('customer_name')
                                    ->weight('bold'),

                                TextEntry::make('customer_email')
                                    ->copyable(),

                                TextEntry::make('customer_phone')
                                    ->copyable(),

                                TextEntry::make('user.loyalty_tier')
                                    ->label('Loyalty tier')
                                    ->badge()
                                    ->visible(fn ($record): bool => $record->user !== null),

                                TextEntry::make('loyalty_points_earned')
                                    ->label('Points earned')
                                    ->badge()
                                    ->color('success'),
                            ]),

                        Section::make('Delivery')
                            ->icon('heroicon-o-truck')
                            ->columnSpan(1)
                            ->schema([
                                TextEntry::make('delivery_method')
                                    ->formatStateUsing(fn ($record): string => app(ShippingCalculator::class)->label($record->delivery_method))
                                    ->badge(),

                                TextEntry::make('shipping_address')
                                    ->visible(fn ($record): bool => $record->delivery_method !== 'click_collect')
                                    ->placeholder('—'),

                                TextEntry::make('emirate')
                                    ->badge()
                                    ->visible(fn ($record): bool => $record->delivery_method !== 'click_collect'),

                                TextEntry::make('store.name')
                                    ->label('Collection store')
                                    ->visible(fn ($record): bool => $record->delivery_method === 'click_collect'),

                                TextEntry::make('delivery_instructions')
                                    ->placeholder('—'),

                                TextEntry::make('courier')
                                    ->formatStateUsing(fn ($record): string => $record->courier_label ?? '—')
                                    ->badge()
                                    ->placeholder('—'),

                                TextEntry::make('tracking_number')
                                    ->placeholder('—')
                                    ->copyable()
                                    ->url(fn ($record): ?string => $record->tracking_url)
                                    ->openUrlInNewTab(),
                            ]),

                        Section::make('Timeline')
                            ->icon('heroicon-o-clock')
                            ->columnSpan(1)
                            ->schema([
                                TextEntry::make('placed_at')
                                    ->label('Placed')
                                    ->dateTime('d M H:i')
                                    ->placeholder('—'),

                                TextEntry::make('shipped_at')
                                    ->label('Shipped')
                                    ->dateTime('d M H:i')
                                    ->placeholder('—'),

                                TextEntry::make('delivered_at')
                                    ->label('Delivered')
                                    ->dateTime('d M H:i')
                                    ->placeholder('—'),

                                TextEntry::make('cancelled_at')
                                    ->label('Cancelled')
                                    ->dateTime('d M H:i')
                                    ->placeholder('—'),

                                TextEntry::make('refunded_at')
                                    ->label('Refunded')
                                    ->dateTime('d M H:i')
                                    ->placeholder('—'),

                                TextEntry::make('cancel_reason')
                                    ->visible(fn ($record): bool => filled($record->cancel_reason)),
                            ]),
                    ]),

                Section::make('Items')
                    ->icon('heroicon-o-cube')
                    ->schema([
                        RepeatableEntry::make('items')
                            ->hiddenLabel()
                            ->columns([
                                'default' => 5,
                            ])
                            ->schema([
                                TextEntry::make('product_name')
                                    ->weight('bold')
                                    ->limit(30),

                                TextEntry::make('brand_name')
                                    ->placeholder('—'),

                                TextEntry::make('shade_name')
                                    ->placeholder('—'),

                                TextEntry::make('unit_price')
                                    ->money('AED'),

                                TextEntry::make('quantity')
                                    ->badge()
                                    ->color('gray'),
                            ]),
                    ]),

                Grid::make(2)
                    ->schema([
                        Section::make('Totals')
                            ->icon('heroicon-o-calculator')
                            ->schema([
                                TextEntry::make('subtotal')
                                    ->money('AED'),

                                TextEntry::make('discount')
                                    ->money('AED')
                                    ->color(fn ($state): string => $state > 0 ? 'danger' : 'gray')
                                    ->formatStateUsing(fn ($state) => $state > 0 ? '- '.number_format((float) $state, 2).' AED' : '0.00 AED'),

                                TextEntry::make('coupon_code')
                                    ->badge()
                                    ->color('info')
                                    ->visible(fn ($record): bool => filled($record->coupon_code)),

                                TextEntry::make('shipping_fee')
                                    ->money('AED')
                                    ->formatStateUsing(fn ($state) => $state == 0 ? 'Free' : number_format((float) $state, 2).' AED'),

                                TextEntry::make('subtotal_ex_tax')
                                    ->label('Taxable amount (excl. VAT)')
                                    ->money('AED')
                                    ->visible(fn ($record): bool => (float) $record->tax_amount > 0),

                                TextEntry::make('tax_amount')
                                    ->label('VAT due')
                                    ->money('AED')
                                    ->formatStateUsing(fn ($record): string => number_format((float) $record->tax_amount, 2).' AED ('.round($record->tax_rate * 100, 2).'%)')
                                    ->color('warning')
                                    ->visible(fn ($record): bool => (float) $record->tax_amount > 0),

                                TextEntry::make('total')
                                    ->weight('bold')
                                    ->money('AED')
                                    ->size('lg')
                                    ->helperText('VAT inclusive where applicable'),

                                TextEntry::make('refund_amount')
                                    ->money('AED')
                                    ->color('danger')
                                    ->visible(fn ($record): bool => (float) $record->refund_amount > 0),
                            ]),

                        Section::make('Extras')
                            ->icon('heroicon-o-gift')
                            ->schema([
                                TextEntry::make('gift_box')
                                    ->label('Gift box')
                                    ->badge()
                                    ->formatStateUsing(fn ($state): string => $state ? 'Yes' : 'No'),

                                TextEntry::make('gift_message')
                                    ->placeholder('—')
                                    ->visible(fn ($record): bool => filled($record->gift_message)),

                                TextEntry::make('samples')
                                    ->badge()
                                    ->color('info')
                                    ->formatStateUsing(fn ($state): string => is_array($state) ? count($state).' samples' : '—'),
                            ]),
                    ]),
            ]);
    }

    protected function getHeaderActions(): array
    {
        return [
            $this->makeTransitionAction('processing', 'Mark as Processing', 'heroicon-o-cog-6-tooth', 'info'),
            $this->makeTransitionAction('shipped', 'Mark as Shipped', 'heroicon-o-truck', 'info')
                ->form([
                    Select::make('courier')
                        ->label('Courier / Carrier')
                        ->options([
                            'aramex' => 'Aramex (أرامكس)',
                            'dhl' => 'DHL Express',
                            'fedex' => 'FedEx',
                            'smsa' => 'SMSA Express',
                            'emirates_post' => 'Emirates Post',
                            'fetchr' => 'Fetchr',
                            'other' => 'Private Delivery Fleet',
                        ])
                        ->default('aramex')
                        ->required(),
                    TextInput::make('tracking_number')
                        ->label('Tracking number')
                        ->maxLength(100)
                        ->placeholder('e.g. 123456789 or DHL-987654321'),
                ]),
            $this->makeTransitionAction('out_for_delivery', 'Out for Delivery', 'heroicon-o-paper-airplane', 'info'),
            $this->makeTransitionAction('delivered', 'Mark as Delivered', 'heroicon-o-check-circle', 'success'),

            Action::make('cancel')
                ->label('Cancel order')
                ->icon('heroicon-o-x-circle')
                ->color('danger')
                ->requiresConfirmation()
                ->form([
                    Textarea::make('cancel_reason')
                        ->label('Cancellation reason')
                        ->required()
                        ->rows(2),
                ])
                ->action(function (array $data): void {
                    $this->applyTransition('cancelled', [
                        'cancel_reason' => $data['cancel_reason'],
                    ], 'Order cancelled. Stock has been restored.');
                }),

            Action::make('refund')
                ->label('Refund')
                ->icon('heroicon-o-arrow-uturn-left')
                ->color('warning')
                ->requiresConfirmation()
                ->visible(fn (): bool => auth()->user()->can('refund', $this->getRecord())
                    && app(OrderStateMachine::class)->canTransition($this->getRecord(), 'refunded'))
                ->form([
                    TextInput::make('refund_amount')
                        ->label('Refund amount')
                        ->numeric()
                        ->prefix('AED')
                        ->required()
                        ->maxValue(fn (): float => (float) $this->getRecord()->total)
                        ->helperText(fn (): string => 'Order total: '.number_format((float) $this->getRecord()->total, 2).' AED'),

                    TextInput::make('refund_reference')
                        ->label('Refund reference')
                        ->maxLength(100),
                ])
                ->action(function (array $data): void {
                    $this->applyTransition('refunded', [
                        'refund_amount' => $data['refund_amount'],
                        'refund_reference' => $data['refund_reference'] ?? null,
                        'payment_status' => 'refunded',
                    ], 'Order refunded.', ability: 'refund');
                }),

            Action::make('markPaid')
                ->label('Mark as paid')
                ->icon('heroicon-o-banknotes')
                ->color('success')
                ->requiresConfirmation()
                ->visible(fn (): bool => $this->getRecord()->payment_status === 'pending'
                    && auth()->user()->can('refund', $this->getRecord()))
                ->action(function (): void {
                    $order = $this->getRecord();

                    $this->authorizeMoneyAction();

                    app(OrderStateMachine::class)->markPaid(
                        $order,
                        'manual',
                        'admin-'.auth()->id(),
                    );

                    $this->logAction('order.payment.marked_paid', [
                        'payment_status' => 'pending',
                    ], [
                        'payment_status' => 'paid',
                    ], "Order {$order->order_number}: payment marked as paid (manual)");

                    Notification::make()
                        ->title('Payment recorded')
                        ->success()
                        ->send();
                }),

            Action::make('invoice')
                ->label('Print tax invoice')
                ->icon('heroicon-o-printer')
                ->color('gray')
                ->url(fn (): string => route('filament.admin.invoice', $this->getRecord()))
                ->openUrlInNewTab(),

            Action::make('resendConfirmation')
                ->label('Resend confirmation')
                ->icon('heroicon-o-envelope')
                ->color('gray')
                ->requiresConfirmation()
                ->modalDescription('Re-sends the original order confirmation email to the customer.')
                ->visible(fn (): bool => filled($this->getRecord()->customer_email ?: $this->getRecord()->guest_email))
                ->action(function (): void {
                    $order = $this->getRecord();

                    Mail::to($order->customer_email ?: $order->guest_email)
                        ->send(new OrderConfirmationMail($order));

                    $this->logAction('order.email.resent', [], [
                        'template' => 'order-confirmation',
                    ], "Order {$order->order_number}: confirmation email resent manually");

                    Notification::make()
                        ->title('Confirmation email sent')
                        ->success()
                        ->send();
                }),

            EditAction::make()
                ->label('Edit details'),
            DeleteAction::make(),
        ];
    }

    private function makeTransitionAction(string $to, string $label, string $icon, string $color): Action
    {
        return Action::make('transition_'.$to)
            ->label($label)
            ->icon($icon)
            ->color($color)
            ->requiresConfirmation()
            ->visible(fn (): bool => app(OrderStateMachine::class)->canTransition($this->getRecord(), $to))
            ->action(function (array $data = []) use ($to): void {
                $this->applyTransition($to, $data, "Order moved to {$to}.");
            });
    }

    private function applyTransition(string $to, array $attributes, string $message, ?string $ability = null): void
    {
        // Hard enforcement: visibility alone does not stop crafted Livewire
        // requests, so the policy is re-checked on every execution.
        $this->authorizeStatusChange($ability);

        try {
            $from = $this->getRecord()->status;
            $order = app(OrderStateMachine::class)->transition($this->getRecord(), $to, $attributes);

            $this->logAction('order.status.updated', [
                'status' => $from,
            ], [
                'status' => $to,
            ], "Order {$order->order_number}: {$from} -> {$to}");

            $this->notifyCustomerOfTransition($order, $to);

            Notification::make()
                ->title($message)
                ->success()
                ->send();

            $this->refreshRecord($order);
        } catch (\InvalidArgumentException $exception) {
            Notification::make()
                ->title('Invalid status change')
                ->body($exception->getMessage())
                ->danger()
                ->send();

            throw ValidationException::withMessages([
                'status' => $exception->getMessage(),
            ]);
        }
    }

    /**
     * Customer e-mails for the transitions where an update is expected.
     * Failures never abort the status change itself.
     */
    private function notifyCustomerOfTransition(Order $order, string $to): void
    {
        try {
            $email = $order->customer_email ?: $order->guest_email;

            if (! $email) {
                return;
            }

            $mail = match ($to) {
                'shipped' => OrderShippedMail::class,
                'refunded' => OrderRefundedMail::class,
                default => null,
            };

            if ($mail !== null) {
                Mail::to($email)->send(new $mail($order));

                $this->logAction('order.email.sent', [], [
                    'template' => $to,
                ], "Order {$order->order_number}: {$to} email sent to customer");
            }
        } catch (\Throwable) {
            // Delivery problems must not roll back a status change.
        }
    }

    /**
     * Every staff member may move an order through fulfilment
     * (OrderPolicy::updateStatus); money movement additionally requires
     * the refund ability (admins and managers only).
     */
    private function authorizeStatusChange(?string $ability = null): void
    {
        $order = $this->getRecord();
        $user = auth()->user();

        abort_if($user === null || ! $user->can('updateStatus', $order), 403);

        if ($ability !== null) {
            abort_if(! $user->can($ability, $order), 403);
        }
    }

    private function authorizeMoneyAction(): void
    {
        $user = auth()->user();

        abort_if($user === null || ! $user->can('refund', $this->getRecord()), 403);
    }

    private function refreshRecord($order): void
    {
        $this->record = $order->refresh();
        $this->fillForm();
    }

    private function logAction(string $action, array $oldValues = [], array $newValues = [], ?string $description = null): void
    {
        AuditLog::create([
            'user_id' => auth()->id(),
            'action' => $action,
            'auditable_type' => $this->getRecord()->getMorphClass(),
            'auditable_id' => $this->getRecord()->getKey(),
            'description' => $description ?? $action,
            'ip_address' => request()?->ip(),
            'user_agent' => substr((string) request()?->userAgent(), 0, 500),
            'old_values' => $oldValues ?: null,
            'new_values' => $newValues ?: null,
        ]);
    }
}
