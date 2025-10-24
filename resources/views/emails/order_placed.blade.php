<!DOCTYPE html>
<html>
<head>
    <title>Order Confirmation</title>
</head>
<body>
<h2>Thank you for your order!</h2>
<p><strong>Order ID:</strong> {{ $order->id }}</p>
<p><strong>Name:</strong> {{ $order->name }}</p>
<p><strong>Total Amount:</strong> Rs. {{ $order->total_amount }}</p>

<h3>Ordered Products:</h3>
<ul>
    @foreach ($order->orderItems as $item)
        <li>{{ $item->product->name }} (x{{ $item->quantity }}) - Rs. {{ $item->price }}</li>
    @endforeach
</ul>

<p>We’ll process your order soon.</p>
</body>
</html>
