<?php

namespace App\Actions\Order;

use App\Actions\Notify\Writer\NewOrderAssigned;
use App\Models\Order;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class Assign
{

    public static function run(Order $order, Request $request): RedirectResponse
    {
        $order->status = 'running';
        $order->assigned_to = $request->assigned_to;
        $order->writer_deadline = Carbon::parse($request->writerDeadline);
        // send email to writer
        (new NewOrderAssigned($order))->notify();

        $order->save();

        return redirect()->route('orders.show', [
            'id' => $order->id
        ])->with('success', 'Assigned to the Writer');
    }
}
