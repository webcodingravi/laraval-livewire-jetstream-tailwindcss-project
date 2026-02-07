<?php

namespace App\Livewire\Components\Admin;

use Livewire\Component;

class Header extends Component
{
    public function render()
    {
        return view('components.admin.header')->layout('layouts.admin');
    }
}