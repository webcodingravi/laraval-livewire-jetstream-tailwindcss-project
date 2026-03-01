<?php

namespace App\Livewire\Admin;

use App\Models\ShippingMethod;
use Livewire\Component;
use Livewire\WithPagination;

class ShippingCreateOrUpdate extends Component
{
   use WithPagination;

   public $name;
   public $price;
   public $delivery_time;
   public $description;
   public $min_order_amount;
   public $status = 'active';
   public $ShippingId = null;
   public $isEdit = false;
   public $isOpen = false;
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

   public function updatedSearch() {
    $this->resetPage();
   }

   public function updatedStatus() {

   }

   protected function rules() {
    return [
         'name'=> 'required|string|max:255',
         'price' => 'required|numeric',


    ];
   }

   public function save() {
     $this->validate();
     try{
        $data = $this->only(['name','price','delivery_time','description','min_order_amount','status']);

         ShippingMethod::create($data);

         $this->dispatch('alert',type:'success',title:'Success!',text:'Shipping Create Successfully!');
         $this->resetForm();
     }
     catch(\Exception $e) {
        $this->dispatch('alert',type:'error',title:'Error!',text:$e->getMessage());
     }
   }

   public function edit($id) {
    try{
       $shipping = ShippingMethod::findOrFail($id);
       $this->name = $shipping->name;
       $this->price = $shipping->price;
       $this->delivery_time = $shipping->delivery_time;
       $this->description = $shipping->description;
       $this->min_order_amount = $shipping->min_order_amount;
       $this->status = $shipping->status;
       $this->ShippingId = $shipping->id;
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
        $shipping = ShippingMethod::findOrFail($this->ShippingId);
        $data = $this->only(['name','price','delivery_time','description','min_order_amount','status']);

        $shipping->fill($data);
        if(!$shipping->isDirty()) {
          $this->dispatch('alert',type:'info',title:'No Change!', text:'You did not update anything.');
         return;
        }
        $shipping->save();

        $this->dispatch('alert',type:'success',title:'Success!', text:'Shipping Successfully Updated');
         $this->resetForm();

     }
     catch(\Exception $e) {
       $this->dispatch('alert',type:'error',title:'Error',text:$e->getMessage());
     }
   }

   public function delete($id) {
 try{
     ShippingMethod::findOrFail($id)->delete();
     $this->dispatch('alert',type:'success',title:'Success!',text:'Shipping move to trash');
     }
     catch(\Exception $e) {
       $this->dispatch('alert',type:'error',title:'Error',text:$e->getMessage());
     }
   }

   public function restore($id) {
 try{
      ShippingMethod::onlyTrashed()->findOrFail($id)->restore();
      $this->dispatch('alert',type:'success',title:'Success!',text:'Shipping Successfully Restored');
     }
     catch(\Exception $e) {
       $this->dispatch('alert',type:'error',title:'Error',text:$e->getMessage());
     }
   }

   public function forceDelete($id) {
 try{
      ShippingMethod::onlyTrashed()->findOrFail($id)->forceDelete();
      $this->dispatch('alert',type:'success',title:'Success!',text:'Shipping Permanently Deleted');
     }
     catch(\Exception $e) {
       $this->dispatch('alert',type:'error',title:'Error',text:$e->getMessage());
     }
   }


   public function resetForm() {
    return $this->reset(['name','price','delivery_time','description','min_order_amount','status','isEdit','isOpen','ShippingId']);
   }


    public function render()
    {
        $Shippings = ShippingMethod::query()
        ->when($this->showTrashed,function($query) {
            $query->onlyTrashed();
        })
        ->when(!$this->showTrashed,function($query) {
            $query->withoutTrashed();
        })

        ->when(!empty($this->search),function($query) {
            $query->where('name','like','%'.$this->search.'%');
        })
        ->when(!empty($this->filterStatus),function($query) {
            $query->where('status',$this->filterStatus);
        })
        ->orderBy('id','desc')
        ->paginate(10);


        return view('admin.shipping-create-or-update',compact('Shippings'))->layout('layouts.admin')->layoutData(['metaTitle'=>'Shipping Methods - Admin','metaDescription' => 'Shiping Methods']);
    }
}