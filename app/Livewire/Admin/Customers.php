<?php

namespace App\Livewire\Admin;

use App\Exports\CustomerExport;
use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;
use Maatwebsite\Excel\Facades\Excel;

class Customers extends Component
{
    use WithPagination;

    public $search = '';

    public $showTrashed = false;

    public function updatedSearch()
    {
        $this->resetPage();
    }

    public function delete($id)
    {
        try {
            User::findOrFail($id)->delete();
            $this->dispatch('alert', type: 'success', title: 'Success', text: 'Customer move to trash');

        } catch (\Exception $e) {
            $this->dispatch('alert', type: 'error', title: 'Error!', text: $e->getMessage());
        }
    }

    public function restore($id)
    {
        try {
            User::onlyTrashed()->findOrFail($id)->restore();
            $this->dispatch('alert', type: 'success', title: 'Success', text: 'Restored Successfully');

        } catch (\Exception $e) {
            $this->dispatch('alert', type: 'error', title: 'Error!', text: $e->getMessage());
        }
    }

    public function forceDelete($id)
    {
        try {
            User::onlyTrashed()->findOrFail($id)->forceDelete();
            $this->dispatch('alert', type: 'success', title: 'Success', text: 'Customer Permanently Deleted');

        } catch (\Exception $e) {
            $this->dispatch('alert', type: 'error', title: 'Error!', text: $e->getMessage());
        }
    }

    public function export()
    {
        return Excel::download(new CustomerExport, 'customers.xlsx');
    }

    public function render()
    {
        $customers = User::with('address:id,user_id,city,state,zip_code,country,address')
            ->when($this->showTrashed, function ($query) {
                $query->onlyTrashed();
            })
            ->when(! $this->showTrashed, function ($query) {
                $query->withoutTrashed();
            })
            ->when(! empty($this->search), function ($query) {

                $query->where(function ($q) {

                    $q->where('fullname', 'like', '%'.$this->search.'%')
                        ->orWhere('email', 'like', '%'.$this->search.'%')
                        ->orWhere('phone_number', 'like', '%'.$this->search.'%')
                        ->orWhereHas('address', function ($q2) {
                            $q2->where('city', 'like', '%'.$this->search.'%');
                            $q2->orWhere('state', 'like', '%'.$this->search.'%');
                        });

                });

            })
            ->where('role', 'user')
            ->orderBy('id', 'desc')
            ->paginate(10);

        return view('admin.customers', compact('customers'))->layout('layouts.admin')->layoutData(['metaTitle' => 'Custemers - ShopHub']);
    }
}