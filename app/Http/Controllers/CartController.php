<?php

namespace App\Http\Controllers;

use App\Models\CartItem;
use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function addToCart($id)
    {
        $product = Product::findOrFail($id);
        $cartItem = CartItem::where('user_id', auth()->id())->where('product_id', $id)->first();

        if ($cartItem) {
            $cartItem->quantity += 1;
            $cartItem->save();
        }else{
            CartItem::create([
                'user_id' => auth()->id(),
                'product_id' => $product->id,
                'quantity' => 1,
                'price' => $product->price,
            ]);
        }
        return back()->with('success', 'Product added to cart successfully!');
    }

    public function viewCart()
    {
        $cartItems = CartItem::where('user_id', auth()->id())->with('product')->get();
        $total = $cartItems->sum(fn($item) => $item->price * $item->quantity);
        return view('cart.index', compact('cartItems', 'total'));
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
        return view('cart.checkout');
    }

}
