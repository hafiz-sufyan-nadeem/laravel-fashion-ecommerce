<h1 style="text-align:center; margin-bottom:20px; color:#333;">Order #{{$order->id}}</h1>
<p style="text-align:center; color:#666;">Placed on: {{$formattedDate}}</p>

<h3 style="margin-top:30px; color:#444;">Items:</h3>

<table border="1" cellpadding="5" cellspacing="0">
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
            <td>{{ number_format($item->price, 2) }}</td>
            <td>{{ number_format($item->subtotal, 2) }}</td>
        </tr>
    @endforeach
    </tbody>
</table>

<hr>

<p><strong>Subtotal:</strong> {{ number_format($subtotal, 2) }}</p>
<p><strong>Tax (16%):</strong> {{ number_format($tax, 2) }}</p>
<p><strong>Shipping:</strong> {{ number_format($shipping, 2) }}</p>
<h3><strong>Grand Total: </strong> {{ number_format($grandTotal, 2) }}</h3>
<hr>

<div class="mr-6">
<form action="{{route('home')}}">
    <button class="btn btn-dark" style="background-color: black; color: white; cursor: pointer; border-radius: 5px; padding: 2px 8px 2px 8px; " type="submit">Home</button>
</form>
</div>

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

    hr {
        margin: 25px 0;
        border: none;
        height: 1px;
        background: #ddd;
    }

</style>
