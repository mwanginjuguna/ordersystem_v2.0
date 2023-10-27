<?php

namespace App\Http\Controllers;

use App\Actions\Notify\Admin\OrderNew;
use App\Actions\Order\UploadFile;
use App\Jobs\SendOrderReceivedEmailJob;
use App\Mail\OrderAction;
use App\Mail\OrderReceived;
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
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;
use Inertia\Response;

class ClientOrdersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        // all orders belonging to this client
        $clientId = auth()->user()->id;
        $clientOrders = Order::query()
            ->where('user_id', '=', $clientId)
            ->where('status', '=', 'running')
            ->latest()->get();
        return Inertia::render('ClientOrders/OrdersInProgress', ['orders' => $clientOrders]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function pending()
    {
        //
        if (auth()->user()->role === 'A') {
            return redirect()->route('admin.orders.pending');
        }

        return Inertia::render('ClientOrders/OrdersPending', [
            'pendingOrders' => Order::query()
                ->where('user_id', '=', auth()->user()->id)
                ->where('status', '=', 'pending')
                ->latest()
                ->get()
        ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function recents()
    {
        //
        if (auth()->user()->role === 'A') {
            return redirect()->route('admin.orders.recents');
        }
        return Inertia::render('ClientOrders/OrdersRecent', [
            'recents' => Order::query()
                ->where('user_id', '=', auth()->user()->id)
                ->where('status', '=', 'new')
                ->latest()
                ->get()
        ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function submitted()
    {
        //
        if (auth()->user()->role === 'A') {
            return redirect()->route('admin.orders.submitted');
        }
        return Inertia::render('ClientOrders/OrdersSubmitted', [
            'submittedOrders' => Order::query()
                ->where('user_id', '=', auth()->user()->id)
                ->where('status', '=', 'submitted')
                ->latest()
                ->get()
        ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function running()
    {
        //
        if (auth()->user()->role === 'A') {
            return redirect()->route('admin.orders.running');
        }
        return Inertia::render('ClientOrders/OrdersInProgress', [
            'runningOrders' => Order::query()
                ->where('user_id', '=', auth()->user()->id)
                ->where('status', '=', 'running')
                ->latest()
                ->get()
        ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function completed(Request $request)
    {
        //
        if (auth()->user()->role === 'A') {
            return redirect()->route('admin.orders.completed');
        }

        return Inertia::render('ClientOrders/OrdersCompleted', [
            'completedOrders' => Order::query()
                ->where('user_id', '=', auth()->user()->id)
                ->where('status', '=', 'complete')
                ->latest()
                ->get()
        ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function cancelled()
    {
        //
        if (auth()->user()->role === 'A') {
            return redirect()->route('admin.orders.cancelled');
        }

        return Inertia::render('ClientOrders/OrdersCancelled', [
            'cancelledOrders' => Order::query()
                ->where('user_id', '=', auth()->user()->id)
                ->where('status', '=', 'cancelled')
                ->latest()
                ->get()
        ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function revision()
    {
        //
        if (auth()->user()->role === 'A') {
            return redirect()->route('admin.orders.revision');
        }
        return Inertia::render('ClientOrders/OrdersInRevision', [
            'revisionOrders' => Order::query()
                ->where('user_id', '=', auth()->user()->id)
                ->where('status', '=', 'revision')
                ->latest()
                ->get()
        ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function disputed()
    {
        //
        if (auth()->user()->role === 'A') {
            return redirect()->route('admin.orders.disputed');
        }

        return Inertia::render('ClientOrders/OrdersDisputed', [
            'disputedOrders' => Order::query()
                ->where('user_id', '=', auth()->user()->id)
                ->where('status', '=', 'disputed')
                ->latest()
                ->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     */
    public function create(): Response
    {
        // new order form
        return Inertia::render('ClientOrders/OrderNew', [
            'order' => new Order(),
            'levels' => AcademicLevel::all(),
            'subjects' => Subject::all(),
            'services' => ServiceType::all(),
            'rates' => Rate::all(),
            'styles' => ReferencingStyle::all(),
            'spacings' => Spacing::all(),
            'writerCategories' => WriterCategory::all(),
            'extras' => AdditionalFeatures::all(),
            'languages' => Language::all(),
            'currencies' => Currency::all(),
            'discounts' => Discount::query()->where('active', '=', '1')->get(),
        ]);
    }

    /**
     * Show the form for creating a new APIresource.
     *
     * @return JsonResponse
     */
    public function createApi(): JsonResponse
    {
        // new order form
        return response()->json([
            'order' => new Order(),
            'levels' => AcademicLevel::all(),
            'subjects' => Subject::all(),
            'services' => ServiceType::all(),
            'rates' => Rate::all(),
            'styles' => ReferencingStyle::all(),
            'spacings' => Spacing::all(),
            'writerCategories' => WriterCategory::all(),
            'extras' => AdditionalFeatures::all(),
            'languages' => Language::all(),
            'currencies' => Currency::all(),
            'discounts' => Discount::query()->where('active', '=', '1')->get(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        // validate and save
        $request->validate([
            'title' => 'required',
            'deadline' => 'required']);

        // check if the user is authenticated - login or register users
        if (!Auth::check()) {
            if (!$request->name) {
                $credentials = $request->validate([
                    'email' => ['required', 'email'],
                    'password' => ['required'],
                ]);

                // login
                if (Auth::attempt($credentials)) {
                    $request->session()->regenerate();
                }
            } else {

                // register
                $request->validate([
                    'name' => 'required|string|max:255',
                    'email' => 'required|string|email|max:255|unique:'.User::class,
                    'password' => ['required', 'confirmed', Rules\Password::defaults()],
                ]);

                $user = User::create([
                    'name' => $request->name,
                    'email' => $request->email,
                    'password' => Hash::make($request->password),
                ]);

                event(new Registered($user));

                // authenticate
                Auth::login($user);
            }
        }

        // create new order
        $order = new Order(
            $request->validate([
                'title' => 'required',
                'deadline' => 'required',
                "service_type_id"=> '',
                "academic_level_id"=> '',
                "subject_id"=> '',
                "instructions"=> '',
                "pages"=> '',
                "slides"=> '',
                "sources"=> '',
                "spacing_id"=> '',
                "referencing_style_id"=> '',
                "language_id"=> '',
                "writer_category_id"=> '',
                "amount"=> '',
                "currency_id"=> '',
                "cpp"=> '',
                "discount_id"=> '',
                "paid"=> ''
            ])
        );

        $order->user_id = auth()->user()->id;
        $order->amount_due = $request->amount;

        $order->due_at = Carbon::now()->addHours($order->deadline);
        $order->save();

        // save order files
        (new UploadFile())->run(order: $order, request: $request);

        // send emails
        (new OrderNew($order))->notify();

        Mail::to($request->user())->queue(
            mailable: new OrderReceived($order)
        );

        // dispatch(new SendOrderReceivedEmailJob(user: $request->user(), order: $order));
        if (auth()->user()->role === 'A') {
            return redirect()->route('admin.orders.pending')->with('success', 'Order added successfully');
        }

        return redirect()->route('orders.preview', [$order->id])
            ->with('success', 'Order added successfully.
            Complete Payment for Our experts to start working on it immediately.');
    }

    /**
     * Display the payment checkout page for an order.
     *
     * @param  int  $id
     * @return Response
     */
    public function preview($id)
    {
        // view an order
        if (auth()->user()->role === 'A') {
            return redirect()->route('admin.orders.show', $id);
        }

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

        $currency = Currency::query()
            ->where('id', '=', $order->currency_id)
            ->pluck('name')
            ->first();

        $deadline = Carbon::create($order->due_at)->diffForHumans(parts: 2);

        $files = File::query()
            ->where('order_id', '=', $order->id)
            ->latest()->get();

        return Inertia::render('ClientOrders/OrderPreview', [
            'order' => $order, 'level' => $level,
            'subject' => $subject, 'service' => $service,
            'spacing' => $spacing, 'style' => $refStyle,
            'language' => $language, 'writerCategory' => $writerCategory,
            'user' => $user, 'discount' => $discount,
            'writer' => $writer ?? null,
            'deadline' => $deadline,
            'files' => $files,
            'currencySymbol' => $currencySymbol,
            'currency' => $currency,
            'discountAmount' => $discountAmount
        ]);
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
        if (auth()->user()->role === 'A') {
            return redirect()->route('admin.orders.show', $id);
        }

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

        $deadline = Carbon::create($order->due_at)->diffForHumans(parts: 2);
        $files = File::query()
            ->where('order_id', '=', $order->id)
            ->latest()->get();


        return Inertia::render('ClientOrders/OrderView', [
            'order' => $order, 'level' => $level,
            'subject' => $subject, 'service' => $service,
            'spacing' => $spacing, 'style' => $refStyle,
            'language' => $language, 'writerCategory' => $writerCategory,
            'user' => $user, 'discount' => $discount,
            'writer' => $writer ?? null,
            'deadline' => $deadline,
            'files' => $files,
            'currencySymbol' => $currencySymbol,
            'discountAmount' => $discountAmount
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Upload files.
     *
     * @param Request $request
     * @param  int  $id
     * @return RedirectResponse
     */
    public function uploadFiles(Request $request, $id): RedirectResponse
    {
        $order = Order::findOrFail($id);

        (new UploadFile())->run(order: $order, request: $request);

        return redirect()->back()->with('success', 'New File Upload was successful.');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param int $id
     * @return RedirectResponse
     */
    public function markCompleted(Request $request, int $id): RedirectResponse
    {
        $order = Order::findOrFail($id);
        if (auth()->user()->role === 'A') {
            return redirect()->route('admin.orders.complete', $order->id);
        }

        $order->status = "complete";
        $order->review = $request->get('review');
        $order->rating = $request->get('stars');
        $order->completed_at = now();
        $order->save();

        $user = User::query()->where('id', $order->user_id)->first();

        Mail::to($user)->queue(new OrderAction(data: [
            'actionTitle' => 'Order marked as complete (#'.$order->id.')',
            'orderAction' => 'Order Completed',
            'orderId' => $order->id
        ]));


        $notifyAdmin = [
            'orderId' => $order->id,
            'username' => \auth()->user()->name,
            'title' => 'Order #'.$order->id.' Completed.',
            'content' => 'An order has been marked Complete.
            Order #'.$order->id.' by '.\auth()->user()->name.'.',
            'url' => route('orders.show', $order->id),
            'action' => 'View Order'
        ];
        $admin = User::query()->where('role', '=', 'A')->first();

        $admin->notify(new AdminNotification($notifyAdmin));

        return redirect()->route('orders.completed')->with('success', 'Order completed');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Order $order
     * @return RedirectResponse
     */
    public function extendDeadline(Request $request, Order $order): RedirectResponse
    {
        //
        $order->deadline += $request->hours;
        $order->save();
        $notifyAdmin = [
            'orderId' => $order->id,
            'username' => \auth()->user()->name,
            'title' => 'Deadline Changed - Order #'.$order->id,
            'content' => 'The client has adjusted the deadline of an existing order.
            Order #'.$order->id.' by '.\auth()->user()->name.'.',
            'url' => route('orders.show', $order->id),
            'action' => 'View Order'
        ];

        $admin = User::query()->where('role', '=', 'A')->first();

        $admin->notify(new AdminNotification($notifyAdmin));

        return redirect()->route('orders.running')->with('success', 'deadline update successfully');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param  int  $id
     * @return RedirectResponse
     */
    public function disputeOrder(Request $request, $id)
    {
        //
        $order = Order::findOrFail($id);
        $order->status = "disputed";
        $order->cancel_reason = $request->cancel_reason;
        $order->save();

        $user = User::query()->where('id', $order->user_id)->first();
        Mail::to($user)->queue(new OrderAction(data: [
            'actionTitle' => 'New Dispute for order #'.$order->id,
            'orderAction' => 'Order Disputed',
            'orderId' => $order->id
        ]));

        $notifyAdmin = [
            'orderId' => $order->id,
            'username' => \auth()->user()->name,
            'title' => 'New Dispute! - Order #'.$order->id,
            'content' => 'An order has been disputed.
            Order #'.$order->id.' by '.\auth()->user()->name.'.',
            'url' => route('orders.show', $order->id),
            'action' => 'View Order'
        ];

        $admin = User::query()->where('role', '=', 'A')->first();

        $admin->notify(new AdminNotification($notifyAdmin));

        return redirect()->route('orders.disputed')
            ->with('success', 'Dispute issued!! We will get back to you shortly with a resolution.');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Order $order
     * @return RedirectResponse
     */
    public function requestRevision(Request $request, Order $order)
    {
        // update order
        $order->status = "revision";
        $order->revision_instructions = $request->revision_instructions;
        $order->save();

        $data = [
            'orderId' => $order->id,
            'orderAction' => 'Order Revision.',
            'actionTitle' => 'Order Revision Request for Order Number #'.$order->id
        ];

        Mail::to(auth()->user())->queue(new OrderAction($data));

        $notifyAdmin = [
            'orderId' => $order->id,
            'username' => auth()->user()->name,
            'title' => 'New Revision Request! - Order #'.$order->id,
            'content' => 'The client has requested a revision.
            Order #'.$order->id.' by '.auth()->user()->name.'.',
            'url' => route('orders.show', $order->id),
            'action' => 'View Order'
        ];

        $admin = User::query()->where('role', '=', 'A')->first();

        $admin->notify(new AdminNotification($notifyAdmin));

        return redirect()->route('orders.revision')
            ->with('success', 'Revision request received. Our writer will start working on it now.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Order $order
     * @return RedirectResponse
     */
    public function destroy(Order $order)
    {
        //
        $order->delete();
        return redirect()->route('orders.recents')->with('success', 'Order removed successfully');
    }
}
