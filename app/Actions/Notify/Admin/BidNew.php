<?php

namespace App\Actions\Notify\Admin;

use App\Models\Order;
use App\Models\User;
use App\Notifications\AdminNotification;

class BidNew
{
    public User $admin;

    public function __construct(public Order $order, public $params = [])
    {
        $this->admin = view()->shared('admin');
    }

    public function notify(): void
    {
        $notifyAdmin = [
            'orderId' => $this->order->id,
            'username' => $this->params['writer'],
            'title' => 'New Bid on Order #'.$this->order->id,
            'content' => 'A new bid has been place by writer on Order #'.$this->order->id,
            'url' => route('admin.bids.show', $this->order->id),
            'action' => 'View Order'
        ];

        $this->admin->notify(new AdminNotification($notifyAdmin));
    }
}
