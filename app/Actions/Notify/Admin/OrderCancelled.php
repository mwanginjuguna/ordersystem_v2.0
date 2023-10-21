<?php

namespace App\Actions\Notify\Admin;

use App\Models\Order;
use App\Models\User;
use App\Notifications\AdminNotification;

class OrderCancelled
{
    public User $admin;

    public function __construct(public Order $order)
    {
        $this->admin = view()->shared('admin');
    }

    public function notify()
    {

        $notifyAdmin = [
            'orderId' => $this->order->id,
            'username' => \auth()->user()->name,
            'title' => 'Order #'.$this->order->id.' Cancelled.',
            'content' => 'Order #'.$this->order->id.' has been Cancelled.',
            'url' => route('orders.show', $this->order->id),
            'action' => 'View Order'
        ];

        $this->admin->notify(new AdminNotification($notifyAdmin));
    }
}
