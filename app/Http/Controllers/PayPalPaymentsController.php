<?php

namespace App\Http\Controllers;

use App\Jobs\SendPaymentReceivedEmailJob;
use App\Mail\OrderAction;
use App\Mail\PaymentSuccess;
use App\Models\Currency;
use App\Models\Order;
use App\Models\Payment;
use App\Models\User;
use App\Notifications\AdminNotification;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Srmklive\PayPal\Services\PayPal;

class PayPalPaymentsController extends Controller
{
    // handle payments
    public function pay(Request $request, $id)
    {
        $order = Order::findOrFail($id);
        $amount = $order->amount;
        $currency = Currency::query()
            ->where('id', '=', $order->currency_id)
            ->pluck('name')->first();

        // initialize paypal client
        $provider = new PayPal();
        $provider->setApiCredentials(config('paypal'));
        $token = $provider->getAccessToken();
        $provider->setAccessToken($token);

        $paypal_order = $provider->createOrder([
            "intent" => "CAPTURE",
            "application_context" => [
                "return_url" => route('payment-success', $id),
                "cancel_url" => route('cancel-payment', $id)
            ],
            "purchase_units" => [
                0 => [
                    "amount" => [
                        "currency_code" => $currency,
                        "value" => $amount,
                    ]
                ]
            ]
        ]);
        if (isset($paypal_order['id']) && $paypal_order['id'] != null) {
            foreach ($paypal_order['links'] as $links) {
                if ($links['rel'] == 'approve') {
                    // create a new transaction instance
                    // $payment = new Payment();
                    // check if the transaction already exists
                    // $transaction = Payment::query()->where('paypal_transaction_id',  '=', $paypal_order['id']);
                    $transactionData = [
                        'order_id' => $order->id,
                        'user_id' => User::query()
                            ->where('id', '=', $order->user_id)
                            ->pluck('id')
                            ->first(),
                        'transaction_status' => $paypal_order['status']
                    ];
                    Payment::updateOrCreate($transactionData);
                    // return redirect()->away($links['href']);
                    return response()->json($paypal_order);
                }
            }
        }


        return redirect()
            ->route('orders.preview', $id)
            ->with('message', 'Something Went Wrong while Connecting! Try Again or Contact Support');
    }

