<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ShoeController extends Controller
{
    public function getAll(Request $request): JsonResponse
    {
        $query = Product::query();

        if ($gender = $request->input('gender')) {
            $query->where('category', $gender);
        }

        if ($brand = $request->input('brand')) {
            $query->where('brand', $brand);
        }

        if ($subcategory = $request->input('subcategory')) {
            $query->where('subcategory', $subcategory);
        }

        if ($size = $request->input('size')) {
            $query->whereJsonContains('sizes', $size);
        }

        if ($search = $request->input('search')) {
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('brand', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%");
            });
        }

        if ($minPrice = $request->input('min_price')) {
            $query->where('price', '>=', $minPrice);
        }

        if ($maxPrice = $request->input('max_price')) {
            $query->where('price', '<=', $maxPrice);
        }

        $sort = $request->input('sort', 'latest');
        match ($sort) {
            'price_asc'  => $query->orderBy('price', 'asc'),
            'price_desc' => $query->orderBy('price', 'desc'),
            'rating'     => $query->orderBy('rating', 'desc'),
            default      => $query->latest(),
        };

        $perPage = min((int) $request->input('per_page', 20), 100);
        $products = $query->paginate($perPage);

        $products->getCollection()->transform(fn ($p) => $this->transform($p));

        return response()->json($products);
    }

    public function show($id): JsonResponse
    {
        $product = Product::findOrFail($id);
        return response()->json($this->transform($product));
    }

    public function brands(): JsonResponse
    {
        $brands = Product::whereNotNull('brand')
            ->where('brand', '!=', '')
            ->select('brand')
            ->distinct()
            ->orderBy('brand')
            ->pluck('brand');

        return response()->json(['brands' => $brands]);
    }

    public function sizes(): JsonResponse
    {
        $sizes = Product::whereNotNull('sizes')
            ->pluck('sizes')
            ->flatten()
            ->unique()
            ->sort()
            ->values();

        return response()->json(['sizes' => $sizes]);
    }

    public function subcategories(): JsonResponse
    {
        $subs = Product::whereNotNull('subcategory')
            ->where('subcategory', '!=', '')
            ->select('subcategory')
            ->distinct()
            ->orderBy('subcategory')
            ->pluck('subcategory');

        return response()->json(['subcategories' => $subs]);
    }

    private function transform(Product $product): array
    {
        return [
            'id'          => $product->id,
            'title'       => $product->title,
            'brand'       => $product->brand,
            'gender'      => $product->category,
            'subcategory' => $product->subcategory,
            'description' => $product->description,
            'price'       => (float) $product->price,
            'stock'       => $product->stock,
            'sizes'       => $product->sizes ?? [],
            'rating'      => (float) ($product->rating ?? 0),
            'image_url'   => $product->image ? url("/api/shoes/{$product->id}/image") : null,
            'created_at'  => $product->created_at,
        ];
    }

    public function image($id)
    {
        $product = Product::findOrFail($id);
        if (!$product->image) {
            abort(404);
        }

        return response($product->image, 200, [
            'Content-Type'  => 'image/jpeg',
            'Cache-Control' => 'public, max-age=86400',
        ]);
    }
}
