<?php

namespace App\Livewire\Admin;

use App\Models\Order;
use App\Models\User;
use Livewire\Component;

class Dashboard extends Component
{
    public $totalSales;

    public $totalOrders;

    public $totalUsers;

    public $recentOrders = [];

    public function mount()
    {
        $this->loadDashboard();
    }

    public function loadDashboard()
    {
        $this->totalSales = Order::sum('total');
        $this->totalOrders = Order::count();

        $this->totalUsers = User::where('role', 'user')->count();

        $this->recentOrders = Order::orderBy('id', 'desc')->take(4)->get();
    }

    public function render()
    {
        return view('admin.dashboard')->layout('layouts.admin')->layoutData(['metaTitle' => 'Dashboard - Admin', 'metaDescription' => 'Manage Dashboard']);
    }
}
