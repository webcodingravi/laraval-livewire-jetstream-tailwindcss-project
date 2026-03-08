<?php

namespace App\Livewire\Components\User;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class UserNotifications extends Component
{
    public $open = false;

    public $notifications = [];

    public function mount()
    {
        $this->loadNotifications();
    }

    public function loadNotifications()
    {
        $this->notifications = Auth::user()
            ->unreadNotifications()
            ->latest()
            ->take(10)
            ->get();
    }

    public function toggle()
    {
        $this->open = ! $this->open;
        $this->loadNotifications();
    }

    public function markAsRead($id)
    {
        $notification = Auth::user()
            ->notifications()
            ->where('id', $id)
            ->first();

        if ($notification) {
            $notification->markAsRead();
        }

        $this->loadNotifications();
    }

    public function render()
    {
        return view('components.user.user-notifications');
    }
}
