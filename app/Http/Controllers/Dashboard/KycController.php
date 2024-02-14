<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Customers;
use App\Models\ManagePurposes;
use App\Models\RequiredDocuments;
use App\Models\TransactionCurrency;
use App\Models\TransactionKyc;
use App\Models\Transactions;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use File;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\TransectionExport;

class KycController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth.agentLogin');
    }

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
            $query->where('created_by', Auth::guard('agent_users')->user()->id)
				->where('status','0');
			
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

    public function editKyc($id)
    {
        $data['data'] = Transactions::where('id',$id)->with('customerData')->first();
		$data['kyc_data'] = TransactionKyc::where('txn_link_no',$data['data']->txn_number)->first();
        $documents = ManagePurposes::where('id',$data['data']->booking_purpose_id)->first()->documents;
        $data['kyc_documents'] = RequiredDocuments::whereIn('id',explode(",",$documents))->get();
        return view('agent.kyc.upload')->with($data);
    }
	
	public function imageVerification(Request $request)
    {

        $curl = curl_init();

	
        curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://preproduction.signzy.tech/api/v2/patrons/login',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS =>'{"username":"'.env('USERNAME').'","password":"'.env('PASSWORD').'"}',
        CURLOPT_HTTPHEADER => array(
            'Accept: */*',
            'Accept-Language: en-US,en;q=0.8',
            'content-type: application/json'
        ),
        ));

        $response = curl_exec($curl);
        curl_close($curl);
        $data          =  json_decode($response);
         $responseData  =  json_decode($this->imageVerificationStep2($request,$data));
        $responseCheck['status']  =  isset($responseData->result) && $responseData->result->summary == 'reject' ? false : true;
        $responseCheck['message'] = "Document Check";
		//echo json_encode($responseData); exit;
        return response()->json($responseCheck);

    }

    public function imageVerificationStep2($request,$data){
        $curl = curl_init();
        $image = $request->file('image');
        $imageName = time() . '.' . $request->image->getClientOriginalExtension();
        // Move the uploaded image to a storage location (e.g., public/images)
        $image->move(public_path('images'), $imageName);
        $imagePath = asset('images/'.$imageName);
        curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://preproduction.signzy.tech/api/v2/patrons/'.$data->userId.'/imagequality',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS =>'{"essentials":{"files":["'.$imagePath.'"],"qualityParameter":"all"}}',
        CURLOPT_HTTPHEADER => array(
            'Accept: */*',
            'Accept-Language: en-US,en;q=0.8',
            'Authorization: '.$data->id.'',
            'content-type: application/json'
        ),
        ));

        $response = curl_exec($curl);
        curl_close($curl);
        if(File::exists($imagePath)) {
            File::delete($imagePath);
        }
        return $response;
    }
	
	public function getTransactionDetail($id)
    {
        $data['data'] = Transactions::where('id',$id)->with('customerData','purposeData','sourceData','txnCurrency')->first();
        return view('agent.kyc.transactiondetail')->with($data);
    }

    public function store(Request $request)
    {
        $input = $request->all();
        $transaction_number = $input['txn_link_no'];
        $booking_purpose_id = Transactions::where('txn_number',$input['txn_link_no'])->first();
        $documents = ManagePurposes::where('id',$booking_purpose_id->booking_purpose_id)->first()->documents;
		$document = TransactionKyc::where('txn_link_no',$input['txn_link_no'])->first();

        $kyc_documents = RequiredDocuments::whereIn('id',explode(",",$documents))->get();

        $validation = [];

        foreach ($kyc_documents as $kyc_document){
			
			if($document ){
                if($document[$kyc_document->document_name.'_status'] != 1){
                    $validation[$kyc_document->document_name] = 'required';
                }
            }else{
                $validation[$kyc_document->document_name] = 'required';
            }
            
        }
        $request->validate($validation);

        date_default_timezone_set('Asia/Kolkata');
        $customerArray = array();
        $customerArray['txn_number'] = $input['txn_link_no'];
        $milliseconds = round(microtime(true) * 1000);
        $todayDate = date('Y-m-d',strtotime($booking_purpose_id->created_at));
        $documentPath = public_path() . '/upload/allDocuments/' . $todayDate . '/' . $transaction_number . '/';
        foreach ($kyc_documents as $kyc_document){
            $key = $kyc_document->document_name;
            if ($request->hasFile($kyc_document->document_name)) {
                $image = $request->file($kyc_document->document_name);
                $extension = $request->$key->getClientOriginalExtension();
                //$image_name = time().$kyc_document->document_name.'.'.$request->$key->extension();
                $uploadFileName = $milliseconds . '_' . $transaction_number . '_' . $kyc_document->document_name . '.' . $extension;
                $image->move($documentPath, $uploadFileName);
                $input[$kyc_document->document_name] = $uploadFileName;
            }
        }

        $checkExist =  TransactionKyc::where('txn_link_no',$input['txn_link_no'])->exists();
        if($checkExist){
            $result = TransactionKyc::where('txn_link_no', $input['txn_link_no'])->update($input);
            $message = 'Successfully Updated';
        }else{
            $result = TransactionKyc::create($input);
            $message = 'Successfully Added';
        }
        if ($result) {
            Transactions::where('txn_number',$input['txn_link_no'])
				->update(['document_upload_status'=>'1','status'=>'1']);
            return response()->json(array('type' => 'SUCCESS', 'message' => $message));
        } else {
            return response()->json(array('type' => 'ERROR', 'message' => 'Something Went Wrong', 'data' => []));
        }
    }
    
     public function export()
    {

        return Excel::download(new TransectionExport, 'transection.xlsx');

    }
    
        public function print()
    {
        $query = Transactions::with('txnCurrency','purposeData','sourceData');
        $query->whereHas('txnCurrency');
        $transections = $query->get();
        return view('agent.print',compact('transections'));

    }
}
