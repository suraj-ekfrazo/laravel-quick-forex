<?php

use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\LoginController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Dashboard\KycController;
use App\Http\Controllers\Auth\SignzyApiController;

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

Route::get('/', [LoginController::class, 'showCommonLoginForm'])->name('showCommonLoginForm');
Route::get('/branch-login', [LoginController::class, 'showLoginForm'])->name('showLoginForm');
Route::post('/login', [LoginController::class, 'authenticate'])->name('login');
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

/* Forgot Password Route */
Route::get('/forgot-password', [ForgotPasswordController::class, 'forgotPwd'])->name('forgot-password');
Route::post('/send-forgot', [ForgotPasswordController::class, 'sendForgotLink'])->name('forgot');
Route::get('/reset-password/{token}', [ForgotPasswordController::class, 'showResetPasswordForm'])->name('agent.passwords.reset');
Route::post('reset-password', [ForgotPasswordController::class, 'submitResetPasswordForm'])->name('reset.password.post');

Route::group(['middleware' => ['auth.agentLogin']], function() {
    Route::get('/dashboard', [App\Http\Controllers\Agent\Dashboard::class, 'index'])->name('dashboard');
    Route::get('/customer/add', [App\Http\Controllers\Agent\Dashboard::class, 'customer'])->name('agent-customer.add');
    Route::get('/customer/getList', [App\Http\Controllers\Agent\Dashboard::class, 'getCustomers'])->name('customers.get');
    Route::get('/customer/getMatchList', [App\Http\Controllers\Agent\Dashboard::class, 'getMatchCustomers'])->name('customers.getMatch'); 
    Route::post('/customer/save', [App\Http\Controllers\Agent\Dashboard::class, 'store'])->name('customer.save');
    Route::get('/rate-block/add',[App\Http\Controllers\Agent\Dashboard::class,'rateBlock'])->name('rate-block.add');
    Route::post('rate-block/save',[App\Http\Controllers\Agent\Dashboard::class,'rateBlockSave'])->name('rate-block.save');
    Route::post('/rate-block/getListRateBlock',[\App\Http\Controllers\Agent\Dashboard::class, 'getRateBlock'])->name('rate-block.list');
    Route::post('/transaction/save', [App\Http\Controllers\Agent\Dashboard::class, 'transactionSave'])->name('transaction.save');
    Route::post('/transaction/delete', [App\Http\Controllers\Agent\Dashboard::class, 'transactionStatusDelete'])->name('transactionStatus.delete');
    Route::post('/transaction/changeActDeAct/{id}', [App\Http\Controllers\Agent\Dashboard::class, 'transactionStatusIsactive'])->name('transactionStatus.changeActDeAct');
    Route::post('/deal-rate/edit',[App\Http\Controllers\Dashboard\RateBlockedController::class,'editDealRate'])->name('deal-rate.edit');
    Route::post('/deal-rate/save', [App\Http\Controllers\Dashboard\RateBlockedController::class, 'dealRateSave'])->name('deal-rate.save');
	Route::get('/profile', [App\Http\Controllers\Agent\Dashboard::class, 'profile'])->name('agent.profile');
    Route::post('/profile/save', [App\Http\Controllers\Agent\Dashboard::class, 'profileSave'])->name('profile.save');
    Route::post('/verifyPanCard', [SignzyApiController::class, 'verifyPanCard'])->name('verify.pancard');
    Route::post('/verifyAadhaarCard', [SignzyApiController::class, 'verifyAadhaarCard'])->name('verify.aadhaarcard');
    Route::post('/panAdharLinkStatus', [SignzyApiController::class, 'getPanAdharLinkStatus'])->name('verify.panadharlinkstatus');
    Route::post('/verifyPassport', [SignzyApiController::class, 'verifyPassportDetails'])->name('verify.passportno');
});

Route::prefix('transaction')->middleware('auth.agentLogin')->group(function() {
    Route::post('table-json/all', [App\Http\Controllers\Agent\Dashboard::class, 'tableTransactionStatus'])->name('transaction-all.data');
    Route::post('customer-lrs-doc', [App\Http\Controllers\Agent\Dashboard::class, 'getCustomerLrsDoc'])->name('getCustomerLrs.data');
    Route::post('customer-swift-doc', [App\Http\Controllers\Agent\Dashboard::class, 'getCustomerSwiftDoc'])->name('getCustomerSwift.data');
    Route::post('table-json/kyc', [KycController::class, 'tableData'])->name('transaction-kyc.data');
    Route::get('editKyc/{id}', [KycController::class, 'editKyc'])->name('transaction-edit.kyc');
	Route::get('get-transaction-detail/{id}', [KycController::class, 'getTransactionDetail'])->name('transaction-kyc.detail');
    Route::post('upload', [KycController::class, 'store'])->name('transaction-kyc.upload');
	Route::get('/notifications', [App\Http\Controllers\Agent\Dashboard::class, 'getNotification'])->name('get.notifications');
	Route::post('imageVerification', [KycController::class, 'imageVerification'])->name('image.verification');
    Route::get('transection-export', [KycController::class, 'export'])->name('transection.export');
    Route::get('transection-print', [KycController::class, 'print'])->name('transection-print');
});

Route::prefix('approved-deal')->middleware('auth.agentLogin')->group(function() {
    Route::post('table-json/all', [App\Http\Controllers\Agent\Dashboard::class, 'tableApprovedDeal'])->name('approved-deal.data');
});

Route::prefix('transaction/payment')->middleware('auth.agentLogin')->group(function() {
    Route::post('table-json', [\App\Http\Controllers\Dashboard\PaymentController::class, 'tableData'])->name('agent-payment.data');
    Route::get('editPayment/{id}', [\App\Http\Controllers\Dashboard\PaymentController::class, 'editPayment'])->name('agent-edit.payment');
	Route::post('paymentUpload', [\App\Http\Controllers\Dashboard\PaymentController::class, 'paymentupload'])->name('payment.upload');
});



Route::post('/razorpay/order', [\App\Http\Controllers\Dashboard\RazorpayController::class, 'createOrder'])->name('razorpay.order');
Route::post('/razorpay/payment/callback', [\App\Http\Controllers\Dashboard\RazorpayController::class, 'paymentCallback'])->name('razorpay.payment.callback');
Route::get('/payment',function(){
    return view('razorpay');
});

Route::get('/payment', [\App\Http\Controllers\Dashboard\RazorpayController::class, 'index'])->name('payment.index');
Route::post('/payment', [\App\Http\Controllers\Dashboard\RazorpayController::class, 'processPayment'])->name('payment.process');
Route::post('/changePaymentStatus', [\App\Http\Controllers\Dashboard\RazorpayController::class, 'changePaymentStatus'])->name('changepayment.status');
Route::post('/payment/success', [\App\Http\Controllers\Dashboard\RazorpayController::class, 'paymentSuccess'])->name('payment.success');
Route::post('/payment/failure', [\App\Http\Controllers\Dashboard\RazorpayController::class, 'paymentFailure'])->name('payment.failure');

