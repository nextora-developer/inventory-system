<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $categories = Category::all();

        $products = [
            [
                'name' => 'Coca Cola 500ml',
                'category' => 'Beverages',
                'brand' => 'Coca Cola',
                'unit' => 'bottle',
                'cost_price' => 2.00,
                'selling_price' => 3.50,
            ],
            [
                'name' => 'Potato Chips',
                'category' => 'Snacks',
                'brand' => 'Lays',
                'unit' => 'pack',
                'cost_price' => 1.50,
                'selling_price' => 2.80,
            ],
            [
                'name' => 'USB Cable',
                'category' => 'Electronics',
                'brand' => 'Baseus',
                'unit' => 'pcs',
                'cost_price' => 5.00,
                'selling_price' => 9.90,
            ],
            [
                'name' => 'Notebook A5',
                'category' => 'Stationery',
                'brand' => 'Campus',
                'unit' => 'pcs',
                'cost_price' => 2.20,
                'selling_price' => 4.50,
            ],
            [
                'name' => 'Dishwashing Liquid',
                'category' => 'Household',
                'brand' => 'Sunlight',
                'unit' => 'bottle',
                'cost_price' => 4.00,
                'selling_price' => 6.90,
            ],
        ];

        foreach ($products as $item) {

            $category = $categories->firstWhere('name', $item['category']);

            Product::create([
                'category_id' => $category?->id,
                'name' => $item['name'],
                'sku' => 'SKU-' . strtoupper(Str::random(6)),
                'barcode' => rand(100000000000, 999999999999),
                'brand' => $item['brand'],
                'unit' => $item['unit'],
                'cost_price' => $item['cost_price'],
                'selling_price' => $item['selling_price'],
                'stock_quantity' => rand(10, 100),
                'minimum_stock' => 5,
                'location' => 'Rack A',
                'description' => $item['name'] . ' description',
                'is_active' => true,
            ]);
        }
    }
}