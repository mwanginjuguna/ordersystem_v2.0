<?php

namespace App\Http\Controllers;

use App\Mail\OrderReceived;
use App\Models\User;
use App\Notifications\AdminNotification;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class MailController extends Controller
{
    /**
     * Send emails to notify a new order has been placed
     * @param Request $request
     * @return JsonResponse
     */
    public function orderReceivedMail(Request $request): JsonResponse
    {
        $order = User::findOrFail($request->input('orderId'));

        $user = User::query()->where('id', $order->user_id)->first();

        Mail::to($user)->send(
            mailable: new OrderReceived($order)
        );

        // send emails
        $notifyAdmin = [
            'orderId' => $order->id,
            'username' => $user->name,
            'title' => 'A New Order has been Placed.',
            'content' => 'A new Order has been placed. Order #'.$order->id.' by '.auth()->user()->name.'.',
            'url' => route('orders.show', $order->id),
            'action' => 'View Order'
        ];

        $admin = User::query()->where('role', '=', 'A')->first();

        $admin->notify(new AdminNotification($notifyAdmin));

        return response()->json([
            'success' => "All done."
        ]);
    }

    /**
     * Send emails to notify an order has been paid for
     * @param Request $request
     * @return JsonResponse
     */
    public function paymentReceivedMail(Request $request): JsonResponse
    {
        $order = User::findOrFail($request->input('orderId'));

        $user = User::query()->where('id', $order->user_id)->first();

        Mail::to($user)->send(
            mailable: new OrderReceived($order)
        );

        // send emails
        $notifyAdmin = [
            'orderId' => $order->id,
            'username' => $user->name,
            'title' => 'A New Order has been Placed.',
            'content' => 'A new Order has been placed. Order #'.$order->id.' by '.auth()->user()->name.'.',
            'url' => route('orders.show', $order->id),
            'action' => 'View Order'
        ];

        $admin = User::query()->where('role', '=', 'A')->first();

        $admin->notify(new AdminNotification($notifyAdmin));

        return response()->json([
            'success' => "All done."
        ]);
    }
}
