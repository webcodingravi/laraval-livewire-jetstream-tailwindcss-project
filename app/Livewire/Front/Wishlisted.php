<?php

namespace App\Livewire\Front;

use App\Models\Product;
use App\Models\ProductWishlist;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Wishlisted extends Component
{

public $wishlists = [];
public $isWishlisted = false;



public function add_wishlists($productId) {
  try{

    if (!Auth::check()) return;

      $user_id = Auth::user()->id;
     $wishlist = ProductWishlist::where('user_id',$user_id)->where('product_id',$productId)->first();
     if($wishlist) {
        $wishlist->delete();
        $this->isWishlisted = false;
     }else{
        ProductWishlist::create([
            'user_id' => $user_id,
            'product_id' => $productId
        ]);

         $this->isWishlisted = true;
     }

     $this->loadWishlist();

     $this->dispatch('wishlistUpdated');

  }
  catch(\Exception $e) {
    $this->dispatch('alert',type:'error',title:'Error!',text:$e->getMessage());
  }
}


public function loadWishlist() {
    $this->wishlists = ProductWishlist::with('product')->where('user_id',Auth::user()->id)->get();
}



public function mount() {
    $this->loadWishlist();
    $product = Product::first();
    if(Auth::check()) {
        $this->isWishlisted = ProductWishlist::where('user_id',Auth::id())->where('product_id',$product->id)->exists();
    }

}

    public function render()
    {
        return view('front.wishlisted');
    }
}