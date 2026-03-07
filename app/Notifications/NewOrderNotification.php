<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class NewOrderNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public $order;

    public $user;

    public function __construct($order, $user)
    {
        $this->order = $order;
        $this->user = $user;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['database'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable)
    {
        // return [
        //     'user_name' => $this->user->fullname,

        //     'order_id' => $this->order->order_number,

        //     'message' => "New order (#{$this->order->order_number}) placed by {$this->user->fullname}",
        // ];
    }

    public function toDatabase($notifiable)
    {
        return [
            'message' => "New order (#{$this->order->order_number}) placed by {$this->user->fullname}",
            'order_id' => $this->order->order_number,
            'user_name' => $this->user->fullname,
        ];
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
