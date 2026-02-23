<?php

namespace App\Livewire\Front;

use App\Models\Product;
use App\Models\ProductWishlist;
use App\Services\WishlistService;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Wishlisted extends Component
{

public $wishlists = [];
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
    $this->loadWishlist();
    $product = Product::first();
    $this->isWishlisted = WishlistService::checkWishlist($product->id);


}

    public function render()
    {
        return view('front.wishlisted');
    }
}
