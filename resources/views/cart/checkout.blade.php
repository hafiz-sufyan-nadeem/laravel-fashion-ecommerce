<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout</title>

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>

<h2 style="text-align: center">Checkout Form</h2>
<p>Please checkout and pay us, before you run away.</p>
<div class="row">
    <div class="col-75">
        <div class="container">
            @if ($errors->any())
                <div style="background: #f8d7da; color: #721c24; padding: 10px; margin: 10px 0; border-radius: 5px;">
                    <ul style="margin: 0; padding-left: 20px;">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form action="{{route('checkout.store')}}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-50">
                        <h3>Billing Address</h3>
                        <label for="fname"><i class="fa fa-user"></i> Full Name</label>
                        <input type="text" id="fname" name="firstname" placeholder="Your Name">
                        <label for="email"><i class="fa fa-envelope"></i> Email</label>
                        <input type="text" id="email" name="email" placeholder="youremail@gmail.com">
                        <label for="adr"><i class="fa fa-address-card-o"></i> Address</label>
                        <input type="text" id="adr" name="address" placeholder="your address">
                        <label for="city"><i class="fa fa-institution"></i> City</label>
                        <input type="text" id="city" name="city" placeholder="your city">

                        <div class="row">
                            <div class="col-50">
                                <label for="state">State</label>
                                <input type="text" id="state" name="state" placeholder="your state">
                            </div>
                            <div class="col-50">
                                <label for="zip">Zip</label>
                                <input type="text" id="zip" name="zip" placeholder="814111">
                            </div>
                        </div>
                    </div>
                    <div class="col-50">
                        <h3>Payment</h3>
                        <label>
                            <input type="radio" name="payment_method" value="COD" checked> Cash on Delivery
                        </label><br>
                        <label>
                            <input type="radio" name="payment_method" value="Card"> Card (Dummy for now)
                        </label>
                    </div>


                </div>
                <label>
                    <input type="checkbox" checked="checked" name="sameadr"> Shipping address same as billing
                </label>
                <input type="submit" value="Place Order" class="btn">
            </form>
        </div>
    </div>
    <div class="col-25">
        <div class="container">
            <h4>Cart <span class="price" style="color:black"><i class="fa fa-shopping-cart"></i> <b>{{ count($cartItems) }}</b></span></h4>
            @foreach($cartItems as $item)
                <p>
                    <span href="#">{{ $item->product->name }}</span>
                    <span class="price">PKR {{ $item->price * $item->quantity }}</span>
                </p>
            @endforeach

            <hr>
            <p>Total <span class="price" style="color:black"><b>PKR {{ $grandTotal }}</b></span></p>
        </div>

    </div>
</div>
</body>
</html>


<style>
    body {
        font-family: Arial;
        font-size: 17px;
        padding: 8px;
    }

    * {
        box-sizing: border-box;
    }

    h2 {
        font-size: 40px;
        background: linear-gradient(to left, #660066 0%, #ff3300 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
    }

    .row {
        display: -ms-flexbox;
        /* IE10 */
        display: flex;
        -ms-flex-wrap: wrap;
        /* IE10 */
        flex-wrap: wrap;
        margin: 0 -16px;
    }

    .col-25 {
        -ms-flex: 25%;
        /* IE10 */
        flex: 25%;
    }

    .col-50 {
        -ms-flex: 50%;
        /* IE10 */
        flex: 50%;
    }

    .col-75 {
        -ms-flex: 75%;
        /* IE10 */
        flex: 75%;
    }

    .col-25,
    .col-50,
    .col-75 {
        padding: 0 16px;
    }

    .container {
        background-color: #f2f2f2;
        padding: 5px 20px 15px 20px;
        border: 1px solid lightgrey;
        border-radius: 3px;
    }

    input[type=text] {
        width: 100%;
        margin-bottom: 20px;
        padding: 12px;
        border: 1px solid #ccc;
        border-radius: 3px;
    }

    label {
        margin-bottom: 10px;
        display: block;
    }

    .icon-container {
        margin-bottom: 20px;
        padding: 7px 0;
        font-size: 24px;
    }

    .btn {
        background: linear-gradient(to left, #99ccff 0%, #003399 100%);
        color: black;
        padding: 12px;
        margin: 10px 0;
        border: none;
        width: 100%;
        border-radius: 3px;
        cursor: pointer;
        font-size: 20px;
    }

    .btn:hover {
        background: linear-gradient(to left, #003399 0%, #99ccff 100%);
    }

    a {
        color: #2196F3;
    }

    hr {
        border: 1px solid lightgrey;
    }

    span.price {
        float: right;
        color: grey;
    }

    /* Responsive layout - when the screen is less than 800px wide, make the two columns stack on top of each other instead of next to each other (also change the direction - make the "cart" column go on top) */
    @media (max-width: 800px) {
        .row {
            flex-direction: column-reverse;
        }

        .col-25 {
            margin-bottom: 20px;
        }
    }
</style>
