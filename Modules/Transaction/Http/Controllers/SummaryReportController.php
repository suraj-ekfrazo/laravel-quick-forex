<?php

namespace Modules\Transaction\Http\Controllers;

use App\Models\AgentUsers;
use App\Models\Transactions;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Maatwebsite\Excel\Facades\Excel;


class SummaryReportController extends Controller
{
    public function transactionWiseReport()
    {
        $data['total'] = Transactions::count();
        $data['approved'] = Transactions::where('kyc_status','1')->where('transaction_status','1')->where('payment_status','1')->count();
        $data['kyc_rejected'] = Transactions::where('kyc_status','2')->count();
        $data['payment_rejected'] = Transactions::where('payment_status','2')->count();
        $data['kyc_pending'] = Transactions::where('kyc_status','0')->count();
        $data['payment_pending'] = Transactions::where('payment_status','0')->count();
        $data['swift_pending'] = Transactions::whereNull('swift_upload_document')->count();

        $agentUsers = AgentUsers::get();

        $branchUserWiseData = [];
        $branchWiseUser_List = [];
        foreach ($agentUsers as $agent) {
            $statusData['agent_name'] = $agent->first_name;
            $statusData['branch_name'] = $agent->branch_name;
            $statusData['total'] = Transactions::where('created_by', $agent->id)->count();
            $statusData['approved'] = Transactions::where('kyc_status','1')->where('transaction_status','1')->where('payment_status','1')->where('created_by', $agent->id)->count();
            $statusData['kyc_rejected'] = Transactions::where('kyc_status','2')->where('created_by', $agent->id)->count();
            $statusData['payment_rejected'] = Transactions::where('payment_status','2')->where('created_by', $agent->id)->count();
            $statusData['kyc_pending'] = Transactions::where('kyc_status','0')->where('created_by', $agent->id)->count();
            $statusData['payment_pending'] = Transactions::where('payment_status','0')->where('created_by', $agent->id)->count();
            $statusData['swift_pending'] = Transactions::whereNull('swift_upload_document')->where('created_by', $agent->id)->count();

            $branchUserWiseData[$agent->id] = $statusData;
            $branchWiseUser_List[$agent->id] = $agent;
        }

        return view('transaction::summaryReport', compact('data','branchUserWiseData','branchWiseUser_List'));
    }

    public function transactionWiseFilterReport(Request $request)
    {
        $input = $request->all();

        if (isset($input['transaction_statusreport_daterange']) && !empty($input['transaction_statusreport_daterange'])) {
            $dateRange = $input['transaction_statusreport_daterange'];
            $dateRange = explode(' - ',$dateRange);
            if (count($dateRange) == 2) {
                $start_date = date("Y-m-d", strtotime($dateRange[0])) ;
                $end_date = date("Y-m-d", strtotime($dateRange[1])) ;
            }
        }

        $data['total'] = Transactions::whereBetween('created_at', [$start_date, $end_date])->count();
        
        $data['approved'] = Transactions::where('kyc_status', '1')
                            ->where('transaction_status', '1')
                            ->where('payment_status', '1')
                            ->whereBetween('created_at', [$start_date, $end_date])
                            ->count();

        $data['kyc_rejected'] = Transactions::where('kyc_status', '2')
                                ->whereBetween('created_at', [$start_date, $end_date])
                                ->count();

        $data['payment_rejected'] = Transactions::where('payment_status', '2')
                                    ->whereBetween('created_at', [$start_date, $end_date])
                                    ->count();

        $data['kyc_pending'] = Transactions::where('kyc_status', '0')
                                ->whereBetween('created_at', [$start_date, $end_date])
                                ->count();

        $data['payment_pending'] = Transactions::where('payment_status', '0')
                                    ->whereBetween('created_at', [$start_date, $end_date])
                                    ->count();

        $data['swift_pending'] = Transactions::whereNull('swift_upload_document')
                                ->whereBetween('created_at', [$start_date, $end_date])
                                ->count();

        return response()->json(['data' => $data]);

    }

