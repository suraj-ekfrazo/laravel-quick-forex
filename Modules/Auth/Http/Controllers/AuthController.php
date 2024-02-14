<?php

namespace Modules\Auth\Http\Controllers;

use Illuminate\Support\Facades\Session;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function __construct()
    {
        /*$this->middleware('guest')->except('logout');*/
        $this->middleware('guest')->except('logout');
        /*$this->middleware('guest')->except('logout');*/
    }

    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        return view('auth::index');
    }

    protected $redirectTo = 'admin-login/dashboard';

    public function authenticate(Request $request) {
        $credentials = $request->validate([
            'user_name' => ['required'],
            'password' => ['required'],
        ]);
		$credentials['status']=1;
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return redirect()->intended('admin-login/dashboard');
        }

        return back()->withErrors([
            'login-error' => 'Invalid login credentials',
        ])->onlyInput('user_name');
    }

    public function logout()
    {
        Session::flush();
        Auth::logout();
        return redirect('/admin-login');
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('auth::create');
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
        return view('auth::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        return view('auth::edit');
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
