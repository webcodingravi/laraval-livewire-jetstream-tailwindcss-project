<?php

namespace App\Exports;

use App\Models\Category;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class CategoriesExport implements FromCollection,WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Category::select('id','name','slug','image','status','created_at')->get();
    }

    public function headings(): array
    {
        return ['ID','Name','Slug','Image','Status','Created Date'];
    }
}