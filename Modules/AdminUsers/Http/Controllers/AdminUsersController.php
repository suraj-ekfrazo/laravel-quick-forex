<?php

namespace Modules\AdminUsers\Http\Controllers;

use App\Models\User;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\Password;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\AdminUserExport;
class AdminUsersController extends Controller
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
        $data['pageTitle'] = "Admin Users";
        return view('adminusers::index')->with($data);
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('adminusers::modal.add');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        $input = $request->all();

        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:admin_users',
            'user_name' => 'required|unique:admin_users',
            'mobile_no' => 'required|unique:admin_users',
            'password' => 'required|string|min:6|regex:/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{8,}$/'
        ]);
        $input['password'] =  password_hash($input['password'], PASSWORD_BCRYPT);
        $result = User::create($input);

        $message = 'Successfully Added';
        if ($result) {
            return response()->json(array('type' => 'SUCCESS', 'message' => $message));
        } else {
            return response()->json(array('type' => 'ERROR', 'message' => 'Something Went Wrong', 'data' => []));
        }
    }

    public function tableData(Request $request)
    {
        $input = $request->all();
        $array = ['name','email','user_name','mobile_no'];
        $column = $input['order'][0]['column'];
        $query = User::orderBy($array[$column], $input['order'][0]['dir'])->where('id',"!=",Auth::user()->id);
        if (isset($input['search']['value']) && !empty($input['search']['value'])) {
            $query->where(function ($query) use ($input) {
                $query->where('mobile_no', 'like', '%' . $input['search']['value'] . '%');
                $query->orWhere('name', 'like', '%' . $input['search']['value'] . '%');
                $query->orWhere('email', 'like', '%' . $input['search']['value'] . '%');
                $query->orWhere('user_name', 'like', '%' . $input['search']['value'] . '%');
            });
        }
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

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        return view('adminusers::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        $result = User::where('id', $id)->first();
        $data['data'] = $result;
        return view('adminusers::modal.edit')->with($data);
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $id)
    {
        $input = $request->all();

        $rules = [
            'name' => 'required',
            'email' => 'required|email|unique:admin_users,email,'.$id. ',id',
            'user_name' => 'required|unique:admin_users,user_name,'.$id. ',id',
            'mobile_no' => 'required|unique:admin_users,mobile_no,'.$id. ',id',
            'password' => 'nullable|string|min:8|regex:/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{8,}$/',
        ];

        $request->validate($rules);

        if(!empty($input['password'])){
            $input['password'] =  password_hash($input['password'], PASSWORD_BCRYPT);
        }else{
            unset($input['password']);
        }

        $result = User::where('id', $id)->update($input);

        $message = 'Successfully Updated';

        if ($result) {
            return response()->json(array('type' => 'SUCCESS', 'message' => $message, 'data' => $result));
        } else {
            return response()->json(array('type' => 'ERROR', 'message' => 'Something Went Wrong', 'data' => []));
        }
    }

    public function status(Request $request, $id){
        $input = $request->all();
        try {
            User::where('id', $id)->update(['status' => ($input['status'] ? false : true)]);
            return response()->json(array('type' => 'SUCCESS', 'message' => "Status Changed Successfully"));
        } catch (\Exception $e) {
            return response()->json(array('type' => 'ERROR', 'message' => $e->getMessage()));
        }
    }

    public function delete(Request $request)
    {
        $input = $request->all();
        $result = User::where('id', $input['id'])->first();
        User::where('id', $result['id'])->delete();
        $message = 'Deleted Successfully';
        if ($result) {
            return response()->json(array('type' => 'SUCCESS', 'message' => $message, 'data' => []));
        } else {
            return response()->json(array('type' => 'ERROR', 'message' => 'Something Went Wrong', 'data' => []));
        }
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
    
        public function export()
    {
        return Excel::download(new AdminUserExport, 'admin-user.xlsx');
    }

    public function print()
    {
        $query = User::where('id',"!=",Auth::user()->id);
        $users = $query->get();
        return view('adminusers::print',compact('users'));

    }
}
