<?php

namespace App\Livewire\Front;

use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class OrderConfirmed extends Component
{
    public $order;

    public function mount($orderId)
    {
        $this->order = Order::where('order_number', $orderId)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        if (! $this->order) {
            // Redirect if order not found or doesn't belong to user
            return redirect()->route('home')->with('error', 'Order not found.');
        }
    }

    public function render()
    {
        return view('front.order-confirmed')->layout('layouts.guest');
    }
}
