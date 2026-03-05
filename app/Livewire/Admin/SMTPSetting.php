<?php

namespace App\Livewire\Admin;

use App\Models\SmtpSetting as ModelsSmtpSetting;
use Livewire\Component;

class SMTPSetting extends Component
{
    public $website_name;

    public $mail_mailer;

    public $mail_host;

    public $mail_port;

    public $mail_username;

    public $mail_encryption;

    public $mail_password;

    public $mail_from_address;

    public function mount()
    {
        try {

            $smt = ModelsSmtpSetting::first();
            if ($smt) {
                $this->website_name = $smt->website_name;
                $this->mail_mailer = $smt->mail_mailer;
                $this->mail_host = $smt->mail_host;
                $this->mail_port = $smt->mail_port;
                $this->mail_encryption = $smt->mail_encryption;
                $this->mail_username = $smt->mail_username;
                $this->mail_password = $smt->mail_password;
                $this->mail_from_address = $smt->mail_from_address;
            }

        } catch (\Exception $e) {
            $this->dispatch('alert', type: 'error', title: 'Error!', text: $e->getMessage());
        }
    }

    public function smtpSetting()
    {
        $this->validate([
            'website_name' => 'required',
            'mail_port' => 'nullable|numeric',
        ]);

        try {
            ModelsSmtpSetting::updateOrCreate(
                ['id' => 1],
                [
                    'website_name' => $this->website_name,
                    'mail_mailer' => $this->mail_mailer,
                    'mail_host' => $this->mail_host,
                    'mail_port' => $this->mail_port,
                    'mail_encryption' => $this->mail_encryption,
                    'mail_username' => $this->mail_username,
                    'mail_password' => $this->mail_password,
                    'mail_from_address' => $this->mail_from_address,

                ]);

            $this->dispatch('alert', type: 'success', title: 'Success!', text: 'SMTP Successfully Updated');

        } catch (\Exception $e) {
            $this->dispatch('alert', type: 'error', title: 'Error!', text: $e->getMessage());
        }
    }

    public function render()
    {
        return view('admin.s-m-t-p-setting')->layout('layouts.admin')->layoutData(['metaTitle' => 'SMTP Setting - ShopHub']);
    }
}
