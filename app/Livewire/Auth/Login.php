<?php

namespace App\Livewire\Auth;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Login extends Component
{
    public $email;
    public $password;
    public $remember = false;

    protected $rules = [
         'email' => 'required|string|email:dns',
         'password' => 'required|string|min:8'
    ];

    public function mount(){
        if(auth()->check()) {
           return redirect()->intended(route('admin.dashboard'));
        }
    }

    public function login() {
        $this->validate();
        try{
            if(auth()->attempt($this->only('email','password'),$this->remember)) {

            session()->regenerate();

            return redirect()->intended(route('admin.dashboard'));


            }else{
               session()->flash('error','Invalid email or Password');
            }

        }
       catch(\Exception $e) {
        $this->dispatch('alert',type:'error',title:'Error!',text:$e->getMessage());
    }
    }
    public function render()
    {
        return view('auth.login')->layoutData(['metaTitle' => 'Sign-in - ShopHub','metaDescription'=>'SingIn']);
    }
}