<?php

namespace App\Exports;


use App\Models\AgentUsers;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use App\Models\Transactions;
use Illuminate\Support\Facades\Auth;
class AdminBranchExport implements FromCollection,WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {

        $users = AgentUsers::get();
        $data1 = [];
        foreach ($users as $k=>$user){
            $data1[$k]['Branch Name'] =  $user->branch_name;
            $data1[$k]['Email ID']    =  $user->email;
            $data1[$k]['Mobile']      =  $user->mobile;
            $data1[$k]['Status']      =  $user->status == 1 ? 'Active' : 'Inactive';
        }

        return collect($data1);
    }



    public function headings(): array
    {

        return ["Branch Name", "Email ID","Mobile","Status"
        ];

    }
}
