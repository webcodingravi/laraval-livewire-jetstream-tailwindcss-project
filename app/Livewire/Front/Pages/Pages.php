<?php

namespace App\Livewire\Front\Pages;

use App\Models\Page;
use Livewire\Component;

class Pages extends Component
{
    public $slug;

    public $page;

    public $metaTitle;

    public $metaDescription;

    public function mount($slug)
    {
        $this->slug = $slug;
        $this->page = Page::where('slug', $slug)->firstOrFail();
        $this->metaTitle = $this->page->meta_title;
        $this->metaDescription = $this->page->meta_description;
    }

    public function submitForm()
    {
        try {

            session()->flash('success', 'Contact Successfully Submited');
        } catch (\Exception $e) {
            session()->flash('error', $e->getMessage());
        }
    }

    public function render()
    {
        return view('front.pages.pages')->layoutData(['metaTitle' => $this->metaTitle, 'metaDescription' => $this->metaDescription]);
    }
}
