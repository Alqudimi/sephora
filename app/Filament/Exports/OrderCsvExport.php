<?php

namespace App\Filament\Exports;

use App\Models\Order;
use Illuminate\Database\Eloquent\Builder;
use Symfony\Component\HttpFoundation\StreamedResponse;

/**
 * Streaming CSV export for orders — memory-safe for large datasets.
 * Accepts an optional query (e.g. the active table filters) and always
 * re-applies deterministic ordering.
 */
class OrderCsvExport
{
    public function download(?Builder $query = null): StreamedResponse
    {
        $filename = 'orders-'.now()->format('Ymd-His').'.csv';

        $base = $query instanceof Builder ? (clone $query) : Order::query();

        return response()->streamDownload(function () use ($base): void {
            $out = fopen('php://output', 'w');

            // UTF-8 BOM so Excel renders the file correctly.
            fwrite($out, "\xEF\xBB\xBF");
            fputcsv($out, [
                'order_number', 'placed_at', 'customer_name', 'customer_email', 'customer_phone',
                'status', 'payment_method', 'payment_status', 'delivery_method', 'emirate',
                'subtotal', 'subtotal_ex_tax', 'tax_rate', 'tax_amount', 'discount', 'coupon_code',
                'shipping_fee', 'total', 'loyalty_points_earned', 'items_count',
                'tracking_number', 'gift_box', 'gift_message',
            ]);

            $base
                ->withCount('items')
                ->orderByDesc('placed_at')
                ->chunk(500, function ($orders) use ($out): void {
                    foreach ($orders as $order) {
                        fputcsv($out, [
                            $order->order_number,
                            optional($order->placed_at)->format('Y-m-d H:i:s'),
                            $order->customer_name,
                            $order->customer_email,
                            $order->customer_phone,
                            $order->status,
                            $order->payment_method,
                            $order->payment_status,
                            $order->delivery_method,
                            $order->emirate,
                            $order->subtotal,
                            $order->subtotal_ex_tax,
                            $order->tax_rate,
                            $order->tax_amount,
                            $order->discount,
                            $order->coupon_code,
                            $order->shipping_fee,
                            $order->total,
                            $order->loyalty_points_earned,
                            $order->items_count,
                            $order->tracking_number,
                            $order->gift_box ? 'yes' : 'no',
                            $order->gift_message,
                        ]);
                    }
                });

            fclose($out);
        }, $filename, [
            'Content-Type' => 'text/csv; charset=UTF-8',
        ]);
    }
}
