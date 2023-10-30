<?php

namespace App\Actions\Order;

use App\Actions\Notify\Admin\OrderRevisionRequest;
use App\Actions\Notify\Writer\OrderRevision;
use App\Mail\OrderAction;
use App\Mail\WriterAction;
use App\Models\Order;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class Revision
{

    public static function run(Order $order, Request $request): bool
    {
        // update order
        $order->status = "revision";
        $order->revision_instructions = $request->revision_instructions;
        $order->save();

        // notify writer
        if ($order->assigned_to) {
            (new OrderRevision(order: $order))->notify();
        }

        // notify user
        Mail::to($order->user)->queue(new OrderAction([
            'orderId' => $order->id,
            'orderAction' => 'Order Revision.',
            'actionTitle' => 'Order Revision Request for Order Number #'.$order->id
        ]));

        // notify admin
        (new OrderRevisionRequest(order: $order))->notify();

        return true;
    }
}
