<?php

namespace App\Actions\Order;

use App\Models\Order;
use App\Models\User;
use App\Notifications\AdminNotification;
use App\Notifications\WriterNotification;
use Illuminate\Http\Request;

class Cancel
{
    public static function run(Order $order, Request $request)
    {
        //
        // change order status to cancelled, notify admin
        $order->status = "cancelled";
        $order->cancel_reason = $request->cancel_reason;
        $order->save();

        $notifyAdmin = [
            'orderId' => $order->id,
            'username' => \auth()->user()->name,
            'title' => 'Order #'.$order->id.' Cancelled.',
            'content' => 'Order #'.$order->id.' has been Cancelled.',
            'url' => route('orders.show', $order->id),
            'action' => 'View Order'
        ];

        $admin = User::query()->where('role', '=', 'A')->first();

        $admin->notify(new AdminNotification($notifyAdmin));

        $writer = User::where('id', $order->assigned_to)->first();

        $data = [
            'orderId' => $order->id,
            'username' => $writer->name,
            'title' => 'Order Cancelled.',
            'content' => 'One of your active orders has been cancelled: Order #'.$order->id.'. No action is expected on your end. If you have questions or need clarification on this action, get in touch with the support team or admin.',
            'url' => route('orders.show', $order->id),
            'action' => 'View Order'
        ];

        $writer->notify(new WriterNotification($data));

        return redirect()->route('orders.show', [
            'id' => $order->id
        ])->with('success', 'Order Cancelled!!');
    }
}
