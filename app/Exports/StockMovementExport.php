<?php

namespace App\Exports;

use App\Models\StockTransaction;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class StockMovementExport implements FromCollection, WithHeadings
{
    protected $filters;

    public function __construct($filters)
    {
        $this->filters = $filters;
    }

    public function collection()
    {
        return StockTransaction::with(['product', 'supplier', 'user'])
            ->when($this->filters['type'] ?? null, fn($q, $v) => $q->where('type', $v))
            ->when($this->filters['product_id'] ?? null, fn($q, $v) => $q->where('product_id', $v))
            ->when($this->filters['date_from'] ?? null, fn($q, $v) => $q->whereDate('transaction_date', '>=', $v))
            ->when($this->filters['date_to'] ?? null, fn($q, $v) => $q->whereDate('transaction_date', '<=', $v))
            ->latest('transaction_date')
            ->get()
            ->map(function ($t) {
                return [
                    'Date' => optional($t->transaction_date)->format('Y-m-d H:i'),
                    'Product' => $t->product?->name,
                    'Type' => $t->type,
                    'Qty' => $t->quantity,
                    'Supplier' => $t->supplier?->name,
                    'Reference' => $t->reference_no,
                    'By' => $t->user?->name,
                ];
            });
    }

    public function headings(): array
    {
        return [
            'Date',
            'Product',
            'Type',
            'Qty',
            'Supplier',
            'Reference',
            'By',
        ];
    }
}
