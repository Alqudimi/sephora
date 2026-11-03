<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Confirmation · <?php echo e($order->order_number); ?></title>
    <style>
        body { font-family: Arial, Helvetica, sans-serif; color: #1a1a1a; background: #f5f5f5; margin: 0; padding: 24px; }
        .card { max-width: 560px; margin: 0 auto; background: #ffffff; border: 1px solid #e5e5e5; }
        .head { background: #000000; color: #ffffff; padding: 20px 28px; }
        .head h1 { font-size: 18px; letter-spacing: 2px; text-transform: uppercase; margin: 0; }
        .body { padding: 24px 28px; }
        .body h2 { font-size: 16px; margin: 0 0 8px; }
        p { font-size: 13px; line-height: 1.6; color: #444; margin: 0 0 12px; }
        table { width: 100%; border-collapse: collapse; margin: 16px 0; }
        th { text-align: left; font-size: 11px; text-transform: uppercase; letter-spacing: 1px; color: #888; border-bottom: 1px solid #ddd; padding: 8px 6px; }
        td { font-size: 13px; padding: 10px 6px; border-bottom: 1px solid #f0f0f0; vertical-align: top; }
        .totals td { border: none; padding: 4px 6px; }
        .totals .grand td { font-weight: bold; font-size: 15px; border-top: 1px solid #ddd; padding-top: 10px; }
        .btn { display: inline-block; background: #000000; color: #ffffff; font-size: 12px; text-transform: uppercase; letter-spacing: 2px; text-decoration: none; padding: 14px 26px; margin-top: 8px; }
        .foot { padding: 16px 28px; font-size: 11px; color: #999; text-align: center; }
    </style>
</head>
<body>
    <div class="card">
        <div class="head">
            <h1>Sephora UAE — Order Confirmed</h1>
        </div>
        <div class="body">
            <h2>Thank you, <?php echo e($order->customer_name); ?>!</h2>
            <p>
                Your order <strong><?php echo e($order->order_number); ?></strong> has been received and is now being prepared.
                <?php echo e($order->delivery_method === 'click_collect' ? 'It will be ready for pick-up in 2 hours.' : 'Estimated delivery: 2–3 business days.'); ?>

            </p>

            <table>
                <tr>
                    <th>Item</th>
                    <th style="text-align:center;">Qty</th>
                    <th style="text-align:right;">Price</th>
                </tr>
                <?php $__currentLoopData = $order->items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td>
                        <strong><?php echo e($item->product_name); ?></strong><br>
                        <span style="color:#888;font-size:11px;"><?php echo e($item->brand_name); ?><?php if($item->shade_name): ?> · <?php echo e($item->shade_name); ?><?php endif; ?></span>
                    </td>
                    <td style="text-align:center;"><?php echo e($item->quantity); ?></td>
                    <td style="text-align:right;">AED <?php echo e(number_format($item->line_total, 2)); ?></td>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <tr class="totals">
                    <td colspan="2" style="text-align:right;">Subtotal</td>
                    <td style="text-align:right;">AED <?php echo e(number_format($order->subtotal, 2)); ?></td>
                </tr>
                <?php if($order->discount > 0): ?>
                <tr class="totals">
                    <td colspan="2" style="text-align:right;">Discount (<?php echo e($order->coupon_code); ?>)</td>
                    <td style="text-align:right;">-AED <?php echo e(number_format($order->discount, 2)); ?></td>
                </tr>
                <?php endif; ?>
                <tr class="totals">
                    <td colspan="2" style="text-align:right;">Delivery</td>
                    <td style="text-align:right;"><?php echo e($order->shipping_fee == 0 ? 'FREE' : 'AED '.number_format($order->shipping_fee, 2)); ?></td>
                </tr>
                <tr class="totals grand">
                    <td colspan="2" style="text-align:right;">Total</td>
                    <td style="text-align:right;">AED <?php echo e(number_format($order->total, 2)); ?></td>
                </tr>
            </table>

            <p>
                Payment method: <strong><?php echo e(strtoupper(str_replace('_', ' ', $order->payment_method))); ?></strong><br>
                You will earn <strong><?php echo e($order->loyalty_points_earned); ?> Beauty Pass points</strong> with this order.
            </p>

            <a class="btn" href="<?php echo e($trackingUrl); ?>">Track My Order</a>
        </div>
        <div class="foot">
            This is an automated message from Sephora UAE. Please do not reply directly to this email.
        </div>
    </div>
</body>
</html>
<?php /**PATH /run/media/alqudimi/azoz/Programming/php/LARAVEL/sephora-uae-laravel-lite/resources/views/emails/order-confirmation.blade.php ENDPATH**/ ?>