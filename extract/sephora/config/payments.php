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
            'enabled' => true,
            'gateway' => 'stripe',
        ],
        'tamara' => [
            'label' => 'Tamara — pay in 3',
            'enabled' => true,
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
        'success_url' => env('STRIPE_SUCCESS_URL', '/checkout/success'),
        'cancel_url' => env('STRIPE_CANCEL_URL', '/checkout'),
        'webhook_tolerance' => 300,
    ],
];
