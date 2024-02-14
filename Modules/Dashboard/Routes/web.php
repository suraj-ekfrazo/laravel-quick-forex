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

Route::prefix('admin-login/dashboard')->group(function() {
    Route::get('/', 'DashboardController@index')->name('dashboard.index');
    Route::get('/view-kyc-doc/{id}', 'KycAdminController@index')->name('dashboard.viewKyc');
	Route::get('update-single-document-status', 'KycAdminController@updateSingleDocumentStatus')->name('dashboard.kyc-single-update-document-status');
    Route::get('update-kyc', 'KycAdminController@updateDcocument')->name('dashboard.kyc-status');
		Route::post('update-multiple-document-status', 'KycAdminController@updateMultipleDocumentStatus')->name('dashboard.kyc-multiple-update-document-status');

});

Route::prefix('admin-login/dashboard/transactionstatus')->group(function() {
    Route::post('table-json', 'DashboardController@tableTransactionData')->name('transactionstatus.data');
	Route::post('completedTransaction', 'DashboardController@completedTransaction')->name('completedTransaction.data');
    Route::post('export/csv', 'DashboardController@tableDataExport')->name('exportData.csv');
	Route::post('single/csv', 'DashboardController@singleDataExport')->name('singleData.csv');
    Route::post('update/{id}', 'DashboardController@updateDeal')->name('transactionstatus.update');
});




Route::prefix('admin-login/dashboard/')->group(function() {
    Route::get('export', 'DashboardController@export')->name('data.export');
    Route::get('print', 'DashboardController@print')->name('data.print');
});

Route::prefix('admin-login/dashboard/transactionkyc')->group(function() {
    Route::post('table-json', 'KycAdminController@tableData')->name('transactionkyc.data');
    Route::post('update/{id}', 'KycAdminController@store')->name('transactionkyc.update');
});

Route::prefix('admin-login/dashboard/approved-deal')->group(function() {
    Route::post('table-json/all', 'DashboardController@tableApprovedDealData')->name('approvedDeal.data');
});

Route::prefix('admin-login/dashboard/rateblocked')->group(function() {
    Route::post('table-json', 'DashboardController@tableRateBlockedData')->name('rateBlocked.data');
    Route::post('update/{id}', 'DashboardController@updateRateBooking')->name('rateBlocked.update');
});
