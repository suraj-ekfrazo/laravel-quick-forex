<?php

namespace App\Exports;


use App\Models\Customers;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use App\Models\Transactions;
use Illuminate\Support\Facades\Auth;
class AdminCustomerExport implements FromCollection,WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {

        $users = Customers::get();

        $data1 = [];
        foreach ($users as $k=>$user){
            $data1[$k]['Name']      = $user->name;
            $data1[$k]['Mobile']    =  $user->mobile;

        }

        return collect($data1);
    }



    public function headings(): array
    {

        return ["Name","Mobile"];

    }
}
