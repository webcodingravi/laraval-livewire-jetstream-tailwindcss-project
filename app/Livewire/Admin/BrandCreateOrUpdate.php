<?php

namespace App\Livewire\Admin;

use App\Exports\BrandsExport;
use App\Models\Brand;
use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\WithPagination;
use Maatwebsite\Excel\Facades\Excel;

class BrandCreateOrUpdate extends Component
{
    use WithPagination;

    public $brand_name;
    public $slug;
    public $category_id;
    public $sub_category_id;
    public $status = 'active';
    public $brandId;
    public $isOpen = false;
    public $isEdit = false;
    public $search = '';
    public $filtterStatus = '';
    public $categories = [];
    public $subCategories =  [];
    public $showTrashed = false;

    public function openModal(){
         $this->isOpen = true;
    }

    public function closeModal() {
        $this->isOpen = false;
        $this->resetForm();
        $this->resetValidation();
    }

    protected function rules() {
        return [
            'brand_name' => 'required',
            'slug' => 'required|unique:brands,slug,'.$this->brandId,
            'category_id' => 'required',
            'sub_category_id' => 'required'

        ];
    }

    public function updatedBrandName($value) {
        $this->slug = Str::slug($value);
    }

    public function updatedSearch() {
        $this->resetPage();
    }

    public function updatedStatus() {
        $this->resetPage();
    }


    public function mount() {
        try{
        // get category
          $category = Category::orderBy('name','asc')->get();
          $this->categories = $category;

       // get SubCategory
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
         $data = $this->only(['brand_name','slug','category_id','sub_category_id','status']);

         Brand::create($data);

         $this->dispatch('alert',type:'success',title:'Error!',text:'Brand Successfully Created !');
        $this->resetForm();
       }
       catch(\Exception $e) {
        $this->dispatch('alert',type:'error',title:'Error!',text:$e->getMessage());
       }
    }

    public function edit($id) {
        try{
           $brand = Brand::findOrFail($id);
           $this->brand_name = $brand->brand_name;
           $this->slug = $brand->slug;
           $this->category_id = $brand->category_id;
           $this->sub_category_id = $brand->sub_category_id;
           $this->status = $brand->status;
           $this->brandId = $brand->id;
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
          $brand = Brand::findOrFail($this->brandId);
          $data = $this->only(['brand_name','slug','category_id','sub_category_id','status']);

          $brand->fill($data);

          if(!$brand->isDirty()) {
            $this->dispatch('alert',type:'error',title:'Error!',text:'You did not update anything.');
             return;
          }
           $brand->save();

           $this->dispatch('alert',type:'success',title:'Success!',text:'Brand Successfully Created');
           $this->resetForm();

        }

        catch(\Exception $e) {
            $this->dispatch('alert',type:'error',title:'Error!',text:$e->getMessage());
        }
    }

    public function delete($id) {
        try{
          $brand = Brand::findOrFail($id);
          $brand->delete();

          $this->dispatch('alert',type:'success',title:'Error!',text:'Brand move to trash');
        }
        catch(\Exception $e) {
            $this->dispatch('alert',type:'error',title:'Error!',text:$e->getMessage());
        }
    }

    public function restore($id) {
        try{
         Brand::onlyTrashed()->findOrFail($id)->restore();
         $this->dispatch('alert',type:'success',title:'Success!',text:'Category Succussfully Restore');
        }
        catch(\Exception $e) {
            $this->dispatch('alert',type:'error',title:'Error!',text:$e->getMessage());
        }
    }

    public function forceDelete($id) {
        try{
          Brand::onlyTrashed()->findOrFail($id)->forceDelete();
          $this->dispatch('alert',type:'success',title:'Success!',text:'Category Parmanently deleted');
        }
        catch(\Exception $e) {
            $this->dispatch('alert',type:'error',title:'Error!',text:$e->getMessage());
        }
    }

    public function export() {
        return Excel::download(new BrandsExport,'brands.xlsx');
    }

    public function resetForm() {
        $this->reset(['brand_name','slug','category_id','sub_category_id','status','brandId','isOpen','isEdit']);
    }


    public function render()
    {
        $brands = Brand::with(['category:id,name','SubCategory:id,name'])
        ->when($this->showTrashed,function($query) {
            $query->onlyTrashed();
        })
        ->when(!$this->showTrashed,function($query) {
            $query->withoutTrashed();
        })
        ->when(!empty($this->search),function($query) {
            $query->where('brand_name','like','%'.$this->search.'%');
        })
        ->when(!empty($this->filtterStatus),function($query){
            $query->where('status',$this->filtterStatus);
        })
        ->orderBy('id','desc')
        ->paginate(10);
        return view('admin.brand-create-or-update',compact('brands'))->layout('layouts.admin');
    }
}