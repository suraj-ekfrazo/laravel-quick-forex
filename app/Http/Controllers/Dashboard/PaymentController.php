<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\TransactionCurrency;
use App\Models\Transactions;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Razorpay\Api\Api;

class PaymentController extends Controller
{
	protected $api;

    public function __construct()
    {
        $this->api = new Api(env('RAZORPAY_KEY_ID'), env('RAZORPAY_KEY_SECRET'));
    }

    public function editPayment($id)
    {
        $data['data'] = Transactions::where('id',$id)->with('customerData')->first();
        return view('agent.payment.upload')->with($data);
    }

    public function tableData(Request $request)
    {
        $input = $request->all();
        $array = ['txn_id','txn_currency_type','txn_currency_type','txn_inr_amount','id','id','id'];
        $query = Transactions::with('txnCurrency','purposeData','sourceData')->where('kyc_status','1')
			->where('p_status','0');
        if (isset($input['search']['value']) && !empty($input['search']['value'])) {
            $query->where('txn_id', 'like', '%' . $input['search']['value'] . '%');
            $query->orWhere('txn_currency_type', 'like', '%' . $input['search']['value'] . '%');
            $query->orWhere('txn_inr_amount', 'like', '%' . $input['search']['value'] . '%');
        }
        $query->whereHas('txnCurrency', function($query) use ($input) {
            $query->where('created_by', Auth::guard('agent_users')->user()->id);
            if (isset($input['search']['value']) && !empty($input['search']['value'])) {
                $query->where('txn_number', 'like', '%' . $input['search']['value'] . '%');
                $query->orWhere('customer_name', 'like', '%' . $input['search']['value'] . '%');
                $query->orWhere('created_at', 'like', '%' . $input['search']['value'] . '%');
            }
        });
		
        $result['draw'] = $input['draw'];
        $result['recordsTotal'] = $query->count();
        $result['recordsFiltered'] = $query->count();
        $result['data'] = $query->skip($input['start'])->take($input['length'])->get()->toArray();
        if ($result) {
            return response()->json(array('type' => 'SUCCESS', 'message' => 'Success', 'data' => $result['data'], 'recordsTotal' => $result['recordsTotal'], 'recordsFiltered' => $result['recordsFiltered']));
        } else {
            return response()->json(array('type' => 'ERROR', 'message' => 'Something Went Wrong', 'data' => []));
        }
    }
	
	public function paymentupload(Request $request)
    {
        $input = $request->all();
        $transaction_detail = Transactions::where('id',$input['id'])->first();

        $validation = [];
        $validation['payment_type'] = 'required';
        if($input['payment_type']==1) {
            $validation['payment_upload_document'] = 'required';
        }
        else{
            $validation['amount'] = 'required';
        }
        $request->validate($validation);
		
		//$amount = $input['amount']!="" ? $input['amount'] : 0.00 ;
		
		if($input['payment_type']==1) {
            unset($input['amount']);

			date_default_timezone_set('Asia/Kolkata');
			$customerArray = array();
			$customerArray['txn_number'] = $transaction_detail['txn_number'];
			$milliseconds = round(microtime(true) * 1000);
			$todayDate = date('Y-m-d',strtotime($transaction_detail['created_at']));
			$documentPath = public_path() . '/upload/allDocuments/' . $todayDate . '/' . $transaction_detail['txn_number'] . '/';


			if ($request->hasFile('payment_upload_document')) {
				$extension = $request->payment_upload_document->getClientOriginalExtension();
				$uploadFileName = $milliseconds . '_' . $transaction_detail['txn_number'] . '_payment.' . $extension;
				$request->payment_upload_document->move($documentPath, $uploadFileName);
				$input['payment_upload_document'] = $uploadFileName;
			}
			unset($input['id']);
			unset($input['amount_payable']);
			
			$input['p_status'] = 1;
			$result = Transactions::where('txn_number', $transaction_detail['txn_number'])->update($input);
			$message = 'Successfully Updated';
			
		}
        else{

            $input = $request->all();

            $api = new Api("rzp_test_pFQn8ncmokidaD", "xBUo7DS74ThuGFROhdt8F65L");

            $payment = $api->payment->fetch($input['razorpay_payment_id']);

            if(count($input)  && !empty($input['razorpay_payment_id'])) {
                try {
                    $response = $api->payment->fetch($input['razorpay_payment_id'])->capture(array('amount'=>$payment['amount']));

                } catch (Exception $e) {
                    return  $e->getMessage();
                    Session::put('error',$e->getMessage());
                    return redirect()->back();
                }
            }

            Session::put('success', 'Payment successful');
            return redirect()->back();


            /*--------------------------------------------*/
        }

        if ($result) {
            return response()->json(array('type' => 'SUCCESS', 'message' => $message));
        } else {
            return response()->json(array('type' => 'ERROR', 'message' => 'Something Went Wrong', 'data' => []));
        }
    }
	
	public function paymentWebhook(Request $request)
    {
		$input = $request->all();
        Log::info("-----------Testing webhook----------------");
		Log::info(json_encode($input));
		Log::info($input['event']);
        Log::info("-----------Testing webhook End----------------");
	
        return response()->json(array('type' => 'SUCCESS'));
    }
}
