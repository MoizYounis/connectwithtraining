<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use DB;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    public function authenticate(Request $request) {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);
        //check authentication 

        if (Auth::guard('web')->attempt(['email' => $request->email, 'password' => $request->password])) {
            return redirect('admin/dashboard')->withSuccess('You are successfully logged in');
        } else {
            //logout
            Auth::guard('web')->logout();
            return redirect()->back()->withInput()->withError('These credentials do not match our records.');
        }
    }

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */

    public function logout(Request $request)
    {
        Auth::guard('web')->logout();
        // $request->session()->flush();
        // $request->session()->regenerate();
        return redirect()->route('admin.login')->withSuccess('Logout successfully');
    }
    

    //protected $redirectTo = 'admin/dashboard';
    public function redirectTo(){
        $userType = DB::table('user_types')->where('id', Auth::user()->user_type_id)->first();
        
        if($userType->type_name == "admin"){
            return 'admin/dashboard';
        }
        else{
            return 'user/dashboard';   
        }
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */

    /**
     * Show the application's login form.
     *
     * @return \Illuminate\Http\Response
     */
    protected function guard()
    {
        return Auth::guard('admin');
    }
    
    public function showLoginForm()
    {
        return view('admin.auth.login');
    }


    public function __construct()
    {
        $this->middleware('guest:admin')->except('logout');
    }
}
