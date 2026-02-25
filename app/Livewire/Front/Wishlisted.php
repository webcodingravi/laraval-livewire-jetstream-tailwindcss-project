<?php

namespace App\Livewire\Front;

use App\Models\Product;
use App\Models\ProductWishlist;
use App\Services\AddToCartService;
use App\Services\WishlistService;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Wishlisted extends Component
{

public $wishlists = [];
public $isWishlisted = [];



// Add Wishlists
public function add_wishlists($productId) {
  try{

    $this->isWishlisted[$productId] = WishlistService::toggle($productId);

      $this->loadWishlist();

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
   $this->dispatch('alert',type:'success',title:'Success!',text:'Added Successfully');
}
catch(\Exception $e) {
    $this->dispatch('alert',type:'error',title:'Error!',text:$e->getMessage());
}

$this->dispatch('cartUpdated');

}

public function mount() {
 $this->loadWishlist();
     foreach(Product::all() as $product) {
       $this->isWishlisted[$product->id] = WishlistService::checkWishlist($product->id);
     }

}

public function loadWishlist() {
if (!auth()->check()) return;
 $this->wishlists = ProductWishlist::with('product')->where('user_id',auth()->id())->get();

}

    public function render()
    {
        return view('front.wishlisted');
    }
}