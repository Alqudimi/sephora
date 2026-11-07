<?php

namespace App\Filament\Pages;

use App\Models\Setting;
use App\Support\CommerceSettings;
use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class ShopSettings extends Page implements HasForms
{
    use InteractsWithForms;

    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-cog-6-tooth';

    protected string $view = 'filament.pages.shop-settings';

    protected static string|\UnitEnum|null $navigationGroup = 'System';

    protected static ?string $title = 'Store Settings';

    protected static ?int $navigationSort = 1;

    /**
     * Store configuration (pricing, delivery, notifications) is a
     * manager/admin concern — support cannot change shop settings.
     */
    public static function canAccess(): bool
    {
        $user = auth()->user();

        return $user !== null && ($user->isAdmin() || $user->hasRole('manager'));
    }

    public ?array $data = [];

    public function mount(): void
    {
        $this->form->fill([
            'free_shipping_threshold' => Setting::get('free_shipping_threshold', config('commerce.free_shipping_threshold')),
            'shipping_fee' => Setting::get('shipping_fee', config('commerce.shipping.standard')),
            'same_day_fee' => Setting::get('same_day_fee', config('commerce.shipping.same_day')),
            'cod_fee' => Setting::get('cod_fee', config('commerce.shipping.cod_fee')),
            'free_shipping_message' => Setting::get('free_shipping_message', 'Free Delivery on orders over 250 AED'),

            'vat_rate_percent' => Setting::get('vat_rate_percent', (string) CommerceSettings::vatRatePercent()),
            'company_trn' => Setting::get('company_trn', ''),

            'low_stock_threshold' => Setting::get('low_stock_threshold', (string) CommerceSettings::lowStockThreshold()),
            'max_quantity_per_item' => Setting::get('max_quantity_per_item', (string) CommerceSettings::maxQuantityPerItem()),
            'max_samples' => Setting::get('max_samples', (string) CommerceSettings::maxSamples()),

            'loyalty_enabled' => Setting::get('loyalty_enabled', '1') !== '0',

            'admin_notify_email' => Setting::get('admin_notify_email', ''),
        ]);
    }

    public function form(Schema $schema): Schema
    {
        return $schema
            ->statePath('data')
            ->components([
                Section::make('Delivery')
                    ->icon('heroicon-o-truck')
                    ->description('These overrides are read live by the storefront checkout.')
                    ->columns(2)
                    ->schema([
                        TextInput::make('free_shipping_threshold')
                            ->label('Free standard shipping threshold')
                            ->numeric()
                            ->prefix('AED')
                            ->minValue(0)
                            ->helperText('Standard delivery is free at or above this merchandise value.'),

                        TextInput::make('shipping_fee')
                            ->label('Standard delivery fee')
                            ->numeric()
                            ->prefix('AED')
                            ->minValue(0),

                        TextInput::make('same_day_fee')
                            ->label('Same-day delivery fee')
                            ->numeric()
                            ->prefix('AED')
                            ->minValue(0),

                        TextInput::make('cod_fee')
                            ->label('Cash-on-delivery surcharge')
                            ->numeric()
                            ->prefix('AED')
                            ->minValue(0)
                            ->helperText('Added on top of the delivery fee for COD orders.'),

                        TextInput::make('free_shipping_message')
                            ->label('Free shipping banner message')
                            ->maxLength(120)
                            ->columnSpanFull(),
                    ]),

                Section::make('Taxes (UAE VAT)')
                    ->icon('heroicon-o-calculator')
                    ->description('VAT is extracted from VAT-inclusive storefront prices.')
                    ->columns(2)
                    ->schema([
                        TextInput::make('vat_rate_percent')
                            ->label('VAT rate (%)')
                            ->numeric()
                            ->suffix('%')
                            ->minValue(0)
                            ->maxValue(100)
                            ->step(0.5)
                            ->helperText('Standard UAE VAT is 5%.'),

                        TextInput::make('company_trn')
                            ->label('Company TRN')
                            ->maxLength(30)
                            ->helperText('Printed on every tax invoice. Leave empty while unregistered.'),
                    ]),

                Section::make('Inventory & cart limits')
                    ->icon('heroicon-o-cube')
                    ->columns(3)
                    ->schema([
                        TextInput::make('low_stock_threshold')
                            ->label('Low-stock threshold')
                            ->numeric()
                            ->minValue(0)
                            ->helperText('Products at or below this stock level count as low stock.'),

                        TextInput::make('max_quantity_per_item')
                            ->label('Max quantity per item')
                            ->numeric()
                            ->minValue(1)
                            ->helperText('Per product in the bag.'),

                        TextInput::make('max_samples')
                            ->label('Max free samples')
                            ->numeric()
                            ->minValue(0)
                            ->helperText('Offered at checkout.'),
                    ]),

                Section::make('Loyalty (Beauty Pass)')
                    ->icon('heroicon-o-star')
                    ->columns(2)
                    ->schema([
                        Toggle::make('loyalty_enabled')
                            ->label('Award Beauty Pass points')
                            ->onColor('success')
                            ->offColor('danger')
                            ->helperText('When off, new orders do not accrue points.'),

                        Placeholder::make('loyalty_preview')
                            ->label('Rule')
                            ->content('1 point per AED 1 of merchandise spend (after discounts).'),
                    ]),

                Section::make('Notifications')
                    ->icon('heroicon-o-bell')
                    ->columns(2)
                    ->schema([
                        TextInput::make('admin_notify_email')
                            ->label('New-order alert email')
                            ->email()
                            ->helperText('Optional. Receives an alert every time an order is placed.')
                            ->columnSpanFull(),
                    ]),
            ]);
    }

    public function save(): void
    {
        $state = $this->form->getState();

        foreach ([
            'free_shipping_threshold' => (string) ($state['free_shipping_threshold'] ?? ''),
            'shipping_fee' => (string) ($state['shipping_fee'] ?? ''),
            'same_day_fee' => (string) ($state['same_day_fee'] ?? ''),
            'cod_fee' => (string) ($state['cod_fee'] ?? ''),
            'free_shipping_message' => (string) ($state['free_shipping_message'] ?? ''),
            'vat_rate_percent' => (string) ($state['vat_rate_percent'] ?? ''),
            'company_trn' => (string) ($state['company_trn'] ?? ''),
            'low_stock_threshold' => (string) ($state['low_stock_threshold'] ?? ''),
            'max_quantity_per_item' => (string) ($state['max_quantity_per_item'] ?? ''),
            'max_samples' => (string) ($state['max_samples'] ?? ''),
            'loyalty_enabled' => ! empty($state['loyalty_enabled']) ? '1' : '0',
            'admin_notify_email' => (string) ($state['admin_notify_email'] ?? ''),
        ] as $key => $value) {
            Setting::set($key, $value);
        }

        Notification::make()
            ->title('Settings saved')
            ->success()
            ->send();
    }
}
