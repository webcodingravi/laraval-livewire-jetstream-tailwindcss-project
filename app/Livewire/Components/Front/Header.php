<?php

namespace App\Livewire\Components\Front;

use App\Models\Category;
use App\Services\AddToCartService;
use App\Services\WishlistService;
use Livewire\Component;

class Header extends Component
{
    protected $listeners = [
    'wishlistUpdated' => 'refreshWishlistCount',
    'cartUpdated'     => 'refreshCart',
];

     public $wishlists  = 0;
     public $cart = 0;

     public function refreshCart() {
        $this->cart = AddToCartService::Count();
     }



   public function refreshWishlistCount() {

     $this->wishlists = WishlistService::Count();

   }

   public function mount()
{
    $this->refreshWishlistCount();
    $this->refreshCart();
}

    public function render()
    {
        $categories = Category::with('subCategories')->orderBy('name','asc')->get();


        return view('components.front.header',compact('categories'));
    }
}
