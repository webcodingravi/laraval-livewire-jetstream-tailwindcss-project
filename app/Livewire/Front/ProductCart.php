<?php

namespace App\Livewire\Front;

use Livewire\Component;
use App\Models\CartItem;
use Illuminate\Support\Facades\Auth;

class ProductCart extends Component
{
    public $cartItems = [];
    public $subtotal = 0;
    public $shipping = 0;
    public $discount = 0;
    public $total = 0;

    public function mount()
    {
        $this->loadCart();
    }

    public function loadCart()
    {
        if (!Auth::check()) {
            $this->cartItems = [];
            $this->updateTotals();
            return;
        }

        $this->cartItems = CartItem::where('user_id', Auth::id())->get()->toArray();
        $this->updateTotals();
    }

    public function updateQuantity($cartItemId, $quantity)
    {
        if ($quantity < 1) {
            $this->removeFromCart($cartItemId);
            return;
        }

        $cartItem = CartItem::find($cartItemId);
        if ($cartItem && $cartItem->user_id === Auth::id()) {
            $cartItem->update(['quantity' => $quantity]);
            $this->loadCart();
        }
    }

    public function removeFromCart($cartItemId)
    {
        $cartItem = CartItem::find($cartItemId);
        if ($cartItem && $cartItem->user_id === Auth::id()) {
            $cartItem->delete();
            $this->loadCart();
            $this->dispatch('cartUpdated', count: count($this->cartItems));
        }
    }

    public function clearCart()
    {
        if (Auth::check()) {
            CartItem::where('user_id', Auth::id())->delete();
            $this->loadCart();
            $this->dispatch('cartUpdated', count: 0);
        }
    }

    public function updateTotals()
    {
        $this->subtotal = collect($this->cartItems)
            ->sum(fn($item) => $item['price'] * $item['quantity']);

        $this->discount = collect($this->cartItems)
            ->sum(fn($item) => (($item['old_price'] - $item['price']) * $item['quantity']));

        $this->shipping = $this->subtotal > 50 ? 0 : 10;
        $this->total = round($this->subtotal  + $this->shipping - $this->discount, 2);
    }

    public function render()
    {
        return view('front.product-cart', [
            'cartItems' => $this->cartItems,
            'subtotal' => $this->subtotal,
            'shipping' => $this->shipping,
            'discount' => $this->discount,
            'total' => $this->total,
        ]);
    }
}