<?php

namespace App\Livewire\Front;

use App\Models\Category;
use App\Models\Product;
use Livewire\Component;

class Home extends Component
{
    public $categories;
    public $featuredProducts;



    public function mount() {
      $category = Category::withCount('product')->orderBy('name','asc')->get();
      $this->categories = $category;

      $featured = Product::with(['category:id,name,slug','subCategory:id,name,slug','productImages:id,product_id,image_name'])->where('is_featured',true)->get();
      $this->featuredProducts = $featured;


    }


    public function render()
    {
        return view('front.home')->layout('layouts.app');
    }
}
