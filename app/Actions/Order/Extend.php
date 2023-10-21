<?php

namespace App\Actions\Order;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class Extend
{

    public static function run(Order $order, Request $request)
    {
        $order->deadline += $request->hours;

        $order->due_at = Carbon::now()->addHours($order->deadline);
        $order->save();

        return redirect()->route('orders.show', [
            'id' => $order->id
        ])->with('success', 'deadline update successfully');
    }
}
