<?php

namespace App\Livewire\Admin;

use Livewire\Component;

class AdminNotificationBell extends Component
{
    public $notifications = [];

    public $open = false;

    protected $listeners = ['orderPlaced' => 'refreshNotifications'];

    public function mount()
    {
        $this->refreshNotifications();
    }

    public function toggle()
    {
        $this->open = ! $this->open;
    }

    public function refreshNotifications()
    {
        $this->notifications = auth()->user()->unreadNotifications;
    }

    public function markAsRead($id)
    {
        $notification = auth()->user()->notifications()->find($id);
        if ($notification) {
            $notification->markAsRead();
        }
        $this->refreshNotifications();
    }

    public function render()
    {
        $this->refreshNotifications();

        return view('admin.admin-notification-bell');
    }
}
