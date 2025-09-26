<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function showOrders(Order $order)
    {
        $order->load('orderItems.product');
        if ($order->user_id !== auth()->id()) abort(404);
        $formattedDate = $order->created_at->format('d,M,Y, h:i A');
        return view('orders.show', compact('order', 'formattedDate'));
    }
}
