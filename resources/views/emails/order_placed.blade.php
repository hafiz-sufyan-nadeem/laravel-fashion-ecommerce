<!DOCTYPE html>
<html>
<head>
    <title>Order Confirmation</title>
</head>
<body>
<h2>Thank you for your order!</h2>
<p>Your order ID: {{ $order->id }}</p>
<p>Product: {{ $order->product_name }}</p>
<p>Total Amount: {{ $order->total }}</p>
<p>We will process your order soon.</p>
</body>
</html>
