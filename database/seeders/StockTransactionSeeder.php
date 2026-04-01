<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\StockTransaction;
use App\Models\Supplier;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StockTransactionSeeder extends Seeder
{
    public function run(): void
    {
        $products = Product::where('is_active', true)->get();
        $suppliers = Supplier::where('is_active', true)->get();
        $users = User::all();

        if ($products->isEmpty() || $users->isEmpty()) {
            $this->command->warn('Products or users not found. Seeder skipped.');
            return;
        }

        DB::transaction(function () use ($products, $suppliers, $users) {
            foreach ($products as $product) {
                // 重置库存，避免重复 seed 越来越大
                $product->update(['stock_quantity' => 0]);

                $startDate = now()->subYear()->startOfDay();
                $endDate = now();

                $currentDate = $startDate->copy();

                while ($currentDate->lte($endDate)) {
                    // 每个月 2~6 次进货
                    $monthlyStockInCount = rand(2, 6);

                    for ($i = 0; $i < $monthlyStockInCount; $i++) {
                        $date = $this->randomDateInMonth($currentDate);

                        $qty = rand(20, 120);
                        $unitCost = rand(800, 8000) / 100; // 8.00 ~ 80.00

                        $supplier = $suppliers->isNotEmpty() ? $suppliers->random() : null;
                        $user = $users->random();

                        $product->increment('stock_quantity', $qty);

                        StockTransaction::create([
                            'product_id' => $product->id,
                            'supplier_id' => $supplier?->id,
                            'user_id' => $user->id,
                            'type' => 'in',
                            'quantity' => $qty,
                            'unit_cost' => $unitCost,
                            'reference_no' => 'IN-' . $date->format('Ymd') . '-' . strtoupper(fake()->bothify('??###')),
                            'remark' => fake()->randomElement([
                                'Restock from supplier',
                                'Monthly replenishment',
                                'Inventory refill',
                                'Purchase order received',
                            ]),
                            'transaction_date' => $date,
                            'created_at' => $date,
                            'updated_at' => $date,
                        ]);
                    }

                    // 每个月 8~25 次出货
                    $monthlyStockOutCount = rand(8, 25);

                    for ($i = 0; $i < $monthlyStockOutCount; $i++) {
                        $date = $this->randomDateInMonth($currentDate);

                        $qty = rand(1, 15);

                        // 如果库存不够，就跳过这笔，避免负库存
                        if ($product->stock_quantity < $qty) {
                            continue;
                        }

                        $user = $users->random();

                        $product->decrement('stock_quantity', $qty);

                        StockTransaction::create([
                            'product_id' => $product->id,
                            'supplier_id' => null,
                            'user_id' => $user->id,
                            'type' => 'out',
                            'quantity' => $qty,
                            'unit_cost' => null,
                            'reference_no' => 'OUT-' . $date->format('Ymd') . '-' . strtoupper(fake()->bothify('??###')),
                            'remark' => fake()->randomElement([
                                'Customer order fulfilled',
                                'Stock issued',
                                'Sales delivery',
                                'Item released from inventory',
                            ]),
                            'transaction_date' => $date,
                            'created_at' => $date,
                            'updated_at' => $date,
                        ]);
                    }

                    $currentDate->addMonth()->startOfMonth();
                }
            }
        });
    }

    private function randomDateInMonth(Carbon $month): Carbon
    {
        $start = $month->copy()->startOfMonth();
        $end = $month->copy()->endOfMonth();

        if ($end->gt(now())) {
            $end = now();
        }

        return Carbon::createFromTimestamp(
            rand($start->timestamp, $end->timestamp)
        );
    }
}
