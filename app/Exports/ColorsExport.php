<?php

namespace App\Exports;

use App\Models\Color;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class ColorsExport implements FromCollection,WithHeadings,WithMapping
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Color::with(['category:id,name','subCategory:id,name'])->select('id','name','code','category_id','sub_category_id','status','created_at')->get();
    }

    public function map($color):array
    {
        return [
            $color->id,
            $color->name,
            $color->code,
            $color->category->name ?? 'N/A',
            $color->subCategory->name ?? 'N/A',
            $color->status ? 'Active' : 'Inactive',
            $color->created_at->format('Y-m-d')

        ];
    }

    public function headings():array
    {
        return ['ID','Color Name','Code','Category','Sub Category','Status','Created Date'];
    }


}
