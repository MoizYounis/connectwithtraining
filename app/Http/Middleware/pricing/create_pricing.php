<?php

namespace App\Http\Middleware\pricing;

use Closure;
use DB;
use Illuminate\Support\Facades\Auth;

class create_pricing
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
                    ->where('pricing_create', 1)
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
