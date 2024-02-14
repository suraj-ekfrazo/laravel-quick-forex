<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\RateBlock;
use App\Models\TransactionCurrency;
use App\Models\Transactions;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RateBlockedController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth.agentLogin');
    }

    public function transactionSave(Request $request)
    {
        $input = $request->all();

        $request->validate([
            'customer_id' => 'required',
            'txn_type' => 'required',
            'booking_purpose_id' => 'required',
            'fund_source_id' => 'required',
            'pancard_no' => 'required',
            'customer_name' => 'required',
            'customer_mobile' => 'required',
            'currency' => 'required',
        ],
            [
                'currency.required' => 'Add min one currency.',
            ]);

        $currency = $input['currency'];
        unset($input['currency']);

        $incidentNumberDetails = Transactions::orderBy('id', 'DESC')->first();
        if ($incidentNumberDetails != '') {
            $number = $incidentNumberDetails->txn_number;
            $indexChar = substr($number, 0, -6);
            $getNumber = substr($number, -6);
            if ($getNumber + 1 > 999999) {
                $number = (++$indexChar . "000001");
                $viewNumber = (++$indexChar . "000001");
                $input['txn_number'] = $number;
                $getNumber = 000001;
            } else {
                $number = ($indexChar . sprintf("%06s", ++$getNumber));
                $viewNumber = ($indexChar . sprintf("%06s", $getNumber));
                $input['txn_number'] = $number;
            }
        } else {
            $input['txn_number'] = 'A000001';
            $viewNumber = 'A000001';
        }
        $result = Transactions::create($input);
        $newCurr = array();
        foreach ($currency as $value){
            $newValue['txn_id'] = $viewNumber;
            $newValue['txn_currency_type'] = $value['txn_currency_type'];
            $newValue['txn_frgn_curr_amount'] = $value['txn_frgn_curr_amount'];
            $newValue['txn_booking_rate'] = $value['txn_booking_rate'];
            $newValue['txn_inr_amount'] = $value['txn_inr_amount'];
            array_push($newCurr,$newValue);
        }

        $resCurr = TransactionCurrency::insert($newCurr);
        $message = 'Transaction No. '.$viewNumber.' Successfully Added';
        if ($result && $resCurr) {
            return response()->json(array('type' => 'SUCCESS', 'message' => $message));
        } else {
            return response()->json(array('type' => 'ERROR', 'message' => 'Something Went Wrong', 'data' => []));
        }
    }

    public function transactionStatusDelete(Request $request)
    {
        $input = $request->all();
        $result = TransactionCurrency::where('id', $input['id'])->first();
        TransactionCurrency::where('id', $result['id'])->delete();
        $message = 'Deleted Successfully';
        if ($result) {
            return response()->json(array('type' => 'SUCCESS', 'message' => $message, 'data' => []));
        } else {
            return response()->json(array('type' => 'ERROR', 'message' => 'Something Went Wrong', 'data' => []));
        }
    }

    public function editDealRate(Request $request)
    {
        $input = $request->all();
        $AuthId = Auth::guard('agent_users')->user()->id;
        $query = RateBlock::where('branch_id',$AuthId)
                ->where('is_used',0)
                ->where('fx_currency',$input['currencyType'])
				->where('purpose_id',$input['bookingPurpose'])
				->where('transaction_type',$input['transactionType'])
                ->whereDate('expiry_date','>',date('Y-m-d'));
                $query->orderBy('expiry_date','ASC');
                $result['data'] = $query->get()->toArray();
        $result['data_count'] = count($result['data']);
        return view('agent.rateblock.model.edit')->with($result);
    }

    public function dealRateSave(Request $request)
    {
        $input = $request->all();

        $check = $request->validate([
            'select_deal_rate' => 'required',
            'branch_margin' => 'required',
        ]);

        if ($check) {
            return response()->json(array('type' => 'SUCCESS', 'message' => "Add Deal Rate",'data'=>$input));
        } else {
            return response()->json(array('type' => 'ERROR', 'message' => 'Something Went Wrong', 'data' => []));
        }
    }
}
