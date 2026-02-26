<?php

namespace App\Livewire\Front;

use App\Models\Category;
use App\Models\Product;
use App\Services\AddToCartService;
use App\Services\WishlistService;
use Livewire\Component;

class Home extends Component
{
    public $categories;
    public $featuredProducts;
    public $isWishlisted = [];

public function add_wishlists($productId) {
  try{

    $this->isWishlisted[$productId] = WishlistService::toggle($productId);
     $this->dispatch('wishlistUpdated');

  }
  catch(\Exception $e) {
    $this->dispatch('alert',type:'error',title:'Error!',text:$e->getMessage());
  }
}


// Add to Cart
public function addToCart($productId) {
     try{
     AddToCartService::add($productId);
     $this->dispatch('alert',type:'success',title:'Success !',text:"Added successfully");

   }catch(\Exception $e) {
        $this->dispatch('alert',type:'error',title:'Error!',text:$e->getMessage());
   }


    $this->dispatch('cartUpdated');
}



    public function mount() {
      $category = Category::withCount('product')->orderBy('name','asc')->get();
      $this->categories = $category;

      $featured = Product::with(['category:id,name,slug','subCategory:id,name,slug','productImages:id,product_id,image_name'])->where('is_featured',true)->get();
      $this->featuredProducts = $featured;

       foreach($featured as $product) {
        $this->isWishlisted[$product->id] = WishlistService::checkWishlist($product->id);
       }

    }


    public function render()
    {
        return view('front.home')->layoutData(['metaTitle'=>'Home - ShopHub','metaDescription'=>'Home']);
    }
}
