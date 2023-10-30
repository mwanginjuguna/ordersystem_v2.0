<?php

namespace App\Http\Controllers;

use App\Actions\Notify\Admin\OrderNew;
use App\Actions\Order\Assign;
use App\Actions\Order\Cancel;
use App\Actions\Order\Complete;
use App\Actions\Order\Dispute;
use App\Actions\Order\Extend;
use App\Actions\Order\Revision;
use App\Actions\Order\UploadFile;
use App\Models\AcademicLevel;
use App\Models\AdditionalFeatures;
use App\Models\Currency;
use App\Models\Discount;
use App\Models\File;
use App\Models\Language;
use App\Models\Order;
use App\Models\Rate;
use App\Models\ReferencingStyle;
use App\Models\ServiceType;
use App\Models\Spacing;
use App\Models\Subject;
use App\Models\User;
use App\Models\WriterCategory;
use App\Notifications\AdminNotification;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;
use Inertia\Response;
use Symfony\Component\HttpFoundation\StreamedResponse;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request): Response
    {
        //
        $url = $request->url();

        $statusMappings = [
            "pending" => ['status' => "pending", 'description' => 'Orders not paid or on-hold.'],
            "recents" => ['status' => "new", 'description' => 'Orders recently placed and/or paid. New orders.'],
            'submitted' => ['status' => 'submitted', 'description' => 'Orders submitted awaiting confirmation.'],
            'running' => ['status' => 'running', 'description' => 'Orders in progress.'],
            'completed' => ['status' => 'complete', 'description' => 'Orders marked as complete.'],
            'revision' => ['status' => 'revision', 'description' => 'Orders under revision.'],
            'disputed' => ['status' => 'disputed', 'description' => 'Orders with disputes.'],
            'cancelled' => ['status' => 'cancelled', 'description' => 'Cancelled orders due to dispute, refund, or other issues.'],
        ];

        // last part of the url
        $segment = last(explode('/', $url));
        $statusInfo = $statusMappings[$segment] ?? null;

        $orders = $statusInfo ? Order::query()->where('status', $statusInfo['status'])
            ->latest()->get() : Order::query()->latest()->get();

        $segment = $segment === 'recents' ? 'New' : ucfirst($segment);

        $info = $statusInfo ? [
            'title' => $segment.' Orders: Admin - '. config('app.website_name'),
            'subtitle' => $segment.' Orders',
            'description' => $statusInfo['description']
        ] : [];

        return Inertia::render('Admin/OrderList', [
             'orders' => $orders,
            'info' => $info ?? []
         ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {


    }

    /**
     * Store a newly created resource in storage.
     *
     */
    public function store(Request $request): RedirectResponse
    {
        // validate and save
        $order = new Order(
            $request->validate([
                'title' => 'required',
                'deadline' => 'required',
                "service_type_id" => '',
                "academic_level_id" => '',
                "subject_id" => '',
                "instructions" => '',
                "pages" => '',
                "slides" => '',
                "sources" => '',
                "spacing_id" => '',
                "referencing_style_id" => '',
                "language_id" => '',
                "writer_category_id" => '',
                "amount" => '',
                "currency_id" => '',
                "cpp" => '',
                "discount_id" => '',
                "paid" => '',
            ])
        );
        $order->user_id = auth()->user()->id;
        $order->due_at = Carbon::now()->addHours($order->deadline);
        $order->save();

        // upload files
        UploadFile::run(order: $order, request: $request);

        (new OrderNew(order: $order))->notify();

        return redirect()->route('orders.recents')->with('success', 'Order added successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id): Response
    {
        // view an order
        $order = Order::where('id', $id)
            ->with([
                'academicLevel:id,name',
                'subject:id,name',
                'serviceType:id,name',
                'spacing:id,name',
                'referencingStyle:id,name',
                'writerCategory:id,name',
                'language:id,name',
                'user:id,name',
                'discount:id,code,rate',
                'currency:id,symbol',
            ])
            ->first();

        if (($order->status === 'new' || $order->status === 'pending') && auth()->user()->role === 'A')
        {
            $writers = User::query()
                ->where('role', '=', 'W')
                ->get();
        }

        $writer = User::query()
            ->where('id', '=', $order->assigned_to)
            ->pluck('name')
            ->first();

        $files = File::query()
            ->where('order_id', '=', $order->id)
            ->latest()->get();

        $deadline = Carbon::create($order->due_at)->diffForHumans(parts: 3);

        return Inertia::render('Admin/ViewOrder', [
            'order' => $order,
            'level' => $order->academicLevel->name,
            'subject' => $order->subject->name,
            'service' => $order->serviceType->name,
            'spacing' => $order->spacing->name,
            'style' => $order->referencingStyle->name,
            'language' => $order->language->name,
            'writerCategory' => $order->writerCategory->name,
            'user' => $order->user->name,
            'discount' => $order->discount->code ?? '',
            'writer' => $writer ?? null,
            'writers' => $writers ?? null,
            'deadline' => $deadline,
            'files' => $files ?? [],
            'currencySymbol' => $order->currency->symbol ?? '',
            'discountAmount' => $order->discount->rate ?? ''
        ]);
    }

    /**
     * download file
     */
    public function downloadFile(int $id): StreamedResponse
    {
        $file = File::findOrFail($id);
        return Storage::download($file->location);
    }

    /**
     * Show the form for editing the specified resource.
     *
     */
    public function edit(Order $order): Response
    {
        // edit an order
        return Inertia::render('Orders/OrderView', [
            'order' => $order
        ]);
    }

    /**
     * Show a file to the client.
     *
     */
    public function showClient(int $fileId): JsonResponse
    {
        $file = File::findOrFail($fileId);

        // hide file from client if visible
        $file->show_client = !$file->show_client;
        // save
        $file->save();
        // json response
        return response()->json([
            "message" => "File updated Successfully"
        ]);
    }

    /**
     * Delete a file.
     */
    public function destroyFile(File $file): JsonResponse
    {
        $file->delete();

        // json response
        return response()->json([
            "message" => "File Removed from database."
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Order $order): RedirectResponse
    {
        //
        $order->instructions = $request->instructions;
        $order->save();

        $notifyAdmin = [
            'orderId' => $order->id,
            'username' => auth()->user()->name,
            'title' => 'Instructions Changed: Order #'.$order->id,
            'content' => 'Updated Instructions for Order #'.$order->id.' by '.auth()->user()->name.'.',
            'url' => route('orders.show', $order->id),
            'action' => 'View Order'
        ];
        $admin = User::query()->where('role', '=', 'A')->first();

        $admin->notify(new AdminNotification($notifyAdmin));

        return redirect()->route('orders.show', [
            'id' => $order->id
        ])->with('success', 'instructions update successfully');
    }

    /**
     * Admin Order Actions - app/Actions
     */
    public function actions(Request $request, $id)
    {
        $action = $request->input('action');
        $order = Order::where('id', $id)->with('user')->first();

        try {
            if ($action === 'cancel') {
                Cancel::run(order: $order, request: $request);
            } elseif ($action === 'complete') {
                Complete::run(order: $order, request: $request);
            } elseif ($action === 'revision') {
                Revision::run(order: $order, request: $request);
            } elseif ($action === 'dispute') {
                Dispute::run(order: $order, request: $request);
            } elseif ($action === 'extend') {
                Extend::run(order: $order, request: $request);
            } elseif ($action === 'assign') {
                Assign::run(order: $order, request: $request);
            } elseif ($action === 'upload') {
                UploadFile::run(order: $order, request: $request);
            }
        } catch (\Exception $exception) {
            return back('500')->with('Error', "An error occurred while processing your request.");
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     */
    public function destroy(int $id): RedirectResponse
    {
        Order::findOrFail($id)
            ->delete();
        return redirect()->route('orders.recents')->with('success', 'Order removed successfully');
    }
}
