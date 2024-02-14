<?php

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

Route::prefix('admin-login/transaction')->group(function() {
    Route::get('/', 'TransactionController@index')->name('agent-transaction.index');
});

Route::prefix('admin-login/rateBooking')->group(function() {
    Route::post('table-json', 'RateBookingController@tableData')->name('rate-booking.data');
});

Route::prefix('admin-login/payment')->group(function() {
    Route::post('table-json', 'PaymentController@tableData')->name('admin-payment.data');
    Route::get('editPayment/{id}', 'PaymentController@editPayment')->name('admin-edit.payment');
    Route::get('get-transaction-detail/{id}', 'PaymentController@getTransactionDetail')->name('admin-transaction-kyc.payment');
	Route::post('update-payment', 'PaymentController@updatePayment')->name('payment.update');
});
