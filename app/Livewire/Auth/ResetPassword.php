<?php

namespace App\Livewire\Auth;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Livewire\Component;

class ResetPassword extends Component
{
    public $token;

    public $email;

    public $password;

    public $password_confirmation;

    protected $rules = [
        'email' => 'required|email',
        'password' => 'required|min:8|confirmed|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*#?&]).{8,}$/',
        'password_confirmation' => 'required',
    ];

    protected $messages = [
        'password.regex' => 'Password must be at least 8 characters and include one uppercase letter, one lowercase letter, one number, and one special character.',
    ];

    public function updatedPassword()
    {
        if ($this->password && $this->password_confirmation) {
            $this->validateOnly('password');
        }

    }

    public function updatedPasswordConfirmation()
    {
        if ($this->password && $this->password_confirmation) {
            $this->validateOnly('password');
        }
    }

    public function updatedEmail()
    {
        $this->validateOnly('email');
    }

    public function mount($token)
    {
        $this->token = $token;
        $this->email = request()->email;
    }

    public function resetPassword()
    {
        $this->validate();

        try {
            $status = Password::reset(
                [
                    'email' => $this->email,
                    'password' => $this->password,
                    'password_confirmation' => $this->password_confirmation,
                    'token' => $this->token,
                ],
                function (User $user) {
                    $user->password = Hash::make($this->password);
                    $user->save();
                }
            );
            if ($status == Password::PASSWORD_RESET) {
                session()->flash('success', 'password Successfully reset');

                return redirect()->route('login');
            } else {
                session()->flash('error', 'Reset failed');
            }

        } catch (\Exception $e) {
            session()->flash('error', $e->getMessage());
        }

    }

    public function render()
    {
        return view('auth.reset-password')->layout('layouts.guest')->layoutData(['metaTitle' => 'Reset Password - ShopHub']);
    }
}
