<?php

namespace Modules\Settings\Http\Controllers;

use App\Http\Controllers\Common\CommonController;
use App\Models\AgentUsers;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Hash;
use mysql_xdevapi\Exception;

class SettingsController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function __construct()
    {
        $this->middleware('auth.adminLogin');
    }

    public function index()
    {
        return view('settings::index');
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */

    public function create()
    {
        try {
            return view('settings::modal.add');
        }catch (Exception $e){
            return $e->getStatusCode();
        }

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
            'first_name' => 'required',
            'last_name' => 'required',
            'branch_name' => 'required',
            'email' => 'required|email|unique:agent_users',
            'mobile' => 'required|unique:agent_users',
            'password' => 'required',
        ]);

        $input['password'] = Hash::make($input['password']);

        /*if ($request->hasFile('profile_pic')) {

            ////Q-cloude upload
            $file=$_FILES['profile_pic'];
            $key = 'itouch-user/' . time().'.'.$request->profile_pic->extension();
            $this->client->putObject(array(
                'Bucket' => $this->bucket,
                'Key' => $key,
                'Body' => fopen($file['tmp_name'], 'rb') ));
            $presignedUrl = CommonController::generatePresignedUrl($key);
            $input['profile_pic']=$presignedUrl;
            Log::info(['$presignedUrl' => $presignedUrl]);

        }*/
        $input['mobile']=str_replace(' ','',$input['mobile']);
        $result = AgentUsers::create($input);

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
        $array = ['first_name','email','mobile','status','id'];
        $column = $input['order'][0]['column'];
        $query = AgentUsers::orderBy($array[$column], $input['order'][0]['dir']);
        if (isset($input['search']['value']) && !empty($input['search']['value'])) {
            $query->where(function ($query) use ($input) {
                $query->where('first_name', 'like', '%' . $input['search']['value'] . '%');
                $query->orWhere('last_name', 'like', '%' . $input['search']['value'] . '%');
                $query->orWhere('email', 'like', '%' . $input['search']['value'] . '%');
                $query->orWhere('mobile', 'like', '%' . $input['search']['value'] . '%');
                $query->orWhere('branch_name', 'like', '%' . $input['search']['value'] . '%');
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
        return view('settings::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        $result = AgentUsers::where('id', $id)->first();
        // $data['device_id'] = DB::table('device_register')->select('id', 'android_device_model')->get();
        $data['data'] = $result;
        return view('settings::modal.edit')->with($data);
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
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email|unique:agent_users,email,'.$id. ',id',
            'mobile' => 'required|unique:agent_users,mobile,'.$id. ',id'
        ]);

        /*if ($request->hasFile('profile_pic')) {

            $image = $request->file('profile_pic');
            $image_name = time().'.'.$request->profile_pic->extension();
            $path = public_path('upload/profile');
            $dest =  $image->move($path, $image_name);
            $input['profile_pic'] = $image_name;
        }*/
        $result = AgentUsers::where('id', $id)->update($input);

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
        $result = AgentUsers::where('id', $input['id'])->first();
        AgentUsers::where('id', $result['id'])->delete();
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
            AgentUsers::where('id', $id)->update(['status' => ($input['status'] ? false : true)]);
            return response()->json(array('type' => 'SUCCESS', 'message' => "Status Changed Successfully"));
        } catch (\Exception $e) {
            return response()->json(array('type' => 'ERROR', 'message' => $e->getMessage()));
        }
    }

    /*public function sendEmail($toEmail, $toName, $id, $type = 'reset')
    {
        $data = array('name' => $toName, 'id' => $id, 'type' => $type);
        Mail::send('mail.reset', $data, function ($message) use ($toEmail, $toName) {
            $message->to($toEmail, $toName)->subject('Invitation');
            $message->from(env('MAIL_FROM_ADDRESS'), env('MAIL_FROM_NAME'));
        });
    }*/

    public function reset(Request $request, $id){
        $input = $request->all();
        try {
            $result = AgentUsers::where('id', $id)->first();
            $generatePwd = $this->generatePassword(10);
            $sendData = array(
                'email'=>$result->email,
                'name'=>$result->first_name." ".$result->last_name,
                'reset_password'=>$generatePwd,
            );
            sendEmail($sendData,"Reset Password",'mail.reset');
            $data['password'] = Hash::make($generatePwd);
            $result = AgentUsers::where('id', $id)->update($data);
            /*AgentUsers::where('id', $id)->update(['status' => ($input['status'] ? false : true)]);*/
            if ($result) {
                return response()->json(array('type' => 'SUCCESS', 'message' => "Reset password Successfully"));
            } else {
                return response()->json(array('type' => 'ERROR', 'message' => 'Something Went Wrong', 'data' => []));
            }
        } catch (\Exception $e) {
            return response()->json(array('type' => 'ERROR', 'message' => $e->getMessage()));
        }
    }

    public function generatePassword( $length ) {

        $chars = 'abcdefghijklmnopqrstuvwxyz@#$ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
        return substr(str_shuffle($chars),0,$length);

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
