<?php

namespace App\Actions\Notify\Writer;

use App\Mail\WriterAction;
use App\Models\Order;
use App\Models\User;
use App\Notifications\WriterNotification;
use Illuminate\Support\Facades\Mail;

class OrderRevision
{
    public User $writer;

    public function __construct(public Order $order)
    {
        $this->writer = User::where('id', $order->assigned_to)->first();
    }

    public function notify(): void
    {
        $writer = User::where('id', $this->order->assigned_to)->first();

        $data = [
            'orderId' => $this->order->id,
            'actionTitle' => 'Revision Request on your active order: Order #'.$this->order->id,
            'actionName' => "Revision Request"
        ];
        Mail::to($writer)->queue(new WriterAction($data));
    }
}
