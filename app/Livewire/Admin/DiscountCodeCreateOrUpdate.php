<?php

namespace App\Livewire\Admin;

use App\Models\DiscountCode;
use Livewire\Component;
use Livewire\WithPagination;

class DiscountCodeCreateOrUpdate extends Component
{
    use WithPagination;

    public $name;
    public $type = "amount";
    public $percent_amount;
    public $expiry_date;
    public $status = 'active';
    public $discountId = null;
    public $isOpen = false;
    public $isEdit = false;
    public $search = '';
    public $filterStatus = '';
    public $showTrashed = false;

    public function openModal() {
        $this->isOpen = true;
    }

    public function closeModal() {
        $this->isOpen = false;
        $this->resetValidation();
        $this->resetForm();
    }


    public function updatedFilterStatus() {
        $this->resetPage();
    }

    public function updatedSearch() {
        $this->resetPage();
    }

    protected function rules(){
        return [
            'name' => 'required|max:255',
            'type' => 'required',
            'percent_amount' => 'required|numeric',
            'expiry_date' => 'required|date|after_or_equal:today',
        ];
    }

    public function save() {
        $this->validate();
     try{
        $data = $this->only(['name','type','percent_amount','expiry_date','status']);
        DiscountCode::create($data);
        $this->dispatch('alert',type:'success',title:'Success!',text:'Discount Code Successfully Created!');

        $this->resetForm();
     }
     catch(\Exception $e) {
        $this->dispatch('alert',type:'error',title:'Error!',text:$e->getMessage());
     }
    }

    public function edit($id) {
        try{
         $discountCode = DiscountCode::findOrFail($id);
         $this->name = $discountCode->name;
         $this->type = $discountCode->type;
         $this->percent_amount = $discountCode->percent_amount;
         $this->expiry_date = $discountCode->expiry_date;
         $this->status = $discountCode->status;
         $this->discountId = $discountCode->id;
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
        $discountCode = DiscountCode::findOrFail($this->discountId);

        $data = $this->only(['name','type','percent_amount','expiry_date','status']);

        $discountCode->fill($data);
        if(!$discountCode->isDirty()) {
            $this->dispatch('alert',type:'info',title:'Not Updated!',text:'You did not update anything');
          return;
        }

        $discountCode->save();
     $this->dispatch('alert',type:'success',title:'Success!',text:'Discount Code Successfully Created!');
     $this->resetForm();

     }
     catch(\Exception $e) {
        $this->dispatch('alert',type:'error',title:'Error!',text:$e->getMessage());
     }
    }

    public function delete($id) {
     try{
       DiscountCode::findOrFail($id)->delete();
       $this->dispatch('alert',type:'success',title:'Success!',text:'Discount Code Move to trash');

     }
     catch(\Exception $e) {
        $this->dispatch('alert',type:'error',title:'Error!',text:$e->getMessage());
     }
    }

    public function restore($id) {
        try{
          DiscountCode::onlyTrashed()->findOrFail($id)->restore();
          $this->dispatch('alert',type:'success',title:'Success!',text:'Discount code Restored Successfully');
        }
        catch(\Exception $e) {
             $this->dispatch('alert',type:'error',title:'Error!',text:$e->getMessage());
        }

    }

  public function forceDelete($id) {
     try{
        DiscountCode::onlyTrashed()->findOrFail($id)->forceDelete();
        $this->dispatch('alert',type:'success',title:'Success!',text:'Discount Code Permanently Deleted');
     }
     catch(\Exception $e) {
        $this->dispatch('alert',type:'error',title:'Error!',text:$e->getMessage());
     }
  }


  public function resetForm() {
    $this->reset(['name','type','percent_amount','expiry_date','isEdit','isOpen','discountId']);
  }


    public function render()
    {
        $discountCodes = DiscountCode::query()
        ->when($this->showTrashed,function($query) {
            $query->onlyTrashed();
        })
        ->when(!$this->showTrashed,function($query) {
            $query->withoutTrashed();
        })
        ->when(!empty($this->search),function($query){
            $query->where('name','like','%'.$this->search.'%');
        })
          ->when(!empty($this->filterStatus),function ($query) {
            $query->where('status',$this->filterStatus);
        })

        ->orderBy('id','desc')
        ->paginate(10);


        return view('admin.discount-code-create-or-update',compact('discountCodes'))->layout('layouts.admin')->layoutData(['metaTitle'=>'Discount Code - Admin','metaDescription'=>'Manage Product Discount code']);
    }
}