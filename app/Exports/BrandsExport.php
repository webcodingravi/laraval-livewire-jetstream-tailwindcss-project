<?php

namespace App\Exports;

use App\Models\Brand;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class BrandsExport implements FromCollection,WithMapping,WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Brand::with(['category:id,name','SubCategory:id,name'])->select('id','brand_name','slug','category_id','sub_category_id','status','created_at')->get();
    }


    public function map($brand): array
     {
       return [
             $brand->id,
             $brand->brand_name,
             $brand->slug,
             $brand->category->name ?? 'N/A',
             $brand->SubCategory->name ?? 'N/A',
             $brand->status ? 'Active' : 'Inactive',
             $brand->created_at->format('Y-m-d')
       ];
     }

     public function headings(): array
     {
         return ['ID','Brand','Slug','Category','Sub Category','Status','Created Date'];
     }
    }
