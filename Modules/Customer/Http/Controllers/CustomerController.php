<?php

namespace Modules\Customer\Http\Controllers;

use App\Models\Customers;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\AdminCustomerExport;
class CustomerController extends Controller
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
        return view('customer::index');
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('customer::modal.add');
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
            'mobile' => 'required|unique:customers',
        ]);

        $input['mobile']=str_replace(' ','',$input['mobile']);
        $result = Customers::create($input);

        $message = 'Agent Successfully Added';
        if ($result) {
            return response()->json(array('type' => 'SUCCESS', 'message' => $message));
        } else {
            return response()->json(array('type' => 'ERROR', 'message' => 'Something Went Wrong', 'data' => []));
        }
    }

    public function tableData(Request $request)
    {
        $input = $request->all();
        $array = ['name','mobile','status','id'];
        $column = $input['order'][0]['column'];
        $query = Customers::orderBy($array[$column], $input['order'][0]['dir']);
        if (isset($input['search']['value']) && !empty($input['search']['value'])) {
            $query->where(function ($query) use ($input) {
                $query->where('mobile', 'like', '%' . $input['search']['value'] . '%');
                $query->orWhere('name', 'like', '%' . $input['search']['value'] . '%');
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
        return view('customer::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        $result = Customers::where('id', $id)->first();
        $data['data'] = $result;
        return view('customer::modal.edit')->with($data);
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

        $request->validate([
            'name' => 'required',
            'mobile' => 'required|unique:customers,mobile,'.$id. ',id'
        ]);

        $input['mobile']=str_replace(' ','',$input['mobile']);
        $result = Customers::where('id', $id)->update($input);

        $message = 'Successfully Updated';

        if ($result) {
            return response()->json(array('type' => 'SUCCESS', 'message' => $message, 'data' => $result));
        } else {
            return response()->json(array('type' => 'ERROR', 'message' => 'Something Went Wrong', 'data' => []));
        }
    }

    public function delete(Request $request)
    {
        $input = $request->all();
        $result = Customers::where('id', $input['id'])->first();
        Customers::where('id', $result['id'])->delete();
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
        return Excel::download(new AdminCustomerExport, 'customer.xlsx');
    }

    public function print()
    {
        $users = Customers::get();
        return view('customer::print',compact('users'));

    }
}
