<h1>My Orders</h1>

<table border="1" cellpadding="5" cellspacing="0">
    <thead>
    <tr>
        <th>Order ID</th>
        <th>Total Amount</th>
        <th>Status</th>
        <th>Placed On</th>
        <th>Action</th>
    </tr>
    </thead>
    <tbody>
    @forelse($orders as $order)
        <tr>
            <td>{{ $order->id }}</td>
            <td>{{ number_format($order->total_amount, 2) }}</td>
            <td>{{ ucfirst($order->status) }}</td>
            <td>{{ $order->created_at->format('d M, Y h:i A') }}</td>
            <td>
                <a href="{{ route('orders.show', $order->id) }}">
                    View Details
                </a>
            </td>
        </tr>
    @empty
        <tr>
            <td colspan="5">No orders found.</td>
        </tr>
    @endforelse
    </tbody>
</table>
