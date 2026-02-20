<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'title',
        'slug',
        'sku',
        'category_id',
        'sub_category_id',
        'brand_id',
        'price',
        'old_price',
        'discount',
        'short_description',
        'description',
        'quantity',
        'is_hot',
        'is_featured',
        'status',
        'meta_title',
        'meta_description',
        'specifications'
    ];

    public function category() {
        return $this->belongsTo(Category::class,'category_id');
    }

    public function subCategory() {
        return $this->belongsTo(SubCategory::class,'sub_category_id');
    }

    public function brand() {
        return $this->belongsTo(Brand::class,'brand_id');
    }

    public function productImages() {
        return $this->hasMany(ImageProduct::class, 'product_id');
    }


public function colors()
{
    return $this->belongsToMany(Color::class, 'product_colors', 'product_id','color_id');
}

    public function sizes() {
        return $this->hasMany(ProductSize::class);
    }


    public function getColors() {
         return $this->belongsToMany(Color::class, 'product_colors');
    }
}
