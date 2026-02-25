<?php

namespace App\Livewire\User;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class Dashboard extends Component
{
    public $user;
    public $recentOrders;
    public $wishlistCount;
    public $totalOrders;
    public $totalSpent;

    public function mount()
    {
        $this->user = Auth::user();
        $this->loadDashboardData();
    }

    public function loadDashboardData()
    {
        // These are example calculations - adjust based on your actual models
        $this->totalOrders = 0; // Update with actual orders count
        $this->totalSpent = 0; // Update with actual total spent
        $this->wishlistCount = 0; // Update with actual wishlist count
        $this->recentOrders = []; // Update with actual recent orders
    }

    public function render()
    {
        return view('user.dashboard');
    }
}