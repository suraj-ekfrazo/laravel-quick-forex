<?php

namespace App\Http\Controllers\Agent;

use App\Http\Controllers\Controller;
use App\Models\{AgentUsers,User};
use App\Models\Customers;
use App\Models\TransactionCurrency;
use App\Models\Transactions;
use App\Models\ManagePurposes;
use App\Models\ManageSources;
use App\Models\RateBlock;
use Carbon\Carbon;
use http\Env\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Notification;
use DB;
use App\Notifications\Transection;
class Dashboard extends Controller
{
    public function __construct()
    {
        $this->middleware('auth.agentLogin');
    }

    public function index()
    {
        $data['customers'] = Customers::where(['deleted_at'=>null])->orWhere('created_by',null)->get()->toArray();
        $data['purposes'] = ManagePurposes::where('deleted_at',null)->get()->toArray();
        $data['sources'] = ManageSources::where('deleted_at',null)->get()->toArray();
		$data['countries'] = json_decode(file_get_contents(database_path('seed/country.json')), true);

        return view('agent.dashboard')->with($data);
    }

    public function customer()
    {
        return view('agent.customer.add');
    }

    public function store(Request $request)
    {
        $input = $request->all();

        $request->validate([
            'mobile' => 'required|unique:customers',
            'name' => 'required',
        ]);
        $input['created_by'] = Auth::guard('agent_users')->user()->id;
        $result = Customers::create($input);

        $message = 'Successfully Added';
        if ($result) {
            return response()->json(array('type' => 'SUCCESS', 'message' => $message));
        } else {
            return response()->json(array('type' => 'ERROR', 'message' => 'Something Went Wrong', 'data' => []));
        }
    }

