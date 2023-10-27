<?php

namespace App\Actions\Notify\Writer;

use App\Models\Order;
use App\Models\User;
use App\Notifications\WriterNotification;

class OrderCancelled
{
    public User $writer;

    public function __construct(public Order $order)
    {
        $this->writer = User::where('id', $order->assigned_to)->first();
    }

    public function notify(): void
    {

        $data = [
            'orderId' => $this->order->id,
            'username' => $this->writer->name,
            'title' => 'Order Cancelled.',
            'content' => 'One of your active orders has been cancelled: Order #'.$this->order->id.'. No action is expected on your end. If you have questions or need clarification on this action, get in touch with the support team or admin.',
            'url' => route('orders.show', $this->order->id),
            'action' => 'View Order'
        ];

        $this->writer->notify(new WriterNotification($data));
    }
}
