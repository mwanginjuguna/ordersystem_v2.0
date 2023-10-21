<?php

use App\Http\Controllers\ChatController;
use App\Http\Controllers\ClientOrdersController;
use App\Http\Controllers\CurrencyController;
use App\Http\Controllers\DiscountController;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RateController;
use App\Http\Controllers\WriterCategoryController;
use App\Models\AcademicLevel;
use App\Models\Currency;
use App\Models\File;
use App\Models\Rate;
use App\Models\ServiceType;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;
use App\Http\Controllers\AcademicLevelController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\ServiceTypeController;

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

Route::get('/', function () {
     return redirect()->route('app-home');
     // return redirect(env('HOME_URL'));
})->name('home');

Route::get('/home', function () {
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
})->name('app-home');

Route::get('/dashboard', function () {
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

Route::get('/admin', function () {
    $orders = \App\Models\Order::query()
        ->latest()->get();
    return Inertia::render('Admin/Index', [
        'orders' => $orders
    ]);
})->name('admin')->middleware('admin');

// admin routes
Route::middleware('admin')->group( function () {
    Route::name('admin.')->group(function () {
        Route::controller(AcademicLevelController::class)->group(function () {
            Route::get('/admin/levels', 'index')->name('levels');
            Route::post('/admin/levels', 'store')->name('levels.add');
            Route::delete('/admin/levels/{id}', 'destroy')->name('levels.delete');
        });

        Route::controller( SubjectController::class)->group(function () {
            Route::get('/admin/subjects', 'index')->name('subjects');
            Route::post('/admin/subjects', 'store')->name('subjects.add');
            Route::delete('/admin/subjects/{id}', 'destroy')->name('subject');
        });

        Route::controller( ServiceTypeController::class)->group(function () {
            Route::get('/admin/services', 'index')->name('services');
            Route::post('/admin/services', 'store')->name('services.add');
            Route::delete('/admin/services/{id}', 'destroy')->name('service');
        });

        Route::controller( \App\Http\Controllers\SpacingController::class)->group(function () {
            Route::get('/admin/spacings', 'index')->name('spacings');
            Route::post('/admin/spacings', 'store')->name('spacings.add');
            Route::delete('/admin/spacings/{id}', 'destroy')->name('spacing');
        });

        Route::controller( \App\Http\Controllers\ReferencingStyleController::class)->group(function () {
            Route::get('/admin/styles', 'index')->name('styles');
            Route::post('/admin/styles', 'store')->name('styles.add');
            Route::delete('/admin/styles/{id}', 'destroy')->name('style');
        });

        Route::controller( \App\Http\Controllers\AdditionalFeaturesController::class)->group(function () {
            Route::get('/admin/extras', 'index')->name('extras');
            Route::post('/admin/extras', 'store')->name('extras.add');
            Route::delete('/admin/extras/{id}', 'destroy')->name('extra');
        });

        Route::controller( LanguageController::class)->group(function () {
            Route::get('/admin/languages', 'index')->name('languages');
            Route::post('/admin/languages', 'store')->name('languages.add');
            Route::delete('/admin/languages/{id}', 'destroy')->name('language');
        });

        Route::controller( RateController::class)->group(function () {
            Route::get('/admin/pricings', 'index')->name('pricings');
            Route::post('/admin/pricings', 'store')->name('pricings.add');
            Route::delete('/admin/pricing/{id}', 'destroy')->name('pricing');
        });

        Route::controller( CurrencyController::class)->group(function () {
            Route::get('/admin/currencies', 'index')->name('currencies');
            Route::post('/admin/currencies', 'store')->name('currencies.add');
            Route::delete('/admin/currencies/{id}', 'destroy')->name('currency');
        });

        Route::controller(DiscountController::class)->group(function () {
            Route::get('/admin/discounts', 'index')->name('discounts');
            Route::post('/admin/discounts', 'store')->name('discounts.add');
            Route::delete('/admin/discounts/{id}', 'destroy')->name('discount');
        });

        Route::controller(WriterCategoryController::class)->group(function () {
            Route::get('/admin/writer_categories', 'index')->name('writer_categories');
            Route::post('/admin/writer_categories', 'store')->name('writer_categories.add');
            Route::delete('/admin/writer_category/{id}', 'destroy')->name('writer_category');
        });
        // Admin Orders
        Route::controller(OrderController::class)->group(function () {
            Route::post('/admin/orders/new', 'store')->name('orders.new');
            Route::get('/admin/orders/order/{id}', 'show')->name('orders.show');
            Route::post('/admin/orders/order/{id}', 'update')->name('orders.update');
            Route::post('admin/orders/order/{id}/delete-file', 'destroyFile')->name('destroyFile');
            Route::get('admin/orders/file/{id}', function ($id) {
                $file = File::findOrFail($id);
                $path2 = Storage::disk('local')->path('orders\\'.$file->name);
                return response()->download($path2);
            })->name('files.download');

            // actions
            Route::post('admin/orders/order/{id}/upload-file', 'actions')->name('orders.upload-file');
            Route::patch('/admin/orders/order/complete/{id}', 'actions')->name('orders.complete');
            Route::patch('/admin/orders/order/cancel/{id}', 'actions')->name('orders.cancel')
                ->middleware('admin');
            Route::post('admin/orders/order/show-file-to-client/{id}/', 'showClient')->name('showClient');
            Route::post('/admin/orders/order/revision/{id}', 'actions')->name('orders.revisionRequest');
            Route::patch('/admin/orders/order/extend/{id}', 'actions')->name('orders.extend');
            Route::patch('/admin/orders/order/assign/{id}', 'actions')->name('orders.assign');
            Route::patch('/admin/orders/order/dispute/{id}', 'actions')->name('orders.dispute');
            Route::delete('/admin/orders/order/{id}', 'destroy')->name('orders.delete');
            Route::get('/admin/orders/recents', 'index')->name('orders.recents');
            Route::get('/admin/orders/cancelled', 'index')->name('orders.cancelled');
            Route::get('/admin/orders/submitted', 'index')->name('orders.submitted');
            Route::get('/admin/orders/running', 'index')->name('orders.running');
            Route::get('/admin/orders/completed', 'index')->name('orders.completed');
            Route::get('/admin/orders/revision', 'index')->name('orders.revision');
            Route::get('/admin/orders/disputed', 'index')->name('orders.disputed');
            Route::get('/admin/orders/pending', 'index')->name('orders.pending');
        });
    });
});

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

    Route::post(
        'orders/order/{id}/upload-file',
        [OrderController::class, 'uploadFiles'])
        ->name('order.submit-files');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::controller(ClientOrdersController::class)->group(function () {
        // Route::get('/orders/new', 'create')->name('orders.new');
        Route::get('orders', 'index')->name('client.orders');
        Route::get('orders/order/{id}', 'show')->name('orders.show');
        Route::get('orders/preview/{id}', 'preview')->name('orders.preview');
        Route::post('orders/order/{id}/upload-file', 'uploadFiles')->name('orders.upload-file');
        Route::get('admin/orders/file/{id}', function ($id) {
            $file = File::findOrFail($id);
            $path2 = Storage::disk('local')->path('orders\\'.$file->name);
            return response()->download($path2);
        })->name('files.download');

        Route::patch('/orders/order/complete/{id}', 'markCompleted')->name('orders.complete');
        Route::post('/orders/order/revision/{id}', 'requestRevision')->name('orders.revisionRequest');
        Route::patch('/orders/order/extend/{id}', 'extendDeadline')->name('orders.extend');
        Route::patch('/orders/order/dispute/{id}', 'disputeOrder')->name('orders.dispute');
        Route::get('/orders/recents', 'recents')->name('orders.recents');
        Route::delete('/orders/order/{id}', 'destroy')->name('orders.delete');
        Route::get('/orders/cancelled', 'cancelled')->name('orders.cancelled');
        Route::get('/orders/submitted', 'submitted')->name('orders.submitted');
        Route::get('/orders/running', 'running')->name('orders.running');
        Route::get('/orders/completed', 'completed')->name('orders.completed');
        Route::get('/orders/revision', 'revision')->name('orders.revision');
        Route::get('/orders/disputed', 'disputed')->name('orders.disputed');
        Route::get('/orders/pending', 'pending')->name('orders.pending');
    });

});

Route::controller(\App\Http\Controllers\PayPalPaymentsController::class)->group(function () {
    Route::get('/orders/order/make-payment/{id}', 'pay')->name('make-payment');
    Route::get('/orders/order/cancel-payment/{id}', 'cancel')->name('cancel-payment');
    Route::get('/orders/order/payment-success/{id}', 'success')->name('payment-success');
})->middleware('auth');

require __DIR__.'/auth.php';