    public function branchUserWiseFilterReportTableData(Request $request)
    {
        $input = $request->all();

        $query = Transactions::query();
    
        // Handle Date Range Filter
        if (isset($input['daterange']) && !empty($input['daterange'])) {
            $dateRange = explode(' - ', $input['daterange']);
            if (count($dateRange) == 2) {
                $start_date = date("Y-m-d", strtotime($dateRange[0]));
                $end_date = date("Y-m-d", strtotime($dateRange[1]));
            }
        }
    
        // Get Agent Users (Filter by branch_user_id if provided)
        if (!isset($input['branch_user_id']) || empty($input['branch_user_id'])) {
            $agentUsers = AgentUsers::get();
        } else {
            $agentUsers = AgentUsers::where('id', $input['branch_user_id'])->get();
        }
    
        $branchUserWiseData = [];
        foreach ($agentUsers as $agent) {
            $statusData['agent_name'] = $agent->first_name;
            $statusData['branch_name'] = $agent->branch_name;
    
            // Total transactions query
            $totalQuery = Transactions::where('created_by', $agent->id);
            if (isset($start_date) && isset($end_date)) {
                $totalQuery->whereBetween('created_at', [$start_date, $end_date]);
            }
            $statusData['total'] = $totalQuery->count();
    
            // Approved transactions query
            $approvedQuery = Transactions::where('kyc_status', '1')
                ->where('transaction_status', '1')
                ->where('payment_status', '1')
                ->where('created_by', $agent->id);
            if (isset($start_date) && isset($end_date)) {
                $approvedQuery->whereBetween('created_at', [$start_date, $end_date]);
            }
            $statusData['approved'] = $approvedQuery->count();
    
            // Other status queries (KYC Rejected, Payment Rejected, etc.)
            $kyc_rejectedQuery = Transactions::where('kyc_status', '2')->where('created_by', $agent->id);
            if (isset($start_date) && isset($end_date)) {
                $kyc_rejectedQuery->whereBetween('created_at', [$start_date, $end_date]);
            }
            $statusData['kyc_rejected'] = $kyc_rejectedQuery->count();
    
            $payment_rejectedQuery = Transactions::where('payment_status', '2')->where('created_by', $agent->id);
            if (isset($start_date) && isset($end_date)) {
                $payment_rejectedQuery->whereBetween('created_at', [$start_date, $end_date]);
            }
            $statusData['payment_rejected'] = $payment_rejectedQuery->count();
    
            $kyc_pendingQuery = Transactions::where('kyc_status', '0')->where('created_by', $agent->id);
            if (isset($start_date) && isset($end_date)) {
                $kyc_pendingQuery->whereBetween('created_at', [$start_date, $end_date]);
            }
            $statusData['kyc_pending'] = $kyc_pendingQuery->count();
    
            $payment_pendingQuery = Transactions::where('payment_status', '0')->where('created_by', $agent->id);
            if (isset($start_date) && isset($end_date)) {
                $payment_pendingQuery->whereBetween('created_at', [$start_date, $end_date]);
            }
            $statusData['payment_pending'] = $payment_pendingQuery->count();
    
            $swift_pendingQuery = Transactions::whereNull('swift_upload_document')->where('created_by', $agent->id);
            if (isset($start_date) && isset($end_date)) {
                $swift_pendingQuery->whereBetween('created_at', [$start_date, $end_date]);
            }
            $statusData['swift_pending'] = $swift_pendingQuery->count();
    
            $branchUserWiseData[] = $statusData;
        }
    
        $totalRecords = count($branchUserWiseData);
        $filteredData = array_slice($branchUserWiseData, $input['start'], $input['length']);
    
        $result['draw'] = $input['draw'];
        $result['recordsTotal'] = $totalRecords;
        $result['recordsFiltered'] = $totalRecords; 
        $result['data'] = $filteredData;  
      
        if ($result) {
            return response()->json(array('type' => 'SUCCESS', 'message' => 'Success', 'data' => $result['data'], 'recordsTotal' => $result['recordsTotal'], 'recordsFiltered' => $result['recordsFiltered']));
        } else {
            return response()->json(array('type' => 'ERROR', 'message' => 'Something Went Wrong', 'data' => []));
        }
    }

    public function adminTransactionStatusExportData(Request $request)
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

        $totalQuery = Transactions::query(); 
        if (isset($start_date) && isset($end_date)) {
            $totalQuery->whereBetween('created_at', [$start_date, $end_date]);
        }
        $statusData['Total'] = $totalQuery->count();

        $approvedQuery = Transactions::where('kyc_status','1');
        $approvedQuery->where('transaction_status','1');
        $approvedQuery->where('payment_status','1');
        if (isset($start_date) && isset($end_date)) {
            $approvedQuery->whereBetween('created_at', [$start_date, $end_date]);
        }
        $statusData['Approved'] =  $approvedQuery->count();

        $kyc_rejectedQuery = Transactions::where('kyc_status','2');
        if (isset($start_date) && isset($end_date)) {
            $kyc_rejectedQuery->whereBetween('created_at', [$start_date, $end_date]);
        }
        $statusData['KYC Rejected'] = $kyc_rejectedQuery->count();

        $payment_rejectedQuery = Transactions::where('payment_status','2');
        if (isset($start_date) && isset($end_date)) {
            $payment_rejectedQuery->whereBetween('created_at', [$start_date, $end_date]);
        }
        $statusData['Payment Rejected'] = $payment_rejectedQuery->count();

        $kyc_pendingQuery = Transactions::where('kyc_status','0');
        if (isset($start_date) && isset($end_date)) {
            $kyc_pendingQuery->whereBetween('created_at', [$start_date, $end_date]);
        }
        $statusData['KYC Pending'] = $kyc_pendingQuery->count();

        $payment_pendingQuery = Transactions::where('payment_status','0');
        if (isset($start_date) && isset($end_date)) {
            $payment_pendingQuery->whereBetween('created_at', [$start_date, $end_date]);
        }
        $statusData['Payment Pending'] = $payment_pendingQuery->count();

        $swift_pendingQuery = Transactions::whereNull('swift_upload_document');
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

            $fileName = "Admin-Transactions-Status-Report-".strtotime('now').".xlsx";
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

