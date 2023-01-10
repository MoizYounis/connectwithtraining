<?php

namespace App\Http\Middleware;

use Closure;
use DB;
use Illuminate\Support\Facades\Auth;

class Superadmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if(!Auth::user()){
            Auth::guard('web')->logout();
            return redirect('login');
        }
        else{
            $userType = DB::table('user_types')->where('id', Auth::user()->user_type_id)->first();
            //echo $userType->type_name;exit;
            if ( $userType->type_name != 'user' ){
                Auth::user()->userType = $userType->type_name;
                return $next($request);
            }
            else{
                //Auth::guard('web')->logout();
                return redirect('login')->withError('You are now allowed to access this page');
            }
        }
    }
}
