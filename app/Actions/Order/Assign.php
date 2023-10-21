<?php

namespace App\Actions\Order;

use App\Models\Order;
use App\Models\User;
use App\Notifications\WriterNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class Assign
{

    public static function run(Order $order, Request $request)
    {
        $order->status = 'running';
        $order->assigned_to = $request->assigned_to;
        $order->writer_deadline = Carbon::parse($request->writerDeadline);
        // send email to writer
        $writer = User::query()->where('id', '=', $order->assigned_to)->first();

        $data = [
            'orderId' => $order->id,
            'username' => $writer->name,
            'title' => 'New Order Assigned.',
            'content' => 'We have considered you for Order #'.$order->id.', and you have been assigned to work on it.
            You are expected to Login to your account, Check the assigned order, and Start working on it immediately.
            <br>Order Topic: '.$order->title.'<br> Order Instructions: <br>'.$order->instructions.'
            <br>A delivery is expected before the deadline of the order expires.
            As usual, plagiarism free and high quality work is expected.',
            'url' => route('orders.show', $order->id),
            'action' => 'View Order'
        ];
        $writer->notify(new WriterNotification($data));

        $order->save();

        return redirect()->route('orders.show', [
            'id' => $order->id
        ])->with('success', 'Assigned to '.$writer->name);
    }
}
