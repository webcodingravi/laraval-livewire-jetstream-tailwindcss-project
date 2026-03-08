<?php

namespace App\Livewire\Components\User;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class ChangePassword extends Component
{
    public $isOpen = false;

    public $current_password;

    public $password;

    public $password_confirmation;

    public function openModal()
    {
        $this->isOpen = true;
    }

    public function closeModal()
    {
        $this->isOpen = false;
        $this->resetValidation();

        $this->reset([
            'current_password',
            'password',

        ]);
    }

    protected $rules = [
        'current_password' => 'required',
        'password' => 'required|min:8|confirmed|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*#?&]).{8,}$/',

    ];

    protected $messages = [
        'password.regex' => 'Password must be at least 8 characters and include one uppercase letter, one lowercase letter, one number, and one special character.',
    ];

    public function updatedCurrentPassword()
    {
        $this->validateOnly('current_password');

    }

    public function updatedPassword()
    {
        if ($this->password && $this->password_confirmation) {
            $this->validateOnly('password');
        }

    }

    public function updated($field)
    {
        $this->validateOnly($field);
    }

    public function updatePassword()
    {
        $this->validate();

        $user = Auth::user();

        if (! Hash::check($this->current_password, $user->password)) {

            session()->flash('error', 'Current password is incorrect');

            return;
        }

        $user->update([
            'password' => Hash::make($this->password),
        ]);


        session()->flash('success', 'Password changed successfully');

        $this->closeModal();
    }

    public function render()
    {
        return view('components.user.change-password');
    }
}
