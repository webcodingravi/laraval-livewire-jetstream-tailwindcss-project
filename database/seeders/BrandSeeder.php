<?php

namespace Database\Seeders;

use App\Models\Brand;
use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class BrandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
       // Electronics category fetch karo
        $electronics = Category::where('name', 'Electronics')->first();

         // Mobile Phones subcategory fetch karo
        $mobiles = SubCategory::where('name', 'Mobile Phones')->first();

        $brands = ['Apple', 'Samsung', 'Sony'];

         foreach ($brands as $brand) {
            Brand::create([
                'brand_name' => $brand,
                'slug' => Str::slug($brand),
                'category_id' => $electronics->id,
                'sub_category_id' => $mobiles->id,
                'status' => 'active',
            ]);
        }
    }
}