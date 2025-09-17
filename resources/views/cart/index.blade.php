<h2>Your Cart</h2>

@foreach($cartItems as $item)
    <div style="margin-bottom: 10px;">
        {{ $item->product->name }} -
        Price: {{ $item->price }}

        <!-- Update quantity -->
        <form action="{{ route('cart.update',$item->id) }}" method="POST" style="display:inline;">
            @csrf
            <input type="number" name="quantity" value="{{ $item->quantity }}" min="1" style="width: 60px;">
            <button type="submit" class="btn btn-sm btn-success">Update</button>
        </form>

        <!-- Delete item -->
        <form action="{{ route('cart.delete',$item->id) }}" method="POST" style="display:inline;">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-sm btn-danger">Remove</button>
        </form>
    </div>
@endforeach

<hr>
<strong>Total: {{ $total }}</strong>

<br><br>
<a href="{{ route('checkout.form') }}" class="btn btn-primary">Proceed to Checkout</a>
