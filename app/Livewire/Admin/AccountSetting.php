<?php

namespace App\Livewire\Admin;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

class AccountSetting extends Component
{
    use WithFileUploads;

    public $first_name;
    public $last_name;
    public $email;
    public $phone_code;
    public $phone_number;
    public $password;
    public $password_confirmation;
    public $bio;
    public $profile_photo;
    public $currentProfilePhoto;

    protected function rules() {
       return [
        'first_name' => 'required|string|max:255',
        'last_name' => 'nullable|string|max:255',
        'email' => 'required|email:dns|unique:users,email,'.Auth::id(),
        'password' => 'nullable|min:8|confirmed|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*#?&]).{8,}$/',
        'phone_code' => 'required|string|max:5',
        'phone_number' => 'required|digits:10|unique:users,phone_number,'.Auth::id(),
        'bio' => 'nullable|string|max:500',
        'profile_photo' => 'nullable|image|max:2048', // Max 2MB
    ];




     }

     protected $messages = [
    'password.regex' =>
        'Password must be at least 8 characters and include one uppercase letter, one lowercase letter, one number, and one special character.',
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



    public function updatedProfilePhoto()
    {

        try{
              $this->validateOnly('profile_photo');

             $user = User::findOrFail(Auth::id());

            //   old image delete
             if(!empty($user->profile_photo_path)) {
               Storage::disk('public')->delete($user->profile_photo_path);
             }

              $path = $this->profile_photo->store('profile-photos','public');

              $user->update(['profile_photo_path' => $path]);
              $this->currentProfilePhoto = $path;
             $this->dispatch('alert',type:'success',title:'Updated!',text:'Profile photo updated successfully.');
              $this->reset('profile_photo');



        }
        catch(\Exception $e){
            $this->dispatch('alert',type:'error',title:'Error!',text:$e->getMessage());
        }

    }


    public function updateProfile()
    {
        $this->validate();
        try{
            $user = User::findOrFail(Auth::id());

            $data = $this->only(['first_name','last_name','email','phone_code','phone_number','bio']);

            $fullname = $this->first_name.' '.$this->last_name;
            $data['fullname'] = $fullname;

             if($this->password){
                $data['password'] = Hash::make($this->password);
            }

            $user->fill($data);

          if ($this->password && Hash::check($this->password, $user->password)) {
                $this->dispatch('alert', type: 'info', title: 'No Changes!', text: 'New password must be different from old password.');
                return;
            }


            if(!$user->isDirty()){
                $this->dispatch('alert',type:'info',title:'No Changes!',text:'No changes detected to update.');
                return;
            }


            $user->update($data);



            $this->dispatch('alert',type:'success',title:'Updated!',text:'Profile updated successfully.');
            $this->reset('password','password_confirmation');



        }
        catch(\Exception $e){
            $this->dispatch('alert',type:'error',title:'Error!',text:$e->getMessage());
        }
    }




    public function mount()
    {
        try{
        $user = User::findOrFail(Auth::id());
        $this->first_name = $user->first;
        $this->last_name = $user->last;
        $this->email = $user->email;
        $this->phone_code = $user->phone_code ?? '+91';
        $this->phone_number = $user->phone_number;
        $this->bio = $user->bio;
        $this->currentProfilePhoto = Auth::user()->profile_photo_path;
        }
        catch(\Exception $e){
            $this->dispatch('alert',type:'error',title:'Error!',text:$e->getMessage());
        }

    }

    public function render()
    {
        return view('admin.account-setting')->layout('layouts.admin')->layoutData(['metaTitle'=>'Account Settings - Admin','metaDescription'=>'Manage Account']);;
    }
}