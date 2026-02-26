<?php

namespace App\Livewire\Front;

use Livewire\Component;
use App\Models\CartItem;
use App\Models\DiscountCode;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class ProductCart extends Component
{
    public $cartItems = [];
    public $subtotal = 0;
    public $shipping = 0;
    public $total = 0;



    public function processToCheckout()
{
    // Strong cart validation
    if (
        empty($this->cartItems) ||
        collect($this->cartItems)->sum('quantity') <= 0
    ) {
        session()->flash('error', 'Your cart is empty.');
        return; // Stop here
    }

    return redirect()->route('checkout');
}


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


    public function applyCoupon() {
         $this->validate([
        'PromoCode' => 'required|string'
    ]);
     try {
        $coupon = DiscountCode::where('name',$this->PromoCode)->whereDate('expiry_date', '>=',Carbon::today())->first();

        if(!$coupon) {
            session()->flash('error','Invalid or Expired coupon.');
            return;
        }

        $this->appliedCoupon = $coupon;
        $this->updateTotals();
        $this->PromoCode = '';

         } catch (\Exception $e) {
       session()->flash('error', 'Something went wrong: '.$e->getMessage());
    }

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

    // // Calculate subtotal
       $this->subtotal = collect($this->cartItems)
        ->sum(fn($item) => $item['price'] * $item['quantity']);

    // // Shipping
      $this->shipping = 0;

    // // Final total = subtotal + shipping - discount
    $this->total = round($this->subtotal + $this->shipping);

}

    public function render()
    {
        return view('front.product-cart', [
            'cartItems' => $this->cartItems,
            'subtotal' => $this->subtotal,
            'shipping' => $this->shipping,
            'total' => $this->total,
        ]);
    }
}
