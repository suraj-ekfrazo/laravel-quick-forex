<?php

namespace App\Exports;


use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use App\Models\Transactions;
use Illuminate\Support\Facades\Auth;
class AdminUserExport implements FromCollection,WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {

        $query = User::where('id',"!=",Auth::user()->id);
        $users = $query->get();
        $data1 = [];
        foreach ($users as $k=>$user){
            $data1[$k]['Name']        =  $user->name;
            $data1[$k]['Email ID']    =  $user->email;
            $data1[$k]['User Name']   =  $user->user_name;
            $data1[$k]['Mobile']      =  $user->mobile_no;
            $data1[$k]['Status']      =  $user->status == 1 ? 'Active' : 'Inactive';
        }

        return collect($data1);
    }



    public function headings(): array
    {

        return ["Name", "Email ID", "User Name","Mobile","Status"
        ];

    }
}
