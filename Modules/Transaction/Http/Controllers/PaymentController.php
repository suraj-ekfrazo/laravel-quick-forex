<?php

namespace Modules\Transaction\Http\Controllers;

use App\Models\Transactions;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        return view('transaction::index');
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('transaction::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        //
    }

    public function editPayment($id)
    {
        $data['data'] = Transactions::where('id',$id)->with('customerData')->first();
        return view('transaction::payment.upload')->with($data);
    }

    public function getTransactionDetail($id)
    {
        $data['data'] = Transactions::where('id',$id)->with('customerData','purposeData','sourceData','txnCurrency')->first();
        return view('agent.kyc.transactiondetail')->with($data);
    }

    public function tableData(Request $request)
    {
        $input = $request->all();
        $array = ['txn_id','txn_currency_type','txn_currency_type','txn_inr_amount','id','id','id'];
        $query = Transactions::with('txnCurrency','purposeData','sourceData');
        if (isset($input['search']['value']) && !empty($input['search']['value'])) {
            $query->where('txn_id', 'like', '%' . $input['search']['value'] . '%');
            $query->orWhere('txn_currency_type', 'like', '%' . $input['search']['value'] . '%');
            $query->orWhere('txn_inr_amount', 'like', '%' . $input['search']['value'] . '%');
        }
        $query->whereHas('txnCurrency', function($query) use ($input) {
            $query->where('kyc_status','1')->where('p_status','0');
            if (isset($input['search']['value']) && !empty($input['search']['value'])) {
                $query->where('txn_number', 'like', '%' . $input['search']['value'] . '%');
                $query->orWhere('customer_name', 'like', '%' . $input['search']['value'] . '%');
                $query->orWhere('created_at', 'like', '%' . $input['search']['value'] . '%');
            }
        });
		$query->orderBy('id','DESC');
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
	
	public function updatePayment(Request $request)
    {
        $input = $request->all();
        $arr_transaction = Transactions::where('id',$input['id'])->first();
        $arr_input=['payment_status'=>$input['payment_status'],'payment_comment'=>$input['payment_comment']];
        if($arr_transaction['kyc_status']=='1' && $input['payment_status']=='1'){
            $arr_input['transaction_status']=1;
        }
		
		$arr_input['p_status']  = $input['payment_status'] == "2" ? '0' : '2';
        $result = Transactions::where('id',$input['id'])->update($arr_input);
        if ($result) {
            return response()->json(array('type' => 'SUCCESS', 'message' => 'Payment status updated.'));
        } else {
            return response()->json(array('type' => 'ERROR', 'message' => 'Something Went Wrong', 'data' => []));
        }
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        return view('transaction::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        return view('transaction::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        //
    }
}
