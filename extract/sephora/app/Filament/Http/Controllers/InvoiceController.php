<?php

namespace App\Filament\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class InvoiceController
{
    public function __invoke(Request $request, Order $order)
    {
        abort_unless($request->user()?->isStaff(), 403);

        return view('filament.invoice', [
            'order' => $order->load(['items', 'store', 'user']),
        ]);
    }
}
