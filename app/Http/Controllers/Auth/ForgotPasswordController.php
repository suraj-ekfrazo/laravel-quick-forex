<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\AgentUsers;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class ForgotPasswordController extends Controller
{
    //

    public function forgotPwd(){
        return view('auth.forgot-password');
    }

    public function sendForgotLink(Request $request) {
        $request->validate([
            'email' => 'required|email|exists:agent_users',
        ]);

        $token = Str::random(64);
        DB::table('password_resets')->where('email',$request->email)->delete();
        DB::table('password_resets')->insert([
            'email' => $request->email,
            'token' => $token,
            'created_at' => Carbon::now()
        ]);
        $result = AgentUsers::where('email', $request->email)->first();

        $sendData = array(
            'email'=>$result->email,
            'name'=>$result->first_name." ".$result->last_name,
            'token'=>$token,
        );
        sendEmail($sendData,"Forgot Password",'mail.forgot');

        return response()->json(array('type' => 'SUCCESS', 'message' => "We have e-mailed your password reset link!"));
    }

    public function showResetPasswordForm($token) {
        $getEmail = DB::table('password_resets')->where('token',$token)->first();
        if(!$getEmail){
            return redirect('/')->with('message', 'Invalid token! unable to reset password.');
        }
        return view('auth.reset-password', ['token'=>$token]);
    }

    public function submitResetPasswordForm(Request $request)
    {
        $request->validate([
            'password' => 'required|string|min:6|confirmed', //This dude
            'password_confirmation' => 'required'
        ]);

        $getEmail = DB::table('password_resets')->where('token',$request->token)->first();
        if(!$getEmail){
            return back()->withInput()->with('error', 'Invalid token!');
        }
        else{
            $oldpassword = AgentUsers::select('password')->where('email',$getEmail->email)->first()->password;
            if (Hash::check($request->password,$oldpassword)) {
                // redirect back with error
                return back()->withInput()->with('error', 'Your new password is too similar to your current password.Please try another password.');
            }
            $user = AgentUsers::where('email', $getEmail->email)->update(['password' => Hash::make($request->password)]);

            DB::table('password_resets')->where(['email'=> $getEmail->email])->delete();
        }
        return redirect('/')->with('message', 'Your password has been changed!');
    }
}
