<?php

namespace App\Livewire\Admin;

use App\Models\ContactUs;
use Livewire\Component;
use Livewire\WithPagination;

class ShowContact extends Component
{
    use WithPagination;

    public function render()
    {
        $contactUs = ContactUs::orderBy('id', 'desc')
            ->paginate(10);

        return view('admin.show-contact', compact('contactUs'))->layout('layouts.admin')->layoutData(['metaTitle' => 'Contact Us - ShopHub']);;
    }
}