@extends('admin.layouts.app')
@section('content')
    <div class="container">
        <h1 style="text-align:center; margin-bottom:20px; color:#333;">
            Order #{{ $order->id }}
        </h1>

        <!-- Customer Info -->
        <div class="order-box order-info">
            <h3>Customer Information</h3>
            <p><strong>Customer:</strong> {{ $order->user->name ?? 'Guest' }}</p>
            <p><strong>Email:</strong> {{ $order->email }}</p>
            <p><strong>Address:</strong> {{ $order->address }}, {{ $order->city }}</p>
            <p><strong>Total:</strong> ${{ number_format($order->total_amount, 2) }}</p>
            <p><strong>Status:</strong>
                <span class="status-badge status-{{ $order->status }}">
                {{ ucfirst($order->status) }}
            </span>
            </p>
            <p><strong>Placed On:</strong> {{ $order->created_at->format('d M, Y h:i A') }}</p>
        </div>

        <!-- Items -->
        <div class="order-box">
            <h3>Items</h3>
            <table>
                <thead>
                <tr>
                    <th>Product</th>
                    <th>Qty</th>
                    <th>Price</th>
                    <th>Subtotal</th>
                </tr>
                </thead>
                <tbody>
                @foreach($order->orderItems as $item)
                    <tr>
                        <td>{{ $item->product->name }}</td>
                        <td>{{ $item->quantity }}</td>
                        <td>${{ number_format($item->price, 2) }}</td>
                        <td>${{ number_format($item->subtotal, 2) }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>

        <!-- Update Status -->
        <div class="order-box">
            <h3>Update Status</h3>
            <form method="POST" action="{{ route('admin.orders.updateStatus', $order->id) }}">
                @csrf
                <select name="status">
                    <option value="pending" {{ $order->status=='pending' ? 'selected' : '' }}>Pending</option>
                    <option value="processing" {{ $order->status=='processing' ? 'selected' : '' }}>Processing</option>
                    <option value="shipped" {{ $order->status=='shipped' ? 'selected' : '' }}>Shipped</option>
                    <option value="delivered" {{ $order->status=='delivered' ? 'selected' : '' }}>Delivered</option>
                    <option value="cancelled" {{ $order->status=='cancelled' ? 'selected' : '' }}>Cancelled</option>
                </select>
                <button type="submit">Update</button>
            </form>
        </div>

    </div>
@endsection

<style>
    .order-box {
        background: #fff;
        padding: 20px;
        margin-bottom: 25px;
        box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        border-radius: 8px;
        font-family: Arial, sans-serif;
    }
    .order-box h3 {
        margin-bottom: 15px;
        color: #444;
    }
    .order-info p {
        margin: 6px 0;
        font-size: 14px;
        color: #333;
    }
    table {
        width: 100%;
        border-collapse: collapse;
        margin: 15px 0;
        font-size: 14px;
    }
    thead tr {
        background-color: #4CAF50;
        color: white;
        text-align: left;
    }
    th, td {
        padding: 12px 15px;
        border: 1px solid #ddd;
    }
    tbody tr:nth-child(even) {
        background-color: #f9f9f9;
    }
    tbody tr:hover {
        background-color: #f1f1f1;
    }
    select, button {
        padding: 8px 12px;
        border-radius: 5px;
        border: 1px solid #ccc;
        font-size: 14px;
    }
    button {
        background-color: black;
        color: white;
        cursor: pointer;
        transition: 0.3s;
    }
    button:hover {
        background-color: #333;
    }
    .status-badge {
        padding: 4px 10px;
        border-radius: 12px;
        font-size: 13px;
        font-weight: bold;
        color: white;
    }
    .status-pending { background: #ffc107; }
    .status-processing { background: #17a2b8; }
    .status-shipped { background: #007bff; }
    .status-delivered { background: #28a745; }
    .status-cancelled { background: #dc3545; }
</style>
