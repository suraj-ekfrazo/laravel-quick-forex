<?php

namespace Modules\CurrencyRate\Http\Controllers;

use App\Models\Currency;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller; 

class CurrencyRateController extends Controller
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
        return view('currencyrate::index');
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('currencyrate::modal.add');
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
            'currency_name' => 'required',
            'status' => 'required',
        ]);

        $result = Currency::create($input);

        $message = 'Currency Rate Successfully Added';
        if ($result) {
            return response()->json(array('type' => 'SUCCESS', 'message' => $message));
        } else {
            return response()->json(array('type' => 'ERROR', 'message' => 'Something Went Wrong', 'data' => []));
        }
    }

    public function tableData(Request $request)
    {
        $input = $request->all();
        $array = ['currency_name'];
        $column = $input['order'][0]['column'];
        $query = Currency::orderBy($array[$column], $input['order'][0]['dir']);
        if (isset($input['search']['value']) && !empty($input['search']['value'])) {
            $query->where(function ($query) use ($input) {
                $query->where('currency_name', 'like', '%' . $input['search']['value'] . '%');
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
        return view('currencyrate::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        $result = Currency::where('cur_id', $id)->first();
        $data['data'] = $result;
        return view('currencyrate::modal.edit')->with($data);
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
            'currency_name' => 'required',
            'status' => 'required',
        ]);

        $result = Currency::where('cur_id', $id)->update($input);

        $message = 'Currency Rate has successfully updated';

        if ($result) {
            return response()->json(array('type' => 'SUCCESS', 'message' => $message, 'data' => $result));
        } else {
            return response()->json(array('type' => 'ERROR', 'message' => 'Something Went Wrong', 'data' => []));
        }
    }

    public function delete(Request $request)
    {
        $input = $request->all();
        $result = Currency::where('cur_id', $input['id'])->first();
        Currency::where('cur_id', $result['id'])->delete();
        $message = 'Rate Margin has successfully deleted';
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
}
