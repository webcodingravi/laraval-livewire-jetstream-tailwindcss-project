<?php

namespace App\Livewire\Components\Admin;

use Livewire\Component;

class Sidebar extends Component
{
    public $setting;

    public function mount($setting)
    {
        $this->setting = $setting;
    }

    public function render()
    {
        return view('components.admin.sidebar')->layout('layouts.admin');
    }
}
