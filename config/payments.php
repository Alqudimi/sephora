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
        // BNPL (Tabby / Tamara) is not backed by a real gateway integration
        // yet — they currently point at the card-only Stripe checkout, which
        // would silently charge the full amount. Disabled until integrated.
        'tabby' => [
            'label' => 'Tabby — 4 payments, no interest',
            'enabled' => false,
            'gateway' => 'stripe',
        ],
        'tamara' => [
            'label' => 'Tamara — pay in 3',
            'enabled' => false,
            'gateway' => 'stripe',
        ],
        'cod' => [
            'label' => 'Cash on Delivery',
            'enabled' => true,
            'gateway' => 'cod',
        ],
    ],

    'fake' => [
        'auto_succeed' => env('PAYMENTS_FAKE_AUTO_SUCCEED', true),
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
