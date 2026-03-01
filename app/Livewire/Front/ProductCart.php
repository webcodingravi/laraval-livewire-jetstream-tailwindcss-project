<?php

namespace App\Livewire\Front;

use Livewire\Component;
use App\Models\CartItem;
use App\Models\DiscountCode;
use App\Models\ShippingMethod;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class ProductCart extends Component
{
    public $cartItems = [];
    public $subtotal = 0;
    public $shipping = 0;
    public $total = 0;
    public $shippingMethods = [];
    public $selectedShipping = null;



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

        // Load all active shipping methods
        $this->shippingMethods = ShippingMethod::where('status', 1)->get();

        // Auto select shipping
        $this->autoSelectShipping();
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


/**
 * Automatically select shipping based on subtotal
 */
public function autoSelectShipping()
{
    // Try to find free shipping eligible
    $freeShipping = $this->shippingMethods
        ->where('price', 0)
        ->where('min_order_amount', '<=', $this->subtotal)
        ->first();

    if ($freeShipping) {
        $this->selectedShipping = $freeShipping->id;
        $this->shipping = 0;
    } else {
        // Default to first available shipping method
        $default = $this->shippingMethods->first();
        if ($default) {
            $this->selectedShipping = $default->id;
            $this->shipping = $default->price;
        } else {
            $this->shipping = 0;
        }
    }
}




/**
 * Update totals when cart changes or shipping selection changes
 */
public function updateTotals()
{
    $this->subtotal = collect($this->cartItems)
        ->sum(fn($item) => $item['price'] * $item['quantity']);

    if(count($this->cartItems) === 0){
        $this->shipping = 0;
    } elseif ($this->selectedShipping) {
        $method = ShippingMethod::find($this->selectedShipping);
        if ($method) {
            $this->shipping = ($method->min_order_amount && $this->subtotal >= $method->min_order_amount)
                ? 0
                : $method->price;
        } else {
            $this->shipping = 0;
        }
    } else {
        $this->shipping = 0;
    }

    $this->total = round($this->subtotal + $this->shipping, 2);
}

/**
 * When user selects a different shipping method
 */
public function updatedSelectedShipping($value)
{
    $this->updateTotals();
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