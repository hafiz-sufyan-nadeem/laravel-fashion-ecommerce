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

        $subtotal = $order->orderItems->sum(function ($item){
            return $item->price * $item->quantity;
        });

        $taxRate = 0.16;
        $tax = round($subtotal * $taxRate, 2);
        $shipping = $subtotal >= 1000 ? 0 : 20;
        $grandTotal = round($subtotal + $tax + $shipping,2);

        return view('orders.show', compact('order', 'formattedDate', 'subtotal', 'tax', 'shipping', 'grandTotal'));
    }

    public function myOrders()
    {
        $orders = Order::where('user_id', auth()->id())->with('orderItems.product')->latest()->get();
        return view('orders.my-orders', compact('orders'));
    }
}
