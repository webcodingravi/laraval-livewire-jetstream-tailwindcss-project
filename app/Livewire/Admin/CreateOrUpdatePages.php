<?php

namespace App\Livewire\Admin;

use App\Models\Page;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class CreateOrUpdatePages extends Component
{
    use WithFileUploads, WithPagination;

    public $name;

    public $slug;

    public $title;

    public $image;

    public $oldImage;

    public $description;

    public $meta_title;

    public $meta_description;

    public $pageId = null;

    public $isEdit = false;

    public $isOpen = false;

    public function openModal()
    {
        $this->isOpen = true;


    }

    public function closeModal()
    {
        $this->isOpen = false;
        $this->resetValidation();
        $this->resetForm();

    }

    public function updatedName($value)
    {
        $this->slug = Str::slug($value);
    }

    protected function rules()
    {
        return [
            'name' => 'required|string',
            'slug' => 'required|string|unique:pages,slug,'.$this->pageId,
            'image' => 'nullable|image|mimes:jpg,png,jpeg',
        ];
    }

    public function edit($id)
    {
        try {
            $page = Page::findOrFail($id);
            $this->name = $page->name;
            $this->slug = $page->slug;
            $this->title = $page->title;
            $this->oldImage = $page->image;
            $this->description = $page->description;
            $this->meta_title = $page->meta_title;
            $this->meta_description = $page->meta_description;
            $this->pageId = $page->id;
            $this->isOpen = true;
            $this->isEdit = true;

        } catch (\Exception $e) {
            $this->dispatch('alert', type: 'error', title: 'Error!', text: $e->getMessage());
        }
    }

    public function save()
    {
        try {
            // Unique slug
            // -------------------
            $slug = Str::slug($this->slug ?? $this->name);
            $originalSlug = $slug;
            $count = 1;

            while (Page::where('slug', $slug)->when($this->pageId, fn ($q) => $q->where('id', '!=', $this->pageId))->exists()) {
                $slug = $originalSlug.'-'.$count;
                $count++;
            }

            $imageName = $this->oldImage;
            if (! empty($this->image)) {
                if ($this->oldImage && Storage::disk('public')->exists('uploads/pages/'.$this->oldImage)) {
                    Storage::disk('public')->delete('uploads/pages/'.$this->oldImage);
                }
                $imageExt = $this->image->getClientOriginalExtension();
                $imageName = Str::slug($this->name).'_'.time().'.'.$imageExt;
                $this->image->storeAs('uploads/pages', $imageName, 'public');
                $data['image'] = $imageName;
            }

            $page = Page::updateOrCreate(
                ['id' => $this->pageId],
                [
                    'name' => $this->name,
                    'slug' => $slug,
                    'title' => $this->title,
                    'description' => $this->description,
                    'meta_title' => $this->meta_title,
                    'meta_description' => $this->meta_description,
                    'image' => $imageName,
                ]
            );

            if (! empty($this->pageId)) {
                $this->dispatch('alert', type: 'success', title: 'Success!', text: "$page->name Page Successfully Updated");

            } else {
                $this->dispatch('alert', type: 'success', title: 'Success!', text: "$page->name Page Successfully Created");
            }

            $this->resetForm();

        } catch (\Exception $e) {
            $this->dispatch('alert', type: 'error', title: 'Error!', text: $e->getMessage());
        }
    }

    public function resetForm()
    {
        return $this->reset(['name', 'slug', 'title', 'description', 'meta_title', 'meta_description', 'image', 'oldImage', 'isEdit', 'isOpen', 'pageId']);
    }

    public function render()
    {
        $pages = Page::orderBy('id', 'desc')->paginate(10);

        return view('admin.create-or-update-pages', compact('pages'))->layout('layouts.admin')->layoutData(['metaTitle' => 'Pages - Admin']);
    }
}