    // capture payment details
    public function capture(Request $request, $id) {
        $data = json_decode($request->getContent(), true);
        $paypalOrderId = $data['orderId'];

        $order = Order::findOrFail($id);
        $user = User::query()->where('id', '=', $order->user_id)->first();

        // Initialize paypal
        $provider = new PayPal();
        $provider->setApiCredentials(config('paypal'));
        $token = $provider->getAccessToken();
        $provider->setAccessToken($token);

        // capture payment details
        $response = $provider->capturePaymentOrder($paypalOrderId);

        if (isset($response['status']) && $response['status'] === 'COMPLETED')
        {
            // update @Payment $payment && Order $order details and save to db
            $payment = Payment::query()
                ->where('order_id', '=', $order->id)
                ->first();
            $payerId = $data['payerId'];
            $paidAmount = $response['purchase_units'][0]['payments']['captures'][0]['amount']['value'];
            $payerName = $response['purchase_units'][0]['shipping']['name']['full_name'];

            $paypalFacilitatorAccessToken = $data['facilitatorAccessToken'];
            $payment->transaction_status = $response['status'];
            $payment->paypal_transaction_id = $paypalOrderId;
            $payment->paypal_payer_id = $payerId;
            $payment->paypal_facilitator_access_token_id = $paypalFacilitatorAccessToken;
            $payment->total_paid = $paidAmount;
            $payment->user_name = $payerName;
            $payment->payer_country_code = $response['purchase_units'][0]['shipping']['address']['country_code'];
            $payment->save();

            $order->amount_due = $order->amount - $paidAmount;
            $order->paid = true;
            $order->status = 'new';
            $order->save();

            // $user = User::query()->where('id', '=', $order->user_id)->first();

            $emailData = [
                'orderId' => $order->id,
                'transactionId' => $paypalOrderId,
                'amount' => $paidAmount,
                'currencySymbol' =>
                    $response['purchase_units'][0]['payments']['captures'][0]['amount']['currency_code'],
                'date' => now()->toDayDateTimeString(),
                'username' => $payerName,
            ];

            $notifyAdmin = [
                'orderId' => $order->id,
                'username' => $user->name.' / '.$payerName,
                'title' => 'Order Paid! - Order #'.$order->id,
                'content' => 'A new order payment has been completed.<br>
                Order #'.$order->id.' paid by '.$payerName.'/'.$user->name.'. <br>Amount Paid: '.
                    $paidAmount,
                'url' => route('orders.show', $order->id),
                'action' => 'View Order'
            ];

            $admin = User::query()->where('role', '=', 'A')->first();

            $admin->notify(new AdminNotification($notifyAdmin));

            Mail::to($user)->later(2000, new PaymentSuccess($emailData));

            // $this->dispatch(new SendPaymentReceivedEmailJob(user: $user, data: $emailData));

            return response()->json($response);

        } elseif (isset($response['debug_ID'])) {
            $paymentError = [
                "name" => $response['name'],
                "error" => $response['message'],
                "details" => $response['details']
            ];
            $notifyAdmin = [
                'orderId' => $order->id,
                'username' => $user->name,
                'title' => 'Order Payment Failed! - Order #'.$order->id,
                'content' => 'Payment for Order #'.$order->id.' paid by '.$user->name.
                    ' has failed. Error Message as follows <br>'.
                    $response["name"].': '.
                    $response["message"],
                'url' => route('orders.show', $order->id),
                'action' => 'View Order'
            ];

            $admin = User::query()->where('role', '=', 'A')->first();

            $admin->notify(new AdminNotification($notifyAdmin));
            return response()->json($paymentError);
        } else {
            return response()->json($response);
        }
    }

    // cancel payment
    public function cancel(Order $order)
    {
        $payment = Payment::query()->where('order_id', '=', $order->id);
        $payment->status = 'CANCELLED';
        $payment->save();

        $user = User::query()->where('id', $order->user_id)->first();

        $notifyAdmin = [
            'orderId' => $order->id,
            'username' => $user->name,
            'title' => 'Order Payment Attempt Failed! - Order #'.$order->id,
            'content' => 'Payment Attempted for Order #'.$order->id.' paid by '.$user->name.
                ' has failed. Payment was cancelled by the user <br>',
            'url' => route('orders.show', $order->id),
            'action' => 'View Order'
        ];

        $admin = User::query()->where('role', '=', 'A')->first();

        $admin->notify(new AdminNotification($notifyAdmin));

        Mail::to($user)->later(3000, new OrderAction(data: [
            'actionTitle' => 'Payment Cancelled',
            'orderId' => $order->id,
            'orderAction' => 'Order Payment Cancelled'
        ]));

        return redirect()
            ->route('make-payment')
            ->with('success', 'Transaction was Cancelled! Your account was not Billed.');
    }

    // success url
    public function success(Request $request, $id)
    {
        $provider = new PayPal();
        $provider->setApiCredentials(config('paypal'));
        $provider->getAccessToken();
        $order = Order::findOrFail($id);
        $response = $provider->capturePaymentOrder($request['token']);

        if (isset($response['status']) && $response['status'] === 'COMPLETED')
        {
            // capture transaction details and save to db
            $payment = Payment::query()
                ->where('order_id', '=', $order->id)
                ->first();
            $payment->status = $response['status'];
            $payment->paypal_transaction_id = $response;
            $payment->save();

            $order->paid = 'Yes';
            $order->status = 'new';
            $order->save();
            return redirect()->route('orders.recents')
                ->with('success', 'Payment for Order #'.$id.' was Successful');
        } else {
            return redirect()
                ->route('make-payment', $id)
                ->with('message', $response['message'] ?? 'Something Went Wrong');
        }
    }
}
