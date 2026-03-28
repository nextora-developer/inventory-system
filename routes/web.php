<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StockAdjustmentController;
use App\Http\Controllers\StockTransactionController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::middleware(['auth'])->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // ADMIN ONLY
    Route::middleware('role:admin')->group(function () {
        Route::resource('categories', CategoryController::class);
        Route::resource('suppliers', SupplierController::class);
        Route::resource('users', UserController::class)->except(['show']);

        Route::patch('/users/{user}/toggle-status', [UserController::class, 'toggleStatus'])
            ->name('users.toggle-status');
    });

    // ADMIN + MANAGER
    Route::middleware('role:admin,manager')->group(function () {
        Route::resource('products', ProductController::class);

        Route::get('/reports/current-stock', [ReportController::class, 'currentStock'])->name('reports.current-stock');
        Route::get('/reports/low-stock', [ReportController::class, 'lowStock'])->name('reports.low-stock');
        Route::get('/reports/stock-movement', [ReportController::class, 'stockMovement'])->name('reports.stock-movement');
        Route::get('/reports/stock-movement/export', [ReportController::class, 'exportStockMovement'])->name('reports.stock-movement.export');
    });

    // ALL STAFF
    Route::middleware('role:admin,manager,staff,storekeeper')->group(function () {
        Route::get('/stock-in', [StockTransactionController::class, 'stockIn'])->name('stock.in');
        Route::post('/stock-in', [StockTransactionController::class, 'storeStockIn'])->name('stock.in.store');

        Route::get('/stock-out', [StockTransactionController::class, 'stockOut'])->name('stock.out');
        Route::post('/stock-out', [StockTransactionController::class, 'storeStockOut'])->name('stock.out.store');
    });

    // ADMIN ONLY
    Route::middleware('role:admin')->group(function () {
        Route::resource('stock-adjustments', StockAdjustmentController::class)
            ->only(['index', 'create', 'store']);
    });
});

require __DIR__ . '/auth.php';
