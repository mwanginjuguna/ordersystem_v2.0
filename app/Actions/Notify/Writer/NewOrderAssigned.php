<?php

namespace App\Actions\Notify\Writer;

use App\Models\Order;
use App\Models\User;
use App\Notifications\WriterNotification;

class NewOrderAssigned
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
            'title' => 'New Order Assigned.',
            'content' => 'We have considered you for Order #'.$this->order->id.', and you have been assigned to work on it.
            You are expected to Login to your account, Check the assigned order, and Start working on it immediately.
            <br>Order Topic: '.$this->order->title.'<br> Order Instructions: <br>'.$this->order->instructions.'
            <br>A delivery is expected before the deadline of the order expires.
            As usual, plagiarism free and high quality work is expected.',
            'url' => route('orders.show', $this->order->id),
            'action' => 'View Order'
        ];

        $this->writer->notify(new WriterNotification($data));
    }
}
