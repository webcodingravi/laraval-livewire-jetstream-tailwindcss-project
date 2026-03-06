<?php

namespace App\Livewire\Auth;

use Illuminate\Support\Facades\Password;
use Livewire\Component;

class ForgotPassword extends Component
{
    public $email;

    public function sendResetLink()
    {
        $this->validate([
            'email' => ['required', 'email'],
        ]);

        try {
            $status = Password::sendResetLink([
                'email' => $this->email,
            ]);

            if ($status === Password::RESET_LINK_SENT) {
                session()->flash('success', 'Password reset link sent to your email');
            } else {
                session()->flash('error', 'Unable to send reset link');
            }
        } catch (\Exception $e) {
            session()->flash('error', $e->getMessage());
        }
    }

    public function render()
    {
        return view('auth.forgot-password')->layout('layouts.guest')->layoutData(['metaTitle' => 'Forgot Password - ShopHub']);
    }
}
