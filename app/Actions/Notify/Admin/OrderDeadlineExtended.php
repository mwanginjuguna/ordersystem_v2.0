<?php

namespace App\Actions\Notify\Admin;

use App\Models\Order;
use App\Models\User;
use App\Notifications\AdminNotification;

class OrderDeadlineExtended
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
            'title' => 'Deadline Changed - Order #'.$this->order->id,
            'content' => 'The client has adjusted the deadline of an existing order.
            Order #'.$this->order->id.' by '.\auth()->user()->name.'.',
            'url' => route('orders.show', $this->order->id),
            'action' => 'View Order'
        ];

        $this->admin->notify(new AdminNotification($notifyAdmin));
    }
}
