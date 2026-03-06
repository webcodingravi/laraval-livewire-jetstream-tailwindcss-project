<?php

namespace App\Livewire\Admin;

use App\Models\HeroSlider;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class CreateOrUpdateHeroSlider extends Component
{
    use WithFileUploads,WithPagination;

    public $title;

    public $description;

    public $button_text;

    public $button_link;

    public $image;

    public $oldImage;

    public $status = 'active';

    public $search = '';

    public $showTrashed = false;

    public $filterStatus = '';

    public $isEdit = false;

    public $isOpen = false;

    public $sliderId = null;

    public function openModal()
    {
        $this->isOpen = true;
    }

    public function closeModal()
    {
        $this->isOpen = false;
        $this->resetForm();
        $this->resetValidation();
    }

    public function updatedFilterStatus()
    {
        $this->resetPage();
    }

    public function updatedSearch()
    {
        $this->resetPage();
    }

    protected function rules()
    {
        return [
            'title' => 'required|string',
            'image' => 'nullable|image',
        ];
    }

    public function save()
    {
        $this->validate();

        try {
            $imageName = $this->oldImage;
            if (! empty($this->image)) {
                if ($this->oldImage && Storage::disk('public')->exists('uploads/slider/'.$this->oldImage)) {
                    Storage::disk('public')->delete('uploads/slider/'.$this->oldImage);
                }

                $imgExt = $this->image->getClientOriginalExtension();
                $imageName = time().'.'.$imgExt;

                $this->image->storeAs('uploads/slider', $imageName, 'public');
            }

            HeroSlider::UpdateOrCreate(
                ['id' => $this->sliderId],
                [
                    'title' => $this->title,
                    'description' => $this->description,
                    'button_text' => $this->button_text,
                    'button_link' => $this->button_link,
                    'status' => $this->status,
                    'image' => $imageName,
                ]
            );

            if (! empty($this->sliderId)) {
                $this->dispatch('alert', type: 'success', title: 'Success!', text: 'Slider Successfully Updated');
            } else {
                $this->dispatch('alert', type: 'success', title: 'Success!', text: 'Slider Successfully Created');
            }

            $this->resetForm();

        } catch (\Exception $e) {
            $this->dispatch('alert', type: 'error', title: 'Error!', text: $e->getMessage());
        }

    }

    public function edit($id)
    {
        try {
            $slider = HeroSlider::findOrFail($id);
            $this->title = $slider->title;
            $this->description = $slider->description;
            $this->oldImage = $slider->image;
            $this->button_text = $slider->button_text;
            $this->button_link = $slider->button_link;
            $this->status = $slider->status;
            $this->sliderId = $slider->id;
            $this->isEdit = true;
            $this->isOpen = true;
        } catch (\Exception $e) {
            $this->dispatch('alert', type: 'error', title: 'Error!', text: $e->getMessage());
        }
    }

    public function delete($id)
    {
        try {
            HeroSlider::findOrFail($id)->delete();

            $this->dispatch('alert', type: 'success', title: 'Success!', text: 'Hero Slider move to trash');

        } catch (\Exception $e) {
            $this->dispatch('alert', type: 'error', title: 'Error!', text: $e->getMessage());
        }
    }

    public function restore($id)
    {
        try {
            HeroSlider::onlyTrashed()->findOrFail($id)->restore();

            $this->dispatch('alert', type: 'success', title: 'Success!', text: 'Hero Slider Successfully Restored');

        } catch (\Exception $e) {
            $this->dispatch('alert', type: 'error', title: 'Error!', text: $e->getMessage());
        }
    }

    public function forceDelete($id)
    {
        try {

            $slider = HeroSlider::onlyTrashed()->findOrFail($id);
            if (! empty($slider->image) && Storage::disk('public')->exists('uploads/slider/'.$slider->image)) {
                Storage::disk('public')->delete('uploads/slider/'.$slider->image);
            }

            $slider->forceDelete();

            $this->dispatch('alert', type: 'success', title: 'Success!', text: 'Hero Slider Permanently Deleted');

        } catch (\Exception $e) {
            $this->dispatch('alert', type: 'error', title: 'Error!', text: $e->getMessage());
        }
    }

    public function resetForm()
    {
        $this->reset(['title', 'description', 'button_text', 'button_link', 'oldImage', 'image', 'status', 'isEdit', 'isOpen', 'sliderId']);
    }

    public function render()
    {
        $sliders = HeroSlider::query()
            ->when($this->showTrashed, function ($query) {
                $query->onlyTrashed();
            })
            ->when(! $this->showTrashed, function ($query) {
                $query->withoutTrashed();
            })
            ->when(! empty($this->search), function ($query) {
                $query->where('title', 'like', '%'.$this->search.'%');
            })
            ->when($this->filterStatus, function ($query) {
                $query->where('status', $this->filterStatus);
            })
            ->orderBy('id', 'desc')->paginate(10);

        return view('admin.create-or-update-hero-slider', compact('sliders'))->layout('layouts.admin')->layoutData(['metaTitle' => 'Hero Slider - ShopHub']);
    }
}
