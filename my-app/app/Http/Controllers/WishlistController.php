<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WishlistController extends Controller
{
    public function index()
    {
        $items = Wishlist::with('product')
            ->where('user_id', Auth::id())
            ->latest()
            ->get();

        return view('customer.heart', compact('items'));
    }

    public function toggle(Product $product)
    {
        $userId = Auth::id();

        $existing = Wishlist::where('user_id', $userId)
            ->where('product_id', $product->id)
            ->first();

        if ($existing) {
            $existing->delete();
            return back()->with('success', 'Removed from wishlist.');
        }

        Wishlist::create([
            'user_id' => $userId,
            'product_id' => $product->id,
        ]);

        return back()->with('success', 'Added to wishlist!');
    }

    public function destroy(Wishlist $item)
    {
        if ($item->user_id !== Auth::id()) {
            abort(403);
        }

        $item->delete();
        return back()->with('success', 'Removed from wishlist.');
    }

    public function moveToCart(Wishlist $item)
    {
        if ($item->user_id !== Auth::id()) {
            abort(403);
        }

        \App\Models\Cart::firstOrCreate(
            ['user_id' => Auth::id(), 'product_id' => $item->product_id],
            ['quantity' => 1]
        );

        $item->delete();

        return redirect()->route('customer.cart')->with('success', 'Moved to cart!');
    }
}
