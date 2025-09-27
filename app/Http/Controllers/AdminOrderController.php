<?php

namespace App\Http\Controllers;
use App\Models\Order;

use http\Client\Curl\User;
use Illuminate\Http\Request;

class AdminOrderController extends Controller
{
    public function index()
    {
        // List all orders
        $orders = Order::with('user')->latest()->get();
        return view('orders.index', compact('orders'));
    }

    // show details
    public function show(Order $order)
    {
        $order->load('orderItems.product', 'user');
        return view('orders.show', compact('order'));
    }

    // update status
    public function updateStatus(Request $request, Order $order)
    {
        $request->validate([
            'status' => 'required|in:pending,processing,shipped,delivered,cancelled'
        ]);
        $order->update(['status' => $request->status]);
        return back()->with('success', 'Order status updated.');
    }
}
