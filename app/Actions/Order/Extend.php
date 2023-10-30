<?php

namespace App\Actions\Order;

use App\Actions\Notify\Admin\OrderDeadlineExtended;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class Extend
{

    public static function run(Order $order, Request $request): bool
    {
        $order->deadline += $request->hours;

        $order->due_at = Carbon::now()->addHours($order->deadline);
        $order->save();

        // notify admin
        (new OrderDeadlineExtended($order))->notify();

        return true;
    }
}
