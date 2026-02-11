<?php

namespace App\Livewire\Admin;

use App\Exports\ColorsExport;
use App\Models\Category;
use App\Models\Color;
use App\Models\SubCategory;
use Livewire\Component;
use Livewire\WithPagination;
use Maatwebsite\Excel\Facades\Excel;

class ColorCreateOrUpdate extends Component
{
    use WithPagination;

    public $name;
    public $code = '#000000';
    public $category_id;
    public $sub_category_id;
    public $status = 'active';
    public $isOpen = false;
    public $isEdit = false;
    public $colorId = null;
    public $filtterStatus = '';
    public $search = '';
    public $showTrashed = false;
    public $categories = [];
    public $subCategories = [];

    public function openModal() {
        $this->isOpen = true;
    }

    public function closeModal() {
       $this->isOpen= true;
       $this->resetForm();
       $this->resetValidation();
    }

    protected function rules() {
        return [
            'name' => 'required|string',
            'category_id' => 'required',
            'sub_category_id' => 'required'
        ];

    }

    public function updatedSearch() {
        $this->resetPage();
    }

    public function updatedStatus() {
        $this->resetPage();
    }

    public function mount() {
        try{
  //    get category
    $categories = Category::orderBy('name','asc')->get();
    $this->categories = $categories;

    // get sub category
     $subCategories = SubCategory::orderBy('name','asc')->get();
    $this->subCategories= $subCategories;
        }
        catch(\Exception $e) {
 $this->dispatch('alert',type:'error',title:'Error!',text:$e->getMessage());
        }
    }

    public function save() {
         $this->validate();
       try{

         $data = $this->only(['name','code','category_id','sub_category_id','status']);

         Color::create($data);

         $this->dispatch('alert',type:'success',title:'Success!',text:'Color Successfully Created');
         $this->resetForm();

       }
       catch(\Exception $e) {
        $this->dispatch('alert',type:'error',title:'Error!',text:$e->getMessage());
       }
    }

    public function edit($id) {
      try{
         $color = Color::findOrFail($id);
          $this->name = $color->name;
          $this->code = $color->code;
          $this->category_id = $color->category_id;
          $this->sub_category_id = $color->sub_category_id;
          $this->status = $color->status;
          $this->colorId = $color->id;
          $this->isOpen = true;
          $this->isEdit = true;
      }
      catch(\Exception $e) {
        $this->dispatch('alert',type:'error',title:'Error!',text:$e->getMessage());
      }
    }

    public function update() {
        $this->validate();
      try{
       $color = Color::findOrFail($this->colorId);
       $data = $this->only(['name','code','category_id','sub_category_id','status']);
       $color->fill($data);
       if(!$color->isDirty()) {
         $this->dispatch('alert',type:'error',title:'Error!',text:'You did not update anything');
         return;
       }
        $color->save();
        $this->dispatch('success',type:'success',title:'Success!',text:'Color Successfully Updated');
        $this->resetForm();
      }
      catch(\Exception $e) {
        $this->dispatch('alert',type:'error',title:'Error!',text:$e->getMessage());
      }
    }

    public function delete($id) {
        try{
         $color= Color::findOrFail($id);
         $color->delete();
         $this->dispatch('alert',type:'success',title:'Success!',text:'Color move to trash');
        }
        catch(\Exception $e) {
        $this->dispatch('alert',type:'error',title:'Error!',text:$e->getMessage());
        }
    }

    public function restore($id) {
     try{
        Color::onlyTrashed()->findOrFail($id)->restore();

        $this->dispatch('alert',type:'success',title:'Success!',text:'Color Restored Successfully');

     }
     catch(\Exception $e) {
        $this->dispatch('alert',type:'error',title:'Error!',text:$e->getMessage());
     }
    }

    public function forceDelete($id) {
          try{
          Color::onlyTrashed()->findOrFail($id)->forceDelete();
          $this->dispatch('alert',type:'success',title:'Success!',text:'Color Permanently Deleted');
          }
          catch(\Exception $e) {
        $this->dispatch('alert',type:'error',title:'Error!',text:$e->getMessage());
          }
    }

    public function resetForm() {
        $this->reset(['name','code','category_id','sub_category_id','status','isOpen','isEdit']);
    }


    public function export() {
        return Excel::download(new ColorsExport,'colors.xlsx');
    }


    public function render()
    {
        $colors = Color::with(['category:id,name','subCategory:id,name'])
        ->when($this->showTrashed,function($query) {
            $query->onlyTrashed();
        })

        ->when(!$this->showTrashed,function($query) {
            $query->withoutTrashed();
        })
        ->when(!empty($this->search),function($query) {
            $query->where('name','like','%'.$this->search.'%');
        })
        ->when(!empty($this->filtterStatus),function($query) {
            $query->where('status',$this->filtterStatus);
        })
        ->orderBy('id','desc')
        ->paginate(10);
        return view('admin.color-create-or-update',compact('colors'))
        ->layout('layouts.admin')
        ->layoutData(['metaTitle'=>'Product Color - Admin','metaDescription'=>'Manage Product Color']);
    }
}
