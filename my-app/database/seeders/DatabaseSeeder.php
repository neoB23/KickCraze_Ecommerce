<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Http;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    private const ALL_SIZES = ['5', '5.5', '6', '6.5', '7', '7.5', '8', '8.5', '9', '9.5', '10', '10.5', '11', '11.5', '12', '13'];

    private const KNOWN_BRANDS = [
        'Nike', 'Adidas', 'Puma', 'New Balance', 'Reebok', 'Vans', 'Converse',
        'Asics', 'Jordan', 'Under Armour', 'Skechers', 'Fila', 'Crocs',
    ];

    public function run(): void
    {
        $sources = [
            'https://dummyjson.com/products/category/mens-shoes?limit=100',
            'https://dummyjson.com/products/category/womens-shoes?limit=100',
            'https://dummyjson.com/products?limit=100',
        ];

        $products = [];
        foreach ($sources as $url) {
            $response = Http::timeout(20)->retry(2, 200)->get($url);
            if ($response->ok()) {
                $products = array_merge($products, $response->json('products') ?? []);
            }
        }

        if (empty($products)) {
            throw new \RuntimeException('DummyJSON request failed.');
        }

        // Dedupe by id
        $byId = [];
        foreach ($products as $p) {
            $byId[$p['id'] ?? uniqid()] = $p;
        }
        $products = array_values($byId);

        Product::query()->delete();

        $items = [];
        $index = 0;
        foreach ($products as $product) {
            $category = $this->mapCategory($product);
            if ($category === null) {
                continue;
            }

            $imageBinary = $this->fetchImageBinary($product);
            if ($imageBinary === null) {
                continue;
            }

            // Redistribute so Kids/Sale aren't empty: every 4th item → Kids, every 5th → Sale.
            if ($index > 0 && $index % 4 === 0) {
                $category = 'Kids';
            } elseif ($index > 0 && $index % 5 === 0) {
                $category = 'Sale';
            }
            $index++;

            $items[] = [
                'title'       => $product['title'] ?? 'Untitled',
                'brand'       => $this->mapBrand($product),
                'category'    => $category,
                'subcategory' => $this->mapSubcategory($product, $category),
                'sizes'       => json_encode($this->randomSizes($category)),
                'description' => $product['description'] ?? '',
                'price'       => $product['price'] ?? 0,
                'stock'       => $product['stock'] ?? 0,
                'rating'      => $product['rating'] ?? 0,
                'image'       => $imageBinary,
                'created_at'  => now(),
                'updated_at'  => now(),
            ];
        }

        if (empty($items)) {
            throw new \RuntimeException('No shoe products matched DummyJSON data.');
        }

        Product::insert($items);

        $this->command?->info(sprintf('Seeded %d products.', count($items)));
    }

    private function mapCategory(array $product): ?string
    {
        $category    = strtolower((string) ($product['category'] ?? ''));
        $title       = strtolower((string) ($product['title'] ?? ''));
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

    private function mapBrand(array $product): string
    {
        if (!empty($product['brand'])) {
            return $product['brand'];
        }

        $haystack = strtolower(($product['title'] ?? '') . ' ' . ($product['description'] ?? ''));

        foreach (self::KNOWN_BRANDS as $brand) {
            if (str_contains($haystack, strtolower($brand))) {
                return $brand;
            }
        }

        // Fallback: pick a deterministic brand per product so things look populated.
        return self::KNOWN_BRANDS[($product['id'] ?? 0) % count(self::KNOWN_BRANDS)];
    }

    private function mapSubcategory(array $product, string $gender): string
    {
        $haystack = strtolower(($product['title'] ?? '') . ' ' . ($product['description'] ?? ''));

        return match (true) {
            str_contains($haystack, 'basketball')               => 'Basketball',
            str_contains($haystack, 'running') || str_contains($haystack, 'runner') => 'Running',
            str_contains($haystack, 'skate')                    => 'Skate',
            str_contains($haystack, 'training') || str_contains($haystack, 'trainer') => 'Training',
            str_contains($haystack, 'boot')                     => 'Boots',
            str_contains($haystack, 'sandal')                   => 'Sandals',
            str_contains($haystack, 'hiking') || str_contains($haystack, 'trail')    => 'Hiking',
            str_contains($haystack, 'slip')                     => 'Slip-Ons',
            str_contains($haystack, 'sneaker')                  => 'Sneakers',
            default                                             => 'Lifestyle',
        };
    }

    private function randomSizes(string $gender): array
    {
        $pool = match ($gender) {
            'Kids'  => ['5', '5.5', '6', '6.5', '7', '7.5', '8'],
            'Women' => ['5', '5.5', '6', '6.5', '7', '7.5', '8', '8.5', '9', '9.5', '10'],
            'Men'   => ['7', '7.5', '8', '8.5', '9', '9.5', '10', '10.5', '11', '11.5', '12', '13'],
            default => self::ALL_SIZES,
        };

        // Pick 5–8 random sizes from the pool.
        $count = min(count($pool), random_int(5, 8));
        $picked = array_rand(array_flip($pool), $count);

        if (is_string($picked)) {
            $picked = [$picked];
        }

        sort($picked);
        return array_values($picked);
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
