<?php

return [
    'subjects' => [
        'order_confirmation' => 'Order Confirmation · :number · SEPHORA UAE',
        'order_shipped' => 'Your order is on its way · :number · SEPHORA UAE',
        'order_refunded' => 'Refund confirmation · :number · SEPHORA UAE',
        'admin_new_order' => '[Admin] New order :number — AED :total',
        'contact_received' => '[Concierge Alert] New message from :name · :subject',
        'contact_general' => 'General Inquiry',
        'newsletter_welcome' => 'Welcome to the Sephora Inner Circle · 10% Off Your Next Indulgence',
    ],

    'common' => [
        'aed' => 'AED',
        'free' => 'FREE',
        'automated_footer' => 'This is an automated message from Sephora UAE. Please do not reply directly to this email.',
        'automated_footer_caps' => 'This is an automated message from SEPHORA UAE.',
        'order_placed_footer' => 'Order :number · Placed :date',
        'copyright' => '© :year SEPHORA UAE. All rights reserved.',
    ],

    'order_confirmation' => [
        'title' => 'Order Confirmation · :number',
        'banner' => 'Sephora UAE — Order Confirmed',
        'greeting' => 'Thank you, :name!',
        'intro_pickup' => 'Your order <strong>:number</strong> has been received and is now being prepared. It will be ready for pick-up in 2 hours.',
        'intro_delivery' => 'Your order <strong>:number</strong> has been received and is now being prepared. Estimated delivery: 2–3 business days.',
        'col_item' => 'Item',
        'col_qty' => 'Qty',
        'col_price' => 'Price',
        'subtotal' => 'Subtotal',
        'discount' => 'Discount (:code)',
        'delivery' => 'Delivery',
        'total' => 'Total',
        'payment_method' => 'Payment method:',
        'loyalty_earned' => 'You will earn <strong>:points Beauty Pass points</strong> with this order.',
        'track_cta' => 'Track My Order',
    ],

    'order_shipped' => [
        'title' => 'Your order is on its way · :number',
        'banner' => 'Sephora UAE — Order Shipped',
        'greeting' => 'Great news, :name!',
        'intro' => 'Your order <strong>:number</strong> has left our fulfilment centre and is on its way to you.',
        'courier' => 'Courier:',
        'tracking_number' => 'Tracking number:',
        'track_cta' => 'Track Your Shipment',
        'track_note' => 'Use this number with your courier to follow every step of the delivery.',
        'pickup_arrival' => 'Once the parcel arrives at <strong>:store</strong> we will send you a pick-up reminder.',
        'delivery_eta' => 'Estimated delivery is within 2–3 business days. If you are not home, the courier will try again or leave the parcel with your building\'s concierge.',
        'closing' => 'Thank you for shopping with Sephora UAE.',
    ],

    'order_refunded' => [
        'title' => 'Refund confirmation · :number',
        'banner' => 'Sephora UAE — Refund Confirmation',
        'greeting' => 'Hello :name,',
        'intro' => 'Your refund for order <strong>:number</strong> has been processed.',
        'amount' => 'Refund amount:',
        'reference' => 'Reference: :ref',
        'timeline_note' => 'Depending on your bank or payment provider, the amount will appear on your statement within 5–10 business days. Cash-on-delivery refunds are transferred to the IBAN registered on your account.',
        'closing' => 'We are sorry this order did not work out and hope to see you again soon.',
    ],

    'admin_new_order' => [
        'title' => 'New Order · :number',
        'banner' => 'New order received — :number',
        'customer' => 'Customer:',
        'phone' => 'Phone:',
        'email' => 'Email:',
        'delivery' => 'Delivery:',
        'payment' => 'Payment:',
        'total' => 'Total:',
        'items' => 'Items:',
    ],

    'contact_message' => [
        'title' => 'New Client Concierge Inquiry',
        'banner' => 'SEPHORA UAE — Client Concierge Inquiry',
        'from' => 'From',
        'phone' => 'Phone / Mobile',
        'subject' => 'Subject',
        'message' => 'Message',
        'reply_note' => 'You can reply directly to this email to reach the client at <strong>:email</strong>.',
        'footer' => 'Received :date · SEPHORA UAE Client Concierge System',
    ],

    'newsletter' => [
        'title' => 'Welcome to SEPHORA UAE',
        'banner' => 'SEPHORA UAE',
        'heading' => 'Welcome to the Inner Circle',
        'intro' => 'You are now part of our exclusive beauty community in the United Arab Emirates. Enjoy early access to coveted launches, private beauty offers, and trend reports.',
        'voucher_label' => 'Your Welcome Privilege · 10% Off',
        'voucher_note' => 'Use code <strong>WELCOME10</strong> at online checkout on orders of 200 AED or more.',
        'cta' => 'Discover What\'s New',
        'footer_reason' => 'Sent to :email · You are receiving this because you subscribed to Sephora UAE updates.',
    ],
];

