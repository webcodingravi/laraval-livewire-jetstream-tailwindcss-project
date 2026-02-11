<?php

namespace App\Livewire\Admin;

use App\Exports\SubCategoriesExport;
use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\WithPagination;
use Maatwebsite\Excel\Facades\Excel;

class SubCategoryCreateOrUpdate extends Component
{
    use WithPagination;

    public $name;
    public $slug;
    public $category_id;
    public $status = 'active';
    public $isOpen = false;
    public $SubCategoryId;
    public $showTrashed = false;
    public $isEdit = false;
    public $search = '';
    public $filtterStatus = '';
    public $categories = [];

    public function openModal() {
        $this->isOpen = true;
    }

    public function closeModal() {
        $this->isOpen = false;
        $this->resetForm();
        $this->resetValidation();
    }

    protected function rules() {
        return [
           'name' => 'required|string',
            'slug' => 'required|unique:sub_categories,slug,'.$this->SubCategoryId,
            'category_id' => 'required'

              ];
    }

    public function updatedName($value) {
        $this->slug = Str::slug($value);
    }

    public function updatedSearch() {
        $this->resetPage();
    }

    public function updatedStatus() {
        $this->resetPage();
    }


    // get Category
    public function mount() {
        try{
           $categories = Category::orderBy('name','asc')->get();

           $this->categories = $categories;
        }
        catch(\Exception $e) {
            $this->dispatch('alert',type:'error',title:'Error!',text:$e->getMessage());
        }
    }



    public function save() {
        $this->validate();
        try{
            $data = $this->only(['name','slug','category_id','status']);

            SubCategory::create($data);

            $this->dispatch('alert',type:'success',title:'Success!',text:'Sub Category Successfully Created !');
           $this->resetForm();
        }
        catch(\Exception $e) {
            $this->dispatch('alert',type:'error',title:'Error!',text:$e->getMessage());
        }
    }

    public function edit($id) {
        try{
          $SubCategory = SubCategory::findOrFail($id);
          $this->name = $SubCategory->name;
          $this->slug = $SubCategory->slug;
          $this->category_id = $SubCategory->category_id;
          $this->SubCategoryId = $SubCategory->id;
          $this->status = $SubCategory->status;
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
            $SubCategory = SubCategory::findOrFail($this->SubCategoryId);
            $data = $this->only(['name','slug','category_id','status']);

            $SubCategory->fill($data);

            if (!$SubCategory->isDirty()) {
            $this->dispatch(
                'alert',
                type: 'error',
                title: 'No Changes!',
                text: 'You did not update anything.'
            );
            return;
        }

          $SubCategory->save();

            $this->dispatch('alert',type:'success',title:'Success!',text:'Sub Category Successfully Updated');

            $this->resetForm();
        }
        catch(\Exception $e) {
            $this->dispatch('alert',type:'error',title:'Error!',text:$e->getMessage());
        }
    }

    public function delete($id) {
        try{
             $SubCategory = SubCategory::findOrFail($id);
             $SubCategory->delete();

             $this->dispatch('alert',type:'success',title:'Success!',text:"Sub Category move to trash");
        }
        catch(\Exception $e) {
            $this->dispatch('alert',type:'error',title:'Error!',text:$e->getMessage());
        }
    }


    public function restore($id) {
        try{
          SubCategory::onlyTrashed()->findOrFail($id)->restore();

          $this->dispatch('alert',type:'success',title:'Success!',text:"Sub Category Restore Successfully");
        }
        catch(\Exception $e) {
            $this->dispatch('alert',type:'error',title:'Error!',text:$e->getMessage());
        }
    }

    public function forceDelete($id) {
       try{
         SubCategory::onlyTrashed()->findOrFail($id)->forceDelete();

         $this->dispatch('alert',type:'success',title:'Success!',text:'Sub Category Permanently Deleted');
       }
       catch(\Exception $e) {
        $this->dispatch('alert',type:'error',title:'Error!',text:$e->getMessage());
       }
    }

  public function resetForm() {
    $this->reset(['name','slug','category_id','status','SubCategoryId','isOpen','isEdit']);
  }


  public function export() {
    return Excel::download(new SubCategoriesExport,'SubCategories.xlsx');
  }


    public function render()
    {
        $SubCategories = SubCategory::with('category:id,name')
        ->when($this->showTrashed,function($query){
            $query->onlyTrashed();
        } )
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

        return view('admin.sub-category-create-or-update',compact('SubCategories'))->layout('layouts.admin');
    }
}