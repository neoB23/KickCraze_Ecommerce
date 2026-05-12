<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Http;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $response = Http::timeout(20)
            ->retry(2, 200)
            ->get('https://dummyjson.com/products?limit=100');

        if (!$response->ok()) {
            throw new \RuntimeException('DummyJSON request failed.');
        }

        $products = $response->json('products') ?? [];

        Product::query()->delete();

        $items = [];
        foreach ($products as $product) {
            $category = $this->mapCategory($product);
            if ($category === null) {
                continue;
            }

            $imageBinary = $this->fetchImageBinary($product);
            if ($imageBinary === null) {
                continue;
            }

            $items[] = [
                'title' => $product['title'] ?? 'Untitled',
                'category' => $category,
                'description' => $product['description'] ?? '',
                'price' => $product['price'] ?? 0,
                'stock' => $product['stock'] ?? 0,
                'image' => $imageBinary,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        if (empty($items)) {
            throw new \RuntimeException('No shoe products matched DummyJSON data.');
        }

        Product::insert($items);
    }

    private function mapCategory(array $product): ?string
    {
        $category = strtolower((string) ($product['category'] ?? ''));
        $title = strtolower((string) ($product['title'] ?? ''));
        $description = strtolower((string) ($product['description'] ?? ''));

        $haystack = $category . ' ' . $title . ' ' . $description;
        $isFootwear = str_contains($haystack, 'shoe')
            || str_contains($haystack, 'sneaker')
            || str_contains($haystack, 'boot')
            || str_contains($haystack, 'trainer')
            || str_contains($haystack, 'cleat')
            || str_contains($haystack, 'sandal');

        if (!$isFootwear) {
            return null;
        }

        $isSale = (float) ($product['discountPercentage'] ?? 0) >= 20;
        if ($isSale) {
            return 'Sale';
        }

        if ($category === 'womens-shoes' || str_contains($haystack, 'women')) {
            return 'Women';
        }

        if ($category === 'mens-shoes' || str_contains($haystack, 'men')) {
            return 'Men';
        }

        if (str_contains($haystack, 'kids') || str_contains($haystack, 'child') || str_contains($haystack, 'boys') || str_contains($haystack, 'girls')) {
            return 'Kids';
        }

        return null;
    }

    private function fetchImageBinary(array $product): ?string
    {
        $url = $product['thumbnail'] ?? null;
        if (empty($url) && !empty($product['images'][0])) {
            $url = $product['images'][0];
        }

        if (empty($url)) {
            return null;
        }

        $response = Http::timeout(20)->get($url);
        if (!$response->ok()) {
            return null;
        }

        return $response->body();
    }
}
