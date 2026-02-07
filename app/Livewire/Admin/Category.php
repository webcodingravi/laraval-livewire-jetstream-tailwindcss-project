<?php

namespace App\Livewire\Admin;

use App\Models\Category as CategoryModel;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\WithFileUploads;

class Category extends Component
{
    use WithFileUploads;


    public $name;
    public $slug;
    public $image;
    public $status = 'active';
    public $isOpen = false;
    public $categoryId;
    public $oldImage;
    public $isEdit = false;



    public function openModal() {
        $this->isOpen = true;
    }
    public function closeModal() {
        $this->isOpen = false;
    }

    protected function rules() {
        return [
            'name'=> 'required|string',
            'slug'=> 'required|unique:categories,slug,'.$this->categoryId,
            'image' => 'nullable|mimes:jpg,jpeg,png',
        ];
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
        session()->flash('error',$e->getMessage());
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
          session()->flash('error',$e->getMessage());
        }
    }

    public function resetForm() {
        $this->reset(['name','slug','image','oldImage','status','isOpen','isEdit']);
    }

    public function render()
    {
        $categories = CategoryModel::orderBy('id','desc')->paginate(10);
        return view('admin.category',compact('categories'))->layout('layouts.admin');
    }
}