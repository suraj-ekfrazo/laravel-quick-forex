<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use App\Models\Transactions;

class TransectionExport implements FromCollection,WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {

        $query = Transactions::with('txnCurrency','purposeData','sourceData');
        $query->whereHas('txnCurrency');
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

            if($transection->transaction_status == 0){
                $transaction_status = "Pending";
            }elseif($transection->transaction_status == 1){
                $transaction_status = "Completed";
            }else{
                $transaction_status = "Rejected";
            }

            $data1[$k]['Transaction Status'] =  $transaction_status;
            $data1[$k]['Deal Expiry Date']   =  $transection->expired_date ? date('d-m-Y h:m:ss A', strtotime($transection->expired_date)) : '';
        }

        return collect($data1);
    }



    public function headings(): array
    {

        return ["Transaction Number", "Customer Name", "Type","Remitter PAN","KYC Status",
        "Payment Status","Transaction Status","Deal Expiry Date"];

    }
}
