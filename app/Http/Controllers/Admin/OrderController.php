<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        $orders = Order::with('items')
            ->when($request->input('status'), fn ($q, $s) => $q->where('status', $s))
            ->when($request->input('q'), fn ($q, $t) => $q->where('order_number', 'like', "%{$t}%"))
            ->latest()
            ->paginate(20);
        return view('admin.orders', ['orders' => $orders]);
    }

    public function show(Order $order)
    {
        return view('admin.order-detail', ['order' => $order->load('items')]);
    }

    public function updateStatus(Request $request, Order $order)
    {
        $validated = $request->validate([
            'status' => 'required|in:pending,processing,shipped,out_for_delivery,delivered,cancelled',
            'payment_status' => 'nullable|in:pending,paid,refunded,failed',
        ]);

        $order->update($validated);
        return back()->with('status_saved', true);
    }
}
