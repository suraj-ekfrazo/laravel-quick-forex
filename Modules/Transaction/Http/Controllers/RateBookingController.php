<?php

namespace Modules\Transaction\Http\Controllers;

use App\Models\RateBlock;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class RateBookingController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        return view('transaction::index');
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('transaction::create');
    }

    public function tableData(Request $request)
    {
        $input = $request->all();
        $array = ['branch_id','fx_currency','fx_value','fx_rate','deal_id'];
        $column = $input['order'][0]['column'];
        $query = RateBlock::with('getAgent')->with('getPurpose')->orderBy('id','DESC')->orderBy($array[$column], $input['order'][0]['dir']);
        if (isset($input['search']['value']) && !empty($input['search']['value'])) {
            $query->where(function ($query) use ($input) {
                $query->where('fx_currency', 'like', '%' . $input['search']['value'] . '%');
                $query->orWhere('fx_value', 'like', '%' . $input['search']['value'] . '%');
				$query->orWhere('reference_number', 'like', '%' . $input['search']['value'] . '%');
                $query->orWhere('fx_rate', 'like', '%' . $input['search']['value'] . '%');
                $query->orWhere('created_at', 'like', '%' . $input['search']['value'] . '%');
            });
        }
        $query->where('deal_id',null);

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
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        return view('transaction::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        return view('transaction::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $id)
    {
        //
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
