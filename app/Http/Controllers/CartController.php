<?php

namespace App\Http\Controllers;

use App\Models\CartItem;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Mail\OrderPlacedMail;
use Illuminate\Support\Facades\Mail;
use Srmklive\PayPal\Services\PayPal as PayPalClient;



class CartController extends Controller
{
    public function addToCart($id)
    {
        $product = Product::findOrFail($id);
        if($product->stock == 0 || $product->quantity <= 0){
            return back()->with('error', "Sorry, this product is out of stock!");
        }
        $cartItem = CartItem::where('user_id', auth()->id())->where('product_id', $id)->first();

        if ($cartItem) {
            $cartItem->quantity += 1;
            $cartItem->save();
            $product->quantity -= 1;
        }else{
            CartItem::create([
                'user_id' => auth()->id(),
                'product_id' => $product->id,
                'quantity' => 1,
                'price' => $product->price,
            ]);
            $product->quantity -= 1;
            if ($product->quantity <= 0){
                $product->stock = 0;
            }
            $product->save();
        }
        return back()->with('success', 'Product added to cart successfully!');
    }

    public function viewCart()
    {
        $cartItems = CartItem::where('user_id', auth()->id())->with('product')->get();

        // subtotal = sum(price * quantity)
        $subtotal = $cartItems->sum(function($item){
            return $item->price * $item->quantity;
        });

        // 16% sales tax
        $taxRate = 0.16;
        $tax = round($subtotal * $taxRate, 2);

        // shipping rule: free if subtotal >= 1000
        $shipping = $subtotal >= 1000 ? 0 : 20;

        $grandTotal = round($subtotal + $tax + $shipping, 2);

        return view('cart.index', compact('cartItems', 'subtotal', 'tax', 'shipping', 'grandTotal'));
    }

    public function update(Request $request, $id)
    {
        $cartItem = CartItem::where('user_id', auth()->id())->findOrFail($id);
        $cartItem->quantity = $request->quantity;
        $cartItem->save();

        return back()->with('success','Quantity updated!');
    }

    public function delete($id)
    {
        $cartItem = CartItem::where('user_id', auth()->id())->findOrFail($id);
        $cartItem->delete();

        return back()->with('success','Item removed!');
    }

    public function checkoutForm(){
        $cartItems = CartItem::with('product')->where('user_id', auth()->id())->get();
        $subtotal = 0;
        foreach ($cartItems as $item){
            $subtotal += $item->price * $item->quantity;
            $taxRate = 0.16;
            $tax = round($subtotal * $taxRate, 2);
            $shipping = $subtotal >= 1000 ? 0 : 20;
            $grandTotal = round($subtotal + $tax + $shipping);
        }
        return view('cart.checkout', compact('cartItems', 'grandTotal'));
    }

    public function checkout(Request $request)
    {
        $cartItems = CartItem::with('product')->where('user_id', auth()->id())->get();

        $subtotal = 0;
        foreach ($cartItems as $item) {
            $subtotal += $item->price * $item->quantity;
        }
        $taxRate = 0.16;
        $tax = round($subtotal * $taxRate, 2);
        $shipping = $subtotal >= 1000 ? 0 : 20;
        $grandTotal = round($subtotal + $tax + $shipping);

        $request->validate([
           'firstname' => 'required',
            'email' => 'required',
            'address' => 'required',
            'city' => 'required',
            'state' => 'required',
            'zip' => 'nullable|string',
            'payment_method' => 'required',
        ]);

        $order = Order::create([
           'user_id' => auth()->id(),
           'name' => $request->firstname,
            'email' => $request->email,
            'address' => $request->address,
            'city' => $request->city,
            'state' => $request->state,
            'zip' => $request->zip,
            'payment_method' => $request->payment_method,
            'total_amount' => $grandTotal,
        ]);

        foreach($cartItems as $item){
            $order->orderItems()->create([
                'product_id' => $item->product_id,
                'quantity' => $item->quantity,
                'price' => $item->price,
                'subtotal' => $item->price * $item->quantity
            ]);
        }

        $order->load('orderItems.product');
        Mail::to($request->email)->send(new OrderPlacedMail($order));

        // Clear the cart
        CartItem::where('user_id', auth()->id())->delete();

        return redirect()->route('orders.show',$order->id)->with('success', 'Order placed successfully!');
    }


public function createPaypalOrder(Request $request)
{
    $cartItems = CartItem::with('product')->where('user_id', auth()->id())->get();

    if($cartItems->isEmpty()){
        return response()->json(['error' => 'Cart is empty!'], 400);
    }

    $subtotal = 0;
    foreach ($cartItems as $item) {
        $subtotal += $item->price * $item->quantity;
    }
    $tax = round($subtotal * 0.16, 2);
    $shipping = $subtotal >= 1000 ? 0 : 20;
    $grandTotal = round($subtotal + $tax + $shipping, 2);

    $provider = new PayPalClient;
    $provider->setApiCredentials(config('paypal'));
    $provider->getAccessToken();

    $order = $provider->createOrder([
        "intent" => "CAPTURE",
        "purchase_units" => [
            [
                "amount" => [
                    "currency_code" => "USD",
                    "value" => $grandTotal
                ]
            ]
        ]
    ]);

    return response()->json($order);
}

public function capturePaypalOrder(Request $request)
{
    $request->validate([
        'orderID' => 'required'
    ]);

    $provider = new PayPalClient;
    $provider->setApiCredentials(config('paypal'));
    $provider->getAccessToken();

    $capture = $provider->capturePaymentOrder($request->orderID);

    if(isset($capture['status']) && $capture['status'] == 'COMPLETED'){

        // Ab ye wahi COD logic jaise order save karte hain
        $cartItems = CartItem::with('product')->where('user_id', auth()->id())->get();

        $subtotal = 0;
        foreach ($cartItems as $item) {
            $subtotal += $item->price * $item->quantity;
        }
        $tax = round($subtotal * 0.16, 2);
        $shipping = $subtotal >= 1000 ? 0 : 20;
        $grandTotal = round($subtotal + $tax + $shipping, 2);

        $order = Order::create([
            'user_id' => auth()->id(),
            'name' => $request->firstname ?? auth()->user()->name,
            'email' => $request->email ?? auth()->user()->email,
            'address' => $request->address ?? '',
            'city' => $request->city ?? '',
            'state' => $request->state ?? '',
            'zip' => $request->zip ?? '',
            'payment_method' => 'PayPal',
            'transaction_id' => $capture['id'] ?? null,
//            'total_amount' => $grandTotal,
            'status' => 'completed'
        ]);

        foreach($cartItems as $item){
            $order->orderItems()->create([
                'product_id' => $item->product_id,
                'quantity' => $item->quantity,
                'price' => $item->price,
                'subtotal' => $item->price * $item->quantity
            ]);
        }

        $order->load('orderItems.product');
        Mail::to($order->email)->send(new OrderPlacedMail($order));

        // Clear cart
        CartItem::where('user_id', auth()->id())->delete();

        return response()->json(['status' => 'success', 'message' => 'Payment completed and order placed!', 'payer' => $capture['payer']]);
    }

    return response()->json(['status' => 'failed', 'message' => 'Payment not completed!'], 400);
}


}
