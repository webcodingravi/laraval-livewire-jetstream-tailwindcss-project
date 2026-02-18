<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Color extends Model
{
    use SoftDeletes;
    protected $guarded = [];

    public function category() {
        return $this->belongsTo(Category::class,'category_id');
    }

    public function subCategory() {
        return $this->belongsTo(SubCategory::class,'sub_category_id');
    }


    // Products relation
    public function products()
    {
        return $this->belongsToMany(
            Product::class,
            'product_colors',
            'color_id',
            'product_id'
        );
    }


}
