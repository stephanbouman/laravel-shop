<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class OrderInvoiceController extends Controller
{
    public function show(Order $order)
    {
        if (! $order->is_paid) {
            abort(404, 'Factuur niet beschikbaar');
        }

        return $order->getInvoicePdfStream();
    }

    public function pdf(Order $order, Request $request)
    {
        if (! $order->is_paid) {
            abort(403);
        }

        if ($request->fingerprint !== $order->fingerprint) {
            abort(403);
        }

        return view('invoices.show', compact('order'));
    }


}
