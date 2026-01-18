<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout</title>

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

    <!-- PayPal SDK -->
    <script src="https://www.paypal.com/sdk/js?client-id={{ env('PAYPAL_SANDBOX_CLIENT_ID') }}&currency=USD"></script>

    <style>
        body {
            background: #f8f9fa;
        }
        .checkout-container {
            max-width: 1100px;
            margin: 50px auto;
            background: white;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        }
        h2 {
            font-size: 35px;
            font-weight: 700;
            text-align: center;
            margin-bottom: 30px;
            background: linear-gradient(to right, #007bff, #6610f2);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }
        #cod-btn {
            display: block;
        }

        #paypal-button-container {
            display: none;
            margin-top: 20px;
        }

    </style>
</head>
<body>

<div class="checkout-container">
    <h2>Checkout Form</h2>
    <p class="text-center text-muted mb-4">Please fill out your billing details and complete your payment.</p>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="row g-4">
        <!-- Billing Form -->
        <div class="col-md-7">
            <form action="{{ route('checkout.store') }}" method="POST" id="checkoutForm">
                @csrf
                <div class="mb-3">
                    <label for="fname" class="form-label"><i class="fa fa-user"></i> Full Name</label>
                    <input type="text" id="fname" name="firstname" class="form-control" placeholder="Your Name">
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label"><i class="fa fa-envelope"></i> Email</label>
                    <input type="email" id="email" name="email" class="form-control" placeholder="youremail@gmail.com">
                </div>
                <div class="mb-3">
                    <label for="adr" class="form-label"><i class="fa fa-address-card"></i> Address</label>
                    <input type="text" id="adr" name="address" class="form-control" placeholder="Your Address">
                </div>
                <div class="mb-3">
                    <label for="city" class="form-label"><i class="fa fa-city"></i> City</label>
                    <input type="text" id="city" name="city" class="form-control" placeholder="Your City">
                </div>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="state" class="form-label">State</label>
                        <input type="text" id="state" name="state" class="form-control" placeholder="Your State">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="zip" class="form-label">Zip</label>
                        <input type="text" id="zip" name="zip" class="form-control" placeholder="814111">
                    </div>
                </div>

                <h5 class="mt-4 mb-3">Payment Method</h5>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="payment_method" id="cod" value="COD" checked>
                    <label class="form-check-label" for="cod">Cash on Delivery</label>
                </div>

                <div class="form-check mt-2">
                    <input class="form-check-input" type="radio" name="payment_method" id="paypal" value="PayPal">
                    <label class="form-check-label" for="paypal">Pay with PayPal</label>
                </div>

                <div class="form-check mt-3">
                    <input class="form-check-input" type="checkbox" checked name="sameadr" id="sameadr">
                    <label class="form-check-label" for="sameadr">Shipping address same as billing</label>
                </div>

                <!-- PayPal button -->
                <div id="paypal-button-container"></div>

                <!-- COD button -->
                <button type="submit" class="btn btn-primary w-100 mt-4" id="cod-btn">Place Order</button>
            </form>
        </div>

        <!-- Cart Summary -->
        <div class="col-md-5">
            <div class="border rounded p-4 bg-light">
                <h4 class="mb-4">Your Cart
                    <span class="float-end text-muted">
                        <i class="fa fa-shopping-cart"></i> {{ count($cartItems) }}
                    </span>
                </h4>

                @foreach($cartItems as $item)
                    <div class="d-flex justify-content-between mb-2">
                        <span>{{ $item->product->name }}</span>
                        <span>PKR {{ $item->price * $item->quantity }}</span>
                    </div>
                @endforeach
                <hr>
                <div class="d-flex justify-content-between">
                    <strong>Total:</strong>
                    <strong>PKR {{ $grandTotal }}</strong>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- PayPal Script -->
<!-- PayPal Script -->
<script>
    document.addEventListener("DOMContentLoaded", function() {

        const codBtn = document.getElementById('cod-btn');
        const paypalContainer = document.getElementById('paypal-button-container');
        const paypalRadio = document.getElementById('paypal');
        const codRadio = document.getElementById('cod');

        // Function to toggle buttons
        function toggleButtons() {
            if (paypalRadio.checked) {
                codBtn.style.display = 'block'; // show plac order button too
                paypalContainer.style.display = 'block';
            } else if (codRadio.checked) {
                codBtn.style.display = 'block';
                paypalContainer.style.display = 'none';
            }
        }


        // Attach event listeners
        paypalRadio.addEventListener('change', toggleButtons);
        codRadio.addEventListener('change', toggleButtons);

        // Run once at start
        toggleButtons();

        // Initialize PayPal Button
        if (typeof paypal !== "undefined") {
            paypal.Buttons({
                createOrder: function(data, actions) {
                    return fetch('{{ route('checkout.fake.paypal') }}', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: JSON.stringify({
                            firstname: document.getElementById('fnanme').value,
                            email: document.getElementById('email').value,
                            address: document.getElementById('adr').value,
                            city: document.getElementById('city').value,
                            state: document.getElementById('state').value,
                            zip: document.getElementById('zip').value,
                        })
                    })
                        .then(res => res.json())
                        .then(data => {
                            if (data.status === 'success') {
                                alert('💰 Fake PayPal Payment Successful! Order ID: ' + data.order_id);
                                window.location.href = '/my-orders';
                            } else {
                                alert('Payment Error: ' + data.message);
                            }
                        });
                },
                onApprove: function() {
                    // Is case me kuch nahi karna, kyunki fake route already order bana chuka hai
                    return Promise.resolve();
                }

            }).render('#paypal-button-container');
        } else {
            console.error("PayPal SDK failed to load.");
        }
    });
</script>



<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
