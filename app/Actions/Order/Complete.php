<?php

namespace App\Actions\Order;

use App\Actions\Notify\Admin\FileUploaded;
use App\Mail\OrderSubmitted;
use App\Models\File;
use App\Models\Order;
use App\Models\User;
use App\Notifications\AdminNotification;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

class Complete
{
    public static function run(Order $order, Request $request): RedirectResponse
    {
        // upload files, change order status to submitted, notify admin and client
        $order->status = auth()->user()->id === $order->user_id ? "complete" : "submitted";

        (new UploadFile())->run(order: $order, request: $request);

        (new \App\Actions\Notify\Admin\OrderSubmitted(order: $order))->notify();

        $client = $order->user()->get(); // User::query()->where('id', '=', $order->user_id)->first();

        Mail::to($client)->queue(new OrderSubmitted($order));

        $order->save();

        return redirect()->route('orders.show', [
            'id' => $order->id
        ])->with('success', 'Order Submitted');
    }
}
