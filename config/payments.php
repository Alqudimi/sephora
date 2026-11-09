<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Payments
    |--------------------------------------------------------------------------
    |
    | Which payment methods the storefront offers, which gateway backs
    | them, and gateway credentials. `driver` selects the runtime:
    | `fake` simulates successful payments locally / in tests,
    | `stripe` routes card payments through the Stripe API.
    |
    */

    'driver' => env('PAYMENTS_DRIVER', 'fake'),

    'currency' => 'AED',

    'methods' => [
        'card' => [
            'label' => 'Credit or Debit Card',
            'enabled' => true,
            'gateway' => 'stripe',
        ],
        'apple_pay' => [
            'label' => 'Apple Pay',
            'enabled' => true,
            'gateway' => 'stripe',
        ],
        'tabby' => [
            'label' => 'Tabby — 4 payments, no interest',
            'enabled' => env('TABBY_ENABLED', false),
            'gateway' => 'tabby',
        ],
        'tamara' => [
            'label' => 'Tamara — pay in 3',
            'enabled' => env('TAMARA_ENABLED', false),
            'gateway' => 'tamara',
        ],
        'cod' => [
            'label' => 'Cash on Delivery',
            'enabled' => true,
            'gateway' => 'cod',
        ],
        'zaincash' => [
            'label' => 'ZainCash (محفظة زين كاش)',
            'enabled' => env('ZAINCASH_ENABLED', false),
            'gateway' => 'zaincash',
        ],
    ],

    'fake' => [
        'auto_succeed' => env('PAYMENTS_FAKE_AUTO_SUCCEED', true),
    ],

    'zaincash' => [
        'enabled' => env('ZAINCASH_ENABLED', false),
        'mode' => env('ZAINCASH_MODE', 'uat'),
        'api_version' => env('ZAINCASH_API_VERSION', 'v2'),
        'client_id' => env('ZAINCASH_CLIENT_ID', ''),
        'client_secret' => env('ZAINCASH_CLIENT_SECRET', ''),
        'merchant_id' => env('ZAINCASH_MERCHANT_ID', ''),
        'secret' => env('ZAINCASH_SECRET', ''),
        'msisdn' => env('ZAINCASH_MSISDN', ''),
        'exchange_rate' => env('ZAINCASH_EXCHANGE_RATE', 355.0),
        'language' => env('ZAINCASH_LANG', 'ar'),
        'use_fake_driver' => env('ZAINCASH_USE_FAKE_DRIVER', false),
    ],

    'tabby' => [
        'enabled' => env('TABBY_ENABLED', false),
        'mode' => env('TABBY_MODE', 'sandbox'),
        'public_key' => env('TABBY_PUBLIC_KEY', ''),
        'secret_key' => env('TABBY_SECRET_KEY', ''),
        'merchant_code' => env('TABBY_MERCHANT_CODE', 'sephora_ae'),
    ],

    'tamara' => [
        'enabled' => env('TAMARA_ENABLED', false),
        'mode' => env('TAMARA_MODE', 'sandbox'),
        'api_token' => env('TAMARA_API_TOKEN', ''),
        'notification_token' => env('TAMARA_NOTIFICATION_TOKEN', ''),
        'public_key' => env('TAMARA_PUBLIC_KEY', ''),
    ],

    'stripe' => [
        'secret' => env('STRIPE_SECRET'),
        'webhook_secret' => env('STRIPE_WEBHOOK_SECRET'),
        'base_url' => env('STRIPE_BASE_URL', 'https://api.stripe.com'),
        'success_url' => env('STRIPE_SUCCESS_URL'),
        'cancel_url' => env('STRIPE_CANCEL_URL'),
        'webhook_tolerance' => 300,
    ],
];
