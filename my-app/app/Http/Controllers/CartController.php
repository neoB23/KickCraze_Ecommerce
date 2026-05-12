<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Cart;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    // Show cart page
    public function index()
{
    $items = Cart::with('product')
                 ->where('user_id', auth()->id())
                 ->get();

    return view('customer.cart', compact('items'));
}


    // Add product to cart
    public function add(Product $product)
    {
        $userId = Auth::id();

        $cartItem = Cart::firstOrCreate(
            ['user_id' => $userId, 'product_id' => $product->id],
            ['quantity' => 0]
        );

        $cartItem->increment('quantity');

        return back()->with('success', 'Product added to cart!');
    }

    // Remove item from cart
    public function remove(Cart $item)
    {
        $item->delete();
        return back()->with('success', 'Product removed from cart!');
    }

    // Update quantity
    public function updateQuantity(Request $request, Cart $item)
    {
        $quantity = max(1, intval($request->quantity));
        $item->update(['quantity' => $quantity]);

        return back()->with('success', 'Quantity updated!');
    }
    
    // Increment item quantity by 1
    public function increment(Cart $item)
    {
        $item->increment('quantity');
        return back()->with('success', 'Quantity increased.');
    }

    // Decrement item quantity by 1 (min 1)
    public function decrement(Cart $item)
    {
        if ($item->quantity > 1) {
            $item->decrement('quantity');
        }
        return back()->with('success', 'Quantity updated.');
    }
    public function removeSelected(Request $request)
{
    if ($request->has('selected')) {
        Cart::whereIn('id', $request->selected)->delete();
    }
    return back()->with('success', 'Selected items removed.');
}

}
