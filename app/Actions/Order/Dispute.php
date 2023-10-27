<?php

namespace App\Actions\Order;

use App\Models\Order;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class Dispute
{

    public static function run(Order $order, Request $request): RedirectResponse
    {
        //
        $order->status = "disputed";
        $order->cancel_reason = $request->cancel_reason;
        $order->save();

        return redirect()->route('orders.show', [
            'id' => $order->id
        ])->with('success', 'Dispute issued!!');
    }
}
