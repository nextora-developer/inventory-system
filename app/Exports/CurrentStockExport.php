<?php

namespace App\Exports;

use App\Models\Product;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class CurrentStockExport implements FromCollection, WithHeadings
{
    protected array $filters;

    public function __construct(array $filters = [])
    {
        $this->filters = $filters;
    }

    public function collection()
    {
        return Product::with('category')
            ->when($this->filters['search'] ?? null, function ($query, $search) {
                $query->where(function ($q) use ($search) {
                    $q->where('name', 'like', "%{$search}%")
                        ->orWhere('sku', 'like', "%{$search}%")
                        ->orWhere('barcode', 'like', "%{$search}%");
                });
            })
            ->orderBy('name')
            ->get()
            ->map(function ($product) {
                $isLowStock = $product->stock_quantity <= $product->minimum_stock;

                return [
                    'Product' => $product->name,
                    'Brand' => $product->brand ?: 'No brand',
                    'Category' => $product->category?->name ?? 'Uncategorized',
                    'SKU' => $product->sku,
                    'Barcode' => $product->barcode,
                    'Stock Quantity' => $product->stock_quantity,
                    'Unit' => $product->unit,
                    'Minimum Stock' => $product->minimum_stock,
                    'Status' => $isLowStock ? 'Low Stock' : 'Healthy',
                    'Cost Price' => $product->cost_price,
                    'Selling Price' => $product->selling_price,
                    'Location' => $product->location,
                    'Description' => $product->description,
                    'Active' => $product->is_active ? 'Yes' : 'No',
                ];
            });
    }

    public function headings(): array
    {
        return [
            'Product',
            'Brand',
            'Category',
            'SKU',
            'Barcode',
            'Stock Quantity',
            'Unit',
            'Minimum Stock',
            'Status',
            'Cost Price',
            'Selling Price',
            'Location',
            'Description',
            'Active',
        ];
    }
}