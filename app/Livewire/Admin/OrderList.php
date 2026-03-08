<?php

namespace App\Livewire\Admin;

use App\Exports\OrdersExport;
use App\Models\Order;
use Livewire\Component;
use Livewire\WithPagination;
use Maatwebsite\Excel\Facades\Excel;

class OrderList extends Component
{
    use WithPagination;

    public $order;

    public $orderItems;

    public $isOpen = false;

    public $showTrashed = false;

    public $search = '';

    public $orderStatus = [];

    public $filterStatus = '';

    public $fromDate;

    public $toDate;

    public function openModal()
    {
        $this->isOpen = true;
    }

    public function closeModal()
    {
        $this->isOpen = false;
    }

    public function updatedSearch()
    {
        $this->resetPage();
    }

    public function updatedFromDate()
    {
        $this->resetPage();
    }

    public function updatedToDate()
    {
        $this->resetPage();
    }

    public function resetDateFilter()
    {
        $this->fromDate = '';
        $this->toDate = '';
    }

    public function updatedFilterStatus()
    {
        $this->resetPage();
    }

    public function updatedOrderStatus($status, $id)
    {
        try {

            Order::where('id', $id)->update(['status' => $status]);

            $this->dispatch('alert', type: 'success', title: 'Success!', text: 'Order Status Successfully Updated !');

        } catch (\Exception $e) {
            $this->dispatch('alert', type: 'error', title: 'Error!', text: $e->getMessage());
        }
    }

    public function view($id)
    {
        try {
            $this->order = Order::with('orderItems')->findOrFail($id);
            $this->orderItems = $this->order->orderItems;
            $this->isOpen = true;
        } catch (\Exception $e) {
            $this->dispatch('alert', type: 'error', title: 'Error!', text: $e->getMessage());
        }
    }

    public function delete($id)
    {
        try {
            Order::findOrFail($id)->delete();

            $this->dispatch('alert', type: 'success', title: 'Success!', text: 'Order move to trash');

        } catch (\Exception $e) {
            $this->dispatch('alert', type: 'error', title: 'Error!', text: $e->getMessage());

        }
    }

    public function restore($id)
    {
        try {
            Order::onlyTrashed()->findOrFail($id)->restore();

            $this->dispatch('alert', type: 'success', title: 'Success!', text: 'Order Successfully Restored');

        } catch (\Exception $e) {
            $this->dispatch('alert', type: 'error', title: 'Error!', text: $e->getMessage());
        }
    }

    public function forceDelete($id)
    {
        try {
            Order::onlyTrashed()->findOrFail($id)->forceDelete();

            $this->dispatch('alert', type: 'success', title: 'Success!', text: 'Order Permanently Deleted');

        } catch (\Exception $e) {
            $this->dispatch('alert', type: 'error', title: 'Error!', text: $e->getMessage());
        }
    }

    public function export() {
      return Excel::download(new OrdersExport,'orders.xlsx');
    }

    public function render()
    {
        $orders = Order::query()
            ->when($this->showTrashed, function ($query) {
                $query->onlyTrashed();
            })
            ->when(! $this->showTrashed, function ($query) {
                $query->withoutTrashed();
            })
            ->when(! empty($this->search), function ($query) {
                $query->where('order_number', 'like', '%'.$this->search.'%');
            })
            ->when(! empty($this->filterStatus), function ($query) {
                $query->where('status', $this->filterStatus);
            })
            ->when($this->fromDate, function ($query) {
                $query->whereDate('created_at', '>=', $this->fromDate);
            })
            ->when($this->toDate, function ($query) {
                $query->whereDate('created_at', '<=', $this->toDate);
            })
            ->orderBy('id', 'desc')->paginate(10);

        foreach ($orders as $order) {
            $this->orderStatus[$order->id] = $order->status;
        }

        if ($this->fromDate && $this->toDate && $this->fromDate > $this->toDate) {

            $this->dispatch('alert',
                type: 'error',
                title: 'Error',
                text: 'From date cannot be greater than To date'
            );
        }

        return view('admin.order-list', compact('orders'))->layout('layouts.admin')->layoutData(['metaTitle' => 'Order List - Admin']);
    }
}
