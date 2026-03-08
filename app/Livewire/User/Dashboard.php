<?php

namespace App\Livewire\User;

use App\Models\Order;
use App\Models\Product;
use App\Models\ProductWishlist;
use App\Services\AddToCartService;
use App\Services\WishlistService;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Dashboard extends Component
{
    public $user;

    public $allOrders;

    public $wishlistCount;

    public $totalOrdersCount;

    public $pendingOrderCount;

    public $totalSpent;

    public $isOpen = false;

    public $wishlists = [];

    public $isWishlisted = [];

    public function openModal()
    {
        $this->isOpen = true;
    }

    public function closeModal()
    {
        $this->isOpen = false;
    }

    public function mount()
    {
        $this->loadDashboardData();
    }

    public function loadDashboardData()
    {
        // These are example calculations - adjust based on your actual models

        $this->totalOrdersCount = Order::where('user_id', Auth::id())->count();
        $this->pendingOrderCount = Order::where('user_id', Auth::id())->where('status', 'pending')->count();
        $this->totalSpent = Order::where('user_id', Auth::id())->where('status', 'completed')->sum('total');
        $this->wishlistCount = ProductWishlist::where('user_id', Auth::id())->count();

        $this->allOrders = Order::with('orderItems.product.productImages')
            ->where('user_id', Auth::id())
            ->get();

        $this->loadWishlist();
        foreach (Product::all() as $product) {
            $this->isWishlisted[$product->id] = WishlistService::checkWishlist($product->id);
        }

    }

    // Add Wishlists
    public function add_wishlists($productId)
    {
        try {

            $this->isWishlisted[$productId] = WishlistService::toggle($productId);

            $this->loadWishlist();

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
            $this->dispatch('alert', type: 'success', title: 'Success!', text: 'Added Successfully');
        } catch (\Exception $e) {
            $this->dispatch('alert', type: 'error', title: 'Error!', text: $e->getMessage());
        }

        $this->dispatch('cartUpdated');

    }

    public function loadWishlist()
    {
        if (! auth()->check()) {
            return;
        }
        $this->wishlists = ProductWishlist::with('product')->where('user_id', auth()->id())->take(4)->get();

    }

    public function render()
    {
        return view('user.dashboard')->layoutData(['metaTitle' => 'Dashboard - ShopHub', 'metaDescription' => 'Dasbhoard']);
    }
}
