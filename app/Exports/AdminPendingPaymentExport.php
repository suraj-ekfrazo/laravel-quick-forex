<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use App\Models\Transactions;

class AdminPendingPaymentExport implements FromCollection,WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {



        $query = Transactions::with('txnCurrency','purposeData','sourceData');
        $query->whereHas('txnCurrency', function($query) {
            $query->where('kyc_status','1')->where('p_status','0');
        });

        $transections = $query->get();
        $data1 = [];
        foreach ($transections as $k=>$transection){
            $data1[$k]['Transaction Number'] =  $transection->txn_number;
            $data1[$k]['Customer Name']      =  $transection->customer_name;
            $data1[$k]['Type']               =  $transection->txn_type == '1' ? 'Remittance' : 'Card';
            $data1[$k]['Remitter PAN']       =  $transection->pancard_no;

            if($transection->kyc_status == 0){
                $kyc_status = "Pending";
            }elseif($transection->kyc_status == 1){
                $kyc_status = "Completed";
            }else{
                $kyc_status = "Rejected";
            }
            $data1[$k]['KYC Status']  =  $kyc_status;

            if($transection->payment_status == 0){
                $payment_status = "Pending";
            }elseif($transection->payment_status == 1){
                $payment_status = "Completed";
            }else{
                $payment_status = "Rejected";
            }

            $data1[$k]['Payment Status']     =  $payment_status;
        }

        return collect($data1);
    }



    public function headings(): array
    {

        return ["Transaction Number", "Customer Name", "Type","Remitter PAN","KYC Status",
        "Payment Status"];

    }
}
