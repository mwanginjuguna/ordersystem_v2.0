<?php

namespace App\Http\Controllers;

use App\Actions\Order\Assign;
use App\Actions\Order\Cancel;
use App\Actions\Order\Complete;
use App\Actions\Order\Dispute;
use App\Actions\Order\Extend;
use App\Actions\Order\Revision;
use App\Actions\Order\UploadFile;
use App\Models\Order;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class ClientActionsController extends Controller
{
    /**
     * Order Actions - app/Actions
     */
    public function actions(Request $request, $id): RedirectResponse
    {

        $action = $request->input('action');
        $order = Order::where('id', $id)->with('user')->first();

        try {
            $message = '';

            if ($action === 'complete') {

                // mark complete
                Complete::run(order: $order, request: $request);
                $message = 'Order completed';

            } elseif ($action === 'revision') {

                // request revision
                Revision::run(order: $order, request: $request);
                $message = 'Revision request received. Our writer will start working on it now.';

            } elseif ($action === 'dispute') {

                // register a dispute
                Dispute::run(order: $order, request: $request);
                $message = 'Dispute has been registered! We are monitoring the issue, and we will get back to you shortly with a resolution.';

            } elseif ($action === 'extend') {

                // extend deadline
                Extend::run(order: $order, request: $request);
                $message = 'Thank you. Deadline has been updated successfully';

            } elseif ($action === 'upload') {
                dd($order->user);
                // Upload files.
                UploadFile::run(order: $order, request: $request);
                $message = 'New File Upload was successful.';
            }

            return back()->with('Success', $message);

        } catch (\Exception $exception) {
            return back('500')->with('Error', "An error occurred while processing your request.");
        }
    }

    /**
     * Upload files.
     *
     */
    public function uploadFiles(Request $request, int $id): RedirectResponse
    {
        $order = Order::where('id', $id)->with('user')->first();

        (new UploadFile())->run(order: $order, request: $request);

        return redirect()->back()->with('success', 'New File Upload was successful.');
    }

}
