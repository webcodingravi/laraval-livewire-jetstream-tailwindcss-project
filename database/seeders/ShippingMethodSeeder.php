<?php

namespace Database\Seeders;

use App\Models\ShippingMethod;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ShippingMethodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         $methods = [
            [
                'name' => 'Standard Shipping',
                'price' => 50,
                'delivery_time' => '5-7 business days',
                'description' => 'Regular delivery option',
                'min_order_amount' => null,
                'status' => 1,
            ],
            [
                'name' => 'Express Shipping',
                'price' => 100,
                'delivery_time' => '2-3 business days',
                'description' => 'Faster delivery option',
                'min_order_amount' => null,
                'status' => 1,
            ],
            [
                'name' => 'Overnight Shipping',
                'price' => 200,
                'delivery_time' => 'Next business day',
                'description' => 'Fastest delivery option',
                'min_order_amount' => null,
                'status' => 1,
            ],
            [
                'name' => 'Free Shipping',
                'price' => 0,
                'delivery_time' => '5-7 business days',
                'description' => 'Available on orders above ₹500',
                'min_order_amount' => 500,
                'status' => 1,
            ],
        ];

         foreach ($methods as $method) {
            ShippingMethod::create($method);
        }
    }
}