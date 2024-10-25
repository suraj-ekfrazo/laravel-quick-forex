<?php

namespace App\Http\Controllers\Agent;

use App\Http\Controllers\Controller;
use App\Models\{AgentUsers,User,Customers};
use App\Models\Transactions;
use http\Env\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Maatwebsite\Excel\Facades\Excel;

class SummaryReport extends Controller
{
    public function __construct()
    {
        $this->middleware('auth.agentLogin');
    }

    public function index()
    {
        $data['total'] = Transactions::where('created_by', Auth::guard('agent_users')->user()->id)->count();
        $data['approved'] = Transactions::where('kyc_status','1')->where('transaction_status','1')->where('payment_status','1')->where('created_by', Auth::guard('agent_users')->user()->id)->count();
        $data['kyc_rejected'] = Transactions::where('kyc_status','2')->where('created_by', Auth::guard('agent_users')->user()->id)->count();
        $data['payment_rejected'] = Transactions::where('payment_status','2')->where('created_by', Auth::guard('agent_users')->user()->id)->count();
        $data['kyc_pending'] = Transactions::where('kyc_status','0')->where('created_by', Auth::guard('agent_users')->user()->id)->count();
        $data['payment_pending'] = Transactions::where('payment_status','0')->where('created_by', Auth::guard('agent_users')->user()->id)->count();
        $data['swift_pending'] = Transactions::whereNull('swift_upload_document')->where('created_by', Auth::guard('agent_users')->user()->id)->count();

        $customers = Transactions::where('created_by', Auth::guard('agent_users')->user()->id)
                    ->distinct()
                    ->pluck('customer_name');

        return view('agent.agentSummaryReport', compact('data', 'customers'));
    }

    public function transactionSummaryReportTableData(Request $request)
    {
        $input = $request->all();

        if (isset($input['daterange']) && !empty($input['daterange'])) {
            $dateRange = $input['daterange'];
            $dateRange = explode(' - ',$dateRange);
            if (count($dateRange) == 2) {
                $start_date = date("Y-m-d", strtotime($dateRange[0])) ;
                $end_date = date("Y-m-d", strtotime($dateRange[1])) ;
            }
        }

        $userId = Auth::guard('agent_users')->user()->id;

        $data['total'] = Transactions::whereBetween('created_at', [$start_date, $end_date])->count();
        
        $data['approved'] = Transactions::where('kyc_status', '1')
                            ->where('transaction_status', '1')
                            ->where('payment_status', '1')
                            ->whereBetween('created_at', [$start_date, $end_date])
                            ->where('created_by', $userId)
                            ->count();

        $data['kyc_rejected'] = Transactions::where('kyc_status', '2')
                                ->whereBetween('created_at', [$start_date, $end_date])
                                ->where('created_by', $userId)
                                ->count();

        $data['payment_rejected'] = Transactions::where('payment_status', '2')
                                    ->whereBetween('created_at', [$start_date, $end_date])
                                    ->where('created_by', $userId)
                                    ->count();

        $data['kyc_pending'] = Transactions::where('kyc_status', '0')
                                ->whereBetween('created_at', [$start_date, $end_date])
                                ->where('created_by', $userId)
                                ->count();

        $data['payment_pending'] = Transactions::where('payment_status', '0')
                                    ->whereBetween('created_at', [$start_date, $end_date])
                                    ->where('created_by', $userId)
                                    ->count();

        $data['swift_pending'] = Transactions::whereNull('swift_upload_document')
                                ->whereBetween('created_at', [$start_date, $end_date])
                                ->where('created_by', $userId)
                                ->count();

        return response()->json(['data' => $data]);
    }

