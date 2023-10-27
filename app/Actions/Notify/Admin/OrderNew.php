<?php

namespace App\Actions\Notify\Admin;

use App\Models\Order;
use App\Models\User;
use App\Notifications\AdminNotification;

class OrderNew
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
            'username' => auth()->user()->name,
            'title' => 'A New Order has been Placed.',
            'content' => 'A new Order has been placed. Order #'.$this->order->id.' by '.auth()->user()->name.'.',
            'url' => route('orders.show', $this->order->id),
            'action' => 'View Order'
        ];

        $this->admin->notify(new AdminNotification($notifyAdmin));
    }
}
