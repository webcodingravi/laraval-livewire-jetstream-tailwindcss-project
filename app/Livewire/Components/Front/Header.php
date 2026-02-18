<?php

namespace App\Livewire\Components\Front;

use App\Models\Category;
use App\Models\SubCategory;
use Livewire\Component;

class Header extends Component
{


    public function render()
    {
        $categories = Category::with('subCategories')->orderBy('name','asc')->get();

        return view('components.front.header',compact('categories'));
    }
}
