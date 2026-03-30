<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            // Beverages
            'Coffee',
            'Tea',
            'Soft Drinks',
            'Juices',
            'Energy Drinks',
            'Mineral Water',

            // Snacks
            'Chips',
            'Biscuits',
            'Chocolate',
            'Candy',
            'Nuts',

            // Electronics
            'Mobile Phones',
            'Laptops',
            'Tablets',
            'Headphones',
            'Power Banks',
            'Chargers',
            'Cables',

            // Stationery
            'Pens',
            'Pencils',
            'Notebooks',
            'Markers',
            'Folders',
            'Staplers',

            // Household
            'Cleaning Supplies',
            'Kitchenware',
            'Laundry Detergent',
            'Toilet Paper',
            'Tissues',
            'Trash Bags',

            // Personal Care
            'Shampoo',
            'Body Wash',
            'Toothpaste',
            'Skincare',
            'Hair Care',

            // Misc
            'Pet Supplies',
            'Baby Products',
            'Office Supplies',
            'Health Products',
        ];

        foreach ($categories as $name) {
            Category::firstOrCreate(
                ['slug' => Str::slug($name)], // 防重复关键
                [
                    'name' => $name,
                    'description' => $name . ' category',
                    'is_active' => true,
                ]
            );
        }
    }
}
