 <div class="cart-page container">
        <h2 class="cart-title">Your Cart ({{ $cartItems->count() }} items)</h2>

        <div class="cart-grid">
            <!-- Left: items list -->
            <div class="cart-items">
                <div class="cart-head">
                    <div class="col item-col">Item</div>
                    <div class="col price-col">Price</div>
                    <div class="col qty-col">Quantity</div>
                    <div class="col total-col">Total</div>
                </div>

                @foreach($cartItems as $item)
                    <div class="cart-row">
                        <div class="col item-col">
                            <img class="thumb" src="{{ $item->product->image ? asset('storage/'.$item->product->image) : asset('images/placeholder.png') }}" alt="product">
                            <div class="meta">
                                <div class="name">{{ $item->product->name }}</div>
                            </div>
                        </div>

                        <div class="col price-col">
                            PKR {{ number_format($item->price, 2) }}
                        </div>

                        <div class="col qty-col">
                            <!-- update form -->
                            <form action="{{ route('cart.update', $item->id) }}" method="POST" class="qty-form">
                                @csrf
                                <div class="qty-controls">
                                    <button type="button" class="qty-btn minus" aria-label="decrease">−</button>
                                    <input class="qty-input" type="number" name="quantity" value="{{ $item->quantity }}" min="1">
                                    <button type="button" class="qty-btn plus" aria-label="increase">+</button>
                                </div>
                            </form>
                        </div>

                        <div class="col total-col">
                            <div class="line-total">PKR {{ number_format($item->price * $item->quantity, 2) }}</div>

                            <form action="{{ route('cart.delete', $item->id) }}" method="POST" class="delete-form">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="remove-btn" onclick="return confirm('Remove this item?')">✕</button>
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Right: summary -->
            <aside class="cart-summary">
                <div class="summary-card">
                    <div class="summary-row"><span>Subtotal:</span><span>PKR {{ number_format($subtotal, 2) }}</span></div>
                    <div class="summary-row"><span>Sales Tax:</span><span>PKR {{ number_format($tax, 2) }}</span></div>
                    <div class="summary-row"><span>Shipping:</span><span>{{ $shipping == 0 ? 'Free' : '$'.number_format($shipping, 2) }}</span></div>

                    <div class="summary-row coupon">
                        <span>Coupon Code:</span>
                        <form action="#" method="POST" class="coupon-form">
                            @csrf
                            <input type="text" name="coupon" placeholder="Add Coupon">
                            <button type="submit" class="btn-apply">Apply</button>
                        </form>
                    </div>

                    <hr>

                    <div class="summary-row grand">
                        <strong>Grand total:</strong>
                        <strong class="grand-amount">PKR {{ number_format($grandTotal, 2) }}</strong>
                    </div>

                    <a href="{{ route('checkout.form') }}" class="btn-checkout">Check out</a>

                    @if($shipping == 0)
                        <p class="free-note">Congrats, you're eligible for Free Shipping</p>
                    @endif
                </div>
            </aside>
        </div>
    </div>

    <!-- Inline CSS for quick start -->
    <style>
        .container{max-width:1100px;margin:30px auto;padding:0 16px;font-family: Arial, sans-serif;}
        .cart-title{ text-align:center;margin-bottom:18px;font-size:22px;font-weight:700;}
        .cart-grid{display:flex;gap:24px;align-items:flex-start;}
        .cart-items{flex:1;background:#fff;}
        .cart-head, .cart-row{display:grid;grid-template-columns: 1fr 120px 220px 120px;align-items:center;padding:14px 12px;border-bottom:1px solid #eee;}
        .cart-head{font-weight:700;color:#777;border-bottom:2px solid #eee;}
        .item-col{display:flex;gap:12px;align-items:center;}
        .thumb{width:72px;height:72px;object-fit:cover;border-radius:6px;border:1px solid #eee;}
        .meta .name{font-weight:700;}
        .meta .desc{font-size:13px;color:#777;}
        .price-col, .qty-col, .total-col{text-align:center;}
        .qty-controls{display:inline-flex;align-items:center;border:1px solid #ddd;border-radius:6px;padding:4px;}
        .qty-btn{border:0;background:#fff;padding:6px 10px;cursor:pointer;font-size:18px;}
        .qty-input{width:54px;text-align:center;border:0;outline:none;font-size:15px;}
        .remove-btn{background:transparent;border:0;color:#888;cursor:pointer;margin-top:6px;}
        .summary-card{width:320px;padding:18px;border-radius:6px;border:1px solid #eee;background:#fff;}
        .summary-row{display:flex;justify-content:space-between;padding:8px 0;font-size:15px;}
        .coupon-form{display:flex;gap:8px;margin-top:6px;}
        .coupon-form input{flex:1;padding:6px;border:1px solid #ddd;border-radius:4px;}
        .btn-apply{padding:6px 10px;border:0;background:#222;color:#fff;border-radius:4px;cursor:pointer;}
        hr{margin:12px 0;border:none;border-top:1px solid #f0f0f0;}
        .btn-checkout{display:block;margin-top:10px;padding:12px;text-align:center;background:#000;color:#fff;border-radius:6px;text-decoration:none;font-weight:700;}
        .free-note{font-size:13px;color:green;margin-top:8px;text-align:center;}
        @media (max-width:900px){
            .cart-grid{flex-direction:column;}
            .cart-head, .cart-row{grid-template-columns: 1fr 110px 160px 90px;}
            .summary-card{width:100%;}
        }
    </style>

    <!-- JS: plus/minus and auto submit -->
    <script>
        document.addEventListener('DOMContentLoaded', function(){
            // increment / decrement buttons
            document.querySelectorAll('.qty-btn.plus').forEach(function(btn){
                btn.addEventListener('click', function(){
                    const form = btn.closest('.qty-form');
                    const input = form.querySelector('.qty-input');
                    input.value = parseInt(input.value || 0) + 1;
                    form.submit();
                });
            });

            document.querySelectorAll('.qty-btn.minus').forEach(function(btn){
                btn.addEventListener('click', function(){
                    const form = btn.closest('.qty-form');
                    const input = form.querySelector('.qty-input');
                    let val = parseInt(input.value || 0) - 1;
                    if(val < 1) val = 1;
                    input.value = val;
                    form.submit();
                });
            });

            // direct change in number input -> submit
            document.querySelectorAll('.qty-input').forEach(function(input){
                input.addEventListener('change', function(){
                    if(input.value < 1) input.value = 1;
                    input.closest('.qty-form').submit();
                });
            });
        });
    </script>

