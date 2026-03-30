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
        $categories = Category::all()->keyBy('name');

        $products = [
            // Beverages
            ['name' => 'Coca Cola 500ml', 'category' => 'Soft Drinks', 'brand' => 'Coca Cola', 'unit' => 'bottle', 'cost_price' => 2.00, 'selling_price' => 3.50],
            ['name' => 'Pepsi 500ml', 'category' => 'Soft Drinks', 'brand' => 'Pepsi', 'unit' => 'bottle', 'cost_price' => 2.00, 'selling_price' => 3.40],
            ['name' => 'Mineral Water 1L', 'category' => 'Mineral Water', 'brand' => 'Spritzer', 'unit' => 'bottle', 'cost_price' => 1.20, 'selling_price' => 2.20],
            ['name' => 'Green Tea Bottle', 'category' => 'Tea', 'brand' => 'Heaven & Earth', 'unit' => 'bottle', 'cost_price' => 2.30, 'selling_price' => 3.80],

            // Snacks
            ['name' => 'Lays Classic Chips', 'category' => 'Chips', 'brand' => 'Lays', 'unit' => 'pack', 'cost_price' => 1.50, 'selling_price' => 2.80],
            ['name' => 'KitKat 4 Fingers', 'category' => 'Chocolate', 'brand' => 'Nestle', 'unit' => 'pack', 'cost_price' => 2.00, 'selling_price' => 3.50],
            ['name' => 'Oreo Biscuits', 'category' => 'Biscuits', 'brand' => 'Oreo', 'unit' => 'pack', 'cost_price' => 2.20, 'selling_price' => 3.90],

            // Electronics
            ['name' => 'Baseus USB Cable', 'category' => 'Cables', 'brand' => 'Baseus', 'unit' => 'pcs', 'cost_price' => 5.00, 'selling_price' => 9.90],
            ['name' => 'Anker Power Bank 10000mAh', 'category' => 'Power Banks', 'brand' => 'Anker', 'unit' => 'pcs', 'cost_price' => 45.00, 'selling_price' => 69.00],
            ['name' => 'Wireless Earbuds', 'category' => 'Headphones', 'brand' => 'Xiaomi', 'unit' => 'pcs', 'cost_price' => 30.00, 'selling_price' => 59.00],

            // Stationery
            ['name' => 'Pilot G2 Pen', 'category' => 'Pens', 'brand' => 'Pilot', 'unit' => 'pcs', 'cost_price' => 1.50, 'selling_price' => 3.00],
            ['name' => 'A5 Notebook', 'category' => 'Notebooks', 'brand' => 'Campus', 'unit' => 'pcs', 'cost_price' => 2.20, 'selling_price' => 4.50],

            // Household
            ['name' => 'Sunlight Dishwashing Liquid', 'category' => 'Cleaning Supplies', 'brand' => 'Sunlight', 'unit' => 'bottle', 'cost_price' => 4.00, 'selling_price' => 6.90],
            ['name' => 'Toilet Paper Roll', 'category' => 'Toilet Paper', 'brand' => 'Kleenex', 'unit' => 'pack', 'cost_price' => 6.00, 'selling_price' => 9.90],
        ];

        foreach ($products as $item) {

            $category = $categories->get($item['category']);

            // 如果分类不存在 → 跳过（避免报错）
            if (!$category) {
                continue;
            }

            Product::firstOrCreate(
                ['name' => $item['name']], // 防重复
                [
                    'category_id' => $category->id,
                    'sku' => 'SKU-' . strtoupper(Str::random(6)),
                    'barcode' => rand(100000000000, 999999999999),
                    'brand' => $item['brand'],
                    'unit' => $item['unit'],
                    'cost_price' => $item['cost_price'],
                    'selling_price' => $item['selling_price'],
                    'stock_quantity' => rand(20, 150),
                    'minimum_stock' => rand(3, 10),
                    'location' => 'Rack ' . chr(rand(65, 68)), // A-D
                    'description' => $item['name'] . ' description',
                    'is_active' => true,
                ]
            );
        }
    }
}
