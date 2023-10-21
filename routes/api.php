<?php

use App\Http\Controllers\ClientOrdersController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\OrderMessageController;
use App\Http\Controllers\PayPalPaymentsController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// initialize Order
Route::get('/api/orders/new', [ClientOrdersController::class, 'createApi'])->name('api.newOrder');
Route::post('/api/orders', [ClientOrdersController::class, 'storeApi'])->name('api.saveOrder');

Route::group(['prefix'=>'paypal'], function () {

    Route::post('/order/{id}/pay', [PayPalPaymentsController::class, 'pay'])
        ->name('paypal.pay');

    Route::post('/order/capture/{id}', [PayPalPaymentsController::class, 'capture'])
        ->name('paypal.capture');

});

Route::group( [ 'prefix' => 'order-messages' ], function () {
    Route::post('/{id}/message', [OrderMessageController::class, 'messagesCreate'])
        ->name('send.message');
    Route::post('/{id}/messages', [OrderMessageController::class, 'messagesIndex'])
        ->name('show.messages');
});

Route::post('/emails/send-order-received', ['']);
