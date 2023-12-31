<?php

use App\Http\Controllers\ChatController;
use App\Http\Controllers\ClientActionsController;
use App\Http\Controllers\ClientOrdersController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PayPalPaymentsController;
use App\Http\Controllers\ProfileController;
use App\Models\AcademicLevel;
use App\Models\Currency;
use App\Models\File;
use App\Models\Rate;
use App\Models\ServiceType;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//Route::get('/', function () {
//     return redirect()->route('app-home');
//     // return redirect(env('HOME_URL'));
//})->name('home');

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'levels' => AcademicLevel::all(),
        'currencies' => Currency::all(),
        'services' => ServiceType::all(),
        'rates' => Rate::all(),
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
})->name('home');

Route::get('/dashboard', function () {
    // redirect admin
    if (auth()->user()->role === 'A')
    {
        return redirect()->route('admin');
    }

    $orders = \App\Models\Order::query()
        ->where('user_id', '=', auth()->user()->id)
        ->latest()
        ->get();
    return Inertia::render('Dashboard', [
        'orders' => $orders
    ]);
})->middleware(['auth', 'verified'])->name('dashboard');

// new order form - guest
Route::get('/orders/new', [ClientOrdersController::class, 'create'])->name('orders.new');
Route::post('/orders/new', [ClientOrdersController::class, 'store'])->name('orders.store');

// registered user routes
Route::middleware('auth')->group(function () {
    // chats
    Route::get('/chats', [ChatController::class, 'index'])->name('chats.index');
    Route::post('/chats/new', [ChatController::class, 'store'])->name('chats.store');
    // messages
    Route::post('/messages/{chat}', [MessageController::class, 'showMessages'])->name('messages.show');
    Route::get('/messages', [MessageController::class, 'index'])->name('messages.index');
    Route::post('/messages/new', [MessageController::class, 'store'])->name('messages.create');
    // profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // upload file
    Route::post('orders/order/{id}/upload-file', [OrderController::class, 'uploadFiles'])
        ->name('order.submit-files');
    // download file
    Route::get('admin/orders/file/{id}', function ($id) {
        $file = File::findOrFail($id);
        $path2 = Storage::disk('local')->path('orders\\'.$file->name);
        return response()->download($path2);
    })->name('files.download');

    Route::controller(ClientOrdersController::class)->group(function () {
        // Route::get('/orders/new', 'create')->name('orders.new');
        Route::get('orders', 'index')->name('client.orders');
        Route::get('orders/order/{id}', 'show')->name('orders.show');
        Route::get('orders/preview/{id}', 'preview')->name('orders.preview');
        // show orders list based on status
        Route::get('/orders/recents', 'index')->name('orders.recents');
        Route::get('/orders/cancelled', 'index')->name('orders.cancelled');
        Route::get('/orders/submitted', 'index')->name('orders.submitted');
        Route::get('/orders/running', 'index')->name('orders.running');
        Route::get('/orders/completed', 'index')->name('orders.completed');
        Route::get('/orders/revision', 'index')->name('orders.revision');
        Route::get('/orders/disputed', 'index')->name('orders.disputed');
        Route::get('/orders/pending', 'index')->name('orders.pending');
        // delete
        Route::delete('/orders/order/{id}', 'destroy')->name('orders.delete');
    });

    Route::controller(ClientActionsController::class)->group(function () {
        Route::patch('/orders/order/complete/{id}', 'actions')->name('orders.complete');
        Route::post('/orders/order/revision/{id}', 'actions')->name('orders.revisionRequest');
        Route::patch('/orders/order/extend/{id}', 'actions')->name('orders.extend');
        Route::patch('/orders/order/dispute/{id}', 'actions')->name('orders.dispute');
        Route::post('orders/order/{id}/upload-file', 'uploadFiles')->name('orders.upload-file');
    });
});

Route::controller(PayPalPaymentsController::class)->group(function () {
    Route::get('/orders/order/make-payment/{id}', 'pay')->name('make-payment');
    Route::get('/orders/order/cancel-payment/{id}', 'cancel')->name('cancel-payment');
    Route::get('/orders/order/payment-success/{id}', 'success')->name('payment-success');
})->middleware('auth');

require __DIR__.'/admin.php';
require __DIR__.'/auth.php';
