<?php

namespace App\Livewire\Admin;

use App\Exports\CategoriesExport;
use App\Models\Category as CategoryModel;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;
use Maatwebsite\Excel\Facades\Excel;

class Category extends Component
{
    use WithFileUploads, WithPagination;


    public $name;
    public $slug;
    public $image;
    public $status = 'active';
    public $isOpen = false;
    public $categoryId;
    public $oldImage;
    public $isEdit = false;
    public $search = '';
    public $filtterStatus = '';
    public $showTrashed = false;



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
            'name'=> 'required|string',
            'slug'=> 'required|unique:categories,slug,'.$this->categoryId,
            'image' => 'nullable|mimes:jpg,jpeg,png',
        ];
    }

    public function updatedSearch() {
        $this->resetPage();
    }

    public function updatedStatus() {
        $this->resetPage();
    }

    public function updatedName($value) {
        $this->slug = Str::slug($value);
    }



    public function save() {
       $this->validate();
       try{
        $data = $this->only(['name','slug','status']);

         if(!empty($this->image)) {
        $ext = $this->image->getClientOriginalExtension();
        $imageName = time().'_'.$this->slug.'.'.$ext;
        $this->image->storeAs("uploads/category",$imageName,'public');
         $data['image'] = $imageName;
         }

        CategoryModel::create($data);

        $this->dispatch('alert',
               type:'success',
               title:'Success!',
               text: 'Category created Successfully'

        );
        $this->resetForm();

       }catch(\Exception $e) {
         $this->dispatch('alert',
               type:'error',
               title:'Error!',
               text: $e->getMessage()

        );
       }
    }

    public function edit($id) {
        try{
          $category = CategoryModel::findOrFail($id);
          $this->name = $category->name;
          $this->slug = $category->slug;
          $this->oldImage = $category->image;
          $this->status = $category->status;
          $this->categoryId = $category->id;
          $this->isEdit = true;
          $this->isOpen = true;


        }
        catch(\Exception $e) {
          $this->dispatch('alert',
                type:'error',
                title: 'Error !',
                text: $e->getMessage()
            );
        }
    }


    public function update() {
        $this->validate();

        try{
            $category = CategoryModel::findOrFail($this->categoryId);

            $data = $this->only(['name','slug','status']);

            if(!empty($this->image)) {
                if(!empty($this->oldImage)) {
                    Storage::disk('public')->delete('uploads/category/'.$this->oldImage);
                }

                $ext = $this->image->getClientOriginalExtension();
                $imageName = time().'_'.$this->slug.'.'.$ext;
                $this->image->storeAs("uploads/category",$imageName,"public");
                $data['image'] = $imageName;

            }

            $category->update($data);

             $this->dispatch('alert',
                 type:"success",
                 title:"Success!",
                 text: "Cateogry Updated Successfully"
             );
            $this->resetForm();

        }

        catch(\Exception $e) {
            $this->dispatch('alert',
                type:'error',
                title: 'Error !',
                text: $e->getMessage()
            );
        }
    }


    public function delete($id) {
        try{
           $category = CategoryModel::findOrFail($id);

           $category->delete();

           $this->dispatch('alert',
              type:'success',
              title: 'Success!',
              text: 'Category move to trash'
            );
        }
        catch(\Exception $e) {
           $this->dispatch('alert',
            type:'error',
            title: 'Error!',
            text: $e->getMessage()
           );
        }
    }


    public function restore($id) {
       try{
           CategoryModel::onlyTrashed()->findOrFail($id)->restore();
           $this->dispatch('alert',type:'success',title:'Success!',text:'Category Restored Successfully');
       }
       catch(\Exception $e) {
         $this->dispatch('alert',
           type:'error',
           title:'Success!',
           text: $e->getMessage()
         );
       }
    }

    public function forceDelete($id){
        try{
          $category = CategoryModel::onlyTrashed()->findOrFail($id);
          if(!empty($category->image)) {
            Storage::disk('public')->delete('uploads/category/'.$category->image);
          }

          $category->forceDelete();

          $this->dispatch('alert',type:'success',title:'Success!',text:'Category Permanently deleted');
        }
        catch(\Exception $e) {
           $this->dispatch('alert',type:'error',title:'Error!', text:$e->getMessage());
        }
    }

    public function resetForm() {
        $this->reset(['name','slug','image','oldImage','status','isOpen','isEdit']);
    }


    public function export() {
       return Excel::download(new CategoriesExport,'categories.xlsx');
    }


    public function render()
    {
        $categories = CategoryModel::query()
        ->when($this->showTrashed,function($query) {
            $query->onlyTrashed();
        })
        ->when(!$this->showTrashed,function($query) {
            $query->where('deleted_at',null);
        })
        ->when(!empty($this->search),function($query) {
          $query->where("name",'like','%'.$this->search.'%');
        })
        ->when(!empty($this->filtterStatus),function($query) {
            $query->where('status',$this->filtterStatus);
        })


        ->orderBy('id','desc')->paginate(10);
        return view('admin.category',compact('categories'))->layout('layouts.admin');
    }
}
