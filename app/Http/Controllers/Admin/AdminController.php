<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactMessage;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;

class AdminController extends Controller
{
    public function dashboard()
    {
        return view('admin.dashboard', [
            'stats' => [
                'orders' => Order::count(),
                'revenue' => Order::where('status', '!=', 'cancelled')->sum('total'),
                'products' => Product::count(),
                'customers' => User::where('is_admin', false)->count(),
                'pending' => Order::where('status', 'processing')->count(),
                'messages' => ContactMessage::where('status', 'new')->count(),
            ],
            'recentOrders' => Order::with('items')->latest()->limit(6)->get(),
        ]);
    }
}
