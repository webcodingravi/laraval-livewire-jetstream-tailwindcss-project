<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;


use App\Models\Product;
use Maatwebsite\Excel\Concerns\FromCollection;

class ProductsExport implements FromCollection,WithHeadings,WithMapping
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
      return Product::with([
    'category:id,name',
    'subCategory:id,name',
    'brand:id,brand_name',
    'productImages:id,product_id,image_name',
    'colors:id,name',
    'sizes:id,product_id,product_size,product_price'
])->get();

    }

 public function map($product): array
     {
        return [
        $product->id,
        $product->title,
        $product->slug,
        $product->category->name ?? 'N/A',
        $product->subCategory->name ?? 'N/A',
        $product->brand->brand_name ?? 'N/A',
        $product->old_price ?? 'N/A',
        $product->discount ?? 'N/A',
        $product->price ?? 'N/A',
        $product->quantity ?? 'N/A',
        $product->short_description ?? 'N/A',
        $product->colors->pluck('name')->implode(', ') ?? 'N/A',
         $product->sizes->pluck('product_size')->implode(', ') ?? 'N/A',
        $product->sizes->pluck('product_price')->implode(', ') ?? 'N/A',
        $product->productImages->pluck('image_name')->implode(', ') ?? 'N/A',

        $product->is_hot ? 'Hot' : 'N/A',
        $product->is_featured ? 'Featured' : 'N/A',
        $product->status ? 'Active' : 'Inactive',
        $product->created_at->format('Y-m-d'),
    ];
     }



    public function headings():array
    {
        return ['ID','Title','Slug','Category','Sub Category','Brand','Old Price','Discount (%)','Price','Qty','Description','Product Colors','Product Size','Product_Size_Price','Images','Hot Products','Featured Products','Status','Created Date'];
    }
}
