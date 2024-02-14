<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
 
    public function __construct()
    {
        $this->middleware('guest:agent_users')->except('logout');
    }

    protected $redirectTo = '/dashboard';
    public function authenticate(Request $request) {

        /*\DB::enableQueryLog(); // Enable query log*/
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => ['required'],
        ]);
        $credentials['status']=1;
        if (Auth::guard('agent_users')->attempt($credentials)) {
            /*dd(\DB::getQueryLog()); // Show results of log*/
            $request->session()->regenerate();

            return redirect()->intended('dashboard');
        }

        return back()->withErrors([
            'login-error' => 'Invalid login credentials',
        ])->onlyInput('email');
    }

    public function logout()
    {
        Session::flush();
        Auth::guard('agent_users')->logout();
        return redirect('/');
    }

    protected function guard()
    {
        return Auth::guard('agent_users');
    }

    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function showCommonLoginForm()
    {
        return view('auth.commonrole');
    }

}
