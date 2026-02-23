<?php

namespace App\Livewire\Front;

use App\Models\Product;
use App\Models\ProductWishlist;
use App\Services\AddToCartService;
use App\Services\WishlistService;
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
    public $productId;
    public $quantity = '1';
    public $color;
    public $discount;






public function increment()
{
    $this->quantity++;
}

public function decrement()
{
    if ($this->quantity > 1) {
        $this->quantity--;
    }
}



public function add_wishlists($productId) {
  try{

    $this->isWishlisted = WishlistService::toggle($productId);
     $this->dispatch('wishlistUpdated');

  }
  catch(\Exception $e) {
    $this->dispatch('alert',type:'error',title:'Error!',text:$e->getMessage());
  }
}





public function addToCart() {
    $this->validate([
        'color' => 'required',
        'product_size' => 'required'
    ]);

   try{
     AddToCartService::add($this->productId,$this->price,$this->old_price,$this->discount,$this->quantity,$this->color,$this->product_size);
     $this->dispatch('alert',type:'success',title:'Success !',text:"Added successfully");

   }catch(\Exception $e) {
        $this->dispatch('alert',type:'error',title:'Error!',text:$e->getMessage());
   }


    $this->dispatch('cartUpdated');
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
        $this->productId = $this->product->id;
        $this->discount = $this->product->discount;


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




        $this->isWishlisted = WishlistService::checkWishlist($this->product->id);



    }
    public function render()
    {
        return view('front.product-details');
    }
}
