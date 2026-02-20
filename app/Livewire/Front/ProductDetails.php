<?php

namespace App\Livewire\Front;

use App\Models\Product;
use Livewire\Component;

class ProductDetails extends Component
{
    public $product;
    public $price;
    public $old_price;
    public $product_size = null;
    public $relatedProducts = [];



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

    }
    public function render()
    {
        return view('front.product-details');
    }
}
