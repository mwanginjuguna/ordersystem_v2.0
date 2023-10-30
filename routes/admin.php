<?php

use App\Http\Controllers\AcademicLevelController;
use App\Http\Controllers\CurrencyController;
use App\Http\Controllers\DiscountController;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\RateController;
use App\Http\Controllers\ServiceTypeController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\WriterCategoryController;
use App\Models\File;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;

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
