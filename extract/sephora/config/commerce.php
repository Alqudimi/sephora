<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Commerce Rules
    |--------------------------------------------------------------------------
    |
    | Central source of truth for storefront + admin commerce behaviour:
    | shipping fees, free-shipping threshold, tax, catalog limits. The
    | storefront reads these live; the admin panel surfaces them in the
    | Settings page (persisted overrides live in the `settings` table).
    |
    */

    'currency' => 'AED',
    'currency_symbol' => 'AED',

    // Merchandise value (AED) at which standard delivery becomes free.
    'free_shipping_threshold' => 250,

    // Delivery fees per method (AED). COD adds a surcharge on top.
    'shipping' => [
        'standard' => 25,
        'same_day' => 40,
        'click_collect' => 0,
        'cod_fee' => 20,
    ],

    // Human labels for each delivery method.
    'delivery_methods' => [
        'standard' => 'Standard Delivery',
        'same_day' => 'Same-Day Delivery',
        'click_collect' => 'Click & Collect',
    ],

    // UAE VAT (fraction of gross, i.e. 0.05 = 5%).
    'tax_rate' => 0.05,

    // Cart limits.
    'max_quantity_per_item' => 20,
    'max_samples' => 3,

    // Loyalty: points awarded per order = floor(subtotal - discount).
    'loyalty_enabled' => true,
];
