<?php

namespace App\Http\Controllers;
use App\Models\Order;
use http\Client\Curl\User;
use Illuminate\Http\Request;
use App\Mail\OrderStatusUpdatedMail;
use Illuminate\Support\Facades\Mail;


class AdminOrderController extends Controller
{
    public function index()
    {
        // List all orders
        $orders = Order::with('user')->latest()->get();
        return view('admin.orders.index', compact('orders'));
    }

    // show details
    public function show(Order $order)
    {
        $order->load('orderItems.product', 'user');
        return view('admin.orders.show', compact('order'));
    }

    // update status
    public function updateStatus(Request $request, Order $order)
    {
        // Validate status aur optional admin message
        $request->validate([
            'status' => 'required|in:pending,processing,shipped,delivered,cancelled',
            'admin_message' => 'nullable|string'
        ]);

        $order->status = $request->status;
        $order->save();

        $order->load('orderItems.product');

        // Optional admin message
        $adminMessage = $request->admin_message ?? null;

        Mail::to($order->email)->send(new OrderStatusUpdatedMail($order, $adminMessage));

        return back()->with('success', 'Order status updated and user notified via email.');
    }

}