    public function viewAllTransactionTableData(Request $request)
    {
        $input = $request->all();

        $query = Transactions::with('txnCurrency','purposeData','sourceData');

        if(isset($request->datefilter) && $request->datefilter != ''){
            $date = $request->datefilter;
            $dates = explode(' - ',$date);
            $date0 = str_replace(' ', '', $dates[0]);
            $dates1 = array_key_exists(1,$dates) ? str_replace('/t', '', $dates[1]) : $date0;
            $query->whereDate('created_at','>=',date('Y-m-d',strtotime($date0)))->whereDate('created_at','<=',date('Y-m-d',strtotime($dates1)));
        }

        if(isset($request->panCardNo) && $request->panCardNo != ''){
            $query->where('pancard_no', $request->panCardNo);
        }

        if(isset($request->customerName) && $request->customerName != ''){
            $query->where('customer_name', 'like', '%' . $request->customerName . '%');
        }

        if (isset($input['search']['value']) && !empty($input['search']['value'])) {
            $query->where('txn_id', 'like', '%' . $input['search']['value'] . '%');
            $query->orWhere('txn_currency_type', 'like', '%' . $input['search']['value'] . '%');
            $query->orWhere('txn_inr_amount', 'like', '%' . $input['search']['value'] . '%');
        }
        $query->whereHas('txnCurrency', function($query) use ($input) {
            $query->where('created_by', Auth::guard('agent_users')->user()->id);
            if (isset($input['search']['value']) && !empty($input['search']['value'])) {
                $query->where('txn_number', 'like', '%' . $input['search']['value'] . '%');
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

    public function agentTransactionStatusExportData(Request $request)
    {
        $input = $request->all();
        
        if (isset($input['daterange']) && !empty($input['daterange'])) {
            $dateRange = $input['daterange'];
            $dateRange = explode(' - ',$dateRange);
            if (count($dateRange) == 2) {
                $start_date = date("Y-m-d", strtotime($dateRange[0])) ;
                $end_date = date("Y-m-d", strtotime($dateRange[1])) ;
            }
        }

        $userId = Auth::guard('agent_users')->user()->id;

        $totalQuery = Transactions::where('created_by', $userId);
        if (isset($start_date) && isset($end_date)) {
            $totalQuery->whereBetween('created_at', [$start_date, $end_date]);
        }
        $statusData['Total'] = $totalQuery->count();

        $approvedQuery = Transactions::where('kyc_status','1');
        $approvedQuery->where('transaction_status','1');
        $approvedQuery->where('payment_status','1');
        $approvedQuery->where('created_by', $userId);
        if (isset($start_date) && isset($end_date)) {
            $approvedQuery->whereBetween('created_at', [$start_date, $end_date]);
        }
        $statusData['Approved'] =  $approvedQuery->count();

        $kyc_rejectedQuery = Transactions::where('kyc_status','2');
        $kyc_rejectedQuery->where('created_by', $userId);
        if (isset($start_date) && isset($end_date)) {
            $kyc_rejectedQuery->whereBetween('created_at', [$start_date, $end_date]);
        }
        $statusData['KYC Rejected'] = $kyc_rejectedQuery->count();

        $payment_rejectedQuery = Transactions::where('payment_status','2');
        $payment_rejectedQuery->where('created_by', $userId);
        if (isset($start_date) && isset($end_date)) {
            $payment_rejectedQuery->whereBetween('created_at', [$start_date, $end_date]);
        }
        $statusData['Payment Rejected'] = $payment_rejectedQuery->count();

        $kyc_pendingQuery = Transactions::where('kyc_status','0');
        $kyc_pendingQuery->where('created_by', $userId);
        if (isset($start_date) && isset($end_date)) {
            $kyc_pendingQuery->whereBetween('created_at', [$start_date, $end_date]);
        }
        $statusData['KYC Pending'] = $kyc_pendingQuery->count();

        $payment_pendingQuery = Transactions::where('payment_status','0');
        $payment_pendingQuery->where('created_by', $userId);
        if (isset($start_date) && isset($end_date)) {
            $payment_pendingQuery->whereBetween('created_at', [$start_date, $end_date]);
        }
        $statusData['Payment Pending'] = $payment_pendingQuery->count();

        $swift_pendingQuery = Transactions::whereNull('swift_upload_document');
        $swift_pendingQuery->where('created_by', $userId);
        if (isset($start_date) && isset($end_date)) {
            $swift_pendingQuery->whereBetween('created_at', [$start_date, $end_date]);
        }
        $statusData['Swift Pending'] = $swift_pendingQuery->count();
        
        if ($statusData) {
            $spreadsheet = new Spreadsheet();
            $sheet = $spreadsheet->getActiveSheet();
            $sheet->setCellValue('A1', 'Transaction Type');
            $sheet->setCellValue('B1', 'Incident Count');

            $rows = 2;

            foreach ($statusData as $key_label => $resultData) {
                $sheet->setCellValue('A' . $rows, ucwords($key_label));
                $sheet->setCellValue('B' . $rows, $resultData);
                $rows++;
            }

            $fileName = "Agent-Transactions-Status-Report-".$userId."-".strtotime('now').".xlsx";
            $writer = new Xlsx($spreadsheet);
            //For download file in project public path
            $writer->save(public_path("summaryReport/" . $fileName));
            //$writer->save($fileName);
            $path = url("summaryReport/" . $fileName);

            return response()->json(array('type' => 'SUCCESS', 'message' => 'Success', 'data' => array('path' => $path)));
        } else {
            return response()->json(array('type' => 'ERROR', 'message' => 'Something Went Wrong', 'data' => []));
        }
    }

    public function agentViewAllTransactionSummaryExportData(Request $request)
    {
        $input = $request->all();
        
        $userId = Auth::guard('agent_users')->user()->id;

        $query = Transactions::with('purposeData','sourceData')->join('transaction_currency','transaction_currency.txn_id','transactions.txn_number')
                ->where('created_by', Auth::guard('agent_users')->user()->id);

        if(isset($request->datefilter) && $request->datefilter != ''){
            $date = $request->datefilter;
            $dates = explode(' - ',$date);
            $date0 = str_replace(' ', '', $dates[0]);
            $dates1 = array_key_exists(1,$dates) ? str_replace('/t', '', $dates[1]) : $date0;
            $query->whereDate('created_at','>=',date('Y-m-d',strtotime($date0)))->whereDate('created_at','<=',date('Y-m-d',strtotime($dates1)));
        }

        if(isset($request->pancard_no) && $request->pancard_no != ''){
            $query->where('pancard_no', $request->pancard_no);
        }

        if(isset($request->customer_name) && $request->customer_name != ''){
            $query->where('customer_name', 'like', '%' . $request->customer_name . '%');
        }

        $query->orderBy('transaction_currency.id','DESC');
        $result['data'] = $query->get()->toArray();

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
            $sheet->setCellValue('Q1', 'Beneficiary Ac No. OR IBAN Code');
            $sheet->setCellValue('R1', 'Bene Bank Name');
            $sheet->setCellValue('S1', 'Bene Bank  Address');
            $sheet->setCellValue('T1', 'Bene Bank SORT/BSB/ABA/TRANSIT/FED WIRE CODE');
            $sheet->setCellValue('U1', 'Bene Bank SWIFT Code');
            $sheet->setCellValue('V1', 'Sub Purpose Code');
            $sheet->setCellValue('W1', 'AdditionalDetails for Education/Tour');
            $sheet->setCellValue('X1', 'FB Charges');
            $sheet->setCellValue('Y1', 'Intermediate Bank Name');
            $sheet->setCellValue('Z1', 'Intermediate Bank Address');
            $sheet->setCellValue('AA1', 'Intermediate Bank SwiftCode');
            $sheet->setCellValue('AB1', 'Intermediate SortCode');
            $sheet->setCellValue('AC1', 'Merchant User Identity');
            $sheet->setCellValue('AD1', 'Remitter Email');
            $sheet->setCellValue('AE1', 'Remitter Mobile ');
            $sheet->setCellValue('AF1', 'Additional Deal No.');
            $sheet->setCellValue('AG1', 'Additional Amount');
            $sheet->setCellValue('AH1', 'Bene User Identity');
            $sheet->setCellValue('AI1', 'Remitter DOB');
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
                $sheet->setCellValue('L' . $rows, ucwords("IN"));
                $sheet->setCellValue('M' . $rows, ucwords($value['beneficiary_name']));
                $sheet->setCellValue('N' . $rows, ucwords($value['beneficiary_address']));
                $sheet->setCellValue('O' . $rows, ucwords($value['beneficiary_city']));
                $sheet->setCellValue('P' . $rows, ucwords($value['beneficiary_country']));
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

            $fileName = "Agent-View-All-Transactions-Summary-Report-".$userId."-".strtotime('now').".xlsx";
            $writer = new Xlsx($spreadsheet);
            //For download file in project public path
            $writer->save(public_path("summaryReport/" . $fileName));
            //$writer->save($fileName);
            $path = url("summaryReport/" . $fileName);

            return response()->json(array('type' => 'SUCCESS', 'message' => 'Success', 'data' => array('path' => $path)));
        } else {
            return response()->json(array('type' => 'ERROR', 'message' => 'Something Went Wrong', 'data' => []));
        }
    }

}
