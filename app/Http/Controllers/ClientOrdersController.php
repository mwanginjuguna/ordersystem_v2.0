<?php

namespace App\Http\Controllers;

use App\Actions\Notify\Admin\OrderNew;
use App\Actions\Order\UploadFile;
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
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Inertia\Inertia;
use Inertia\Response;

class ClientOrdersController extends Controller
{
    public function adminCheck($id = 0, $routeName='admin')
    {
        $id !== 0 ? $params = $id : $params = [];

        if (auth()->user()->role === 'A') {
            return redirect()->route($routeName, $params);
        }
    }

    public function isAdmin(): bool
    {
        return auth()->user()->role === 'A';
    }

    /**
     * Display a listing of the resource.
     *
     */
    public function index(Request $request): Response
    {
        // all orders belonging to this client
        $this->adminCheck();

        $url = $request->url();

        $statusMappings = [
            "pending" => ['status' => "pending", 'description' => 'Orders not paid or on-hold.'],
            "recents" => ['status' => "new", 'description' => 'Your recently placed Orders. New orders.'],
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

        $orders = $statusInfo ?
            Order::query()->where('status', $statusInfo['status'])
                ->where('user_id', \auth()->user()->id)
                ->latest()->get() :
            Order::query()->where('user_id', \auth()->user()->id)->latest()->get();

        $segment = $segment === 'recents' ? 'New' : ucfirst($segment);

        $info = $statusInfo ? [
            'title' => $segment.' Orders: - '. config('app.website_name'),
            'subtitle' => $segment.' Orders',
            'description' => $statusInfo['description']
        ] : [];

        return Inertia::render('ClientOrders/OrdersList', [
            'orders' => $orders,
            'info' => $info
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
        $this->adminCheck(routeName: 'admin.orders.pending');

        return redirect()->route('orders.preview', [$order->id])
            ->with('success', 'Order added successfully.
            Complete Payment for Our experts to start working on it immediately.');
    }

    /**
     * Display the payment checkout page for an order.
     *
     */
    public function preview($id): Response
    {
        // view an order
        if ($this->isAdmin()) {
            return redirect()->route('admin.orders.show', $id);
        }

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
                'currency:id,symbol,name',
                'files'
            ])
            ->first();

        $writer = User::query()
            ->where('id', '=', $order->assigned_to)
            ->pluck('name')
            ->first();

        $deadline = Carbon::create($order->due_at)->diffForHumans(parts: 2);

        return Inertia::render('ClientOrders/OrderPreview', [
            'order' => $order,
            'level' => $order->academicLevel->name,
            'subject' => $order->subject->name,
            'service' => $order->serviceType->name,
            'spacing' => $order->spacing->name,
            'style' => $order->referencingStyle->name,
            'language' => $order->language->name,
            'writerCategory' => $order->writerCategory->name,
            'user' => $order->user->name,
            'discount' => $order->discount->code,
            'writer' => $writer ?? null,
            'deadline' => $deadline,
            'files' => $order->files ?? [],
            'currencySymbol' => $order->currency->symbol,
            'discountAmount' => $order->discount->rate,
            'currency' => $order->currency->name,
        ]);
    }

    /**
     * Display the specified resource.
     *
     */
    public function show(int $id): Response|RedirectResponse
    {
        // view an order
        if ($this->isAdmin()) {
            return redirect()->route('admin.orders.show', $id);
        }
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

        $writer = User::query()
            ->where('id', '=', $order->assigned_to)
            ->pluck('name')
            ->first();

        $files = File::query()
            ->where('order_id', '=', $order->id)
            ->latest()->get();

        $deadline = Carbon::create($order->due_at)->diffForHumans(parts: 2);

        return Inertia::render('ClientOrders/OrderView', [
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
            'deadline' => $deadline,
            'files' => $files ?? [],
            'currencySymbol' => $order->currency->symbol ?? '',
            'discountAmount' => $order->discount->rate ?? ''
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     */
    public function destroy(Order $order): RedirectResponse
    {
        //
        $order->delete();
        return redirect()->route('orders.recents')->with('success', 'Order removed successfully');
    }
}
