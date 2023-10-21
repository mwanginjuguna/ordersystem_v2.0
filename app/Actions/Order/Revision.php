<?php

namespace App\Actions\Order;

use App\Mail\WriterAction;
use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class Revision
{

    public static function run(Order $order, Request $request)
    {
        //
        $order->status = "revision";
        $order->revision_instructions = $request->revision_instructions;
        $order->save();

        if ($order->assigned_to) {
            $writer = User::where('id', $order->assigned_to)->first();
            $data = [
                'orderId' => $order->id,
                'actionTitle' => 'Revision Request on your active order: Order #'.$order->id,
                'actionName' => "Revision Request"
            ];
            Mail::to($writer)->queue(new WriterAction($data));
        }

        return redirect()->route('orders.show', [
            'id' => $id
        ])->with('success', 'Revision request received.');
    }
}
