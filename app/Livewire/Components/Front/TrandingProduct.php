<?php

namespace App\Livewire\Components\Front;

use App\Models\Product;
use App\Services\AddToCartService;
use App\Services\WishlistService;
use Livewire\Component;

class TrandingProduct extends Component
{
    public $trandingProducts;

    public $isWishlisted = [];

    public function add_wishlists($productId)
    {
        try {

            $this->isWishlisted[$productId] = WishlistService::toggle($productId);
            $this->dispatch('wishlistUpdated');

        } catch (\Exception $e) {
            $this->dispatch('alert', type: 'error', title: 'Error!', text: $e->getMessage());
        }
    }

    // Add to Cart
    public function addToCart($productId)
    {
        try {
            AddToCartService::add($productId);
            $this->dispatch('alert', type: 'success', title: 'Success !', text: 'Added successfully');

        } catch (\Exception $e) {
            $this->dispatch('alert', type: 'error', title: 'Error!', text: $e->getMessage());
        }

        $this->dispatch('cartUpdated');
    }

    public function mount()
    {
        $this->loadTrandingProducts();
    }

    private function loadTrandingProducts()
    {
        $tranding = Product::with([
            'category:id,name,slug',
            'subCategory:id,name,slug',
            'productImages:id,product_id,image_name',
        ])
            ->where('status', 'active')
            ->take(6)
            ->orderBy('id', 'desc')
            ->get();

        $this->trandingProducts = $tranding;

        foreach ($tranding as $product) {
            $this->isWishlisted[$product->id] = WishlistService::checkWishlist($product->id);
        }
    }

    public function render()
    {
        return view('components.front.tranding-product');
    }
}
