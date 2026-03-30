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
                'contact_person' => 'Ahmad Rahman',
                'phone' => '0123456789',
                'email' => 'abc@trading.com',
                'address' => 'Kuala Lumpur',
                'remark' => 'General goods supplier',
            ],
            [
                'name' => 'Global Supply',
                'contact_person' => 'John Lee',
                'phone' => '0139876543',
                'email' => 'global@supply.com',
                'address' => 'Selangor',
                'remark' => 'Bulk purchase available',
            ],
            [
                'name' => 'Tech Distributor',
                'contact_person' => 'Siva Kumar',
                'phone' => '0191234567',
                'email' => 'tech@dist.com',
                'address' => 'Penang',
                'remark' => 'Electronics specialist',
            ],
            [
                'name' => 'Fresh Mart Supply',
                'contact_person' => 'Nur Aisyah',
                'phone' => '0174567890',
                'email' => 'fresh@mart.com',
                'address' => 'Johor Bahru',
                'remark' => 'Beverages & snacks',
            ],
            [
                'name' => 'Office Needs Sdn Bhd',
                'contact_person' => 'Daniel Tan',
                'phone' => '0168899001',
                'email' => 'office@needs.com',
                'address' => 'Petaling Jaya',
                'remark' => 'Stationery supplier',
            ],
            [
                'name' => 'Home Care Supply',
                'contact_person' => 'Farah Aziz',
                'phone' => '0182233445',
                'email' => 'homecare@supply.com',
                'address' => 'Shah Alam',
                'remark' => 'Household products',
            ],
        ];

        foreach ($suppliers as $supplier) {

            Supplier::firstOrCreate(
                ['email' => $supplier['email']], // 防重复关键
                [
                    'name' => $supplier['name'],
                    'contact_person' => $supplier['contact_person'],
                    'phone' => $supplier['phone'],
                    'address' => $supplier['address'],
                    'remark' => $supplier['remark'],
                    'is_active' => true,
                ]
            );
        }
    }
}
