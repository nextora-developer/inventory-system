<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Supplier;

class SupplierSeeder extends Seeder
{
    public function run(): void
    {
        $suppliers = [
            [
                'name' => 'ABC Trading',
                'contact_person' => 'Ahmad',
                'phone' => '0123456789',
                'email' => 'abc@trading.com',
                'address' => 'Kuala Lumpur',
            ],
            [
                'name' => 'Global Supply',
                'contact_person' => 'John Lee',
                'phone' => '0139876543',
                'email' => 'global@supply.com',
                'address' => 'Selangor',
            ],
            [
                'name' => 'Tech Distributor',
                'contact_person' => 'Siva Kumar',
                'phone' => '0191234567',
                'email' => 'tech@dist.com',
                'address' => 'Penang',
            ],
        ];

        foreach ($suppliers as $supplier) {
            Supplier::create([
                ...$supplier,
                'remark' => null,
                'is_active' => true,
            ]);
        }
    }
}
