<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         $data = [
            'Electronics' => [
                'Mobile Phones',
                'Laptops',
                'Headphones',
            ],
            'Fashion' => [
                'Men Clothing',
                'Women Clothing',
            ],
        ];


            foreach ($data as $categoryName => $subCategories) {

            // Parent category create
            $category = Category::create([
                'name' => $categoryName,
                'slug' => Str::slug($categoryName),
            ]);

            // Sub categories create with category_id
            foreach ($subCategories as $subName) {
                SubCategory::create([
                    'name' => $subName,
                    'slug' => Str::slug($subName),
                    'category_id' => $category->id,
                ]);
            }
    }
}
}