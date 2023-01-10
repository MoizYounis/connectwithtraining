<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\User; 
use Illuminate\Support\Facades\Auth;
use Validator;
use Illuminate\Http\Request;
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

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
     
    public function logout(Request $request)
    {
        $this->guard()->logout();
        $request->session()->invalidate();
        return $this->loggedOut($request) ?: redirect()->back();
    }
    
    protected $redirectTo = 'user/dashboard';

    /**
     * Create a new controller instance.
     *
     * @return void
     */

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
    
    public function authenticate(Request $request) {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);
        $email = $request->get('email');
        $password = $request->get('password');
        //check authentication 
        if (Auth::guard('web')->attempt(['email' => $email, 'password' => $password, 'status' => 'Active'])) {
            return redirect()->back()->withSuccess('You are successfully logged in');
        } else {
            //logout
            Auth::guard('web')->logout();
            return redirect()->back()->withInput()->withError('These credentials do not match our records.');
        }
    }
}
