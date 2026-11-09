<?php

namespace App\Filament\Pages;

use App\Models\Setting;
use App\Support\CommerceSettings;
use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\Select;
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

            'zaincash_enabled' => (bool) Setting::get('zaincash_enabled', config('payments.zaincash.enabled', false)),
            'zaincash_mode' => Setting::get('zaincash_mode', config('payments.zaincash.mode', 'uat')),
            'zaincash_api_version' => Setting::get('zaincash_api_version', config('payments.zaincash.api_version', 'v2')),
            'zaincash_exchange_rate' => Setting::get('zaincash_exchange_rate', (string) config('payments.zaincash.exchange_rate', 355.0)),
            'zaincash_language' => Setting::get('zaincash_language', config('payments.zaincash.language', 'ar')),
            'zaincash_client_id' => Setting::get('zaincash_client_id', config('payments.zaincash.client_id', '')),
            'zaincash_client_secret' => Setting::get('zaincash_client_secret', config('payments.zaincash.client_secret', '')),
            'zaincash_merchant_id' => Setting::get('zaincash_merchant_id', config('payments.zaincash.merchant_id', '')),
            'zaincash_secret' => Setting::get('zaincash_secret', config('payments.zaincash.secret', '')),
            'zaincash_msisdn' => Setting::get('zaincash_msisdn', config('payments.zaincash.msisdn', '')),
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

                Section::make('ZainCash Payment Gateway (بوابة زين كاش)')
                    ->icon('heroicon-o-credit-card')
                    ->description('ZainCash Iraq digital wallet gateway configuration. All keys and environment switches can be managed dynamically here.')
                    ->columns(2)
                    ->schema([
                        Toggle::make('zaincash_enabled')
                            ->label('Enable ZainCash Gateway (تفعيل بوابة زين كاش)')
                            ->helperText('Enables the ZainCash wallet option in the storefront checkout.')
                            ->onColor('success')
                            ->offColor('danger')
                            ->columnSpanFull(),

                        Select::make('zaincash_mode')
                            ->label('Environment Mode (بيئة العمل)')
                            ->options([
                                'uat' => 'UAT / Sandbox (بيئة الاختبار والتجربة)',
                                'production' => 'Production (البيئة الحقيقية المباشرة)',
                            ])
                            ->default('uat')
                            ->required(),

                        Select::make('zaincash_api_version')
                            ->label('API Version (إصدار الواجهة البرمجية)')
                            ->options([
                                'v2' => 'API v2 (Modern OAuth2 - الواجهة الحديثة الموصى بها)',
                                'v1' => 'API v1 (Standard JWT HS256 - الواجهة التقليدية)',
                            ])
                            ->default('v2')
                            ->required(),

                        TextInput::make('zaincash_exchange_rate')
                            ->label('Exchange Rate (سعر الصرف: 1 درهم = دينار عراقي)')
                            ->numeric()
                            ->step(0.1)
                            ->minValue(1)
                            ->default(355.0)
                            ->helperText('Conversion rate from AED to IQD. Orders are converted to IQD when sending to ZainCash.')
                            ->required(),

                        Select::make('zaincash_language')
                            ->label('Payment Page Language (لغة صفحة الدفع)')
                            ->options([
                                'ar' => 'العربية (Arabic)',
                                'en' => 'English (الإنجليزية)',
                            ])
                            ->default('ar')
                            ->required(),

                        TextInput::make('zaincash_client_id')
                            ->label('OAuth2 Client ID (معرف العميل v2)')
                            ->placeholder('Enter ZainCash Client ID for v2 API')
                            ->helperText('Required for API v2 OAuth2 token generation.'),

                        TextInput::make('zaincash_client_secret')
                            ->label('OAuth2 Client Secret (الرمز السري للعميل v2)')
                            ->password()
                            ->revealable()
                            ->placeholder('Enter ZainCash Client Secret')
                            ->helperText('Required for API v2 OAuth2 token generation.'),

                        TextInput::make('zaincash_merchant_id')
                            ->label('Merchant ID (معرف التاجر)')
                            ->placeholder('e.g. 5ff64b154782d40008090d8c')
                            ->helperText('ZainCash Merchant ID.'),

                        TextInput::make('zaincash_secret')
                            ->label('Merchant Secret / JWT Key (المفتاح السري)')
                            ->password()
                            ->revealable()
                            ->placeholder('Secret key for JWT signing & webhook verification')
                            ->helperText('Used for signing v1 requests and verifying callback/webhook tokens.'),

                        TextInput::make('zaincash_msisdn')
                            ->label('Merchant MSISDN / Wallet Number (رقم محفظة التاجر)')
                            ->placeholder('9647800000000')
                            ->helperText('ZainCash mobile wallet number (e.g. 9647800000000).'),

                        Placeholder::make('zaincash_webhook_url')
                            ->label('ZainCash Webhook URL (رابط الويب هوك لإشعارات السيرفر)')
                            ->content(fn () => url('/payments/webhook/zaincash'))
                            ->helperText('Register this URL in your ZainCash Merchant Portal for asynchronous transaction confirmation.')
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
            'zaincash_enabled' => ! empty($state['zaincash_enabled']) ? '1' : '0',
            'zaincash_mode' => (string) ($state['zaincash_mode'] ?? 'uat'),
            'zaincash_api_version' => (string) ($state['zaincash_api_version'] ?? 'v2'),
            'zaincash_exchange_rate' => (string) ($state['zaincash_exchange_rate'] ?? '355'),
            'zaincash_language' => (string) ($state['zaincash_language'] ?? 'ar'),
            'zaincash_client_id' => (string) ($state['zaincash_client_id'] ?? ''),
            'zaincash_client_secret' => (string) ($state['zaincash_client_secret'] ?? ''),
            'zaincash_merchant_id' => (string) ($state['zaincash_merchant_id'] ?? ''),
            'zaincash_secret' => (string) ($state['zaincash_secret'] ?? ''),
            'zaincash_msisdn' => (string) ($state['zaincash_msisdn'] ?? ''),
        ] as $key => $value) {
            Setting::set($key, $value);
        }

        Notification::make()
            ->title('Settings saved')
            ->success()
            ->send();
    }
}
