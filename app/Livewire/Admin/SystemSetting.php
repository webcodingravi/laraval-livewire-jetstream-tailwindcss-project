<?php

namespace App\Livewire\Admin;

use App\Models\SystemSetting as ModelsSystemSetting;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\WithFileUploads;

class SystemSetting extends Component
{
    use WithFileUploads;

    public $website_name;

    // logo
    public $logo;

    public $oldLogo;

    public $favicon;

    public $oldFavicon;

    public $address;

    public $phone_number;

    public $email;

    public $footer_description;

    public $facebook_link;

    public $twitter_link;

    public $instagram_link;

    public $youtube_link;

    public function mount()
    {
        $setting = ModelsSystemSetting::first();
        if ($setting) {
            $this->website_name = $setting->website_name;
            $this->email = $setting->email;
            $this->phone_number = $setting->phone_number;
            $this->address = $setting->address;
            $this->footer_description = $setting->footer_description;
            $this->facebook_link = $setting->facebook_link;
            $this->twitter_link = $setting->twitter_link;
            $this->instagram_link = $setting->instagram_link;
            $this->youtube_link = $setting->youtube_link;
            $this->oldLogo = $setting->logo;
            $this->oldFavicon = $setting->favicon;

        }
    }

    public function systemSetting()
    {
        $this->validate([
            'website_name' => 'required|string',
            'email' => 'nullable|email:dns|string',
            'phone_number' => 'nullable|numeric|digits:10',
            'logo' => 'nullable|mimes:jpg,jpeg,png,webp|max:2048',
            'favicon' => 'nullable|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        try {

            $logoName = $this->oldLogo;
            $faviconName = $this->oldFavicon;
            if (! empty($this->logo)) {
                if ($this->oldLogo && Storage::disk('public')->exists('uploads/settings/'.$this->oldLogo)) {
                    Storage::disk('public')->delete('uploads/settings/'.$this->oldLogo);
                }
                $logoExt = $this->logo->getClientOriginalExtension();
                $logoName = Str::slug($this->website_name).'_'.time().'.'.$logoExt;

                $this->logo->storeAs('uploads/settings', $logoName, 'public');
            }

            if (! empty($this->favicon)) {
                if ($this->oldFavicon && Storage::disk('public')->exists('uploads/settings/'.$this->oldFavicon)) {
                    Storage::disk('public')->delete('uploads/settings/'.$this->oldFavicon);
                }

                $faviconExt = $this->favicon->getClientOriginalExtension();
                $faviconName = time().'_'.'favicon'.'.'.$faviconExt;
                $this->favicon->storeAs('uploads/settings', $faviconName, 'public');
            }

            ModelsSystemSetting::updateOrCreate(
                ['id' => 1],
                [
                    'website_name' => $this->website_name,
                    'email' => $this->email,
                    'phone_number' => $this->phone_number,
                    'address' => $this->address,
                    'footer_description' => $this->footer_description,
                    'facebook_link' => $this->facebook_link,
                    'twitter_link' => $this->twitter_link,
                    'instagram_link' => $this->instagram_link,
                    'youtube_link' => $this->youtube_link,
                    'logo' => $logoName,
                    'favicon' => $faviconName,

                ]

            );

            $this->dispatch('alert', type: 'success', title: 'Success !', text: 'Setting Successfully Updated');

        } catch (\Exception $e) {
            $this->dispatch('alert', type: 'error', title: 'Error !', text: $e->getMessage());

        }

    }

    public function render()
    {
        return view('admin.system-setting')->layout('layouts.admin')->layoutData(['metaTitle' => 'System Setting - ShopHub']);
    }
}
