<?php

namespace Modules\Dashboard\Http\Controllers;

use App\Models\{ManagePurposes,AgentUsers};
use App\Models\RateBlock;
use App\Models\RequiredDocuments;
use App\Models\TransactionCurrency;
use App\Models\TransactionKyc;
use App\Models\Transactions;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Notification;
use App\Notifications\Transection;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\{AdminApprovedDealsExport,AdminKycExport,AdminPendingPaymentExport,AdminAllBookingExport,AdminCompleteTransectionExport};
class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth.adminLogin');
    }

    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        return view('dashboard::index');
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('dashboard::create');
    }

    public function viewKyc($txnNo){
        $data['txnData'] = Transactions::where('txn_number',$txnNo)->first();
        $data['txnCurrency'] = TransactionCurrency::where('txn_id',$txnNo)->get();
        $data['txnKyc'] = TransactionKyc::where(['txn_link_no'=>$txnNo])->first();
        $data['purposes'] = ManagePurposes::where('id',$data['txnData']->booking_purpose_id)->first();
        $data['documents'] = RequiredDocuments::whereIn('id',explode(",",$data['purposes']->documents))->pluck('document_value','document_name')->toArray();
        return view('dashboard::tcuser')->with($data);
    }

    public function tableTransactionData(Request $request)
    {
        $input = $request->all();
        /*$array = ['txn_id','txn_currency_type','txn_currency_type','txn_inr_amount','id','id','id'];*/
        $query = Transactions::with('txnCurrency','purposeData','sourceData')->orderBy('txn_number', 'DESC');
        

        if(isset($request->customer_id) && $request->customer_id!=''){
            $query->where('customer_id', $request->customer_id);
        }

        if(isset($request->agent_id) && $request->agent_id!=''){
            $query->where('created_by', $request->agent_id);
        }


        if(isset($request->datefilter) && $request->datefilter!=''){
            $date=$request->datefilter;
             $dates=explode(' - ',$date);
            $date0 = str_replace(' ', '', $dates[0]);
            $dates1 = array_key_exists(1,$dates) ? str_replace('/t', '', $dates[1]) : $date0;
            $query->whereDate('created_at','>=',date('Y-m-d',strtotime($date0)))
                    ->whereDate('created_at','<=',date('Y-m-d',strtotime($dates1)));
        }

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
        $result['data'] = $query->skip($input['start'])->take($input['length'])->get()->toArray();
        if ($result) {
            return response()->json(array('type' => 'SUCCESS', 'message' => 'Success', 'data' => $result['data'], 'recordsTotal' => $result['recordsTotal'], 'recordsFiltered' => $result['recordsFiltered']));
        } else {
            return response()->json(array('type' => 'ERROR', 'message' => 'Something Went Wrong', 'data' => []));
        }
    }

    public function tableRateBlockedData(Request $request)
    {
        $input = $request->all();
        /*$array = ['txn_id','txn_currency_type','txn_currency_type','txn_inr_amount','id','id','id'];*/
        /*$query = TransactionCurrency::with('transactionData');*/
        $query = TransactionCurrency::with('transactionData')->whereHas('transactionData', function($q) use ($input) {
            $q->where('transactions.is_active', 1);
            $q->where('transactions.customer_name', 'like', '%' . $input['search']['value'] . '%');
            $q->orWhere('txn_id', 'like', '%' . $input['search']['value'] . '%');
        });
        /*$query->whereNotNull('deal_rate');
        $query->whereNotNull('deal_id');*/
        $result['draw'] = $input['draw'];
        $result['recordsTotal'] = $query->count();
        $result['recordsFiltered'] = $query->count();
        $result['data'] = $query->skip($input['start'])->take($input['length'])->get()->toArray();
        /*dd(\DB::getQueryLog()); // Show results of log*/
        if ($result) {
            return response()->json(array('type' => 'SUCCESS', 'message' => 'Success', 'data' => $result['data'], 'recordsTotal' => $result['recordsTotal'], 'recordsFiltered' => $result['recordsFiltered']));
        } else {
            return response()->json(array('type' => 'ERROR', 'message' => 'Something Went Wrong', 'data' => []));
        }
    }

    public function updateRateBooking(Request $request,$id){
        try {
            $input = $request->all();
			
            //date("Y-m-d", strtotime('+ '.daysToAdd , strtotime($userPromotionDays)));
            $days_added = strtotime(date("Y-m-d", strtotime(date('Y-m-d'))) . " +4 days");
            $dateToExpire=date('Y-m-d',$days_added);
            $input['expiry_date']=$dateToExpire;
            $result = RateBlock::where('id', $id)->update($input);
			
            $message = 'Successfully Updated';
            if ($result) {
				 $viewNumber = RateBlock::where('id', $id)->first();
                $message  = 'Rate #'.$viewNumber['reference_number'].' Block Updated';
                $sendUser = AgentUsers::where('id',$viewNumber['branch_id'])->first();
                Notification::send($sendUser,new Transection($message));
                return response()->json(array('type' => 'SUCCESS', 'message' => $message, 'data' => $result));
            } else {
                return response()->json(array('type' => 'ERROR', 'message' => 'Something Went Wrong', 'data' => []));
            }
        } catch (\Exception $e) {
            return response()->json(array('type' => 'ERROR', 'message' => $e->getMessage()));
        }
    }

    public function updateDeal(Request $request,$id){
        try {
            $input = $request->all();
            $result = TransactionCurrency::where('id', $id)->update($input);
            $message = 'Successfully Updated';
            if ($result) {
                return response()->json(array('type' => 'SUCCESS', 'message' => $message, 'data' => $result));
            } else {
                return response()->json(array('type' => 'ERROR', 'message' => 'Something Went Wrong', 'data' => []));
            }
        } catch (\Exception $e) {
            return response()->json(array('type' => 'ERROR', 'message' => $e->getMessage()));
        }
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
	
	public function completedTransaction(Request $request)
    {
        $input = $request->all();
        /*$array = ['txn_id','txn_currency_type','txn_currency_type','txn_inr_amount','id','id','id'];*/
        $query = Transactions::with('txnCurrency','purposeData','sourceData');
        if(isset($request->customer_id) && $request->customer_id!=''){
            $query->where('customer_id', $request->customer_id);
        }

        if(isset($request->agent_id) && $request->agent_id!=''){
            $query->where('created_by', $request->agent_id);
        }


        if(isset($request->datefilter) && $request->datefilter!=''){
            $date=$request->datefilter;
             $dates=explode(' - ',$date);
            $date0 = str_replace(' ', '', $dates[0]);
            $dates1 = array_key_exists(1,$dates) ? str_replace('/t', '', $dates[1]) : $date0;
            $query->whereDate('created_at','>=',date('Y-m-d',strtotime($date0)))
                    ->whereDate('created_at','<=',date('Y-m-d',strtotime($dates1)));
        }
        
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
        $query->where('kyc_status','1')->where('transaction_status','1')->where('payment_status','1')->orderBy('id','DESC');
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
	
	//Export Buy data
    public function tableDataExport(Request $request)
    {
        $input = $request->all();

        $result['data'] = Transactions::with('purposeData','sourceData')->join('transaction_currency','transaction_currency.txn_id','transactions.txn_number')->where('payment_status','1')->where('transaction_status','1')->where('kyc_status','1')->orderBy('transaction_currency.id','DESC')->get()->toArray();

        if ($result) {
            $spreadsheet = new Spreadsheet();
            $sheet = $spreadsheet->getActiveSheet();
            $sheet->setCellValue('A1', 'Customer Reference');
            $sheet->setCellValue('B1', 'Tran Date');
            $sheet->setCellValue('C1', 'Mode');
            $sheet->setCellValue('D1', 'DD Number');
            $sheet->setCellValue('E1', 'Curr');
            $sheet->setCellValue('F1', 'FCY Amount');
            $sheet->setCellValue('G1', 'Forward Booking Ref');
            $sheet->setCellValue('H1', 'Remitter Name');
            $sheet->setCellValue('I1', 'Remitter PAN');
            $sheet->setCellValue('J1', 'Remitter Address');
            $sheet->setCellValue('K1', 'Remitter City');
            $sheet->setCellValue('L1', 'Remitter Country');
            $sheet->setCellValue('M1', 'Beneficiary Name');
            $sheet->setCellValue('N1', 'Beneficiary Address');
            $sheet->setCellValue('O1', 'Beneficiary City');
            $sheet->setCellValue('P1', 'Beneficiary Country');
            $sheet->setCellValue('Q1', 'Beneficiary Ac No./IBAN Code');
            $sheet->setCellValue('R1', 'Bene Bank Name');
            $sheet->setCellValue('S1', 'Bene Bank  Address');
            $sheet->setCellValue('T1', 'Bene Bank SORT/BSB/ABA/TRANSIT/FED WIRE CODE');
            $sheet->setCellValue('U1', 'Bene Bank SWIFT Code');
            $sheet->setCellValue('V1', 'Sub Purpose Code');
            $sheet->setCellValue('W1', 'Additional Details (For Education/Tour Etc)');
            $sheet->setCellValue('X1', 'FB Charges');
            $sheet->setCellValue('Y1', 'Interm Bank Name');
            $sheet->setCellValue('Z1', 'interm Address');
            $sheet->setCellValue('AA1', 'interm BIC Code');
            $sheet->setCellValue('AB1', 'Interm Bank SORT/BSB/ABA/TRANSIT/FED WIRE CODE');
            $sheet->setCellValue('AC1', 'Individual/Entity/Corporate');
            $sheet->setCellValue('AD1', 'Remitter Email');
            $sheet->setCellValue('AE1', 'Remitter Mobile ');
            $sheet->setCellValue('AF1', 'Deal No');
            $sheet->setCellValue('AG1', 'Amount');
            $sheet->setCellValue('AH1', 'Bene User Identity');
            $sheet->setCellValue('AI1', 'DOB');
            $sheet->setCellValue('AJ1', 'Relation');
            $sheet->setCellValue('AK1', 'Additional Field1');
            $sheet->setCellValue('AL1', 'Additional Field2');
            $sheet->setCellValue('AM1', 'Additional Field3');
            $rows = 2;

            foreach ($result['data'] as $key => $value) {
                $sheet->setCellValue('A' . $rows, ucwords($value['customer_reference']));
                $sheet->setCellValue('B' . $rows, date('d-m-Y',strtotime($value['created_at'])));
                $sheet->setCellValue('C' . $rows, 'TT');
                $sheet->setCellValue('D' . $rows, ucwords($value['dd_number']));
                $sheet->setCellValue('E' . $rows, ucwords($value['txn_currency_type']));
                $sheet->setCellValue('F' . $rows, ucwords($value['txn_frgn_curr_amount']));
                $sheet->setCellValue('G' . $rows, ucwords($value['forward_booking_ref']));
                $sheet->setCellValue('H' . $rows, ucwords($value['pancard_name']));
                $sheet->setCellValue('I' . $rows, ucwords($value['pancard_no']));
                $sheet->setCellValue('J' . $rows, ucwords($value['remitter_address']));
                $sheet->setCellValue('K' . $rows, ucwords($value['remitter_city']));
                $sheet->setCellValue('L' . $rows, ucwords($value['remitter_country']));
                $sheet->setCellValue('M' . $rows, ucwords($value['beneficiary_name']));
                $sheet->setCellValue('N' . $rows, ucwords($value['beneficiary_address']));
                $sheet->setCellValue('O' . $rows, ucwords($value['beneficiary_country']));
                $sheet->setCellValue('P' . $rows, ucwords($value['beneficiary_city']));
                $sheet->setCellValue('Q' . $rows, ucwords($value['beneficiary_ac_number']));
                $sheet->setCellValue('R' . $rows, ucwords($value['beneficiary_bank_name']));
                $sheet->setCellValue('S' . $rows, ucwords($value['beneficiary_bank_address']));
                $sheet->setCellValue('T' . $rows, ucwords($value['beneficiary_bank_sort']));
                $sheet->setCellValue('U' . $rows, ucwords($value['beneficiary_swift_code']));
                $sheet->setCellValue('V' . $rows, ucwords($value['sub_purpose_code']));
                $sheet->setCellValue('W' . $rows, ucwords($value['additional_detail']));
                $sheet->setCellValue('X' . $rows, ucwords($value['fb_charges']));
                $sheet->setCellValue('Y' . $rows, ucwords($value['interm_bank_name']));
                $sheet->setCellValue('Z' . $rows, ucwords($value['interm_address']));
                $sheet->setCellValue('AA' . $rows, ucwords($value['interm_bic_code']));
                $sheet->setCellValue('AB' . $rows, ucwords($value['interm_bank_sort']));
                $sheet->setCellValue('AC' . $rows, ucwords($value['individual_entity_corporate']));
                $sheet->setCellValue('AD' . $rows, ucwords($value['remitter_email']));
                $sheet->setCellValue('AE' . $rows, ucwords($value['remitter_mobile']));
                $sheet->setCellValue('AF' . $rows, '');
                $sheet->setCellValue('AG' . $rows, $value['gross_payable']);
                $sheet->setCellValue('AH' . $rows, ucwords($value['individual_entity_corporate']));
                $sheet->setCellValue('AI' . $rows, '');
                $sheet->setCellValue('AJ' . $rows, ucwords($value['pancard_relation']));
                $sheet->setCellValue('AK' . $rows, '');
                $sheet->setCellValue('AL' . $rows, '');
                $sheet->setCellValue('AM' . $rows, '');
                $rows++;
            }

            $fileName = "transactions.xlsx";
            $writer = new Xlsx($spreadsheet);
            //For download file in project public path
            $writer->save(public_path("transaction/" . $fileName));
            //$writer->save($fileName);
            $path = url("transaction/" . $fileName);

            return response()->json(array('type' => 'SUCCESS', 'message' => 'Success', 'data' => array('path' => $path)));
        } else {
            return response()->json(array('type' => 'ERROR', 'message' => 'Something Went Wrong', 'data' => []));
        }
    }
	
	//Export Single data
    public function singleDataExport(Request $request)
    {
        $input = $request->all();

        /*$array = ['txn_id','txn_currency_type','txn_currency_type','txn_inr_amount','id','id','id'];*/
        $query = Transactions::join('transaction_currency','transaction_currency.txn_id','transactions.txn_number')->where('transactions.id',$input['id']);

        $query->where('kyc_status','1')->where('transaction_status','1')->where('payment_status','1');

        $result['data'] = $query->get()->toArray();

       // print_r($result['data']); exit;

        if ($result) {
            $spreadsheet = new Spreadsheet();
            $sheet = $spreadsheet->getActiveSheet();
            $sheet->setCellValue('A1', 'Customer Reference');
            $sheet->setCellValue('B1', 'Tran Date');
            $sheet->setCellValue('C1', 'Mode');
            $sheet->setCellValue('D1', 'DD Number');
            $sheet->setCellValue('E1', 'Curr');
            $sheet->setCellValue('F1', 'FCY Amount');
            $sheet->setCellValue('G1', 'Forward Booking Ref');
            $sheet->setCellValue('H1', 'Remitter Name');
            $sheet->setCellValue('I1', 'Remitter PAN');
            $sheet->setCellValue('J1', 'Remitter Address');
            $sheet->setCellValue('K1', 'Remitter City');
            $sheet->setCellValue('L1', 'Remitter Country');
            $sheet->setCellValue('M1', 'Beneficiary Name');
            $sheet->setCellValue('N1', 'Beneficiary Address');
            $sheet->setCellValue('O1', 'Beneficiary City');
            $sheet->setCellValue('P1', 'Beneficiary Country');
            $sheet->setCellValue('Q1', 'Beneficiary Ac No./IBAN Code');
            $sheet->setCellValue('R1', 'Bene Bank Name');
            $sheet->setCellValue('S1', 'Bene Bank  Address');
            $sheet->setCellValue('T1', 'Bene Bank SORT/BSB/ABA/TRANSIT/FED WIRE CODE');
            $sheet->setCellValue('U1', 'Bene Bank SWIFT Code');
            $sheet->setCellValue('V1', 'Sub Purpose Code');
            $sheet->setCellValue('W1', 'Additional Details (For Education/Tour Etc)');
            $sheet->setCellValue('X1', 'FB Charges');
            $sheet->setCellValue('Y1', 'Interm Bank Name');
            $sheet->setCellValue('Z1', 'interm Address');
            $sheet->setCellValue('AA1', 'interm BIC Code');
            $sheet->setCellValue('AB1', 'Interm Bank SORT/BSB/ABA/TRANSIT/FED WIRE CODE');
            $sheet->setCellValue('AC1', 'Individual/Entity/Corporate');
            $sheet->setCellValue('AD1', 'Remitter Email');
            $sheet->setCellValue('AE1', 'Remitter Mobile ');
            $sheet->setCellValue('AF1', 'Deal No');
            $sheet->setCellValue('AG1', 'Amount');
            $sheet->setCellValue('AH1', 'Bene User Identity');
            $sheet->setCellValue('AI1', 'DOB');
            $sheet->setCellValue('AJ1', 'Relation');
            $sheet->setCellValue('AK1', 'Additional Field1');
            $sheet->setCellValue('AL1', 'Additional Field2');
            $sheet->setCellValue('AM1', 'Additional Field3');
            $rows = 2;

            foreach ($result['data'] as $key => $value) {
                $sheet->setCellValue('A' . $rows, ucwords($value['customer_reference']));
                $sheet->setCellValue('B' . $rows, date('d-m-Y',strtotime($value['created_at'])));
                $sheet->setCellValue('C' . $rows, 'TT');
                $sheet->setCellValue('D' . $rows, ucwords($value['dd_number']));
                $sheet->setCellValue('E' . $rows, ucwords($value['txn_currency_type']));
                $sheet->setCellValue('F' . $rows, ucwords($value['txn_frgn_curr_amount']));
                $sheet->setCellValue('G' . $rows, ucwords($value['forward_booking_ref']));
                $sheet->setCellValue('H' . $rows, ucwords($value['pancard_name']));
                $sheet->setCellValue('I' . $rows, ucwords($value['pancard_no']));
                $sheet->setCellValue('J' . $rows, ucwords($value['remitter_address']));
                $sheet->setCellValue('K' . $rows, ucwords($value['remitter_city']));
                $sheet->setCellValue('L' . $rows, ucwords($value['remitter_country']));
                $sheet->setCellValue('M' . $rows, ucwords($value['beneficiary_name']));
                $sheet->setCellValue('N' . $rows, ucwords($value['beneficiary_address']));
                $sheet->setCellValue('O' . $rows, ucwords($value['beneficiary_country']));
                $sheet->setCellValue('P' . $rows, ucwords($value['beneficiary_city']));
                $sheet->setCellValue('Q' . $rows, ucwords($value['beneficiary_ac_number']));
                $sheet->setCellValue('R' . $rows, ucwords($value['beneficiary_bank_name']));
                $sheet->setCellValue('S' . $rows, ucwords($value['beneficiary_bank_address']));
                $sheet->setCellValue('T' . $rows, ucwords($value['beneficiary_bank_sort']));
                $sheet->setCellValue('U' . $rows, ucwords($value['beneficiary_swift_code']));
                $sheet->setCellValue('V' . $rows, ucwords($value['sub_purpose_code']));
                $sheet->setCellValue('W' . $rows, ucwords($value['additional_detail']));
                $sheet->setCellValue('X' . $rows, ucwords($value['fb_charges']));
                $sheet->setCellValue('Y' . $rows, ucwords($value['interm_bank_name']));
                $sheet->setCellValue('Z' . $rows, ucwords($value['interm_address']));
                $sheet->setCellValue('AA' . $rows, ucwords($value['interm_bic_code']));
                $sheet->setCellValue('AB' . $rows, ucwords($value['interm_bank_sort']));
                $sheet->setCellValue('AC' . $rows, ucwords($value['individual_entity_corporate']));
                $sheet->setCellValue('AD' . $rows, ucwords($value['remitter_email']));
                $sheet->setCellValue('AE' . $rows, ucwords($value['remitter_mobile']));
                $sheet->setCellValue('AF' . $rows, '');
                $sheet->setCellValue('AG' . $rows, $value['gross_payable']);
                $sheet->setCellValue('AH' . $rows, ucwords($value['individual_entity_corporate']));
                $sheet->setCellValue('AI' . $rows, '');
                $sheet->setCellValue('AJ' . $rows, ucwords($value['pancard_relation']));
                $sheet->setCellValue('AK' . $rows, '');
                $sheet->setCellValue('AL' . $rows, '');
                $sheet->setCellValue('AM' . $rows, '');
                $rows++;
            }

            $fileName = "transaction-".$result['data'][0]['txn_number'].".xlsx";
            $writer = new Xlsx($spreadsheet);
            //For download file in project public path
            $writer->save(public_path("transaction/" . $fileName));
            //$writer->save($fileName);
            $path = url("transaction/" . $fileName);

            return response()->json(array('type' => 'SUCCESS', 'message' => 'Success', 'data' => array('path' => $path)));
        } else {
            return response()->json(array('type' => 'ERROR', 'message' => 'Something Went Wrong', 'data' => []));
        }

    }
	
	 public function tableApprovedDealData(Request $request)
    {
        $input = $request->all();
        /*$array = ['txn_id','txn_currency_type','txn_currency_type','txn_inr_amount','id','id','id'];*/
        $query = RateBlock::with('getPurpose','getAgent')
        ->whereNotNull('fx_rate');

        if (isset($input['search']['value']) && !empty($input['search']['value'])) {

            $searchValue = $input['search']['value'];
            $query->where(function ($query) use ($searchValue) {
                $query->where('reference_number', 'like', '%' . $searchValue . '%')
                      ->orWhere('fx_value', 'like', '%' . $searchValue . '%')
                      ->orWhere('fx_currency', 'like', '%' . $searchValue . '%')
                      ->orWhere('fx_rate', 'like', '%' . $searchValue . '%')
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
    
    
    public function export(Request $request)
    {

        if($request->type == "approved_deals"){
            return Excel::download(new AdminApprovedDealsExport, 'approved-deals.xlsx');
        }elseif($request->type == "kyc"){
            return Excel::download(new AdminKycExport, 'kyc.xlsx');
        }elseif($request->type == "pending_payment"){
         
            return Excel::download(new AdminPendingPaymentExport,'pending-payments.xlsx');
        }elseif($request->type == "all_transection"){
            $sData['customer_id'] = $request->customer_id;
            $sData['agent_id'] = $request->agent_id;
            $sData['datefilter'] = $request->datefilter;


            return Excel::download(new AdminAllBookingExport($sData),'all-booking.xlsx');
        }elseif($request->type == "complete_transection"){
            $sData['customer_id'] = $request->customer_id;
            $sData['agent_id'] = $request->agent_id;
            $sData['datefilter'] = $request->datefilter;

            return Excel::download(new AdminCompleteTransectionExport($sData),'complete-transection.xlsx');
        }
    }

    public function print(Request $request)
    {

         $type = $request->type;
        if($request->type == "approved_deals"){
           $transections = RateBlock::with('getPurpose','getAgent')
                        ->whereNotNull('fx_rate')->get();
            return view('dashboard::print',compact('transections','type'));
        }elseif($request->type == "kyc"){

            $query = Transactions::with('txnCurrency','purposeData','sourceData');
            $query->whereHas('txnCurrency', function($query){
                $query->where('kyc_status','!=','1');
            });
            $transections = $query->get();

            return view('dashboard::print',compact('transections','type'));
        }elseif($request->type == "pending_payment"){

            $query = Transactions::with('txnCurrency','purposeData','sourceData');
            $query->whereHas('txnCurrency', function($query) {
                $query->where('kyc_status','1')->where('p_status','0');
            });
            $transections = $query->get();
            return view('dashboard::print',compact('transections','type'));

        }elseif($request->type == "all_transection"){
            $sData['customer_id'] = $request->customer_id;
            $sData['agent_id'] = $request->agent_id;
            $sData['datefilter'] = $request->datefilter;

            $query = Transactions::with('txnCurrency','purposeData','sourceData');
            $query->whereHas('txnCurrency');

            if(isset($sData['customer_id']) && $sData['customer_id']!=''){
                $query->where('customer_id', $sData['customer_id']);
            }

            if(isset($sData['agent_id']) && $sData['agent_id']!=''){
                $query->where('created_by', $sData['agent_id']);
            }


            if(isset($sData['datefilter']) && $sData['datefilter']!=''){
                $date=$sData['datefilter'];
                $dates=explode(' - ',$date);
                $date0 = str_replace(' ', '', $dates[0]);
                $dates1 = array_key_exists(1,$dates) ? str_replace('/t', '', $dates[1]) : $date0;
                $query->whereDate('created_at','>=',date('Y-m-d',strtotime($date0)))
                        ->whereDate('created_at','<=',date('Y-m-d',strtotime($dates1)));
            }
            $transections = $query->get();
            return view('dashboard::print',compact('transections','type'));

        }elseif($request->type == "complete_transection"){
            $sData['customer_id'] = $request->customer_id;
            $sData['agent_id'] = $request->agent_id;
            $sData['datefilter'] = $request->datefilter;

            $query = Transactions::with('txnCurrency','purposeData','sourceData');
            $query->whereHas('txnCurrency');

            if(isset($sData['customer_id']) && $sData['customer_id']!=''){
                $query->where('customer_id', $sData['customer_id']);
            }

            if(isset($sData['agent_id']) && $sData['agent_id']!=''){
                $query->where('created_by', $sData['agent_id']);
            }

            if(isset($sData['datefilter']) && $sData['datefilter']!=''){
                $date=$sData['datefilter'];
                $dates=explode(' - ',$date);
                $date0 = str_replace(' ', '', $dates[0]);
                $dates1 = array_key_exists(1,$dates) ? str_replace('/t', '', $dates[1]) : $date0;
                $query->whereDate('created_at','>=',date('Y-m-d',strtotime($date0)))
                        ->whereDate('created_at','<=',date('Y-m-d',strtotime($dates1)));
            }
            $transections = $query->where('kyc_status','1')->where('transaction_status','1')->where('payment_status','1')->get();

            return view('dashboard::print',compact('transections','type'));
        }

    }

}
