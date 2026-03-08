<?php

namespace App\Livewire\Components\User;

use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class CustomerOrders extends Component
{
    use WithPagination;

    public $singleOrder;

    public $isOpen = false;

    public function closeModal()
    {
        $this->isOpen = false;
    }

    public function mount()
    {
        if (! Auth::check()) {
            abort(403);
        }

    }

    public function view($id)
    {

        try {
            $this->singleOrder = Order::with(['orderItems.product.productImages'])->findOrFail($id);
            $this->isOpen = true;
        } catch (\Exception $e) {
            $this->dispatch('alert', type: 'error', title: 'Error!', text: $e->getMessage());
        }
    }

    public function render()
    {
        $orders = Order::where('user_id', Auth::id())
            ->latest()
            ->take(3)
            ->paginate(10);

        return view('components.user.customer-orders', compact('orders'));
    }
}
