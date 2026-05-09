<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
{
    DB::table('products')->insert([
        [
            'title' => "Nike Air Force 1 '07 LV8",
            'price' => 6995,
            'image' => 'Images/Mens/1.png',
            'description' => 'Great shoes.',
            'category' => 'Men',
        ],
        [
            'title' => "Nike Air Max Excee",
            'price' => 3847,
            'image' => 'Images/Mens/2.png',
            'description' => 'Great shoes.',
            'category' => 'Men',
        ],
        [
            'title' => "Nike Air Max (Model 3)",
            'price' => 0, // Add price if known
            'image' => 'Images/Mens/3.png',
            'description' => 'Great shoes.',
            'category' => 'Men',
        ],
        
    ]);
}
}
