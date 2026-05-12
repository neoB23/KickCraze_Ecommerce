<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    // Men's Products + Search by title only
    public function mens(Request $request)
    {
        $search = $request->input('search');

        $products = Product::where('category', 'Men')
            ->when($search, function ($query) use ($search) {
                $query->where('title', 'like', "%{$search}%");
            })
            ->get();

        return view('pages.mens', compact('products'));
    }

    // Women's Products + Search by title only
    public function womens(Request $request)
    {
        $search = $request->input('search');

        $products = Product::where('category', 'Women')
            ->when($search, function ($query) use ($search) {
                $query->where('title', 'like', "%{$search}%");
            })
            ->get();

        return view('pages.womens', compact('products'));
    }

    // Kids Products + Search by title only
    public function kids(Request $request)
    {
        $search = $request->input('search');

        $products = Product::where('category', 'Kids')
            ->when($search, function ($query) use ($search) {
                $query->where('title', 'like', "%{$search}%");
            })
            ->get();

        return view('pages.kids', compact('products'));
    }

    // Sale Products + Search by title only
    public function sale(Request $request)
    {
        $search = $request->input('search');

        $products = Product::where('category', 'Sale')
            ->when($search, function ($query) use ($search) {
                $query->where('title', 'like', "%{$search}%");
            })
            ->get();

        return view('pages.sale', compact('products'));
    }

    // Product details
    public function show($id)
    {
        $product = Product::findOrFail($id);
        return view('customer.detail', compact('product'));
    }
}
