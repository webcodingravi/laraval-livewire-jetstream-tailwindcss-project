<?php

namespace App\Services;

use App\Models\CartItem;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class AddToCartService
{
 public static function add($productId, $price = null, $old_price = null, $discount = null, $quantity = 1, $color = null, $product_size = null)

{
    $product = Product::findOrFail($productId);

      $selectedSize = null;
    $selectedColor = null;

    if ($product_size) {
        $selectedSize = $product->sizes()
            ->where('product_id', $product_size)
            ->first();
    }

        if ($color) {
        $selectedColor = $product->colors()
            ->where('product_id', $color)
            ->first();
    }


    $userId = Auth::id();

    CartItem::where('product_id',$productId,'user_id',$userId)
        ->create([
            'user_id' => $userId,
            'product_id' => $product->id,
            'title' => $product->title,
            'sku' => $product->sku,
            'old_price' => $old_price,
            'discount' => $discount,
            'price' => $price,
            'image' => $product->productImages->first()?->image_name,
            'quantity' => $quantity,
            'color' =>  $selectedColor?->name,
            'size' => $selectedSize?->product_size
        ]);
    }


    public static function count() {
        if(!Auth::check()) {
            return 0;
        }
        return CartItem::where('user_id',Auth::user()->id)->sum('quantity');


    }


}
