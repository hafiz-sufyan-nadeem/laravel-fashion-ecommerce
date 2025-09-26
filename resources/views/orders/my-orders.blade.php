<h1 style="text-align:center; margin-bottom:20px; color:#333;">My Orders</h1>

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


<style>
    table {
        width: 100%;
        border-collapse: collapse;
        margin: 20px 0;
        font-family: Arial, sans-serif;
        font-size: 14px;
        box-shadow: 0 2px 8px rgba(0,0,0,0.1);
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

    a {
        text-decoration: none;
        color: #2196F3;
        font-weight: bold;
    }

    a:hover {
        color: #0d6efd;
    }

    .empty-row {
        text-align: center;
        font-style: italic;
        color: #777;
    }
</style>
