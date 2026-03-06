<?php

namespace App\Livewire\Components\Front;

use App\Models\Category;
use App\Models\Product;
use App\Services\AddToCartService;
use App\Services\WishlistService;
use Livewire\Component;

class Header extends Component
{
    public $search = '';

    public $results = [];

    public function updatedSearch()
    {
        if (strlen($this->search) < 2) {
            $this->results = [];

            return;
        }

        $this->results = Product::with('productImages')->where('title', 'like', '%'.$this->search.'%')->take(6)->get();
    }

    protected $listeners = [
        'wishlistUpdated' => 'refreshWishlistCount',
        'cartUpdated' => 'refreshCart',
    ];

    public $wishlists = 0;

    public $cart = 0;

    public function refreshCart()
    {
        $this->cart = AddToCartService::Count();
    }

    public function refreshWishlistCount()
    {

        $this->wishlists = WishlistService::Count();

    }

    public function mount()
    {
        $this->refreshWishlistCount();
        $this->refreshCart();
    }

    public function render()
    {
        $categories = Category::with('subCategories')->orderBy('name', 'asc')->get();

        return view('components.front.header', compact('categories'));
    }
}
