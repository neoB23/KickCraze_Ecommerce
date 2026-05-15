<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BrandController extends Controller
{
    public function index()
    {
        $brands = Product::query()
            ->selectRaw('brand, COUNT(*) as product_count, SUM(stock) as total_stock, AVG(price) as avg_price, MIN(price) as min_price, MAX(price) as max_price')
            ->whereNotNull('brand')
            ->where('brand', '!=', '')
            ->groupBy('brand')
            ->orderBy('brand')
            ->get();

        return view('admin.brands.index', compact('brands'));
    }

    public function show(string $brand)
    {
        $products = Product::where('brand', $brand)->latest()->paginate(20);

        if ($products->isEmpty()) {
            abort(404);
        }

        return view('admin.brands.show', compact('brand', 'products'));
    }

    public function rename(Request $request, string $brand)
    {
        $validated = $request->validate([
            'new_name' => 'required|string|max:100',
        ]);

        $updated = Product::where('brand', $brand)->update(['brand' => $validated['new_name']]);

        return redirect()
            ->route('admin.brands.index')
            ->with('success', "Renamed {$updated} product(s) from \"{$brand}\" to \"{$validated['new_name']}\".");
    }
}
