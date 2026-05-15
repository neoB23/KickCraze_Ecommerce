<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Http\Response;

class ProductImageController extends Controller
{
    public function main($id): Response
    {
        $product = Product::findOrFail($id);

        abort_if(!$product->image, 404);

        return response($product->image, 200, [
            'Content-Type'  => 'image/jpeg',
            'Cache-Control' => 'public, max-age=86400',
        ]);
    }

    public function gallery($id): Response
    {
        $image = ProductImage::findOrFail($id);

        return response($image->image, 200, [
            'Content-Type'  => 'image/jpeg',
            'Cache-Control' => 'public, max-age=86400',
        ]);
    }
}
