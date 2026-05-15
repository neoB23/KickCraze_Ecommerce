<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\ProductImage;

class ProductController extends Controller
{
    private const SUBCATEGORIES = [
        'Sneakers', 'Running', 'Basketball', 'Skate', 'Lifestyle',
        'Training', 'Sandals', 'Boots', 'Slip-Ons', 'Hiking',
    ];

    private const SIZES = [
        '5', '5.5', '6', '6.5', '7', '7.5', '8', '8.5', '9',
        '9.5', '10', '10.5', '11', '11.5', '12', '13',
    ];

    public function index(Request $request)
    {
        $query = Product::query();

        if ($search = $request->input('search')) {
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('brand', 'like', "%{$search}%");
            });
        }

        if ($cat = $request->input('category')) {
            $query->where('category', $cat);
        }

        if ($brand = $request->input('brand')) {
            $query->where('brand', $brand);
        }

        $products = $query->latest()->paginate(15)->withQueryString();

        $brands = Product::whereNotNull('brand')
            ->where('brand', '!=', '')
            ->distinct()
            ->pluck('brand')
            ->sort()
            ->values();

        return view('admin.products.index', compact('products', 'brands'));
    }

    public function create()
    {
        return view('admin.products.create', [
            'subcategories' => self::SUBCATEGORIES,
            'sizes'         => self::SIZES,
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title'             => 'required|string|max:255',
            'brand'             => 'required|string|max:100',
            'category'          => 'required|in:Men,Women,Kids,Sale',
            'subcategory'       => 'nullable|string|max:100',
            'description'       => 'required|string',
            'price'             => 'required|numeric|min:0',
            'stock'             => 'required|integer|min:0',
            'sizes'             => 'nullable|array',
            'sizes.*'           => 'string|max:10',
            'image'             => 'required|mimes:png,jpg,jpeg,webp,avif',
            'gallery_images'    => 'nullable|array|max:6',
            'gallery_images.*'  => 'mimes:png,jpg,jpeg,webp,avif',
        ]);

        $galleryFiles = $request->file('gallery_images', []);
        unset($validated['gallery_images']);

        $validated['image'] = file_get_contents($request->file('image')->getRealPath());

        $product = Product::create($validated);

        foreach ($galleryFiles as $i => $file) {
            ProductImage::create([
                'product_id' => $product->id,
                'image'      => file_get_contents($file->getRealPath()),
                'sort_order' => $i,
            ]);
        }

        return redirect()->route('admin.products.index')->with('success', 'Product created!');
    }

    public function edit($id)
    {
        $product = Product::findOrFail($id);

        return view('admin.products.edit', [
            'product'       => $product,
            'subcategories' => self::SUBCATEGORIES,
            'sizes'         => self::SIZES,
        ]);
    }

    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        $validated = $request->validate([
            'title'             => 'required|string|max:255',
            'brand'             => 'required|string|max:100',
            'category'          => 'required|in:Men,Women,Kids,Sale',
            'subcategory'       => 'nullable|string|max:100',
            'description'       => 'required|string',
            'price'             => 'required|numeric|min:0',
            'stock'             => 'required|integer|min:0',
            'sizes'             => 'nullable|array',
            'sizes.*'           => 'string|max:10',
            'image'             => 'nullable|mimes:png,jpg,jpeg,webp,avif',
            'gallery_images'    => 'nullable|array|max:6',
            'gallery_images.*'  => 'mimes:png,jpg,jpeg,webp,avif',
            'remove_gallery'    => 'nullable|array',
            'remove_gallery.*'  => 'integer',
        ]);

        $galleryFiles  = $request->file('gallery_images', []);
        $removeIds     = $request->input('remove_gallery', []);
        unset($validated['gallery_images'], $validated['remove_gallery']);

        if ($request->hasFile('image')) {
            $validated['image'] = file_get_contents($request->file('image')->getRealPath());
        }

        $product->update($validated);

        if (!empty($removeIds)) {
            ProductImage::where('product_id', $product->id)
                ->whereIn('id', $removeIds)
                ->delete();
        }

        $nextSort = (int) ($product->images()->max('sort_order') ?? -1) + 1;
        foreach ($galleryFiles as $file) {
            ProductImage::create([
                'product_id' => $product->id,
                'image'      => file_get_contents($file->getRealPath()),
                'sort_order' => $nextSort++,
            ]);
        }

        return redirect()->route('admin.products.index')->with('success', 'Product updated!');
    }

    public function destroy($id)
    {
        Product::findOrFail($id)->delete();
        return redirect()->back()->with('success', 'Product deleted.');
    }
}
