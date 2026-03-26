<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\StockAdjustment;
use App\Models\StockTransaction;
use App\Models\Supplier;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        $totalProducts = Product::count();
        $totalCategories = Category::count();
        $totalSuppliers = Supplier::count();

        $lowStockCount = Product::whereColumn('stock_quantity', '<=', 'minimum_stock')->count();

        $stockInToday = StockTransaction::where('type', 'in')
            ->whereDate('transaction_date', today())
            ->sum('quantity');

        $stockOutToday = StockTransaction::where('type', 'out')
            ->whereDate('transaction_date', today())
            ->sum('quantity');

        $todayAdjustments = StockAdjustment::whereDate('created_at', today())->count();

        $activeUsers = User::count();

        $recentTransactions = StockTransaction::with(['product', 'user', 'supplier'])
            ->latest('transaction_date')
            ->take(8)
            ->get();

        return view('dashboard', compact(
            'totalProducts',
            'totalCategories',
            'totalSuppliers',
            'lowStockCount',
            'stockInToday',
            'stockOutToday',
            'todayAdjustments',
            'activeUsers',
            'recentTransactions'
        ));
    }
}