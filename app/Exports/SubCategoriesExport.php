<?php

namespace App\Exports;

use App\Models\SubCategory;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class SubCategoriesExport implements FromCollection,WithHeadings,WithMapping
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return SubCategory::with('category:id,name')->select('id','name','slug','category_id','status','created_at')->get();
    }

        public function map($sub): array
    {
        return [
            $sub->id,
            $sub->name,
            $sub->slug,
            $sub->category?->name ?? 'N/A',
            $sub->status ? 'Active' : 'Inactive',
            $sub->created_at->format('Y-m-d'),
        ];
    }


    public function headings():array
    {
        return ['ID','Sub Category','Slug','Category','Status','Created Date'];
    }

}
