<?php

namespace App\Http\Controllers;

use App\Actions\Notify\Admin\BidNew;
use App\Actions\Order\Assign;
use App\Models\Bid;
use App\Models\Order;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class BidController extends Controller
{
    /**
     * Show all bids
     */
    public function index(Request $request, Order $order): Response
    {
        return Inertia::render('Admin/Bids', [
            'bids' => Bid::with('writer')->latest()->get()
        ]);
    }

    /**
     * Placing a bid
     */
    public function bid(Request $request, Order $order): RedirectResponse
    {
        $writer = auth()->user();

        Bid::create([
            'order_id' => $order->id,
            'user_id' => $writer->id,
            'bid_message' => $request->input('bid_message')
        ]);

        (new BidNew($order, ['writer' => $writer->name]))->notify();

        return redirect()->back()->with('Success', 'Your bid has been successfuly placed.');
    }

    /**
     * Assign the writer with the winning bid
     */

    public function assign(Request $request, Order $order): RedirectResponse
    {
        Assign::run(order: $order, request: $request);

        return redirect()->back()->with('success', "Order has been assigned to a writer successfully.");
    }
}