    public function transactionSave(Request $request)
    {
        $input = $request->all();

        $request->validate([
            'customer_id' => 'required',
            'txn_type' => 'required',
            'booking_purpose_id' => 'required',
            'fund_source_id' => 'required',
            'pancard_name' => 'required',
            'pancard_no' => 'required',
            'pancard_relation' => 'required',
            'nostro_charge_type' => 'required',
            'customer_name' => 'required',
            'nostro_charge'=>'required_if:nostro_charge_type,OUR,SHA',
        ]);

        if($input['nostro_charge_type']!="" && $input['nostro_charge_type']=='OUR') {
            $this->validate($request, [
                'nostro_charge' => 'required | numeric | min:1250',
            ]);
        }

        if($input['nostro_charge_type']!="" && $input['nostro_charge_type']=='SHA') {
            $this->validate($request, [
                'nostro_charge' => 'required | numeric | min:400',
            ]);
        }

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
        $input['created_by'] = Auth::guard('agent_users')->user()->id;
        $startDate = Carbon::now();
        $input['expired_date'] = addDaysSkipWeekend(strtotime($startDate), 4);
        //echo json_encode($input); exit;
		$result = Transactions::create($input);
        $newCurr = array();
        foreach ($currency as $value){
            $newValue['txn_id'] = $viewNumber;
            $newValue['txn_currency_type'] = $value['txn_currency_type'];
            $newValue['txn_frgn_curr_amount'] = $value['txn_frgn_curr_amount'];
            $newValue['txn_booking_rate'] = $value['txn_booking_rate'];
            $newValue['txn_branch_margin'] = $value['txn_branch_margin'];
            $newValue['txn_agent_commission'] = $value['txn_agent_commission']!="" ? $value['txn_agent_commission'] : 0.00;
            $newValue['txn_rate_block_id'] = $value['txn_rate_block_id'];
            $newValue['txn_inr_amount'] = $value['txn_inr_amount'];
            $newValue['branch_id'] = Auth::guard('agent_users')->user()->id;
            RateBlock::where('id', $value['txn_rate_block_id'])->update(['is_used' => 1]);
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

    public function tableTransactionStatus(Request $request)
    {
        $input = $request->all();
        /*$array = ['txn_id','txn_currency_type','txn_currency_type','txn_inr_amount','id','id','id'];*/
        $query = Transactions::with('txnCurrency','purposeData','sourceData');
        if (isset($input['search']['value']) && !empty($input['search']['value'])) {
            $query->where('txn_id', 'like', '%' . $input['search']['value'] . '%');
            $query->orWhere('txn_currency_type', 'like', '%' . $input['search']['value'] . '%');
            $query->orWhere('txn_inr_amount', 'like', '%' . $input['search']['value'] . '%');
        }
        $query->whereHas('txnCurrency', function($query) use ($input) {
            if (isset($input['search']['value']) && !empty($input['search']['value'])) {
                $query->where('txn_number', 'like', '%' . $input['search']['value'] . '%');
                $query->orWhere('customer_name', 'like', '%' . $input['search']['value'] . '%');
                $query->orWhere('created_at', 'like', '%' . $input['search']['value'] . '%');
            }
        });
        $result['draw'] = $input['draw'];
        $result['recordsTotal'] = $query->count();
        $result['recordsFiltered'] = $query->count();
        $result['data'] = $query->skip($input['start'])->take($input['length'])->orderBy('id','DESC')->get()->toArray();
        if ($result) {
            return response()->json(array('type' => 'SUCCESS', 'message' => 'Success', 'data' => $result['data'], 'recordsTotal' => $result['recordsTotal'], 'recordsFiltered' => $result['recordsFiltered']));
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

    public function transactionStatusIsactive(Request $request, $id){
        $input = $request->all();
        try {
            Transactions::where('id', $id)->update(['is_active' => ($input['is_active'] ? false : true)]);
            return response()->json(array('type' => 'SUCCESS', 'message' => "Active/Deactive Changed Successfully"));
        } catch (\Exception $e) {
            return response()->json(array('type' => 'ERROR', 'message' => $e->getMessage()));
        }
    }

    public function getCustomers()
    {
        $result = Customers::where(['deleted_at'=>null])->get();

        $message = 'Successfully Added';
        if ($result) {
            return response()->json(array('type' => 'SUCCESS', 'data' => $result));
        } else {
            return response()->json(array('type' => 'ERROR', 'message' => 'Something Went Wrong', 'data' => []));
        }
    }

    public function rateBlock(Request $request)
    {
        return view('agent.rateblock.add');
    }

    public function rateBlockSave(Request $request)
    {
        $input = $request->all();
		$incidentNumberDetails = RateBlock::orderBy('id', 'DESC')->first();
        if ($incidentNumberDetails != '' && $incidentNumberDetails->reference_number!="") {
            $number = $incidentNumberDetails->reference_number;
            $indexChar = substr($number, 0, -6);
            $getNumber = substr($number, -6);
            if ($getNumber + 1 > 999999) {
                $number = (++$indexChar . "000001");
                $viewNumber = (++$indexChar . "000001");
                $input['reference_number'] = $number;
                $getNumber = 000001;
            } else {
                $number = ($indexChar . sprintf("%06s", ++$getNumber));
                $viewNumber = ($indexChar . sprintf("%06s", $getNumber));
                $input['reference_number'] = $number;
            }
        } else {
            $input['reference_number'] = 'REF000001';
            $viewNumber = 'REF000001';
        }
        $input['branch_id']=Auth::guard('agent_users')->user()->id;
        if($input['currency']) {
            foreach ($input['currency'] as $key => $value) {
				//print_r($value); 
				//$arr[]=['branch_id' => $input['branch_id'], 'fx_currency' => $value['txn_currency_typerb'], 'fx_value' => $value['txn_frgn_curr_amountrb'],'purpose_id' => $value['txn_booking_purpose'],'transaction_type' => $value['txn_type']];
                $result = RateBlock::create(['reference_number'=>$viewNumber,'branch_id' => $input['branch_id'], 'fx_currency' => $value['txn_currency_typerb'], 'fx_value' => $value['txn_frgn_curr_amountrb'],'purpose_id' => $value['txn_booking_purpose'],'transaction_type' => $value['txn_type']]);
            }
        }
        $message = '#'.$viewNumber.' Successfully Added';
        if($result){
            $message  = 'New Rate #'.$viewNumber.' Block Added';
            $sendUser = User::all();
            Notification::send($sendUser,new Transection($message));
            return response()->json(['type' => 'SUCCESS', 'message' => $message]);
        }
        else{
            return response()->json(['type' => 'ERROR', 'message' => 'Something went wrong!']);
        }
    }

    public function getRateBlock(Request $request){
        $input = $request->all();
        $AuthId=Auth::guard('agent_users')->user()->id;
        $array = ['fx_currency','fx_value','fx_rate','expiry_date'];
        $column = $input['order'][0]['column'];

        $query = RateBlock::where('branch_id',$AuthId)->where('is_used',0)->whereDate('expiry_date','>',date('Y-m-d'));

        if (isset($input['search']['value']) && !empty($input['search']['value'])) {
            $query->where('fx_currency', 'like', '%' . $input['search']['value'] . '%');
            $query->orWhere('fx_value', 'like', '%' . $input['search']['value'] . '%');
            $query->orWhere('fx_rate', 'like', '%' . $input['search']['value'] . '%');
        }
        $query->orderBy('expiry_date','ASC');
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
	
	public function profile()
    {
        $authUser['data'] = Auth::guard('agent_users')->user();
        return view('agent.profile')->with($authUser);
    }

    public function profileSave(Request $request)
    {
        $input = $request->all();
        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email',
            'mobile' => 'required|numeric|digits:10',
        ]);

        if($input['password']!="") {
            $this->validate($request, [
                'password' => 'min:6',
            ]);
            $input['password']=Hash::make($input['password']);
        }
        else{
            unset($input['password']);
        }
        $id = Auth::guard('agent_users')->user()->id;
        $result = AgentUsers::find($id)->update($input);
        $message = 'Successfully Updated';
        if($result){
            return response()->json(['type' => 'SUCCESS', 'message' => $message]);
        }
        else{
            return response()->json(['type' => 'ERROR', 'message' => 'Something went wrong!']);
        }
    }
	
	
	 /** get admin Notification*/
     public function getNotification()
     {
        DB::beginTransaction();
        try{

            $data = DB::table('notifications')->where('notifiable_id', Auth::guard('agent_users')->user()->id)
            ->where('notifiable_type', get_class(Auth::guard('agent_users')->user()))
            ->where('read_at',null)
            ->first();
            if($data){

                DB::table('notifications')->where('notifiable_id', Auth::guard('agent_users')->user()->id)
                ->where('notifiable_type', get_class(Auth::guard('agent_users')->user()))
                ->update(['read_at'=> date('Y-m-d')]);
                $message =  explode('"',$data->data);
                $response['data']    =  $message[3];
            }else{
                 $response['data']       = $data;
            }
            DB::commit();
            $response['status']     = true;
            $response['message']    = "Nofificaion Get Succesfully";
            return response()->json($response);
        }catch(Exception $e){
            DB::rollback();
            return response()->json($response);
        }
     }
	
	public function tableApprovedDeal(Request $request)
    {
        $input = $request->all();
        /*$array = ['txn_id','txn_currency_type','txn_currency_type','txn_inr_amount','id','id','id'];*/
        $query = RateBlock::with('getPurpose')->where('branch_id',Auth::guard('agent_users')->user()->id)
                ->whereNotNull('fx_rate');



        if (isset($input['search']['value']) && !empty($input['search']['value'])) {

        $searchValue = $input['search']['value'];
        $query->where(function ($query) use ($searchValue) {
            $query->where('reference_number', 'like', '%' . $searchValue . '%')
                  ->orWhere('fx_value', 'like', '%' . $searchValue . '%')
                  ->orWhere('fx_currency', 'like', '%' . $searchValue . '%')
                  ->orWhere('deal_id', 'like', '%' . $searchValue . '%')
                  ->orWhere('expiry_date', 'like', '%' . $searchValue . '%');
            });
        };

        $result['draw'] = $input['draw'];
        $result['recordsTotal'] = $query->count();
        $result['recordsFiltered'] = $query->count();
        $result['data'] = $query->skip($input['start'])->take($input['length'])->orderBy('id','DESC')->get()->toArray();
        if ($result) {
            return response()->json(array('type' => 'SUCCESS', 'message' => 'Success', 'data' => $result['data'], 'recordsTotal' => $result['recordsTotal'], 'recordsFiltered' => $result['recordsFiltered']));
        } else {
            return response()->json(array('type' => 'ERROR', 'message' => 'Something Went Wrong', 'data' => []));
        }
    }
}
