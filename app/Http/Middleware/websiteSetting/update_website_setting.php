<?php

namespace App\Http\Middleware\websiteSetting;

use Closure;
use DB;
use Illuminate\Support\Facades\Auth;

class update_website_setting
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
                    ->where('website_setting_update', 1)
                    ->first();
        if($check == null){
            return redirect('not_allowed');
        }
        else{
            return $next($request);
        }
    }
}
