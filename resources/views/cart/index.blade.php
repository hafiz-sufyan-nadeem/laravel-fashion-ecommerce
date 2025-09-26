<nav>
    <form action="{{route('home')}}">
    <button class="btn btn-dark" style="background-color: black; color: white; cursor: pointer; border-radius: 5px; padding: 2px 8px 2px 8px" type="submit">Home</button>
    </form>
</nav>

<div class="cart-container">
    <table class="cart-table">
        <tr>
            <th>Item</th>
            <th>Price</th>
            <th>Quantity</th>
            <th>Total</th>
            <th>Action</th>
        </tr>

        @foreach($cartItems as $item)
            <tr>
                <td style="display:flex; align-items:center; gap:10px;">
                    <img src="{{ $item->product->image ? asset('storage/'.$item->product->image) : asset('images/placeholder.png') }}">
                    <span>{{ $item->product->name }}</span>
                </td>
                <td>PKR {{ $item->price }}</td>
                <td>
                    <form action="{{ route('cart.update',$item->id) }}" method="POST" class="qty-form">
                        @csrf
                        <button type="button" class="qty-btn minus">−</button>
                        <input type="number" name="quantity" value="{{ $item->quantity }}" min="1" class="qty-input">
                        <button type="button" class="qty-btn plus">+</button>
                    </form>
                </td>
                <td>PKR {{ $item->price * $item->quantity }}</td>
                <td>
                    <form action="{{ route('cart.delete',$item->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="remove-btn">Remove</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </table>

    <div class="summary-box">
        <p><span>Subtotal:</span> <span>PKR {{ $subtotal }}</span></p>
        <p><span>Tax:</span> <span>PKR {{ $tax }}</span></p>
        <p><span>Shipping:</span> <span>{{ $shipping == 0 ? 'Free' : '$'.$shipping }}</span></p>
        <hr>
        <p class="grand"><span>Grand Total:</span> <span>PKR {{ $grandTotal }}</span></p>

        <a href="{{ route('checkout.form') }}" class="btn-checkout">Check out</a>

        @if($shipping == 0)
            <p class="free-note">Congrats! You're eligible for Free Shipping</p>
        @endif
    </div>
</div>


<style>
    table {
        border-collapse: collapse;
        width: 100%;
    }
    th, td {
        border: 1px solid #ddd;
        padding: 8px;
    }
    th {
        background: #f4f4f4;
    }
    button {
        padding: 4px 8px;
        margin-left: 4px;
    }

    .cart-container {
        display: flex;
        gap: 20px;
        margin-top: 20px;
    }

    .cart-table {
        flex: 2;
        width: 100%;
        border-collapse: collapse;
        background: #fff;
        border-radius: 8px;
        overflow: hidden;
        box-shadow: 0 2px 6px rgba(0,0,0,0.05);
    }

    .cart-table th,
    .cart-table td {
        padding: 12px;
        border-bottom: 1px solid #eee;
        text-align: center;
    }

    .cart-table th {
        background: #f7f7f7;
        font-weight: bold;
    }

    .cart-table td img {
        width: 70px;
        height: 70px;
        object-fit: cover;
        border-radius: 6px;
        border: 5px solid #ddd;
    }

    .qty-form {
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .qty-btn {
        border: 1px solid #ccc;
        background: #f8f8f8;
        cursor: pointer;
        padding: 5px 10px;
        font-size: 16px;
        border-radius: 4px;
        transition: 0.2s;
    }

    .qty-btn:hover {
        background: #ddd;
    }

    .qty-input {
        width: 50px;
        text-align: center;
        margin: 0 5px;
        padding: 4px;
        border: 1px solid #ccc;
        border-radius: 4px;
    }


    .remove-btn {
        background: #ff4d4d;
        color: white;
        border: 1px solid red;
        padding: 6px 10px;
        border-radius: 4px;
        cursor: pointer;
        transition: 0.2s;
    }

    .remove-btn:hover {
        background: #e60000;
    }

    .summary-box {
        flex: 1;
        border: 1px solid #eee;
        background: #fff;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 2px 6px rgba(0,0,0,0.05);
    }

    .summary-box p {
        display: flex;
        justify-content: space-between;
        margin: 10px 2px;
        font-size: 15px;
    }

    .summary-box hr {
        margin: 15px 0;
    }

    .summary-box .grand {
        font-weight: bold;
        font-size: 18px;
    }

    .btn-checkout {
        display: block;
        width: 100%;
        padding: 12px;
        background: black;
        color: white;
        text-align: center;
        border-radius: 6px;
        text-decoration: none;
        margin-top: 15px;
        font-weight: bold;
        transition: 0.2s;
    }

    .btn-checkout:hover {
        background: #333;
    }

    .free-note {
        color: green;
        font-size: 14px;
        text-align: center;
        margin-top: 10px;
    }


</style>
<script>
    document.addEventListener('DOMContentLoaded', function(){
        document.querySelectorAll('.qty-form')
            .forEach(function(form){
            let input = form.querySelector('input[name="quantity"]');
            let plus = form.querySelector('.qty-btn.plus');
            let minus = form.querySelector('.qty-btn.minus');

            plus.addEventListener('click', function(){
                input.value = parseInt(input.value) + 1;
                form.submit();
            });

            minus.addEventListener('click', function(){
                let newVal = parseInt(input.value) - 1;
                if(newVal < 1) newVal = 1;
                input.value = newVal;
                form.submit();
            });

            input.addEventListener('change', function(){
                if(input.value < 1) input.value = 1;
                form.submit();
            });
        });
    });
</script>
