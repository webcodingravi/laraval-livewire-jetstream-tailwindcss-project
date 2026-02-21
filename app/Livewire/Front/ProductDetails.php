<?php

namespace App\Livewire\Front;

use App\Models\Product;
use App\Models\ProductWishlist;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class ProductDetails extends Component
{
    public $product;
    public $price;
    public $old_price;
    public $isWishlisted = false;
    public $product_size = null;
    public $relatedProducts = [];




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

     $this->dispatch('wishlistUpdated');

  }
  catch(\Exception $e) {
    $this->dispatch('alert',type:'error',title:'Error!',text:$e->getMessage());
  }
}

public function calculatePrice()
{
    $baseOldPrice = (float) $this->product->old_price;

    // size price add karo
    if ($this->product_size) {
        $size = $this->product->sizes->where('id', $this->product_size)->first();
        if ($size) {
            $baseOldPrice += (float) $size->product_price;
        }
    }

    $this->old_price = $baseOldPrice;

    // discount apply karo
    if ($this->product->discount) {
        $discountAmount = ($baseOldPrice * $this->product->discount) / 100;
        $this->price = $baseOldPrice - $discountAmount;
    } else {
        $this->price = $baseOldPrice;
    }
}

public function updatedProductSize()
{
    $this->calculatePrice();
}


    public function mount($slug) {
        $this->product = Product::with(['category:id,name,slug','subCategory:id,name,slug','productImages:id,image_name,product_id'])->where('slug',$slug)->firstOrFail();
        $this->old_price = $this->product->old_price;
        $this->price = $this->product->price;


   if ($this->product->sizes->count()) {
        $this->product_size = $this->product->sizes->first()->id;
    }

    $this->calculatePrice();



        // Related Products fetch
        $this->relatedProducts = Product::with(['category:id,name,slug','subCategory:id,name,slug','productImages:id,image_name,product_id'])
        ->where('slug', '!=', $this->product->slug)
        ->limit(3)
        ->orderBy('id','desc')
        ->get();


 if(Auth::check()) {
        $this->isWishlisted = ProductWishlist::where('user_id',Auth::id())->where('product_id',$this->product->id)->exists();
    }


    }
    public function render()
    {
        return view('front.product-details');
    }
}
