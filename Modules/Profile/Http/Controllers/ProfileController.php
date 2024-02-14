<?php

namespace Modules\Profile\Http\Controllers;

use App\Models\{User,Notification};
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use DB;
class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $result = User::where('id', Auth::user()->id)->first();
        $data['data'] = $result;
        return view('profile::index')->with($data);
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('profile::create');
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
        return view('profile::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        return view('profile::edit');
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
            'password' => 'nullable|string|min:8|same:confirm_password|regex:/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{8,}$/',
            'confirm_password' => 'required_with:password|nullable|string|min:8|regex:/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{8,}$/',
        ];

        $request->validate($rules);

        if(!empty($input['password'])){
            $input['password'] =  password_hash($input['password'], PASSWORD_BCRYPT);
        }else{
            unset($input['password']);
        }
        unset($input['confirm_password']);

        $result = User::where('id', $id)->update($input);

        $message = 'Successfully Updated';

        if ($result) {
            return response()->json(array('type' => 'SUCCESS', 'message' => $message, 'data' => $result));
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
	
	/** get admin Notification*/
    public function getNotification()
    {
        DB::beginTransaction();
        try{

            $data =Notification::where('notifiable_id',Auth::user()->id)
            ->where('read_at',null)->first();


            if($data){
                $data->update([
                    'read_at'=>date('Y-m-d'),
                ]);
                $message =  explode('"',$data->data);
                $response['data']    =  $message[3];
            }else{
                $response['data']       = $data;
            }
            DB::commit();
            $response['status']     = true;
            $response['message']    = "Nofificaion Get Succesfully";
            return response()->json($response);
        }catch(Exception $e){
            return $e;
            return response()->json($response);
        }
    }
}
