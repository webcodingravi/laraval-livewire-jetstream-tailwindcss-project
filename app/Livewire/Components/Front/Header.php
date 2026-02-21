<?php

namespace App\Livewire\Components\Front;

use App\Models\Category;
use App\Models\ProductWishlist;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Header extends Component
{
    protected $listeners = ['wishlistUpdated' => 'refreshWishlistCount'];

     public $wishlists  = 0;

   public function refreshWishlistCount() {
    if(Auth::check()) {
        $this->wishlists = ProductWishlist::where('user_id',Auth::user()->id)->count();
    }

   }

   public function mount()
{
    if (Auth::check()) {
        $this->wishlists = ProductWishlist::where('user_id', Auth::id())->count();
    }
}

    public function render()
    {
        $categories = Category::with('subCategories')->orderBy('name','asc')->get();


        return view('components.front.header',compact('categories'));
    }
}