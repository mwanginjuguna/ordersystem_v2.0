<?php

namespace App\Actions\Order;

use App\Actions\Notify\Admin\OrderDisputed;
use App\Mail\OrderAction;
use App\Models\Order;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class Dispute
{

    public static function run(Order $order, Request $request): bool
    {
        // update order
        $order->status = "disputed";
        $order->cancel_reason = $request->cancel_reason;
        $order->save();

        // notify user
        Mail::to($order->user)->queue(new OrderAction(data: [
            'actionTitle' => 'New Dispute for order #'.$order->id,
            'orderAction' => 'Order Disputed',
            'orderId' => $order->id
        ]));

        // notify admin
        (new OrderDisputed($order))->notify();

        return true;
    }
}
