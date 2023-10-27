<?php

namespace App\Http\Controllers;

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
//        $relationships = [
//            'levels',
//            'subjects',
//            'services',
//            'rates',
//            'styles',
//            'spacings',
//            'writerCategories',
//            'languages',
//            'currencies',
//            'discounts'
//        ];
//        $data = Order::with($relationships);
        $dbQuery = DB::query()
            ->from('academic_levels', 'levels')
            ->from('subjects', 'subjects')
            ->from('service_types', 'services')
            ->from('rates', 'rates')
            ->from('referencing_styles', 'styles')
            ->from('spacings', 'spacings')
            ->from('writer_categories', 'writerCategories')
            ->from('languages', 'languages')
            ->from('currencies', 'currencies')
            ->from('discounts', 'discounts')
            ->from('additional_features', 'extras')
            ->get();

        $order = new Order();

        // new order form
        return Inertia::render('Orders/OrderNew', [
            'order' => $order,
            'data' => $dbQuery
        ]);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request)
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
        foreach ($request->files as $file) {
            $filename = auth()->id().'_'.$file->getClientOriginalName();
            $newFile = new File([
                'order_id' => $order->id,
                'name' => $filename,
                'location' => Storage::putFileAs('orders', $file, $filename)
            ]);
            $newFile->save();
        }

        $notifyAdmin = [
            'orderId' => $order->id,
            'username' => auth()->user()->name,
            'title' => 'New Order #'.$order->id,
            'content' => 'New Order added. Order #'.$order->id.' by '.auth()->user()->name.'.',
            'url' => route('orders.show', $order->id),
            'action' => 'View Order'
        ];
        $admin = User::query()->where('role', '=', 'A')->first();

        $admin->notify(new AdminNotification($notifyAdmin));

        return redirect()->route('orders.recents')->with('success', 'Order added successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        // view an order
        $order = Order::findOrFail($id);
        $authUserRole = \auth()->user()->role;

        if (($order->status === 'new' || $order->status === 'pending') && $authUserRole === 'A')
        {
            $writers = User::query()
                ->where('role', '=', 'W')
                ->get();
        }


        $level = AcademicLevel::query()
            ->where('id', '=', $order->academic_level_id)
            ->pluck('name')
            ->first();

        $subject = Subject::query()
            ->where('id', '=', $order->subject_id)
            ->pluck('name')
            ->first();
        $service = ServiceType::query()
            ->where('id', '=', $order->service_type_id)
            ->pluck('name')
            ->first();
        $spacing = Spacing::query()
            ->where('id', '=', $order->spacing_id)
            ->pluck('name')
            ->first();
        $refStyle = ReferencingStyle::query()
            ->where('id', '=', $order->referencing_style_id)
            ->pluck('name')
            ->first();
        $language = Language::query()
            ->where('id', '=', $order->language_id)
            ->pluck('name')
            ->first();
        $writerCategory = WriterCategory::query()
            ->where('id', '=', $order->writer_category_id)
            ->pluck('name')
            ->first();
        $user = User::query()
            ->where('id', '=', $order->user_id)
            ->pluck('name')
            ->first();
        $writer = User::query()
            ->where('id', '=', $order->assigned_to)
            ->pluck('name')
            ->first();
        $discount = Discount::query()
            ->where('id', '=', $order->discount_id)
            ->pluck('code')
            ->first();
        $discountAmount = Discount::query()
                    ->where('id', '=', $order->discount_id)
                    ->pluck('rate')
                    ->first();
        $currencySymbol = Currency::query()
            ->where('id', '=', $order->currency_id)
            ->pluck('symbol')
            ->first();

        $deadline = Carbon::create($order->due_at)->diffForHumans(parts: 3);
        $files = File::query()
            ->where('order_id', '=', $order->id)
            ->latest()->get();

        return Inertia::render('Admin/ViewOrder', [
            'order' => $order, 'level' => $level,
            'subject' => $subject, 'service' => $service,
            'spacing' => $spacing, 'style' => $refStyle,
            'language' => $language, 'writerCategory' => $writerCategory,
            'user' => $user, 'discount' => $discount,
            'writers' => $writers ?? null,
            'writer' => $writer ?? null,
            'deadline' => $deadline,
            'discountAmount' => $discountAmount,
            'currencySymbol' => $currencySymbol,
            'files' => $files
        ]);
    }

    /**
     * @param $id
     * @return StreamedResponse
     */
    public function downloadFile($id): StreamedResponse
    {
        $file = File::findOrFail($id);
        return Storage::download($file->location);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Order $order
     * @return Response
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
     * @param int $fileId
     * @return JsonResponse
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
     *
     * @param File $file
     * @return JsonResponse
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
     *
     * @param Request $request
     * @param Order $order
     * @return RedirectResponse
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
     * Order Actions - app/Actions
     */
    public function actions(Request $request, $id)
    {
        $action = $request->input('action');
        $order = Order::findOrFail($id);

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
     * @param  int  $id
     * @return RedirectResponse
     */
    public function destroy($id)
    {
        //
        Order::findOrFail($id)
            ->delete();
        return redirect()->route('orders.recents')->with('success', 'Order removed successfully');
    }
}
