<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductReview;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function store(Request $request, Product $product)
    {
        $validated = $request->validate([
            'rating'  => 'required|integer|min:1|max:5',
            'title'   => 'nullable|string|max:120',
            'comment' => 'required|string|max:2000',
        ]);

        ProductReview::create([
            'product_id' => $product->id,
            'user_id'    => $request->user()->id,
            'rating'     => $validated['rating'],
            'title'      => $validated['title'] ?? null,
            'comment'    => $validated['comment'],
        ]);

        $avg = round((float) $product->reviews()->avg('rating'), 2);
        $product->update(['rating' => $avg]);

        return redirect()
            ->route('product.show', $product->id)
            ->with('success', 'Thanks for your review!')
            ->withFragment('reviews');
    }
}
