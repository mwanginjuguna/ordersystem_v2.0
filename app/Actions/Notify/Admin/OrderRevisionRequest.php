<?php

namespace App\Actions\Notify\Admin;

use App\Models\Order;
use App\Models\User;
use App\Notifications\AdminNotification;

class OrderRevisionRequest
{
    public User $admin;

    public function __construct(public Order $order)
    {
        $this->admin = view()->shared('admin');
    }

    public function notify(): void
    {

        $notifyAdmin = [
            'orderId' => $this->order->id,
            'username' => auth()->user()->name,
            'title' => 'New Revision Request! - Order #'.$this->order->id,
            'content' => 'The client has requested a revision.
            Order #'.$this->order->id.' by '.auth()->user()->name.'.',
            'url' => route('orders.show', $this->order->id),
            'action' => 'View Order'
        ];

        $this->admin->notify(new AdminNotification($notifyAdmin));
    }
}
