<?php

namespace App\Actions\Order;

use App\Actions\Notify\Admin\OrderCancelled;
use App\Models\Order;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class Cancel
{
    public static function run(Order $order, Request $request): RedirectResponse
    {
        //
        // change order status to cancelled, notify admin
        $order->status = "cancelled";
        $order->cancel_reason = $request->cancel_reason;
        $order->save();

        // notify admin
        (new OrderCancelled($order))->notify();

        // notify writer
        (new \App\Actions\Notify\Writer\OrderCancelled($order))->notify();

        return redirect()->route('orders.show', [
            'id' => $order->id
        ])->with('success', 'Order Cancelled!!');
    }
}
