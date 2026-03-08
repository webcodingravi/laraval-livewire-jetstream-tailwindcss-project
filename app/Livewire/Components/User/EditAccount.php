<?php

namespace App\Livewire\Components\User;

use App\Models\User;
use App\Models\UserAddress;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

class EditAccount extends Component
{
    use WithFileUploads;

    public $isOpen = false;

    public $profile_photo;

    public $currentProfilePhoto;

    public $first_name = '';

    public $last_name = '';

    public $email = '';

    public $phone_number = '';

    public $address = '';

    public $city = '';

    public $state = '';

    public $zip_code = '';

    public $country = 'india';

    public $shipping_address = '';

    public $shipping_address_id;

    public $billing_address = '';

    public $type = 'shipping';

    public $addresses = [];

    public $billing_same_as_shipping = true;

    public function openModal()
    {
        $this->isOpen = true;
    }

    public function closeModal()
    {
        $this->isOpen = false;
    }

    public function rules()
    {
        return [
            'profile_photo' => 'nullable|image|max:2048',
        ];
    }

    public function updatedProfilePhoto()
    {

        $this->validateOnly('profile_photo');

        try {

            $user = User::findOrFail(Auth::id());

            //   old image delete
            if (! empty($user->profile_photo_path)) {
                Storage::disk('public')->delete($user->profile_photo_path);
            }

            $path = $this->profile_photo->store('profile-photos', 'public');

            $user->update(['profile_photo_path' => $path]);
            $this->currentProfilePhoto = $path;
            $this->dispatch('alert', type: 'success', title: 'Updated!', text: 'Profile photo updated successfully.');
            $this->reset('profile_photo');

        } catch (\Exception $e) {
            $this->dispatch('alert', type: 'error', title: 'Error!', text: $e->getMessage());
        }

    }

    public function mount()
    {
        if (! Auth::check()) {
            abort(404);
        }

        $this->first_name = Auth::user()->first_name;
        $this->last_name = Auth::user()->last_name;
        $this->phone_number = Auth::user()->phone_number;
        $this->email = Auth::user()->email;
        $this->currentProfilePhoto = Auth::user()->profile_photo_path;
        $this->addresses = UserAddress::where('user_id', Auth::id())->get();

        $this->getAddress();

    }

    public function getAddress()
    {
        $userId = Auth::id();
        // Default shipping address
        $shippingAddress = UserAddress::where('user_id', $userId)
            ->where('is_default', 1)
            ->where('type', 'shipping') // agar type column hai
            ->first();

        if ($shippingAddress) {
            $this->shipping_address = $shippingAddress->address;
            $this->city = $shippingAddress->city;
            $this->state = $shippingAddress->state;
            $this->zip_code = $shippingAddress->zip_code;
            $this->country = $shippingAddress->country;
        }

        // Billing address
        $billingAddress = UserAddress::where('user_id', $userId)
            ->where('type', 'billing')
            ->first();

        // Fallback to shipping address if billing not set
        $this->billing_address = $billingAddress ? $billingAddress->address : $this->shipping_address;
    }

    public function saveChanges()
    {
        try {
            $user = Auth::user();
            $user->update([
                'first_name' => $this->first_name,
                'last_name' => $this->last_name,
                'email' => $this->email,
                'phone_number' => $this->phone_number,
            ]);

            UserAddress::updateOrCreate(
                ['user_id' => $user->id, 'type' => 'shipping'],
                [
                    'address' => $this->shipping_address,
                    'city' => $this->city,
                    'state' => $this->state,
                    'zip_code' => $this->zip_code,
                    'country' => $this->country,
                    'is_default' => 1,
                ]
            );

            UserAddress::updateOrCreate(
                ['user_id' => $user->id, 'type' => 'billing'],
                ['address' => $this->billing_address]
            );

      
            $this->dispatch('alert', type: 'success', title: 'Success', text: 'Account Successfully Updated');
            $this->closeModal();
        } catch (\Exception $e) {
            $this->dispatch('alert', type: 'error', title: 'Error', text: $e->getMessage());
        }

    }

    public function render()
    {
        return view('components.user.edit-account');
    }
}
