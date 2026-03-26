<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\StockTransaction;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StockTransactionController extends Controller
{
    public function stockIn()
    {
        $products = Product::where('is_active', true)->orderBy('name')->get();
        $suppliers = Supplier::where('is_active', true)->orderBy('name')->get();

        $transactions = StockTransaction::with(['product', 'supplier', 'user'])
            ->where('type', 'in')
            ->latest()
            ->paginate(10);

        return view('stock.stock-in', compact('products', 'suppliers', 'transactions'));
    }

    public function storeStockIn(Request $request)
    {
        $validated = $request->validate([
            'product_id' => ['required', 'exists:products,id'],
            'supplier_id' => ['nullable', 'exists:suppliers,id'],
            'quantity' => ['required', 'integer', 'min:1'],
            'unit_cost' => ['nullable', 'numeric', 'min:0'],
            'reference_no' => ['nullable', 'string', 'max:255'],
            'remark' => ['nullable', 'string'],
            'transaction_date' => ['nullable', 'date'],
        ]);

        DB::transaction(function () use ($validated, $request) {
            $product = Product::lockForUpdate()->findOrFail($validated['product_id']);

            $product->increment('stock_quantity', $validated['quantity']);

            StockTransaction::create([
                'product_id' => $product->id,
                'supplier_id' => $validated['supplier_id'] ?? null,
                'user_id' => auth()->id(),
                'type' => 'in',
                'quantity' => $validated['quantity'],
                'unit_cost' => $validated['unit_cost'] ?? null,
                'reference_no' => $validated['reference_no'] ?? null,
                'remark' => $validated['remark'] ?? null,
                'transaction_date' => $validated['transaction_date'] ?? now(),
            ]);
        });

        return redirect()->route('stock.in')->with('success', 'Stock In recorded successfully.');
    }

    public function stockOut()
    {
        $products = Product::where('is_active', true)->orderBy('name')->get();

        $transactions = StockTransaction::with(['product', 'user'])
            ->where('type', 'out')
            ->latest()
            ->paginate(10);

        return view('stock.stock-out', compact('products', 'transactions'));
    }

    public function storeStockOut(Request $request)
    {
        $validated = $request->validate([
            'product_id' => ['required', 'exists:products,id'],
            'quantity' => ['required', 'integer', 'min:1'],
            'reference_no' => ['nullable', 'string', 'max:255'],
            'remark' => ['nullable', 'string'],
            'transaction_date' => ['nullable', 'date'],
        ]);

        DB::transaction(function () use ($validated) {
            $product = Product::lockForUpdate()->findOrFail($validated['product_id']);

            if ($product->stock_quantity < $validated['quantity']) {
                abort(422, 'Not enough stock for this product.');
            }

            $product->decrement('stock_quantity', $validated['quantity']);

            StockTransaction::create([
                'product_id' => $product->id,
                'supplier_id' => null,
                'user_id' => auth()->id(),
                'type' => 'out',
                'quantity' => $validated['quantity'],
                'unit_cost' => null,
                'reference_no' => $validated['reference_no'] ?? null,
                'remark' => $validated['remark'] ?? null,
                'transaction_date' => $validated['transaction_date'] ?? now(),
            ]);
        });

        return redirect()->route('stock.out')->with('success', 'Stock Out recorded successfully.');
    }
}