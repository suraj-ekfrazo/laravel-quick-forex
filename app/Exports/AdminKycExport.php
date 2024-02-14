<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use App\Models\Transactions;

class AdminKycExport implements FromCollection,WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {

        $query = Transactions::with('txnCurrency','purposeData','sourceData');

        $query->whereHas('txnCurrency', function($query){
            $query->where('kyc_status','!=','1');
        });


        $transections = $query->get();

        $data1 = [];
        foreach ($transections as $k=>$transection){
            $data1[$k]['Transaction Number'] =  $transection->txn_number;
            $data1[$k]['Customer Name']      =  $transection->customer_name;
            $data1[$k]['Transaction type']   =  $transection->txn_type == '1' ? 'Remittance' : 'Card';
            $data1[$k]['Purpose']            =  optional($transection->purposeData)->purpose_name;
        }

        return collect($data1);
    }



    public function headings(): array
    {

        return ["Transaction Number", "Customer Name", "Transaction type","Purpose"];

    }
}
