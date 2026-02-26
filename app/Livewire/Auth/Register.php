<?php

namespace App\Livewire\Auth;

use App\Models\User;
use DirectoryTree\Authorization\Role;
use Illuminate\Container\Attributes\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Register extends Component
{
    public $first_name;
    public $last_name;
    public $email;
    public $phone_code = '+91';
    public $phone_number;
    public $password;
    public $password_confirmation;

    protected $rules = [
        'first_name' => 'required|string|max:255',
        'last_name' => 'required|string|max:255',
        'email' => 'required|string|email:dns|unique:users,email',
        'phone_code' => 'required|string|max:5',
        'phone_number' => 'required|numeric|digits:10|unique:users,phone_number',
        'password' => 'required|min:8|confirmed|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*#?&]).{8,}$/',
        'password_confirmation' => 'required',
    ];

protected $messages = [
    'password.regex' =>
        'Password must be at least 8 characters and include one uppercase letter, one lowercase letter, one number, and one special character.',
];

public function updatedPassword() {
    if($this->password && $this->password_confirmation) {
       $this->validateOnly('password');
    }

}

public function updatedPasswordConfirmation() {
    if($this->password && $this->password_confirmation) {
        $this->validateOnly('password');
    }
}

public function updatedEmail() {
    $this->validateOnly('email');
}

public function updatedPhoneNumber() {
    $this->validateOnly('phone_number');
}


public function register() {
    $this->validate();
    DB::beginTransaction();
    try{
        $data = $this->only(['first_name','last_name','email','phone_code','phone_number','password']);
        $fullname = $this->first_name.' '.$this->last_name;
        $data['fullname'] = $fullname;
       $user = User::create($data);

    //assign default role to the user
    $userRole = Role::where('name','user')->firstOrFail();
    $user->roles()->save($userRole);




    DB::commit();
    session()->flash('success','Registration successfully You can now log in');

    return redirect()->route('login');

    $this->reset();
    }
    catch(\Exception $e) {
        DB::rollBack();
        $this->dispatch('alert',type:'error',title:'Error!',text:$e->getMessage());
    }
}

    public function render()
    {
        return view('auth.register')->layoutData(['metaTitle' => 'Signup - ShopHub','metaDescription'=>'Singup']);
    }
}
