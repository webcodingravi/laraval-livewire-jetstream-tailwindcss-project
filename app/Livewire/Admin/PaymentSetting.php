<?php

namespace App\Livewire\Admin;

use App\Models\PaymentSetting as ModelsPaymentSetting;
use Livewire\Component;

class PaymentSetting extends Component
{
    public $cod = false;

    public $stripe = false;

    public $stripe_public_key;

    public $stripe_secret_key;

    public function mount()
    {
        try {
            $payment = ModelsPaymentSetting::first();
            if ($payment) {
                $this->cod = (bool)$payment->cod;
                $this->stripe = (bool) $payment->stripe;
                $this->stripe_public_key = $payment->stripe_public_key;
                $this->stripe_secret_key = $payment->stripe_secret_key;
            }

        } catch (\Exception $e) {
            $this->dispatch('alert', type: 'error', title: 'Error!', text: $e->getMessage());
        }
    }

    public function paymentSetting()
    {
        try {
            ModelsPaymentSetting::updateOrCreate(
                ['id' => 1],
                [
                    'cod' => $this->cod,
                    'stripe' => $this->stripe,
                    'stripe_public_key' => $this->stripe_public_key,
                    'stripe_secret_key' => $this->stripe_secret_key,

                ]
            );
            $this->dispatch('alert', type: 'success', title: 'Success!', text: 'Payment Setting Successfully Updated');

        } catch (\Exception $e) {
            $this->dispatch('alert', type: 'error', title: 'Error!', text: $e->getMessage());
        }
    }

    public function render()
    {
        return view('admin.payment-setting')->layout('layouts.admin')->layoutData(['metaTitle' => 'Payment Setting - ShopHub']);
    }
}
