<?php

namespace App\Livewire\Auth;

use Livewire\Component;

class ForgotPassword extends Component
{
    public function render()
    {
        return view('auth.forgot-password')->layout('layouts.guest')->layoutData(['metaTitle' => 'Forgot Password - ShopHub']);
    }
}
