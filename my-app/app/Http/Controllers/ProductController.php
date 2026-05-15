<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    private function buildList(string $category, Request $request)
    {
        $query = Product::where('category', $category);

        if ($search = $request->input('search')) {
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('brand', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%");
            });
        }

        if ($brands = $request->input('brand')) {
            $query->whereIn('brand', (array) $brands);
        }

        if ($subs = $request->input('subcategory')) {
            $query->whereIn('subcategory', (array) $subs);
        }

        if ($sizes = $request->input('size')) {
            $query->where(function ($q) use ($sizes) {
                foreach ((array) $sizes as $size) {
                    $q->orWhereJsonContains('sizes', $size);
                }
            });
        }

        if ($min = $request->input('min_price')) {
            $query->where('price', '>=', $min);
        }
        if ($max = $request->input('max_price')) {
            $query->where('price', '<=', $max);
        }

        $sort = $request->input('sort', 'latest');
        match ($sort) {
            'price_asc'  => $query->orderBy('price', 'asc'),
            'price_desc' => $query->orderBy('price', 'desc'),
            'rating'     => $query->orderBy('rating', 'desc'),
            default      => $query->latest(),
        };

        $products = $query->get();

        $filterOptions = [
            'brands'        => Product::where('category', $category)->whereNotNull('brand')->where('brand', '!=', '')->distinct()->orderBy('brand')->pluck('brand'),
            'subcategories' => Product::where('category', $category)->whereNotNull('subcategory')->where('subcategory', '!=', '')->distinct()->orderBy('subcategory')->pluck('subcategory'),
            'sizes'         => Product::where('category', $category)->whereNotNull('sizes')->pluck('sizes')->flatten()->unique()->sort()->values(),
            'totalCount'    => Product::where('category', $category)->count(),
        ];

        return compact('products', 'filterOptions');
    }

    public function mens(Request $request)
    {
        return view('pages.mens', $this->buildList('Men', $request));
    }

    public function womens(Request $request)
    {
        return view('pages.womens', $this->buildList('Women', $request));
    }

    public function kids(Request $request)
    {
        return view('pages.kids', $this->buildList('Kids', $request));
    }

    public function sale(Request $request)
    {
        return view('pages.sale', $this->buildList('Sale', $request));
    }

    public function show($id)
    {
        $product = Product::with(['images', 'reviews.user'])->findOrFail($id);

        $similar = Product::where('id', '!=', $product->id)
            ->where(function ($q) use ($product) {
                $q->where('category', $product->category)
                  ->orWhere('brand', $product->brand);
            })
            ->orderByRaw('CASE WHEN brand = ? THEN 0 ELSE 1 END', [$product->brand])
            ->orderBy('rating', 'desc')
            ->limit(8)
            ->get();

        $reviews        = $product->reviews;
        $averageRating  = $product->averageRating();
        $reviewCount    = $reviews->count();
        $ratingBuckets  = [5,4,3,2,1];
        $ratingCounts   = collect($ratingBuckets)
            ->mapWithKeys(fn($r) => [$r => $reviews->where('rating', $r)->count()]);

        return view('customer.detail', compact(
            'product', 'similar', 'reviews', 'averageRating', 'reviewCount', 'ratingCounts'
        ));
    }
}
