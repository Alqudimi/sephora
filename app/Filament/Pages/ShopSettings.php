<?php

namespace App\Filament\Pages;

use App\Models\Setting;
use App\Support\CommerceSettings;
use Filament\Forms\Components\ColorPicker;
use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
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
            // General Information & Branding
            'store_name' => Setting::get('store_name', config('app.name', 'SEPHORA UAE')),
            'store_tagline' => Setting::get('store_tagline', 'Beauty Products, Makeup, Perfume & Skincare'),
            'contact_email' => Setting::get('contact_email', 'customercare@sephora.ae'),
            'contact_phone' => Setting::get('contact_phone', '+971 4 000 0000'),
            'support_hours' => Setting::get('support_hours', '10 AM – 10 PM'),
            'currency_symbol' => Setting::get('currency_symbol', 'AED'),

            // Top Announcement Bar
            'announcement_enabled' => Setting::get('announcement_enabled', '1') !== '0',
            'announcement_bold' => Setting::get('announcement_bold', 'Discover The Holiday Collection'),
            'announcement_message' => Setting::get('announcement_message', 'Limited-edition sets, iconic bestsellers, and festive must-haves - shop them all.'),
            'announcement_action_text' => Setting::get('announcement_action_text', 'SHOP NOW →'),
            'announcement_action_link' => Setting::get('announcement_action_link', '/shop/gifts'),
            'announcement_bg_color' => Setting::get('announcement_bg_color', '#1A3066'),
            'announcement_text_color' => Setting::get('announcement_text_color', '#FFFFFF'),

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

            // Payment Gateways
            'card_enabled' => Setting::get('card_enabled', config('payments.methods.card.enabled', true) ? '1' : '0') !== '0',
            'apple_pay_enabled' => Setting::get('apple_pay_enabled', config('payments.methods.apple_pay.enabled', true) ? '1' : '0') !== '0',
            'cod_enabled' => Setting::get('cod_enabled', config('payments.methods.cod.enabled', true) ? '1' : '0') !== '0',
            'cod_max_limit' => Setting::get('cod_max_limit', '5000'),
            // Tabby
            'tabby_enabled' => (bool) Setting::get('tabby_enabled', config('payments.tabby.enabled', false)),
            'tabby_mode' => Setting::get('tabby_mode', config('payments.tabby.mode', 'sandbox')),
            'tabby_public_key' => Setting::get('tabby_public_key', config('payments.tabby.public_key', '')),
            'tabby_secret_key' => Setting::get('tabby_secret_key', config('payments.tabby.secret_key', '')),
            'tabby_merchant_code' => Setting::get('tabby_merchant_code', config('payments.tabby.merchant_code', 'sephora_ae')),

            // Tamara
            'tamara_enabled' => (bool) Setting::get('tamara_enabled', config('payments.tamara.enabled', false)),
            'tamara_mode' => Setting::get('tamara_mode', config('payments.tamara.mode', 'sandbox')),
            'tamara_api_token' => Setting::get('tamara_api_token', config('payments.tamara.api_token', '')),
            'tamara_notification_token' => Setting::get('tamara_notification_token', config('payments.tamara.notification_token', '')),
            'tamara_public_key' => Setting::get('tamara_public_key', config('payments.tamara.public_key', '')),

            'stripe_secret' => Setting::get('stripe_secret', (string) config('payments.stripe.secret', '')),
            'stripe_webhook_secret' => Setting::get('stripe_webhook_secret', (string) config('payments.stripe.webhook_secret', '')),

            // ZainCash
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

            // Social & SEO
            'social_instagram' => Setting::get('social_instagram', 'https://instagram.com/sephoramiddleeast'),
            'social_facebook' => Setting::get('social_facebook', 'https://facebook.com/sephoramiddleeast'),
            'social_tiktok' => Setting::get('social_tiktok', 'https://tiktok.com/@sephoramiddleeast'),
            'social_youtube' => Setting::get('social_youtube', 'https://youtube.com/sephoramiddleeast'),
            'social_twitter' => Setting::get('social_twitter', 'https://twitter.com/sephora'),
            'seo_meta_title' => Setting::get('seo_meta_title', 'Beauty Products, Makeup, Perfume & Skincare ≡ Sephora UAE'),
            'seo_meta_description' => Setting::get('seo_meta_description', 'Shop makeup, skincare, fragrance & more at Sephora UAE. Free delivery on orders over 250 AED. 100% authentic products from official brands.'),
        ]);
    }

    public function form(Schema $schema): Schema
    {
        return $schema
            ->statePath('data')
            ->components([
                Section::make('Store Identity & Contact (هوية المتجر وبيانات التواصل)')
                    ->icon('heroicon-o-building-storefront')
                    ->description('General store name, branding, customer concierge contacts, and currency.')
                    ->columns(2)
                    ->schema([
                        TextInput::make('store_name')
                            ->label('Store Name (اسم المتجر)')
                            ->required()
                            ->maxLength(100),

                        TextInput::make('currency_symbol')
                            ->label('Currency Code (رمز العملة)')
                            ->default('AED')
                            ->required()
                            ->maxLength(10),

                        TextInput::make('store_tagline')
                            ->label('Store Slogan (شعار المتجر)')
                            ->maxLength(200)
                            ->columnSpanFull(),

                        TextInput::make('contact_email')
                            ->label('Customer Care Email (بريد خدمة العملاء)')
                            ->email()
                            ->required()
                            ->maxLength(120),

                        TextInput::make('contact_phone')
                            ->label('Customer Care Phone / WhatsApp (رقم الهاتف / واتساب)')
                            ->required()
                            ->maxLength(50),

                        TextInput::make('support_hours')
                            ->label('Concierge Working Hours (ساعات العمل)')
                            ->default('10 AM – 10 PM')
                            ->maxLength(100)
                            ->columnSpanFull(),
                    ]),

                Section::make('Header Announcement Bar (شريط الإعلانات أعلى المتجر)')
                    ->icon('heroicon-o-megaphone')
                    ->description('The top announcement banner displayed across all storefront pages.')
                    ->columns(2)
                    ->schema([
                        Toggle::make('announcement_enabled')
                            ->label('Show Announcement Bar (عرض شريط الإعلانات)')
                            ->onColor('success')
                            ->offColor('danger')
                            ->columnSpanFull(),

                        TextInput::make('announcement_bold')
                            ->label('Bold Highlight Text (النص البارز)')
                            ->placeholder('e.g. Discover The Holiday Collection')
                            ->maxLength(120),

                        TextInput::make('announcement_message')
                            ->label('Message Text (نص الرسالة)')
                            ->placeholder('Limited-edition sets, iconic bestsellers, and festive must-haves')
                            ->maxLength(255),

                        TextInput::make('announcement_action_text')
                            ->label('Button / Link Text (نص زر الانتقال)')
                            ->placeholder('e.g. SHOP NOW →')
                            ->maxLength(60),

                        TextInput::make('announcement_action_link')
                            ->label('Button / Link URL (رابط الانتقال)')
                            ->placeholder('e.g. /shop/gifts or /shop/fragrance')
                            ->maxLength(255),

                        TextInput::make('announcement_bg_color')
                            ->label('Background Color Hex (لون الخلفية)')
                            ->default('#1A3066')
                            ->placeholder('#1A3066')
                            ->maxLength(20),

                        TextInput::make('announcement_text_color')
                            ->label('Text Color Hex (لون النص)')
                            ->default('#FFFFFF')
                            ->placeholder('#FFFFFF')
                            ->maxLength(20),
                    ]),

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

                Section::make('Credit/Debit Cards & Stripe (البطاقات الائتمانية)')
                    ->icon('heroicon-o-credit-card')
                    ->description('Manage Stripe card gateway credentials and toggle card/Apple Pay methods.')
                    ->columns(2)
                    ->schema([
                        Toggle::make('card_enabled')
                            ->label('Enable Credit/Debit Cards (تفعيل الدفع بالبطاقات)')
                            ->helperText('Visa, MasterCard, American Express via Stripe.')
                            ->onColor('success')
                            ->offColor('danger'),

                        Toggle::make('apple_pay_enabled')
                            ->label('Enable Apple Pay (تفعيل الدفع عبر آبل باي)')
                            ->helperText('Available on supported Apple devices.')
                            ->onColor('success')
                            ->offColor('danger'),

                        TextInput::make('stripe_secret')
                            ->label('Stripe Secret Key (sk_live_... / sk_test_...)')
                            ->password()
                            ->revealable()
                            ->placeholder('sk_live_... or sk_test_...')
                            ->helperText('Required for processing online card payments.'),

                        TextInput::make('stripe_webhook_secret')
                            ->label('Stripe Webhook Secret (whsec_...)')
                            ->password()
                            ->revealable()
                            ->placeholder('whsec_...')
                            ->helperText('Required for verifying asynchronous payment events.'),

                        Placeholder::make('stripe_webhook_url')
                            ->label('Stripe Webhook URL (رابط الويب هوك لإشعارات Stripe)')
                            ->content(fn () => url('/payments/webhook/stripe'))
                            ->helperText('Set this URL in your Stripe Dashboard under Developers > Webhooks.')
                            ->columnSpanFull(),
                    ]),

                Section::make('Cash on Delivery & BNPL (الدفع عند الاستلام والتقسيط)')
                    ->icon('heroicon-o-banknotes')
                    ->description('Manage Cash on Delivery and Split-Payment services.')
                    ->columns(2)
                    ->schema([
                        Toggle::make('cod_enabled')
                            ->label('Enable Cash on Delivery (تفعيل الدفع عند الاستلام)')
                            ->onColor('success')
                            ->offColor('danger'),

                        TextInput::make('cod_max_limit')
                            ->label('COD Maximum Order Limit (الحد الأقصى للطلب)')
                            ->numeric()
                            ->prefix('AED')
                            ->default(5000)
                            ->helperText('Orders exceeding this total cannot use Cash on Delivery.'),
                    ]),

                Section::make('Tabby Pay Later (بوابة تابي - الدفع بالتقسيط)')
                    ->icon('heroicon-o-credit-card')
                    ->description('Tabby Buy Now Pay Later (Split in 4). Configure API keys for test and live operations.')
                    ->columns(2)
                    ->schema([
                        Toggle::make('tabby_enabled')
                            ->label('Enable Tabby (تفعيل بوابة تابي)')
                            ->helperText('Allow shoppers to split payments into 4 interest-free instalments.')
                            ->onColor('success')
                            ->offColor('danger')
                            ->columnSpanFull(),

                        Select::make('tabby_mode')
                            ->label('Environment Mode (بيئة العمل)')
                            ->options([
                                'sandbox' => 'Sandbox / Test Mode (بيئة الاختبار)',
                                'production' => 'Production / Live (بيئة الإنتاج الحقيقية)',
                            ])
                            ->default('sandbox'),

                        TextInput::make('tabby_merchant_code')
                            ->label('Merchant Code (كود التاجر)')
                            ->placeholder('e.g. sephora_ae'),

                        TextInput::make('tabby_public_key')
                            ->label('Public Key (المفتاح العام)')
                            ->placeholder('pk_test_... or pk_live_...'),

                        TextInput::make('tabby_secret_key')
                            ->label('Secret Key (المفتاح السري)')
                            ->password()
                            ->revealable()
                            ->placeholder('sk_test_... or sk_live_...'),
                    ]),

                Section::make('Tamara Pay in 3 (بوابة تمارا - الدفع بالتقسيط)')
                    ->icon('heroicon-o-sparkles')
                    ->description('Tamara Sharia-compliant Buy Now Pay Later. Configure API credentials and webhook tokens.')
                    ->columns(2)
                    ->schema([
                        Toggle::make('tamara_enabled')
                            ->label('Enable Tamara (تفعيل بوابة تمارا)')
                            ->helperText('Allow shoppers to split payments into 3 instalments.')
                            ->onColor('success')
                            ->offColor('danger')
                            ->columnSpanFull(),

                        Select::make('tamara_mode')
                            ->label('Environment Mode (بيئة العمل)')
                            ->options([
                                'sandbox' => 'Sandbox / Test Mode (بيئة الاختبار)',
                                'production' => 'Production / Live (بيئة الإنتاج الحقيقية)',
                            ])
                            ->default('sandbox'),

                        TextInput::make('tamara_public_key')
                            ->label('Public Key (المفتاح العام)')
                            ->placeholder('Tamara Public Key'),

                        TextInput::make('tamara_api_token')
                            ->label('API Token / Secret (رمز الدخول البرمجي)')
                            ->password()
                            ->revealable()
                            ->placeholder('Enter Tamara API Bearer Token'),

                        TextInput::make('tamara_notification_token')
                            ->label('Notification / Webhook Token (رمز الإشعارات)')
                            ->password()
                            ->revealable()
                            ->placeholder('Token used to verify incoming Tamara webhooks'),
                    ]),

                Section::make('ZainCash Payment Gateway (بوابة زين كاش)')
                    ->icon('heroicon-o-wallet')
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

                Section::make('Social Media & SEO (شبكات التواصل ومحركات البحث)')
                    ->icon('heroicon-o-globe-alt')
                    ->description('Configure social links displayed in the footer/contact pages and meta tags.')
                    ->columns(2)
                    ->schema([
                        TextInput::make('social_instagram')
                            ->label('Instagram URL')
                            ->placeholder('https://instagram.com/sephoramiddleeast')
                            ->maxLength(255),

                        TextInput::make('social_facebook')
                            ->label('Facebook URL')
                            ->placeholder('https://facebook.com/sephoramiddleeast')
                            ->maxLength(255),

                        TextInput::make('social_tiktok')
                            ->label('TikTok URL')
                            ->placeholder('https://tiktok.com/@sephoramiddleeast')
                            ->maxLength(255),

                        TextInput::make('social_youtube')
                            ->label('YouTube URL')
                            ->placeholder('https://youtube.com/sephoramiddleeast')
                            ->maxLength(255),

                        TextInput::make('social_twitter')
                            ->label('Twitter / X URL')
                            ->placeholder('https://twitter.com/sephora')
                            ->maxLength(255),

                        TextInput::make('seo_meta_title')
                            ->label('Default Meta Title (عنوان الموقع لمحركات البحث)')
                            ->maxLength(255)
                            ->columnSpanFull(),

                        Textarea::make('seo_meta_description')
                            ->label('Default Meta Description (وصف الموقع لمحركات البحث)')
                            ->rows(2)
                            ->maxLength(500)
                            ->columnSpanFull(),
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
            // General & Branding
            'store_name' => (string) ($state['store_name'] ?? 'SEPHORA UAE'),
            'store_tagline' => (string) ($state['store_tagline'] ?? ''),
            'contact_email' => (string) ($state['contact_email'] ?? ''),
            'contact_phone' => (string) ($state['contact_phone'] ?? ''),
            'support_hours' => (string) ($state['support_hours'] ?? ''),
            'currency_symbol' => (string) ($state['currency_symbol'] ?? 'AED'),

            // Announcement
            'announcement_enabled' => ! empty($state['announcement_enabled']) ? '1' : '0',
            'announcement_bold' => (string) ($state['announcement_bold'] ?? ''),
            'announcement_message' => (string) ($state['announcement_message'] ?? ''),
            'announcement_action_text' => (string) ($state['announcement_action_text'] ?? ''),
            'announcement_action_link' => (string) ($state['announcement_action_link'] ?? ''),
            'announcement_bg_color' => (string) ($state['announcement_bg_color'] ?? '#1A3066'),
            'announcement_text_color' => (string) ($state['announcement_text_color'] ?? '#FFFFFF'),

            // Delivery & limits
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

            // Payment Gateways
            'card_enabled' => ! empty($state['card_enabled']) ? '1' : '0',
            'apple_pay_enabled' => ! empty($state['apple_pay_enabled']) ? '1' : '0',
            'cod_enabled' => ! empty($state['cod_enabled']) ? '1' : '0',
            'cod_max_limit' => (string) ($state['cod_max_limit'] ?? '5000'),
            // Tabby
            'tabby_enabled' => ! empty($state['tabby_enabled']) ? '1' : '0',
            'tabby_mode' => (string) ($state['tabby_mode'] ?? 'sandbox'),
            'tabby_public_key' => (string) ($state['tabby_public_key'] ?? ''),
            'tabby_secret_key' => (string) ($state['tabby_secret_key'] ?? ''),
            'tabby_merchant_code' => (string) ($state['tabby_merchant_code'] ?? 'sephora_ae'),

            // Tamara
            'tamara_enabled' => ! empty($state['tamara_enabled']) ? '1' : '0',
            'tamara_mode' => (string) ($state['tamara_mode'] ?? 'sandbox'),
            'tamara_api_token' => (string) ($state['tamara_api_token'] ?? ''),
            'tamara_notification_token' => (string) ($state['tamara_notification_token'] ?? ''),
            'tamara_public_key' => (string) ($state['tamara_public_key'] ?? ''),
            'stripe_secret' => (string) ($state['stripe_secret'] ?? ''),
            'stripe_webhook_secret' => (string) ($state['stripe_webhook_secret'] ?? ''),

            // ZainCash
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

            // Social & SEO
            'social_instagram' => (string) ($state['social_instagram'] ?? ''),
            'social_facebook' => (string) ($state['social_facebook'] ?? ''),
            'social_tiktok' => (string) ($state['social_tiktok'] ?? ''),
            'social_youtube' => (string) ($state['social_youtube'] ?? ''),
            'social_twitter' => (string) ($state['social_twitter'] ?? ''),
            'seo_meta_title' => (string) ($state['seo_meta_title'] ?? ''),
            'seo_meta_description' => (string) ($state['seo_meta_description'] ?? ''),
        ] as $key => $value) {
            Setting::set($key, $value);
        }

        Notification::make()
            ->title('Settings saved')
            ->success()
            ->send();
    }
}
