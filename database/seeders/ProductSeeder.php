<?php

namespace Database\Seeders;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\SubCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $electronics = Category::where('name', 'Electronics')->first();
        $mobiles = SubCategory::where('name', 'Mobile Phones')->first();
        $apple = Brand::where('brand_name', 'Apple')->first();


               $products = [
            [
                'title' => 'iPhone 15 Pro Max',
                'old_price' => 150000,
                'discount' => 10,
                'quantity' => 50,
            ],
            [
                'title' => 'iPhone 14',
                'old_price' => 90000,
                'discount' => 5,
                'quantity' => 100,
            ],
        ];

          foreach ($products as $index => $item) {

            $price = $item['old_price'] - ($item['old_price'] * $item['discount'] / 100);

            Product::create([
                'title' => $item['title'],
                'slug' => Str::slug($item['title']),
                 'sku' => 'ELEC-MOB-' . strtoupper(Str::random(6)) . '-' . ($index + 1),
                'category_id' => $electronics->id,
                'sub_category_id' => $mobiles->id,
                'brand_id' => $apple->id,
                'old_price' => $item['old_price'],
                'discount' => $item['discount'],
                'price' => $price,
                'short_description' => 'Premium smartphone with advanced camera, powerful processor and stunning display.',
                'description' => 'Premium smartphone with advanced camera, powerful processor and stunning display.',
                'quantity' => $item['quantity'],
                'specifications' => json_encode([
                    'Display' => '6.7 inch OLED',
                    'Storage' => '256GB',
                    'RAM' => '8GB',
                    'Battery' => '4500mAh',
                    'Warranty' => '1 Year',
                ]),
            ]);
        }


    }
}
