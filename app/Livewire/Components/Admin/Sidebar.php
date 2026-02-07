<?php

namespace App\Livewire\Components\Admin;

use Livewire\Component;

class Sidebar extends Component
{
    public function render()
    {
        return view('components.admin.sidebar')->layout('layouts.admin');
    }
}