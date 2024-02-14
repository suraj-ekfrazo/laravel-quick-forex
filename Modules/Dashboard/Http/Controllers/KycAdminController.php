<?php

namespace Modules\Dashboard\Http\Controllers;

use App\Models\ManagePurposes;
use App\Models\RequiredDocuments;
use App\Models\TransactionCurrency;
use App\Models\TransactionKyc;
use App\Models\Transactions;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;

class KycAdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth.adminLogin');
    }

    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index($txnNo)
    {
        $data['txnData'] = Transactions::where('txn_number',$txnNo)->first();
        $data['txnCurrency'] = TransactionCurrency::where('txn_id',$txnNo)->get();
        $data['txnKyc'] = TransactionKyc::where(['txn_link_no'=>$txnNo])->first();
        $data['purposes'] = ManagePurposes::where('id',$data['txnData']->booking_purpose_id)->first();
        $data['documents'] = RequiredDocuments::whereIn('id',explode(",",$data['purposes']->documents))->pluck('document_value','document_name')->toArray();
        return view('dashboard::tcuser')->with($data);
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */

    public function tableData(Request $request)
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
            $query->where('kyc_status','!=','1');
            if (isset($input['search']['value']) && !empty($input['search']['value'])) {
                $query->where('txn_number', 'like', '%' . $input['search']['value'] . '%');
                $query->orWhere('customer_name', 'like', '%' . $input['search']['value'] . '%');
                $query->orWhere('created_at', 'like', '%' . $input['search']['value'] . '%');
            }
        });
		$query->orderBy('id','Desc');
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

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
     public function store(Request $request,$txn_link_no)
    {
        $input = $request->all();
        /*$booking_purpose_id = Transactions::where('txn_number',$txn_link_no)->first()->booking_purpose_id;
        $documents = ManagePurposes::where('id',$booking_purpose_id)->first()->documents;
        $kyc_documents = RequiredDocuments::whereIn('id',explode(",",$documents))->get();

        $validation = [];
        $txnKycData = [];
        foreach ($kyc_documents as $kyc_document){
            $validation[$kyc_document->document_name.'_comment'] = 'required_if:'.$kyc_document->document_name.'_status,false';
            $txnKycData[$kyc_document->document_name.'_status'] =  $input[$kyc_document->document_name.'_status'];
            $txnKycData[$kyc_document->document_name.'_comment'] =  $input[$kyc_document->document_name.'_comment'];
        }
        $validation['kyc_status'] = 'required|boolean:0,1,true,false';
        $validation['kyc_comment'] = 'required_if:kyc_status,false';
        $request->validate($validation);

        $resTxnKyc = TransactionKyc::where('txn_link_no',$txn_link_no)->update($txnKycData);*/

        $validation['kyc_status'] = 'required';
        $validation['kyc_comment'] = 'required_if:kyc_status,false';
        $request->validate($validation);

        $txnData['kyc_status'] = $input['kyc_status'];
        $txnData['kyc_comment'] = $input['kyc_comment'];

        $resTxn = Transactions::where('txn_number',$txn_link_no)->update($txnData);
        if ($resTxn) {
            $message = 'Successfully Updated';
            return response()->json(array('type' => 'SUCCESS', 'message' => $message, 'data' => $resTxn));
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
        return view('dashboard::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        return view('dashboard::edit');
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
	
	//update single document status and comment
    public function updateSingleDocumentStatus(Request $request)
    {

        $id = $request->id;
        $status = $request->status;
        $comment = $request->comment ? $request->comment : '';
        $doc_type = $request->doc_type;
        $commentname=$doc_type.'_comment';
        $request->request->add([$commentname => $request->comment]); //add request
        $input=$request->all();
        //$input[$commentname]=$request->comment;
        //print_r($input); exit;
        $valid_array = array();
        if($status==0){
            $valid_array[$doc_type.'_comment'] = 'required';
        }
        //Validation for comment
        //print_r([$doc_type."_status"=>$status,$doc_type."_comment"=>$comment]);exit;
        $request->validate($valid_array);
        TransactionKyc::where('id',$id)->update([$doc_type."_status"=>$status,$doc_type."_comment"=>$comment]);
        return json_encode(array("status" => 200, "message" => "Document updated successfully!"));
    }
	
	
	public function updateMultipleDocumentStatus(Request $request)
    {


        foreach($request->typesArray as $data){
            TransactionKyc::where('id',$request->id)
            ->update([$data['type']."_status"=>$data['checked'] == 'true' ? '1' : '2',
            $data['type']."_comment"=>$data['comment'] ?? '']);
        }

        $transaction = TransactionKyc::where('id',$request->id)->first();

		
        $resTxn = Transactions::where('txn_number',$transaction->txn_link_no)
        ->update(['kyc_status'=>$request->status,'kyc_comment'=>$request->comment,'status'=>$request->status  == '2' ? '0' : '1']);
		
        $response['status'] = true;
        $response['message'] = "Document updated successfully";
        return response()->json($response);
    }

    //Update KYC status
    public function updateDcocument(Request $request)
    {

        $id = $request->id;
        $inci_number = $request->inci_number;
        $update_data = array();
        $validate_array = array();
        $message = array();
        $update_txndata = array();

        if ($request->inci_status == 1) {
            $validate_array['kyc_comment'] = 'required';
            $message = [
                'kyc_comment.required' => 'Please add comment here',
            ];
        }
        $validate_array['kyc_status'] = 'required';
        $this->validate($request, $validate_array, $message);
        $update_txndata['kyc_comment'] = '';
        if (!empty($request->kyc_comment)) {
            $update_txndata['kyc_comment'] = $request->kyc_comment;
        }
		
        $update_txndata['kyc_status'] = $request->kyc_status;
        return response()->json(['message' => 'Document updated successfully!']);
    }
}
