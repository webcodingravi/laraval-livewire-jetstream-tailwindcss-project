<?php

namespace App\Livewire\Components\Front;

use App\Models\Category as CategoryModel;
use Livewire\Component;

class Category extends Component
{
    public $categories;

    public function mount()
    {
        $category = CategoryModel::where('status', 'active')->orderBy('name', 'asc')->get();
        $this->categories = $category;
    }

    public function render()
    {
        return view('components.front.category');
    }
}
