<?php

namespace App\Livewire\Front;

use App\Models\Category;
use App\Models\Product;
use App\Models\ProductWishlist;
use App\Services\WishlistService;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Home extends Component
{
    public $categories;
    public $featuredProducts;
    public $isWishlisted = false;

public function add_wishlists($productId) {
  try{

    $this->isWishlisted = WishlistService::toggle($productId);
     $this->dispatch('wishlistUpdated');

  }
  catch(\Exception $e) {
    $this->dispatch('alert',type:'error',title:'Error!',text:$e->getMessage());
  }
}


    public function mount() {
      $category = Category::withCount('product')->orderBy('name','asc')->get();
      $this->categories = $category;

      $featured = Product::with(['category:id,name,slug','subCategory:id,name,slug','productImages:id,product_id,image_name'])->where('is_featured',true)->get();
      $this->featuredProducts = $featured;

      $product = Product::first();
      if(!empty($product)){
 $this->isWishlisted = WishlistService::checkWishlist($product->id);
      }




    }


    public function render()
    {
        return view('front.home')->layout('layouts.app');
    }
}
