<?php

namespace App\Actions\Notify\Admin;

use App\Models\Order;
use App\Models\User;
use App\Notifications\AdminNotification;

class FileUploaded
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
            'content' => 'A new File has been uploaded to Order #'.$this->order->id.' by '.auth()->user()->name,
            'title' => 'File Upload Notice - Order #'.$this->order->id,
            'url' => route('orders.show', $this->order->id),
            'action' => 'View Order'
        ];

        $this->admin->notify(new AdminNotification($notifyAdmin));
    }
}
