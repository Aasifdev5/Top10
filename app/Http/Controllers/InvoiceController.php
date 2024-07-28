<?php

namespace App\Http\Controllers;

use App\Models\Order; // Assuming you have an Order model
use PDF;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    public function generateInvoice($id)
    {
        $order = Order::with(['customer'])->findOrFail($id);

        // Assuming you have 'orderItems' relationship on Order model
        $orderItems = $order->orderItems()->with('product')->get();

        // Share data to view
        $data = [
            'order' => $order,
            'items' => $orderItems,
        ];

        // Load view and pass the data
        $pdf = PDF::loadView('invoice', $data);

        // Download PDF file
        return $pdf->download('invoice-' . $order->id . '.pdf');
    }
}
