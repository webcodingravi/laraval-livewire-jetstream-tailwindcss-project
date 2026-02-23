<?php

namespace App\Services;

use App\Models\ProductWishlist;
use Illuminate\Support\Facades\Auth;

class WishlistService
{

 public static function toggle($productId) {
    if(!Auth::check()) {
        return false;
    }

    $userId = Auth::user()->id;
     $wishlist = ProductWishlist::where('user_id',$userId)->where('product_id',$productId)->first();
     if($wishlist) {
        $wishlist->delete();
        return false;
     }else{
        ProductWishlist::create([
            'user_id' => $userId,
            'product_id' => $productId
        ]);

        return true;
     }

  }

  public static function Count() {
    if(!Auth::check()) {
        return 0;
    }

   return ProductWishlist::where('user_id',Auth::user()->id)->count();
  }

  public static function checkWishlist($productId)
{
    if (!Auth::check()) return false;

   return ProductWishlist::where('user_id', Auth::user()->id)
        ->where('product_id', $productId)
        ->exists();
}
}