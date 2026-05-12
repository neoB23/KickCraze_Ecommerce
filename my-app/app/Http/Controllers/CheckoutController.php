<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    // Show checkout page
    public function index()
    {
        $items = Cart::with('product')
                     ->where('user_id', Auth::id())
                     ->get();

        return view('customer.checkout', compact('items'));
    }

    // Process checkout
    public function process()
    {
        $userId = Auth::id();
        
        $cartItems = Cart::with('product')
                         ->where('user_id', $userId)
                         ->get();

        if ($cartItems->isEmpty()) {
            return back()->with('error', 'Your cart is empty.');
        }

        // Check stock for each item
        foreach ($cartItems as $item) {
            if ($item->quantity > $item->product->stock) {
                return back()->with('error', $item->product->title . ' does not have enough stock.');
            }
        }

        // Create an OrderItem for each cart item
        foreach ($cartItems as $cartItem) {
            $itemTotal = $cartItem->quantity * $cartItem->product->price;
            
            OrderItem::create([
                'customer_id'  => $userId,
                'product_id'   => $cartItem->product_id,
                'quantity'     => $cartItem->quantity,
                'total_amount' => $itemTotal,
                'status'       => 'Pending',
            ]);

            // Reduce stock for each product
            $cartItem->product->decrement('stock', $cartItem->quantity);
        }

        // Clear the cart
        Cart::where('user_id', $userId)->delete();

        return redirect()->route('customer.orders')->with('success', 'Checkout complete!');
    }
}
