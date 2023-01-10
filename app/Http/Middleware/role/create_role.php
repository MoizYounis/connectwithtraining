<?php

namespace App\Http\Middleware\role;

use Closure;
use DB;
use Illuminate\Support\Facades\Auth;

class create_role
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
        $check =  DB::table('permissions')
                    ->where('user_type_id', Auth()->user()->user_type_id)
                    ->where('role_create', 1)
                    ->first();
        if($check == null){
            return redirect('not_allowed');
            //return redirect()->back()->withInput()->withErrors('Permission Not Allowed');
        }
        else{
            return $next($request);
        }
    }
}
