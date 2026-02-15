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
        'short_description',
        'description',
        'quantity',
        'is_hot',
        'is_featured',
        'status'
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

    public function colors() {
        return $this->hasMany(ProductColor::class);
    }

    public function sizes() {
        return $this->hasMany(ProductSize::class);
    }
}