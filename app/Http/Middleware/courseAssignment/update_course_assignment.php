<?php

namespace App\Http\Middleware\courseAssignment;

use Closure;
use DB;
use Illuminate\Support\Facades\Auth;

class update_course_assignment
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
                    ->where('course_assignment_update', 1)
                    ->first();
        if($check == null){
            return redirect('not_allowed');
        }
        else{
            return $next($request);
        }
    }
}
