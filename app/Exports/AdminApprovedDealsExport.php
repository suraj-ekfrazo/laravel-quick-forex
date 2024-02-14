<?php

namespace App\Exports;


use App\Models\RateBlock;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use App\Models\Transactions;

class AdminApprovedDealsExport implements FromCollection,WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $transections = RateBlock::with('getPurpose','getAgent')
                        ->whereNotNull('fx_rate')->get();

        $data1 = [];
        foreach ($transections as $k=>$transection){
            $data1[$k]['Transaction Number'] =  $transection->reference_number;
            $data1[$k]['Branch']             =  $transection->branch_id ? optional($transection->getAgent)->branch_name : '';
            $data1[$k]['Currency']           =  $transection->fx_currency;
            $data1[$k]['Value']              =  $transection->fx_value;
            $data1[$k]['Purpose']            =  $transection->getPurpose ? optional($transection->getPurpose)->purpose_name : 'N/A';
            $data1[$k]['Transection Type']   =  "Remittance";
            $data1[$k]['Rate']               =  $transection->fx_rate;
            $data1[$k]['Deal ID']            =  $transection->deal_id ?? '';
            $data1[$k]['Expiry Date']        =  $transection->expiry_date ? date('d-m-Y h:m:ss A', strtotime($transection->expiry_date)) : '';
        }

        return collect($data1);
    }


    public function headings(): array
    {

        return ["Transaction Number", "Branch", "Currency","Value","Purpose",
        "Transection Type","Rate","Deal ID","Expiry Date"];

    }
}
