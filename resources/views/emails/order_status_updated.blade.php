<!DOCTYPE html>
<html>
<head>
    <title>Order Status Updated</title>
</head>
<body>
<h2>Order #{{ $order->id }} Status Update</h2>
<p><strong>Status:</strong> {{ ucfirst($order->status) }}</p>

@if($adminMessage)
    <p><strong>Note from Admin:</strong> {{ $adminMessage }}</p>
@endif

<h3>Products in your order:</h3>
<ul>
    @foreach ($order->orderItems as $item)
        <li>{{ $item->product->name }} (x{{ $item->quantity }}) - Rs. {{ $item->price }}</li>
    @endforeach
</ul>

<p>Total Amount: Rs. {{ $order->total_amount }}</p>
</body>
</html>
