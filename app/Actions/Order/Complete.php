<?php

namespace App\Actions\Order;

use App\Mail\OrderSubmitted;
use App\Models\File;
use App\Models\Order;
use App\Models\User;
use App\Notifications\AdminNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

class Complete
{
    public static function run(Order $order, Request $request)
    {
        // upload files, change order status to submitted, notify admin and client
        $order->status = "submitted";

        foreach ($request->files as $file) {
            $filename = $order->id.'_'.$file->getClientOriginalName();
            $newFile = new File([
                'order_id' => $order->id,
                'name' => $filename,
                'location' => Storage::putFileAs('orders', $file, $filename ),
                'uploaded_by' => \auth()->user()->role,
                'type' => $request->file_type
            ]);
            $newFile->save();
        }
        $notifyAdmin = [
            'orderId' => $order->id,
            'username' => auth()->user()->name,
            'title' => 'Order #'.$order->id.' Submitted by '.auth()->user()->name,
            'content' => 'Order #'.$order->id.' has been submitted.',
            'url' => route('orders.show', $order->id),
            'action' => 'View Order'
        ];
        $admin = User::query()->where('role', '=', 'A')->first();

        $admin->notify(new AdminNotification($notifyAdmin));

        $client = User::query()->where('id', '=', $order->user_id)->first();

        Mail::to($client)->queue(new OrderSubmitted($order));

        $order->save();

        return redirect()->route('orders.show', [
            'id' => $id
        ])->with('success', 'Order Submitted');
    }
}
