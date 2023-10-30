<?php

namespace App\Actions\Order;

use App\Actions\Notify\Admin\OrderCompleted;
use App\Mail\OrderAction;
use App\Models\Order;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class Complete
{
    public static function run(Order $order, Request $request): bool
    {
        // upload files, change order status to submitted, notify admin and client
        $order->status = "complete";
        $order->review = $request->get('review');
        $order->rating = $request->get('stars');
        $order->completed_at = now();
        $order->save();

        (new OrderCompleted(order: $order))->notify();

        $user = $order->user;
        Mail::to($user)->queue(new OrderAction(data: [
            'actionTitle' => 'Order marked as complete (#'.$order->id.')',
            'orderAction' => 'Order Completed',
            'orderId' => $order->id
        ]));

        return true;
    }
}
