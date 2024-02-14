<?php

namespace Modules\Settings\Http\Controllers;

use App\Http\Controllers\Common\CommonController;
use App\Models\ManageSources;
use App\Models\RequiredDocuments;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class ManageSourcesController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function __construct()
    {
        $this->middleware('auth.adminLogin');
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */

    public function create()
    {
        $data['dataDocuments'] = RequiredDocuments::get()->toArray();
        return view('settings::sources.add')->with($data);
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
            'source_name' => 'required|unique:manage_sources',
            'exempt' => 'required',
            'tcs_rate' => 'required',
        ]);
        /*if(isset($input['documents'])){
            $input['documents'] = implode( ',', $input['documents'] );
        }*/
        $result = ManageSources::create($input);

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
        $array = ['source_name','tcs_rate','exempt','id','status'];
        $column = $input['order'][0]['column'];
        $query = ManageSources::orderBy($array[$column], $input['order'][0]['dir']);
        if (isset($input['search']['value']) && !empty($input['search']['value'])) {
            $query->where(function ($query) use ($input) {
                $query->where('source_name', 'like', '%' . $input['search']['value'] . '%');
                $query->orWhere('tcs_rate', 'like', '%' . $input['search']['value'] . '%');
                $query->orWhere('exempt', 'like', '%' . $input['search']['value'] . '%');
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
        $result = ManageSources::where('id', $id)->first();
        $data['data'] = $result;
        $data['dataDocuments'] = RequiredDocuments::get()->toArray();
        return view('settings::sources.view')->with($data);
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        $result = ManageSources::where('id', $id)->first();
        $data['data'] = $result;
        /*$data['dataDocuments'] = RequiredDocuments::get()->toArray();*/
        return view('settings::sources.edit')->with($data);
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
            'source_name' => 'required|unique:manage_sources,source_name,'.$id. ',id',
            'tcs_rate' => 'required',
            'exempt' => 'required',
        ]);
        /*if(isset($input['documents'])){
            $input['documents'] = implode( ',', $input['documents'] );
        }*/
        $result = ManageSources::where('id', $id)->update($input);

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
        $result = ManageSources::where('id', $input['id'])->first();
        ManageSources::where('id', $result['id'])->delete();
        $message = 'Deleted Successfully';
        if ($result) {
            return response()->json(array('type' => 'SUCCESS', 'message' => $message, 'data' => []));
        } else {
            return response()->json(array('type' => 'ERROR', 'message' => 'Something Went Wrong', 'data' => []));
        }
    }

    public function status(Request $request, $id){
        $input = $request->all();
        try {
            ManageSources::where('id', $id)->update(['status' => ($input['status'] ? false : true)]);
            return response()->json(array('type' => 'SUCCESS', 'message' => "Status Changed Successfully"));
        } catch (\Exception $e) {
            return response()->json(array('type' => 'ERROR', 'message' => $e->getMessage()));
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
}
