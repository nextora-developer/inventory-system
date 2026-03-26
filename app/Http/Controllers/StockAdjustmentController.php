<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\StockAdjustment;
use App\Models\StockTransaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StockAdjustmentController extends Controller
{
    public function index()
    {
        $adjustments = StockAdjustment::with(['product', 'user'])
            ->latest()
            ->paginate(10);

        return view('stock-adjustments.index', compact('adjustments'));
    }

    public function create()
    {
        $products = Product::orderBy('name')->get();

        return view('stock-adjustments.create', compact('products'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'product_id' => ['required', 'exists:products,id'],
            'new_quantity' => ['required', 'integer', 'min:0'],
            'reason' => ['nullable', 'string', 'max:255'],
            'remark' => ['nullable', 'string'],
        ]);

        DB::transaction(function () use ($validated) {
            $product = Product::lockForUpdate()->findOrFail($validated['product_id']);

            $oldQuantity = $product->stock_quantity;
            $newQuantity = (int) $validated['new_quantity'];
            $difference = $newQuantity - $oldQuantity;

            $product->update([
                'stock_quantity' => $newQuantity,
            ]);

            StockAdjustment::create([
                'product_id' => $product->id,
                'user_id' => auth()->id(),
                'old_quantity' => $oldQuantity,
                'new_quantity' => $newQuantity,
                'difference' => $difference,
                'reason' => $validated['reason'] ?? null,
                'remark' => $validated['remark'] ?? null,
            ]);

            if ($difference !== 0) {
                StockTransaction::create([
                    'product_id' => $product->id,
                    'supplier_id' => null,
                    'user_id' => auth()->id(),
                    'type' => $difference > 0 ? 'adjustment_plus' : 'adjustment_minus',
                    'quantity' => abs($difference),
                    'unit_cost' => null,
                    'reference_no' => 'ADJ-' . now()->format('YmdHis'),
                    'remark' => $validated['remark'] ?? $validated['reason'] ?? 'Stock adjustment',
                    'transaction_date' => now(),
                ]);
            }
        });

        return redirect()->route('stock-adjustments.index')
            ->with('success', 'Stock adjustment recorded successfully.');
    }
}