    public function adminBranchUserWiseExportData(Request $request)
    {
        $input = $request->all();

        $query = Transactions::query();
    
        // Handle Date Range Filter
        if (isset($input['daterange']) && !empty($input['daterange'])) {
            $dateRange = explode(' - ', $input['daterange']);
            if (count($dateRange) == 2) {
                $start_date = date("Y-m-d", strtotime($dateRange[0]));
                $end_date = date("Y-m-d", strtotime($dateRange[1]));
            }
        }
    
        // Get Agent Users (Filter by branch_user_id if provided)
        if (!isset($input['branch_user_id']) || empty($input['branch_user_id'])) {
            $agentUsers = AgentUsers::get();
        } else {
            $agentUsers = AgentUsers::where('id', $input['branch_user_id'])->get();
        }
    
        $branchUserWiseData = [];
        foreach ($agentUsers as $agent) {
            $statusData['agent_name'] = $agent->first_name;
            $statusData['branch_name'] = $agent->branch_name;
    
            // Total transactions query
            $totalQuery = Transactions::where('created_by', $agent->id);
            if (isset($start_date) && isset($end_date)) {
                $totalQuery->whereBetween('created_at', [$start_date, $end_date]);
            }
            $statusData['total'] = $totalQuery->count();
    
            // Approved transactions query
            $approvedQuery = Transactions::where('kyc_status', '1')
                ->where('transaction_status', '1')
                ->where('payment_status', '1')
                ->where('created_by', $agent->id);
            if (isset($start_date) && isset($end_date)) {
                $approvedQuery->whereBetween('created_at', [$start_date, $end_date]);
            }
            $statusData['approved'] = $approvedQuery->count();
    
            // Other status queries (KYC Rejected, Payment Rejected, etc.)
            $kyc_rejectedQuery = Transactions::where('kyc_status', '2')->where('created_by', $agent->id);
            if (isset($start_date) && isset($end_date)) {
                $kyc_rejectedQuery->whereBetween('created_at', [$start_date, $end_date]);
            }
            $statusData['kyc_rejected'] = $kyc_rejectedQuery->count();
    
            $payment_rejectedQuery = Transactions::where('payment_status', '2')->where('created_by', $agent->id);
            if (isset($start_date) && isset($end_date)) {
                $payment_rejectedQuery->whereBetween('created_at', [$start_date, $end_date]);
            }
            $statusData['payment_rejected'] = $payment_rejectedQuery->count();
    
            $kyc_pendingQuery = Transactions::where('kyc_status', '0')->where('created_by', $agent->id);
            if (isset($start_date) && isset($end_date)) {
                $kyc_pendingQuery->whereBetween('created_at', [$start_date, $end_date]);
            }
            $statusData['kyc_pending'] = $kyc_pendingQuery->count();
    
            $payment_pendingQuery = Transactions::where('payment_status', '0')->where('created_by', $agent->id);
            if (isset($start_date) && isset($end_date)) {
                $payment_pendingQuery->whereBetween('created_at', [$start_date, $end_date]);
            }
            $statusData['payment_pending'] = $payment_pendingQuery->count();
    
            $swift_pendingQuery = Transactions::whereNull('swift_upload_document')->where('created_by', $agent->id);
            if (isset($start_date) && isset($end_date)) {
                $swift_pendingQuery->whereBetween('created_at', [$start_date, $end_date]);
            }
            $statusData['swift_pending'] = $swift_pendingQuery->count();
    
            $branchUserWiseData[] = $statusData;
        }
        
        if ($branchUserWiseData) {
            $spreadsheet = new Spreadsheet();
            $sheet = $spreadsheet->getActiveSheet();
            $sheet->setCellValue('A1', 'Agent Name');
            $sheet->setCellValue('B1', 'Branch Name');
            $sheet->setCellValue('C1', 'Transaction Created');
            $sheet->setCellValue('D1', 'Approved');
            $sheet->setCellValue('E1', 'KYC Rejected');
            $sheet->setCellValue('F1', 'Payment Rejected');
            $sheet->setCellValue('G1', 'kYC Pending');
            $sheet->setCellValue('H1', 'Payment Pending');
            $sheet->setCellValue('I1', 'Swift Pending');

            $rows = 2;

            foreach ($branchUserWiseData as $key_label => $resultData) {

                $sheet->setCellValue('A' . $rows, $resultData['agent_name']);
                $sheet->setCellValue('B' . $rows, $resultData['branch_name']);
                $sheet->setCellValue('C' . $rows, $resultData['total']);
                $sheet->setCellValue('D' . $rows, $resultData['approved']);
                $sheet->setCellValue('E' . $rows, $resultData['kyc_rejected']);
                $sheet->setCellValue('F' . $rows, $resultData['payment_rejected']);
                $sheet->setCellValue('G' . $rows, $resultData['kyc_pending']);
                $sheet->setCellValue('H' . $rows, $resultData['payment_pending']);
                $sheet->setCellValue('I' . $rows, $resultData['swift_pending']);
                
                $rows++;
            }

            $fileName = "Admin-Branch-Wise-Transactions-Report-".strtotime('now').".xlsx";
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
