<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Transactions;
use Illuminate\Http\Request;
use Razorpay\Api\Api;

class RazorpayController extends Controller
{
    protected $api;

    public function __construct()
    {
        $this->api = new Api(env('RAZORPAY_KEY_ID'), env('RAZORPAY_KEY_SECRET'));
    }

    public function index()
    {
        return view('payment.index');
    }

    public function processPayment(Request $request)
    {
        $amount = $request->input('amount') * 100; // Razorpay accepts amount in paise
        $currency = 'INR'; // Change this to your desired currency

        $order = $this->api->order->create([
            'receipt' => uniqid(),
            'amount' => $amount,
            'currency' => $currency,
        ]);
        $data['order_id'] = $order->id;
        $data['amount'] = $order->amount;
        $data['currency'] = $order->currency;
        return Response()->json($data);
    }

    public function changePaymentStatus(Request $request)
    {
        $input = $request->all();
        $transactionData = Transactions::where('id',$input['id'])->first();
        if($transactionData['kyc_status']==1)
        {
            $transactionStatus = 1;
        }
        else{
            $transactionStatus = $transactionData['transaction_status'];
        }

        Transactions::where('id',$input['id'])->update(['payment_status'=>1, 'transaction_status'=>$transactionStatus , 'razorpay_paymentid'=>$input['data']['razorpay_payment_id'], 'razorpay_orderid'=>$input['data']['razorpay_order_id'], 'razorpay_signature'=>$input['data']['razorpay_signature'],'p_status'=>1]);
        return Response()->json(["status"=>"True","transactionid"=>$transactionData['txn_number']]);
    }


    public function paymentSuccess(Request $request)
    {
        // Handle successful payment
        return view('payment.success');
    }

    public function paymentFailure(Request $request)
    {
        // Handle failed payment
        return view('payment.failure');
    }
}
