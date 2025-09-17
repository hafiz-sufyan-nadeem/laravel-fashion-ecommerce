<h2>Your Cart</h2>

@foreach($cartItems as $item)
    <div>
        {{ $item->product->name }} -
        Qty: {{ $item->quantity }} -
        Price: {{ $item->price }}
    </div>
@endforeach

<hr>
<strong>Total: {{ $total }}</strong>

<br><br>
<a href="{{ route('checkout.form') }}" class="btn btn-primary">Proceed to Checkout</a>
