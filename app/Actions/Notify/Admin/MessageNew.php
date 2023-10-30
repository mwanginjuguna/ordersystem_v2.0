<?php

namespace App\Actions\Notify\Admin;

use App\Models\Order;
use App\Models\User;
use App\Notifications\AdminNotification;

class MessageNew
{
    public User $admin;

    public function __construct(public Order $order, public $params = [])
    {
        $this->admin = view()->shared('admin');
    }

    public function notify(): void
    {
        $orderMessage = $this->params['orderMessage'];
        
        $notifyAdmin = [
            'orderId' => $this->order->id,
            'username' => $this->order->user->name,
            'title' => 'Order #'.$this->order->id.' Message.',
            'content' => 'A new message has been sent on Order #'.$this->order->id.' by '.$this->order->user->name.
                '. "'.$orderMessage->message.'".',
            'url' => route('orders.show', $this->order->id),
            'action' => 'View Order'
        ];

        $this->admin->notify(new AdminNotification($notifyAdmin));
    }
}
