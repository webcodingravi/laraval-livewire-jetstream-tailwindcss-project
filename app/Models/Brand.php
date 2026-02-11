<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Brand extends Model
{
    use SoftDeletes;
    protected $guarded = [];

    public function category() {
        return $this->belongsTo(Category::class,'category_id');
    }

    public function SubCategory() {
        return $this->belongsTo(SubCategory::class,'sub_category_id');
    }
}
