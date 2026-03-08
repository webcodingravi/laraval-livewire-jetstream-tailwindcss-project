<?php

namespace App\Livewire\Components\User;

use App\Models\UserAddress;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class MyAddress extends Component
{
    public $shipping;

    public $billing;

    public $isOpen = false;

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
        $addresses = UserAddress::where('user_id', Auth::id())->get();

        $shipping = $addresses->where('type', 'shipping')->first();
        $billing = $addresses->where('type', 'billing')->first();

        if($shipping) {
            $this->shipping = $shipping->address;
        }
        if($billing) {
            $this->billing = $billing->address;
        }
    }

    public function render()
    {
        return view('components.user.my-address');
    }
}
